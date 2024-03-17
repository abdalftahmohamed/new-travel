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
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'stars_numbers' => 'nullable|string',
                'description' => 'nullable|string',
                'client_id' => 'nullable|integer|exists:clients,id',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'offer_id' => 'nullable|integer|exists:offers,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            $review = Review::create($validatedData);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                $review->image_path = $review_image;
                $review->save();
            }

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
            $validatedData = $request->validate([
                'name' => 'required|string',
                'stars_numbers' => 'nullable|string',
                'description' => 'nullable|string',
                'client_id' => 'nullable|integer|exists:clients,id',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'offer_id' => 'nullable|integer|exists:offers,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $review = Review::findOrFail($request->id);
            $review->update($validatedData);
            if ($request->hasFile('image_path')) {
                $this->deleteFile('reviews',$review->id);
                $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                $review->image_path = $review_image;
                $review->save();
            }

            session()->flash('message', 'review Updated Successfully');
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
