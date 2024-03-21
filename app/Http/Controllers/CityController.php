<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\City;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;


class CityController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $citys = City::get();
        return view('pages.city.index', compact('citys'));
    }


    public function create()
    {
        $countries = Country::all();
        return view('pages.city.create',compact('countries'));
    }

//    public function store(Request $request)
//    {
//        DB::beginTransaction();
//        try {
//            $validatedData1 = $request->validate([
//                'name_ar' => 'required|string',
//                'name_en' => 'required|string',
//                'name_ur' => 'required|string',
//                'description_ar' => 'nullable|string',
//                'description_en' => 'nullable|string',
//                'description_ur' => 'nullable|string',
//            ]);
//            $validatedData = $request->validate([
//                'country_id' => 'nullable|integer|exists:countries,id',
//                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
//            ]);
//
//            $validatedData['name']=['ar' => $request->name_ar, 'en' => $request->name_en, 'ur' => $request->name_or];
//            $validatedData['description']=['ar' => $request->description_ar, 'en' => $request->description_en, 'ur' => $request->description_or];
//
//            $city = City::create($validatedData);
//            // Check if an image was provided
//            if ($request->hasFile('image_path')) {
//                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
//                $city->image_path = $city_image;
//                $city->save();
//            }
//
//            DB::commit();
//
//            session()->flash('message', 'City Created Successfully');
//            return redirect()->route('admin.city.index');
//        } catch (ValidationException $e) {
//            return redirect()->back()->withErrors($e->errors())->withInput();
//        } catch (Exception $e) {
//            DB::rollback();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
//
//    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'country_id' => 'nullable|integer|exists:countries,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $cityData = [
                'name' => [
                    'ar' => $validatedData['name_ar'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_ur']
                ],
                'description' => [
                    'ar' => $validatedData['description_ar'],
                    'en' => $validatedData['description_en'],
                    'ur' => $validatedData['description_ur']
                ],
                'country_id' => $validatedData['country_id']
            ];

            $city = City::create($cityData);

            if ($request->hasFile('image_path')) {
                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
                $city->image_path = $city_image;
                $city->save();
            }

            DB::commit();

            session()->flash('message', 'City Created Successfully');
            return redirect()->route('admin.city.index');
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
        $city = City::findOrFail($id);
        $invoices = $city->invoices()->get();
        $quotes = $city->quotes()->get();
        $projects = $city->projects()->get();
        return view('pages.city.show', compact('projects', 'invoices', 'quotes', 'city'));
    }


    public function edit($id)
    {
        $city = City::findOrFail($id);
        $countries = Country::all();

        return view('pages.city.edit', compact('countries','city'));
    }

    public function update(Request $request)
    {

        try {
            $city = City::findOrFail($request->id);
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'country_id' => 'nullable|integer|exists:countries,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $cityData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $city->getTranslation('name', 'ar'),
                    'en' => $validatedData['name_en'] ?? $city->getTranslation('name', 'en'),
                    'ur' => $validatedData['name_ur'] ?? $city->getTranslation('name', 'ur')
                ],
                'description' => [
                    'ar' => $validatedData['description_ar'] ?? $city->getTranslation('description', 'ar'),
                    'en' => $validatedData['description_en'] ?? $city->getTranslation('description', 'en'),
                    'ur' => $validatedData['description_ur'] ?? $city->getTranslation('description', 'ur')
                ],
                'country_id' => $validatedData['country_id'] ?? $city->country_id
            ];

            $city->update($cityData);

            if ($request->hasFile('image_path')) {
                $this->deleteFile('citys',$request->id);
                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
                $city->image_path = $city_image;
                $city->save();
            }
            session()->flash('message', 'city Updated Successfully');
            return redirect()->route('admin.city.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Find the city by ID
            $city = City::findOrFail($request->id);
            $this->deleteFile('citys',$request->id);

            // Delete the city
            $city->delete();
            session()->flash('message', 'city Deleted Successfully');
            return redirect()->route('admin.city.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
