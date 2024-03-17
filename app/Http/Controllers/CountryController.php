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


class CountryController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $countrys = Country::get();
        return view('pages.country.index', compact('countrys'));
    }


    public function create()
    {
        $countries = Countries::all()->pluck('name.common', 'cca2')->values()->toArray();
        return view('pages.country.create',compact('countries'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $country = Country::create($validatedData);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $country_image = $this->saveImage($request->file('image_path'), 'attachments/countrys/' . $country->id);
                $country->image_path = $country_image;
                $country->save();
            }

            DB::commit();

            session()->flash('message', 'Country Created Successfully');
            return redirect()->route('admin.country.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $country = Country::findOrFail($id);
        $invoices = $country->invoices()->get();
        $quotes = $country->quotes()->get();
        $projects = $country->projects()->get();
        return view('pages.country.show', compact('projects', 'invoices', 'quotes', 'country'));
    }


    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $countries = Countries::all()->pluck('name.common', 'cca2')->values()->toArray();
        return view('pages.country.edit', compact('country','countries'));
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);


            $country = Country::findOrFail($request->id);
            $country->update($validatedData);

            if ($request->hasFile('image_path')) {
                $this->deleteFile('countrys',$request->id);

                $country_image = $this->saveImage($request->file('image_path'), 'attachments/countrys/' . $country->id);
                $country->image_path = $country_image;
                $country->save();
            }
            session()->flash('message', 'country Updated Successfully');
            return redirect()->route('admin.country.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Find the country by ID
            $country = Country::findOrFail($request->id);
            $this->deleteFile('countrys',$request->id);

            // Delete the country
            $country->delete();
            session()->flash('message', 'country Deleted Successfully');
            return redirect()->route('admin.country.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
