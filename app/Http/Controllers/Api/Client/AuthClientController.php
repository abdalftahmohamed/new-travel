<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthClientController extends Controller
{
    use ImageTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:clientApi', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]
//            , [
//            'email.required' => [
//                'ar' => 'البريد الإلكتروني مطلوب',
//                'en' => 'The email field is required.'
//            ],
//            'email.email' => [
//                'ar' => 'يرجى إدخال بريد إلكتروني صالح.',
//                'en' => 'Please enter a valid email address.'
//            ],
//            'password.required' => [
//                'ar' => 'حقل كلمة المرور مطلوب.',
//                'en' => 'The password field is required.'
//            ],
//            'password.string' => [
//                'ar' => 'يرجى إدخال كلمة مرور صالحة.',
//                'en' => 'Please enter a valid password.'
//            ],
//            'password.min' => [
//                'ar' => 'يجب أن تتكون كلمة المرور من :min أحرف على الأقل.',
//                'en' => 'The password must be at least :min characters.'
//            ],
//        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        if (!$token = auth('clientApi')->attempt($validator->validated())) {
            return response()->json([
                'status' => false,
                'message' => __('transMessage.messErrorPassword'),
            ], 400);
        }
        $client = auth('clientApi')->user();
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
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
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name_ar' => ['nullable', 'max:255'],
                'name_en' => ['required', 'max:255'],
                'name_ur' => ['nullable', 'max:255'],
                'email' => ['required', 'email', 'unique:clients', 'max:150'],
                'password' => ['required', 'string', 'min:6'],
                'phone' => 'nullable|integer',
                'address_ar' => 'nullable|string',
                'address_en' => 'nullable|string',
                'address_ur' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            // No need to check if validation fails as Laravel will automatically handle it

            $clientData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $validatedData['name_en'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_ur'] ?? $validatedData['name_en']
                ],
                'address' => [
                    'ar' => $validatedData['address_ar'] ?? null,
                    'en' => $validatedData['address_en'] ?? null,
                    'ur' => $validatedData['address_ur'] ?? null
                ],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone' => $validatedData['phone'],
            ];


            $client = Client::create($clientData);

            // If image is provided, save it
            if ($request->hasFile('image_path')) {
                $client_image = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
                $client->image_path = $client_image;
                $client->save();
            }

            // Generate token for the newly registered client
            $token = Auth::guard('clientApi')->login($client);

            // Return response with success message and client data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessRegister'),
                'data' => [
                    'token_type' => 'bearer',
                    'access_token' => $token,
                    'expires_in' => auth('clientApi')->factory()->getTTL() * 1,
                    'client' => new ClientResource($client)
                ]
            ], 201);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $client = auth('clientApi')->user();
            $validatedData = $request->validate([
                'name_ar' => ['nullable', 'max:255'],
                'name_en' => ['required', 'max:255'],
                'name_ur' => ['nullable', 'max:255'],
                'email' => ['required', 'email', 'unique:clients,email,' . $client->id, 'max:150'],
                'password' => ['nullable', 'string', 'min:6'],
                'phone' => 'nullable|integer',
                'address_ar' => 'nullable|string',
                'address_en' => 'nullable|string',
                'address_ur' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            $clientData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $client->getTranslation('name', 'ar'),
                    'en' => $validatedData['name_en'] ?? $client->getTranslation('name', 'en'),
                    'ur' => $validatedData['name_ur'] ?? $client->getTranslation('name', 'ur')
                ],
                'address' => [
                    'ar' => $validatedData['address_ar'] ?? $client->getTranslation('address', 'ar'),
                    'en' => $validatedData['address_en'] ?? $client->getTranslation('address', 'en'),
                    'ur' => $validatedData['address_ur'] ?? $client->getTranslation('address', 'ur')
                ],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
            ];

            if (isset($request->password)) {
                $clientData['password'] = Hash::make($validatedData['password']);
            }
            $client->update($clientData);

            // If image is provided, save it
            if ($request->hasFile('image_path')) {
                $this->deleteFile('clients', $client->id);
                $client_image = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
                $client->image_path = $client_image;
                $client->save();
            }


            // Return response with success message and client data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessUpdated'),
                'data' => [
                    'client' => new ClientResource($client)
                ]
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProfile()
    {
        try {
            $client = auth('clientApi')->user();
            $this->deleteFile('clients', $client->id);
            $client->delete();

            // Return response with success message and client data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessDeleted'),
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('clientApi')->logout();
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSignedOut'),
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
//        return $this->createNewToken(auth('clientApi')->refresh());
        $token = auth('clientApi')->refresh();
        $client = auth('clientApi')->user();

        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
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
    public function userProfile()
    {
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'client' => new ClientResource(auth('clientApi')->user())
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
