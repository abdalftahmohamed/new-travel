<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\ConfirmRequest;
use App\Http\Resources\Home\ClientResource;
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
                'message' =>__('transMessage.messNotFound'),
            ], 400);
        }
        $codeInsert->generateCode();

        #forget_password Email
        $codeInsert->notify(new ForgetPassword);

        return response()->json([
            'success' => true,
            'message' =>__('transMessage.messSendEmail'),
        ]);
    }

    public function reset(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'code' => 'required|digits:6',
            ]);
            $currentDate = Carbon::now('Africa/Cairo');
            $Client = Client::where([['email', $request->email], ['code', $request->code]])->first();
            if (!$Client) {
                return response()->json([
                    'status' => false,
                    'message' =>__('transMessage.messFailedSendCode'),
                ], 400);
            }

            $token = auth('clientApi')->login($Client);

            $Client->update([
                'expire_at' => $currentDate->addMinutes(5),
                'code'=>null
            ]);
            return response()->json([
                'status' => true,
                'message' =>__('transMessage.messToken'),
                'data'=>[
                    'expire_at' => $currentDate->addMinutes(5),
                    'token' => $token,
                ]
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status' => false,
                'message' =>$exception->getMessage(),
            ], 400);
        }
    }

    public function confirm(ConfirmRequest $request)
    {
        $Client = auth('clientApi')->user();
        if (!$Client) {
            return response()->json([
                'status' => false,
                'message' =>__('transMessage.messFailedSendCode'),
            ], 400);
        }
        // Check if the token has expired
        $expirationTime = Carbon::parse($Client->expire_at);
        if ($expirationTime->isPast()) {
            return response()->json([
                'status' => false,
                'message' => __('transMessage.messExpirationTime'),
            ], 400);
        }

        $Client->update([
            'password' => Hash::make($request->password),
            'code' => null,
            'expire_at' => null,
        ]);
        $token = auth('clientApi')->login($Client);
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messResetPassword'),
            'data'=>[
                'token' => $token,
                'client' => new ClientResource($Client)
            ]
        ]);

    }

    public function updatePassword(ConfirmRequest $request)
    {
        $user = auth('clientApi')->user();
//        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return response([
                'status' => true,
                'message' => __('transMessage.messResetPassword'),
            ]);
//        }
//        return response([
//            'message' => [
//                'en' => 'you should enter the old password',
//                'ar' => 'من فضلك ادخل كلمة المرور القديمة',
//            ],
//            'success' => false,
//        ], 400);

    }

}
