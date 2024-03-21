<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\AttachmentVideo;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;


class CompanyController extends Controller
{

    use ImageTrait;
    public function index()
    {
        $companys=Company::get();
        return view('pages.company.index', compact('companys'));
    }


    public function create()
    {
        $countries =Country::all();
//        $cities =City::all();
        return view('pages.company.create',compact('countries'));
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
                'email' => 'required|email|unique:companies',
                'password' => ['required',Password::default()],
                'phone' => 'nullable|string',
                'url' => 'nullable|url',
                'status' => ['required', Rule::in([0,1])],
                'country_id' => 'nullable|integer|exists:countries,id',
                'city_id' => 'nullable|integer|exists:cities,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $companyData = [
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
                'url' => $validatedData['url'],
                'status' => $validatedData['status'],
                'country_id' => $validatedData['country_id'],
                'city_id' => $validatedData['city_id'],
            ];

            $company = Company::create($companyData);

            if ($request->hasFile('image_path')) {
                $company_image = $this->saveImage($request->file('image_path'), 'attachments/companys/' . $company->id);
                $company->image_path = $company_image;
                $company->save();
            }

            DB::commit();

            session()->flash('message', 'Company Created Successfully');
            return redirect()->route('admin.company.index');
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
        $company = Company::findOrFail($id);
        $invoices = $company->invoices()->get();
        $quotes = $company->quotes()->get();
        $projects = $company->projects()->get();
        return view('pages.company.show', compact('projects','invoices','quotes','company'));
    }


    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $countries = Country::all();
        return view('pages.company.edit', compact('countries','company'));
    }

    public function update(Request $request)
    {
        try {
            $company = Company::findOrFail($request->id);

            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'address_ar' => 'nullable|string',
                'address_en' => 'nullable|string',
                'address_ur' => 'nullable|string',
                'email' => 'nullable|email|unique:companies,email,'.$company->id,
                'password' => 'nullable|string|min:8', // Adjust minimum length as needed
                'phone' => 'nullable|string',
                'url' => 'nullable|url',
                'status' => ['nullable', Rule::in([0,1])],
                'country_id' => 'nullable|integer|exists:countries,id',
                'city_id' => 'nullable|integer|exists:cities,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $companyData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $company->name['ar'],
                    'en' => $validatedData['name_en'] ?? $company->name['en'],
                    'ur' => $validatedData['name_ur'] ?? $company->name['ur']
                ],
                'address' => [
                    'ar' => $validatedData['address_ar'] ?? $company->address['ar'],
                    'en' => $validatedData['address_en'] ?? $company->address['en'],
                    'ur' => $validatedData['address_ur'] ?? $company->address['ur']
                ],
                'email' => $validatedData['email'] ?? $company->email,
                'phone' => $validatedData['phone'] ?? $company->phone,
                'url' => $validatedData['url'] ?? $company->url,
                'status' => $validatedData['status'] ?? $company->status,
                'country_id' => $validatedData['country_id'] ?? $company->country_id,
                'city_id' => $validatedData['city_id'] ?? $company->city_id,
            ];

            if ($request->filled('password')) {
                $companyData['password'] = Hash::make($validatedData['password']);
            }

            $company->update($companyData);

            if ($request->hasFile('image_path')) {
                $this->deleteFile('companys', $request->id);
                $company_image = $this->saveImage($request->file('image_path'), 'attachments/companys/'.$company->id);
                $company->image_path = $company_image;
                $company->save();
            }

            session()->flash('message', 'Company updated successfully');
            return redirect()->route('admin.company.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Find the company by ID
            $company = Company::findOrFail($request->id);
            $this->deleteFile('companys',$request->id);

            // Delete the company
            $company->delete();
            session()->flash('message', 'company Deleted Successfully');
            return redirect()->route('admin.company.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();

        return response()->json(['cities' => $cities]);
    }

}
