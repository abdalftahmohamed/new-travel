<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\ConfirmRequest;
use App\Models\Client;
use App\Notifications\ForgetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordClientController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $codeInsert = Client::where('email', $request->email)->first();
        if (!$codeInsert) {
            return response()->json([
                'success' => false,
                'message' => [
                    'en' => 'Client Not Found',
                    'ar' => 'لم يوجد مستخدم بهذا الحساب',
                ],
            ], 404);
        }
        $codeInsert->generateCode();

        #forget_password Email
        $codeInsert->notify(new ForgetPassword);


        return response()->json([
            'success' => true,
            'message' => [
                'en' => 'User successfully sent code check it',
                'ar' => 'تم إرسال الرمز بنجاح',
            ],
        ], 201);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);
        $currentDate = Carbon::now('Africa/Cairo');
        $Client = Client::where([['email', $request->email], ['code', $request->code]])->first();
        if (!$Client) {
            return response()->json([
                'success' => false,
                'message' => [
                    'en' => 'Invalid verification code. Please try again.',
                    'ar' => 'هذا الرمز غير صالح يرجي التحقق مره أحري',
                ],
            ], 502);
        }

        $token = auth('clientApi')->login($Client);

        $Client->update([
            'expire_at' => $currentDate->addMinutes(5),
            'code'=>null
        ]);
        return response()->json([
            'success' => true,
            'message' => [
                'en' => 'Token',
                'ar' => 'التوكـــن',
            ],
            'token' => $token,
            'expire_at' => $currentDate->addMinutes(5)
        ]);

    }

    public function confirm(ConfirmRequest $request)
    {
        $Client = auth('clientApi')->user();
        if (!$Client) {
            return response()->json([
                'success' => false,
                'message' => [
                    'en' => 'Invalid verification code. Please try again.',
                    'ar' => 'هذا الرمز غير صالح يرجي التحقق مره أحري',
                ],
            ], 502);
        }
        // Check if the token has expired
        $expirationTime = Carbon::parse($Client->expire_at);
        if ($expirationTime->isPast()) {
            return response()->json([
                'success' => false,
                'message' => [
                    'en' => 'The verification token has expired. Please request a new one.',
                    'ar' => 'انتهت صلاحية الرمز. يرجى طلب رمز جديد.',
                ],
            ], 502);
        }

        $Client->update([
            'password' => Hash::make($request->password),
            'code' => null,
            'expire_at' => null,
        ]);
        return response([
            'success' => false,
            'message' => [
                'en' => 'Password reset successfully',
                'ar' => 'تم تغيير كلمة المرور بنجاح',
            ],

        ]);

    }

    public function updatePassword(ConfirmRequest $request)
    {
        $user = auth('clientApi')->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return response([
                'message' => [
                    'en' => 'Password update successfully',
                    'ar' => 'تم تغيير كلمة المرور بنجاح',
                ],
                'success' => true,
            ]);
        }
        return response([
            'message' => [
                'en' => 'you should enter the old password',
                'ar' => 'من فضلك ادخل كلمة المرور القديمة',
            ],
            'success' => false,
        ], 502);

    }

}
