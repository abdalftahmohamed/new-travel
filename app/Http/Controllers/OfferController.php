<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Address;
use App\Models\Company;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class OfferController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $offers = Offer::get();
        return view('pages.offer.index', compact('offers'));
    }


    public function create()
    {
        $trips = Trip::all();
        return view('pages.offer.create', compact('trips'));
    }


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
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'trip_id' => 'nullable|integer|exists:trips,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $offerData = [
                'name' => [
                    'ar' => $validatedData['name_ar'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_ur']
                ],
                'offer_description' => [
                    'ar' => $validatedData['description_ar'],
                    'en' => $validatedData['description_en'],
                    'ur' => $validatedData['description_ur']
                ],
                'old_price' => $validatedData['old_price'],
                'young_price' => $validatedData['young_price'],
                'status' => $validatedData['status'],
                'trip_id' => $validatedData['trip_id']
            ];

            $offer = Offer::create($offerData);

            if ($request->hasFile('image_path')) {
                $offer_image = $this->saveImage($request->file('image_path'), 'attachments/offers/' . $offer->id);
                $offer->image_path = $offer_image;
                $offer->save();
            }
            // insert img
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $value) {
                    $image_path = $this->saveImage($value, 'attachments/images/offers/' . $offer->id);
                    // insert in InvoiceMedia
                    $offer->images()->create([
                        'image_path'=>$image_path,
                    ]);
                }
            }

            $addressLists = json_decode($request->input('List_Address'), true);
            if ($addressLists !== null) {
                foreach ($addressLists as $address) {
                    $offer->addresses()->create([
                        'name'=>['ar'=>$address['name_address_ar'],'en'=>$address['name_address_en'],'ur'=>$address['name_address_ur'],],
                        'description'=>['ar'=>$address['description_address_ar'],'en'=>$address['description_address_en'],'ur'=>$address['description_address_ur'],],
                    ]);
                }
            }
            DB::commit();

            session()->flash('message', 'Offer Created Successfully');
            return redirect()->route('admin.offer.index');
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
        $offer = Offer::findOrFail($id);
        $invoices = $offer->invoices()->get();
        $quotes = $offer->quotes()->get();
        $projects = $offer->projects()->get();
        return view('pages.offer.show', compact('projects', 'invoices', 'quotes', 'offer'));
    }


    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $trips = Trip::all();
        return view('pages.offer.edit', compact('trips','offer'));
    }

    public function update(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id);
            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'trip_id' => 'nullable|integer|exists:trips,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $offerData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $offer->name['ar'],
                    'en' => $validatedData['name_en'] ?? $offer->name['en'],
                    'ur' => $validatedData['name_ur'] ?? $offer->name['ur']
                ],
                'offer_description' => [
                    'ar' => $validatedData['description_ar'] ?? $offer->offer_description['ar'],
                    'en' => $validatedData['description_en'] ?? $offer->offer_description['en'],
                    'ur' => $validatedData['description_ur'] ?? $offer->offer_description['ur']
                ],
                'old_price' => $validatedData['old_price'] ?? $offer->old_price,
                'young_price' => $validatedData['young_price'] ?? $offer->young_price,
                'status' => $validatedData['status'] ?? $offer->status,
                'trip_id' => $validatedData['trip_id'] ?? $offer->trip_id
            ];

            $offer->update($offerData);

            if ($request->hasFile('image_path')) {
                $this->deleteFile('offers', $request->id);
                $offer_image = $this->saveImage($request->file('image_path'), 'attachments/offers/' . $offer->id);
                $offer->image_path = $offer_image;
                $offer->save();
            }

            session()->flash('message', 'Offer updated successfully');
            return redirect()->route('admin.offer.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Find the offer by ID
            $offer = Offer::findOrFail($request->id);
            $this->deleteFile('offers',$request->id);
            $this->deleteFile('images/offers',$request->id);

            // Delete the offer
            $offer->delete();
            session()->flash('message', 'offer Deleted Successfully');
            return redirect()->route('admin.offer.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
