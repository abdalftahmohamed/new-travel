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

    public function store(Request $request)
    {
//        return $request;
//        dd($request);
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'country_id' => 'nullable|integer|exists:countries,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $city = City::create($validatedData);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
                $city->image_path = $city_image;
                $city->save();
            }

            DB::commit();

            session()->flash('message', 'City Created Successfully');
            return redirect()->route('admin.city.index');
        } catch (ValidationException $e) {
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
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'country_id' => 'nullable|integer|exists:countries,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $city = City::findOrFail($request->id);
            $city->update($validatedData);

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
