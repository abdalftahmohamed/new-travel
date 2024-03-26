<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Department;
use App\Models\Review;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class ReviewController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $client = auth('client')->user();
        $reviews = $client->reviws()->get();
        return view('client.pages.review.index', compact('reviews'));
    }


    public function create()
    {
        $companys = Company::all();
        $departments = Department::all();
        return view('client.pages.review.create', compact('companys','departments'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::commit();

            session()->flash('message', 'Review Created Successfully');
            return redirect()->route('admin.review.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $review = Review::findOrFail($id);
        $addresses = $review->addresses()->get();
        $images = $review->images()->get();
        return view('client.pages.review.show', compact('images', 'addresses', 'review'));
    }


    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $trips = Trip::whereStatus(1)->get();
        $blogs = Blog::get();
        return view('client.pages.review.edit', compact('review','trips','blogs'));
    }


    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'stars_numbers' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
                $review =Review::findOrFail($request->id);
                $reviewDataUpdate = [
                    'name' => [
                        'ar' => $validatedData['name_ar'] ?? $review->name['ar'],
                        'en' => $validatedData['name_en'] ?? $review->name['en'],
                        'ur' => $validatedData['name_ur'] ?? $review->name['ur']
                    ],
                    'description' => [
                        'ar' => $validatedData['description_ar'] ?? $review->description['ar'],
                        'en' => $validatedData['description_en'] ?? $review->description['en'],
                        'ur' => $validatedData['description_ur'] ?? $review->description['ur']
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


            toastr()->success('Review Added successfully');
            session()->flash('message', 'Review Added successfully');
            return redirect()->route('client.review.index');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $this->deleteFile('reviews',$request->id);
        $review->delete();
        toastr()->error('Review Deleted Successfully');
        session()->flash('message', 'Review Deleted Successfully');
        return redirect()->route('client.review.index');
    }

}
