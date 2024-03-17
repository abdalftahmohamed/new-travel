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
//        return $request;
//        dd($request->List_Image);
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'offer_date' => 'nullable|string',
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'name' => 'nullable|string',
                'offer_description' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'trip_id' => 'nullable|integer|exists:trips,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            $offer = Offer::create($validatedData);


            $addressLists = json_decode($request->input('List_Address'), true);
            if ($addressLists !== null) {
                foreach ($addressLists as $address) {
                    $offer->addresses()->create([
                        'name'=>$address['name_address'],
                        'description'=>$address['description_address'],
                    ]);
                }
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

//            $imageLists = json_decode($request->input('List_Image'), true);
//            if ($imageLists !== null) {
//                foreach ($imageLists as $image) {
////                    dd($image['name_image']);
////                     Check if an image was provided
//                    if ($request->hasFile($image['name_image'])) {
//                        $offer_image = $this->saveImage($request->file($image['name_image']), 'attachments/images/offer/' . $offer->id);
//                        $offer->images()->create([
//                            'image_path'=>$offer_image,
//                            'description'=>$image['description_image'],
//                        ]);
//                    }
//                }
//            }


            DB::commit();

            session()->flash('message', 'Offer Created Successfully');
            return redirect()->route('admin.offer.index');
        } catch (ValidationException $e) {
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
            $validatedData = $request->validate([
                'offer_date' => 'nullable|string',
                'old_price' => 'nullable|string',
                'young_price' => 'nullable|string',
                'name' => 'nullable|string',
                'offer_description' => 'nullable|string',
                'status' => ['nullable', Rule::in([0, 1])],
                'trip_id' => 'nullable|integer|exists:trips,id',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $offer = Offer::findOrFail($request->id);
            $offer->update($validatedData);


            session()->flash('message', 'offer Updated Successfully');
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
