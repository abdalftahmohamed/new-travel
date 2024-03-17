<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthClientController extends Controller
{
    use ImageTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:clientApi', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => [
                'ar' => 'البريد الإلكتروني مطلوب',
                'en' => 'The email field is required.'
            ],
            'email.email' => [
                'ar' => 'يرجى إدخال بريد إلكتروني صالح.',
                'en' => 'Please enter a valid email address.'
            ],
            'password.required' => [
                'ar' => 'حقل كلمة المرور مطلوب.',
                'en' => 'The password field is required.'
            ],
            'password.string' => [
                'ar' => 'يرجى إدخال كلمة مرور صالحة.',
                'en' => 'Please enter a valid password.'
            ],
            'password.min' => [
                'ar' => 'يجب أن تتكون كلمة المرور من :min أحرف على الأقل.',
                'en' => 'The password must be at least :min characters.'
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'errors' => $validator->errors(),
            ], 400);
        }

        if (! $token = auth('clientApi')->attempt($validator->validated())) {
            return response()->json([
                'status'=>false,
                'message'=>[
                    'ar'=>'يوجد خطأ في الايميل او كلمة المرور',
                    'en'=>'error with email or password',
                ]
            ], 401);
        }
        $client = auth('clientApi')->user();
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User Show successfully',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'token_type' => 'bearer',
                'access_token' => $token,
                'expires_in' => auth('clientApi')->factory()->getTTL() * 1,
                'client' => new ClientResource($client)
            ]
        ]);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
//        $validator = Validator::make($request->all(), [
//            'name' => ['required', 'max:255'],
//            'email.required' => 'required|string|max:150',
//            'email.email' => 'email',
//            'email.unique' => 'unique:clients',
//            'password' => 'required|string|confirmed|min:6',
//            'phone' => 'nullable|integer',
//            'address' => 'nullable|string',
//            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
//        ]);
//        if($validator->fails()){
////            $errors = $validator->errors();
//            if ($validator->messages()->get("name['required']")){
//                return response()->json([
//                    'ar'=>'من فضلك الاسم مطلوب',
//                    'en'=>'name is required',
//                ], 400);
//            }
//
//            if ($validator->messages()->get('password')){
//                return response()->json([
//                    'ar'=>'يوجد خطأ في كلمة المرور',
//                    'en'=>'password error please try again',
//                ], 400);
//            }
//
//            if ($validator->messages()->get('email.required')){
//                return response()->json([
//                    'ar'=>'يوجد خطأ في البريد الاليكتروني',
//                    'en'=>'email error required please try again',
//                ], 400);
//            }
//
//            if ($validator->messages()->get('email.email')){
//                return response()->json([
//                    'ar'=>'يوجد خطأ في البريد الاليكتروني',
//                    'en'=>'email error email please try again',
//                ], 400);
//            }
//
//            if ($validator->messages()->get('email.unique')){
//                return response()->json([
//                    'ar'=>'يوجد خطأ في البريد الاليكتروني',
//                    'en'=>'email error unique please try again',
//                ], 400);
//            }
//
//            //            return response()->json($validator->errors(), 400);
//
//            return response()->json($validator->messages()->all(), 400);
//        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:clients', 'max:150'],
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'nullable|integer',
            'address' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
        ], [
            'name.required' => ['ar' => 'من فضلك الاسم مطلوب', 'en' => 'Name is required'],
            'name.max' => ['ar' => 'اسم طويل جدا', 'en' => 'Name is too long'],
            'email.required' => ['ar' => 'يجب ادخال البريد الإلكتروني', 'en' => 'Email is required'],
            'email.email' => ['ar' => 'صيغة البريد الإلكتروني غير صحيحة', 'en' => 'Invalid email format'],
            'email.unique' => [
                'ar' => 'البريد الإلكتروني مستخدم مسبقا',
                'en' => 'This email is used'
            ],
            'password.required' => ['ar' => 'يجب ادخال كلمة المرور', 'en' => 'Password is required'],
            'password.min' => ['ar' => 'يجب أن تحتوي كلمة المرور على الأقل 6 أحرف', 'en' => 'Password must be at least 6 characters long'],
            'password.confirmed' => ['ar' => 'تأكيد كلمة المرور غير متطابق', 'en' => 'Password confirmation does not match'],
            'phone.integer' => ['ar' => 'يجب أن يكون الهاتف رقمًا صحيحًا', 'en' => 'Phone must be a valid number'],
            'address.string' => ['ar' => 'يجب أن يكون العنوان نصًا', 'en' => 'Address must be a string'],
            'image_path.image' => ['ar' => 'الملف المرفق يجب أن يكون صورة', 'en' => 'Attached file must be an image'],
            'image_path.mimes' => ['ar' => 'امتداد الملف غير مدعوم. يجب أن يكون jpeg أو png أو jpg أو gif', 'en' => 'File extension not supported. Should be jpeg, png, jpg, or gif'],
            'image_path.max' => ['ar' => 'حجم الملف يجب أن لا يتجاوز 50048 كيلوبايت', 'en' => 'File size must not exceed 50048 kilobytes'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 400);
        }


        $client = Client::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        if ($request->hasFile('image_path')) {
            $client_image = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
            $client->image_path = $client_image;
            $client->save();
        }


        $token = Auth::guard('clientApi')->login($client);
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User successfully registered',
                'ar'=>'تم التسجيل  بنجاح',
            ],
            'data' => [
                'token_type' => 'bearer',
                'access_token' => $token,
                'expires_in' => auth('clientApi')->factory()->getTTL() * 1,
                'client' => new ClientResource($client)
            ]
        ],201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->guard('clientApi')->logout();
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User successfully signed out',
                'ar'=>'تم التسجيل الخروج بنجاح',
            ],
        ]);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
//        return $this->createNewToken(auth('clientApi')->refresh());
        $token=auth('clientApi')->refresh();
        $client = auth('clientApi')->user();

        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User Show successfully',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'token_type' => 'bearer',
                'access_token' => $token,
                'expires_in' => auth('clientApi')->factory()->getTTL() * 14,
                'client' => new ClientResource($client)
            ]
        ]);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User Show successfully',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'client'=>new ClientResource(auth('clientApi')->user())
            ]
        ]);
    }
//    /**
//     * Get the token array structure.
//     *
//     * @param  string $token
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    protected function createNewToken($token){
//        return response()->json([
//            'status' => true,
//            'message' => [
//                'en'=>'User Show successfully',
//                'ar'=>'تم عرض البيانات بنجاح',
//            ],
//            'data' => [
//                'token_type' => 'bearer',
//                'access_token' => $token,
//                'expires_in' => auth('clientApi')->factory()->getTTL() * 60,
//                'client' => auth('clientApi')->user()
//            ]
//        ]);
//    }
}
