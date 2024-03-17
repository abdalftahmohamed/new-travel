<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\Client;
use Illuminate\Http\Request;
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
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth('clientApi')->attempt($validator->validated())) {
            return response()->json([
                'status'=>false,
                'message'=>[
                    'ar'=>'يوجد خطأ في الايميل او كلمة المرور',
                    'en'=>'error with email or password',
                ]
            ], 401);        }
//        return $request;
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:150|unique:clients',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'nullable|integer',
            'address' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
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


        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'User successfully registered',
                'ar'=>'تم التسجيل  بنجاح',
            ],
            'client' => new ClientResource($client)
        ], 201);
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
        return $this->createNewToken(auth('clientApi')->refresh());
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
            'data' => new ClientResource(auth('clientApi')->user())
        ], 201);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
//            'expires_in' => auth('clientApi')->factory()->getTTL() * 60,
            'user' => auth('clientApi')->user()
        ]);
    }
}
