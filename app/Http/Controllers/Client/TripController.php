<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Address;
use App\Models\Company;
use App\Models\Department;
use App\Models\Image;
use App\Models\Review;
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
        $trips = Trip::whereStatus(1)->get();
        return view('client.pages.trip.index', compact('trips'));
    }



    public function cartOlder(Request $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
//        attach
        $trip->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->price,
                'date' => $request->date,
            ],
        ]);
        session()->flash('message', 'Trip Added To Cart Successfully');
        return redirect()->route('client.trip.show',$trip->id);
    }

    public function cartYounger(Request $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
//        attach
        $trip->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->young_price,
            ],
        ]);
        session()->flash('message', 'Trip Added To Cart Successfully');
        return redirect()->route('client.trip.show',$trip->id);
    }


    public function create()
    {
        $companys = Company::all();
        $departments = Department::all();
        return view('client.pages.trip.create', compact('companys','departments'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::commit();

            session()->flash('message', 'Trip Created Successfully');
            return redirect()->route('admin.trip.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        $addresses = $trip->addresses()->get();
        $images = $trip->images()->get();
        return view('client.pages.trip.show', compact('images', 'addresses', 'trip'));
    }


    public function rate($id)
    {
        $trip = Trip::findOrFail($id);
        $client = auth('client')->user();
        $review=Review::where([['client_id',$client->id],['trip_id',$trip->id]])->first();
        if ($review){
            return view('client.pages.trip.rateEdit', compact('trip','review'));
        }else{
            return view('client.pages.trip.rateCreate', compact('trip'));
        }
    }


    public function updateRate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'required|string',
                'name_ur' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'stars_numbers' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            if (isset($request->review_id)){
                $review =Review::findOrFail($request->review_id);
                $reviewDataUpdate = [
                    'name' => [
                        'ar' => $validatedData['name_ar'] ?? $review->name['ar'] ?? null,
                        'en' => $validatedData['name_en'] ?? $review->name['en'] ?? null,
                        'ur' => $validatedData['name_ur'] ?? $review->name['ur'] ?? null
                    ],
                    'description' => [
                        'ar' => $validatedData['description_ar'] ?? $review->description['ar'] ?? null,
                        'en' => $validatedData['description_en'] ?? $review->description['en'] ?? null,
                        'ur' => $validatedData['description_ur'] ?? $review->description['ur'] ?? null
                    ],
                    'stars_numbers' => $validatedData['stars_numbers'] ?? $review->stars_numbers,
                    'trip_id' => $validatedData['trip_id'] ?? $review->trip_id,
                    'blog_id' => $validatedData['blog_id'] ?? $review->blog_id,
                    'offer_id' => $validatedData['offer_id'] ?? $review->offer_id,
                ];
                $review->update($reviewDataUpdate);
                if ($request->hasFile('image_path')) {
                    $this->deleteFile('reviews', $review->id);
                    $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                    $review->image_path = $review_image;
                    $review->save();
                }

            }else{
                $reviewDataCrete = [
                    'name' => [
                        'ar' => $validatedData['name_ar'] ?? $validatedData['name_en'] ?? null ,
                        'en' => $validatedData['name_en'] ?? null,
                        'ur' => $validatedData['name_ur'] ?? $validatedData['name_en'] ?? null
                    ],
                    'description' => [
                        'ar' => $validatedData['description_ar'] ?? $validatedData['description_en'] ?? null,
                        'en' => $validatedData['description_en'] ?? null,
                        'ur' => $validatedData['description_ur'] ?? $validatedData['description_en'] ?? null
                    ],
                    'stars_numbers' => $validatedData['stars_numbers'],
                    'trip_id' => $validatedData['trip_id'],
                    'client_id' => auth('client')->user()->id,
                ];
                $review = Review::create($reviewDataCrete);
                if ($request->hasFile('image_path')) {
                    $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                    $review->image_path = $review_image;
                    $review->save();
                }
            }
            toastr()->success('Review Added successfully');
            session()->flash('message', 'Review Added successfully');
            return redirect()->route('client.trip.index');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {

    }

}
