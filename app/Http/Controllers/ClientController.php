<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\City;
use App\Models\Company;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class ClientController extends Controller
{

    use ImageTrait;
    public function dashboard()
    {
        return view('client.index');
    }

    public function createLogin()
    {
        return view('pages.client.login');
    }

    public function createRegister()
    {
        return view('client.auth.register');
    }

    public function storeLogin(LoginClientRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::CLIENT);
    }

//    public function storeLogin1(Request $request)
//    {
//        $this->validate($request,[
//            'email' => ['required', 'string', 'email'],
//            'password' => ['required', 'string'],
//        ]);
//        if (Auth::guard('client')->attempt(['status'=>1, 'email'=>$request->email, 'password'=>$request->password,])){
//            $request->session()->regenerate();
//            return redirect()->intended(RouteServiceProvider::CLIENT);
//        }
//        return redirect()->back()->withInput($request->only('email','remember'));
//    }


    public function logout(Request $request)
    {
//        return $request;

        Auth::guard('client')->logout();

//        $request->session()->invalidate();

//        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        $clients = Client::get();
        return view('pages.client.index', compact('clients'));
    }


    public function create()
    {
        $companys = Company::all();
        return view('pages.client.create', compact('companys'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'address_ar' => 'nullable|string',
                'address_en' => 'nullable|string',
                'address_ur' => 'nullable|string',
                'email' => 'required|email|unique:clients',
                'password' => ['required',Password::default()],
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
                'status' => ['required', Rule::in([0,1])],
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $clientData = [
                'name' => [
                    'ar' => $validatedData['name_ar'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_ur']
                ],
                'address' => [
                    'ar' => $validatedData['address_ar'],
                    'en' => $validatedData['address_en'],
                    'ur' => $validatedData['address_ur']
                ],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone' => $validatedData['phone'],
                'status' => $validatedData['status'],
            ];

            $client = Client::create($clientData);

            if ($request->hasFile('image_path')) {
                $client_image = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
                $client->image_path = $client_image;
                $client->save();
            }

            DB::commit();

            session()->flash('message', 'Client Created Successfully');
            return redirect()->route('admin.client.index');
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $client = Client::findOrFail($id);
        $invoices = $client->invoices()->get();
        $quotes = $client->quotes()->get();
        $projects = $client->projects()->get();
        return view('pages.client.show', compact('projects', 'invoices', 'quotes', 'client'));
    }


    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $companys = Company::all();
        return view('pages.client.edit', compact('companys','client'));
    }

    public function update(Request $request)
    {
        try {
            $client = Client::findOrFail($request->id);

            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'address_ar' => 'nullable|string',
                'address_en' => 'nullable|string',
                'address_ur' => 'nullable|string',
                'email' => 'nullable|email|unique:clients,email,' . $client->id,
                'password' => 'nullable|string|min:6',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
                'status' => ['nullable', Rule::in([0,1])],
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $clientData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $client->getTranslation('name','ar'),
                    'en' => $validatedData['name_en'] ?? $client->getTranslation('name','en'),
                    'ur' => $validatedData['name_ur'] ?? $client->getTranslation('name','ur')
                ],

                'email' => $validatedData['email'] ?? $client->email,
                'phone' => $validatedData['phone'] ?? $client->phone,
                'status' => $validatedData['status'] ?? $client->status,
            ];

            if ($request->filled('address_en')||$request->filled('address_ar')||$request->filled('address_ur')){
             $clientData['address']=[
                     'ar' => $validatedData['address_ar'] ?? $client->getTranslation('address','ar'),
                     'en' => $validatedData['address_en'] ?? $client->getTranslation('address','en'),
                     'ur' => $validatedData['address_ur'] ?? $client->getTranslation('address','ur')
             ];
            }
            // Update client data
            if ($request->filled('password')) {
                $clientData['password'] = Hash::make($validatedData['password']);
            }
            $client->update($clientData);

            // Handle image update if provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('clients', $request->id);
                $image_path = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
                $client->image_path = $image_path;
                $client->save();
            }

            // Flash success message and redirect
            session()->flash('message', 'Client updated successfully');
            return redirect()->route('admin.client.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $client = Client::findOrFail($request->id);

            $this->deleteFile('clients', $request->id);


            // Delete the client
            $client->delete();
            session()->flash('message', 'client Deleted Successfully');
            return redirect()->route('admin.client.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request) {
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
                    'ar' => $validatedData['name_en'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_en']
                ],
//                'address' => [
//                    'ar' => $validatedData['address_ar'],
//                    'en' => $validatedData['address_en'],
//                    'ur' => $validatedData['address_ur']
//                ],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
//                'phone' => $validatedData['phone'],
            ];

            $client = Client::create($clientData);

            // If image is provided, save it
            if ($request->hasFile('image_path')) {
                $client_image = $this->saveImage($request->file('image_path'), 'attachments/clients/' . $client->id);
                $client->image_path = $client_image;
                $client->save();
            }

            event(new Registered($client));

            auth('client')->login($client);
            toastr()->success('تم تسجسل الدخول بنجاح');
            return redirect(RouteServiceProvider::CLIENT);

        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }
    }


}
