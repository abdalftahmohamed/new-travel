<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Blog;
use App\Models\Client;
use App\Models\Company;
use App\Models\Offer;
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
        $reviews = Review::get();
        return view('pages.review.index', compact('reviews'));
    }


    public function create()
    {
        $offers = Offer::all();
        $blogs = Blog::all();
        $trips = Trip::all();
        $clients = Client::all();
        return view('pages.review.create', compact('offers','blogs','trips','clients'));
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
                'stars_numbers' => 'nullable|string',
                'client_id' => 'required|integer|exists:clients,id',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'offer_id' => 'nullable|integer|exists:offers,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $reviewData = [
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
                'stars_numbers' => $validatedData['stars_numbers'],
                'client_id' => $validatedData['client_id'],
            ];
            if (isset($request->trip_id)){
                $reviewData['trip_id']=$validatedData['trip_id'];
            }
            if (isset($request->blog_id)){
                $reviewData['blog_id']=$validatedData['blog_id'];
            }
            if (isset($request->offer_id)){
                $reviewData['offer_id']=$validatedData['offer_id'];
            }
            $review = Review::create($reviewData);

            if ($request->hasFile('image_path')) {
                $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                $review->image_path = $review_image;
                $review->save();
            }

            DB::commit();

            session()->flash('message', 'Review Created Successfully');
            return redirect()->route('admin.review.index');
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
        $review = Review::findOrFail($id);
        $invoices = $review->invoices()->get();
        $quotes = $review->quotes()->get();
        $projects = $review->projects()->get();
        return view('pages.review.show', compact('projects', 'invoices', 'quotes', 'review'));
    }


    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $offers = Offer::all();
        $blogs = Blog::all();
        $trips = Trip::all();
        $clients = Client::all();
        return view('pages.review.edit', compact('offers','blogs','trips','clients','review'));
    }

    public function update(Request $request)
    {
        try {
            $review = Review::findOrFail($request->id);
            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'stars_numbers' => 'nullable|string',
                'client_id' => 'required|integer|exists:clients,id',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'offer_id' => 'nullable|integer|exists:offers,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $reviewData = [
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
                'client_id' => $validatedData['client_id'],
                'trip_id' => $validatedData['trip_id'] ?? $review->trip_id,
                'blog_id' => $validatedData['blog_id'] ?? $review->blog_id,
                'offer_id' => $validatedData['offer_id'] ?? $review->offer_id,
            ];

            // Update review data
            $review->update($reviewData);

            // Handle image update if provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('reviews', $review->id);
                $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                $review->image_path = $review_image;
                $review->save();
            }

            session()->flash('message', 'Review updated successfully');
            return redirect()->route('admin.review.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $review = Review::findOrFail($request->id);
            $this->deleteFile('reviews', $request->id);
            // Delete the review
            $review->delete();
            session()->flash('message', 'review Deleted Successfully');
            return redirect()->route('admin.review.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
