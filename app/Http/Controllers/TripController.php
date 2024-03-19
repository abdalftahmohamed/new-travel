<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Address;
use App\Models\Company;
use App\Models\Department;
use App\Models\Image;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class TripController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $trips = Trip::get();
        return view('pages.trip.index', compact('trips'));
    }


    public function create()
    {
        $companys = Company::all();
        $departments = Department::all();
        return view('pages.trip.create', compact('companys','departments'));
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
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'type' => 'nullable|string',
                'location' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'department_id' => 'nullable|integer|exists:departments,id',
                'company_id' => 'nullable|integer|exists:companies,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $tripData = [
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
                'trip_description' => [
                    'ar' => $validatedData['description_ar'],
                    'en' => $validatedData['description_en'],
                    'ur' => $validatedData['description_ur']
                ],
                'old_price' => $validatedData['old_price'],
                'young_price' => $validatedData['young_price'],
                'type' => $validatedData['type'],
                'location' => $validatedData['location'],
                'status' => $validatedData['status'],
                'department_id' => $validatedData['department_id'],
                'company_id' => $validatedData['company_id'],
            ];

            $trip = Trip::create($tripData);

            if ($request->hasFile('image_path')) {
                $trip_image = $this->saveImage($request->file('image_path'), 'attachments/trips/' . $trip->id);
                $trip->image_path = $trip_image;
                $trip->save();
            }

            // insert img
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $value) {
                    $image_path = $this->saveImage($value, 'attachments/images/trips/' . $trip->id);
                    // insert in InvoiceMedia
                    $trip->images()->create([
                        'image_path'=>$image_path,
                    ]);
                }
            }

            $addressLists = json_decode($request->input('List_Address'), true);
            if ($addressLists !== null) {
                foreach ($addressLists as $address) {
                    $trip->addresses()->create([
                        'name'=>['ar'=>$address['name_address_ar'],'en'=>$address['name_address_en'],'ur'=>$address['name_address_ur'],],
                        'description'=>['ar'=>$address['description_address_ar'],'en'=>$address['description_address_en'],'ur'=>$address['description_address_ur'],],
                    ]);
                }
            }

            DB::commit();

            session()->flash('message', 'Trip Created Successfully');
            return redirect()->route('admin.trip.index');
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
        $trip = Trip::findOrFail($id);
        $invoices = $trip->invoices()->get();
        $quotes = $trip->quotes()->get();
        $projects = $trip->projects()->get();
        return view('pages.trip.show', compact('projects', 'invoices', 'quotes', 'trip'));
    }


    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $companys = Company::all();
        $departments = Department::all();
        return view('pages.trip.edit', compact('trip','companys','departments'));
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'trip_date' => 'nullable|string',
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'name' => 'nullable|string',
                'type' => 'nullable|string',
                'location' => 'nullable|string',
                'trip_description' => 'nullable|string',
                'cus_rating' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'department_id' => 'nullable|integer|exists:departments,id',
                'company_id' => 'nullable|integer|exists:companies,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',

            ]);

            $trip = Trip::findOrFail($request->id);
            $trip->update($validatedData);
            if ($request->hasFile('image_path')) {
                $this->deleteFile('trips',$request->id);
                $trip_image = $this->saveImage($request->file('image_path'), 'attachments/trips/' . $trip->id);
                $trip->image_path = $trip_image;
                $trip->save();
            }
            session()->flash('message', 'trip Updated Successfully');
            return redirect()->route('admin.trip.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Find the trip by ID
            $trip = Trip::findOrFail($request->id);
            $this->deleteFile('trips',$request->id);
            $this->deleteFile('images/trips',$request->id);

            // Delete the trip
            $trip->delete();
            session()->flash('message', 'trip Deleted Successfully');
            return redirect()->route('admin.trip.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
