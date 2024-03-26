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


class BlogController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $blogs = Blog::get();
        return view('client.pages.blog.index', compact('blogs'));
    }



    public function cartOlder(Request $request)
    {
        $blog = Review::findOrFail($request->blog_id);
//        attach
        $blog->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->price,
                'date' => $request->date,
            ],
        ]);
        session()->flash('message', 'Review Added To Cart Successfully');
        return redirect()->route('client.blog.show',$blog->id);
    }

    public function cartYounger(Request $request)
    {
        $blog = Review::findOrFail($request->blog_id);
//        attach
        $blog->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->young_price,
            ],
        ]);
        session()->flash('message', 'Review Added To Cart Successfully');
        return redirect()->route('client.blog.show',$blog->id);
    }


    public function create()
    {
        $companys = Company::all();
        $departments = Department::all();
        return view('client.pages.blog.create', compact('companys','departments'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::commit();

            session()->flash('message', 'Review Created Successfully');
            return redirect()->route('admin.blog.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $blog = Review::findOrFail($id);
        $addresses = $blog->addresses()->get();
        $images = $blog->images()->get();
        return view('client.pages.blog.show', compact('images', 'addresses', 'blog'));
    }


    public function edit($id)
    {
        $blog = Review::findOrFail($id);
        $trips = Trip::whereStatus(1)->get();
        return view('client.pages.blog.edit', compact('blog','trips'));
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
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
                $blog =Review::findOrFail($request->id);
                $blogDataUpdate = [
                    'name' => [
                        'ar' => $validatedData['name_ar'] ?? $blog->name['ar'],
                        'en' => $validatedData['name_en'] ?? $blog->name['en'],
                        'ur' => $validatedData['name_ur'] ?? $blog->name['ur']
                    ],
                    'description' => [
                        'ar' => $validatedData['description_ar'] ?? $blog->description['ar'],
                        'en' => $validatedData['description_en'] ?? $blog->description['en'],
                        'ur' => $validatedData['description_ur'] ?? $blog->description['ur']
                    ],
                    'stars_numbers' => $validatedData['stars_numbers'] ?? $blog->stars_numbers,
                    'trip_id' => $validatedData['trip_id'] ?? $blog->trip_id,
//                    'blog_id' => $validatedData['blog_id'] ?? $blog->blog_id,
//                    'offer_id' => $validatedData['offer_id'] ?? $blog->offer_id,
                ];
                $blog->update($blogDataUpdate);

                if ($request->hasFile('image_path')) {
                    $this->deleteFile('blogs', $blog->id);
                    $blog_image = $this->saveImage($request->file('image_path'), 'attachments/blogs/' . $blog->id);
                    $blog->image_path = $blog_image;
                    $blog->save();
                }


            toastr()->success('Review Added successfully');
            session()->flash('message', 'Review Added successfully');
            return redirect()->route('client.blog.index');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        $blog = Review::findOrFail($request->id);
        $this->deleteFile('blogs',$request->id);
        $blog->delete();
        toastr()->error('Review Deleted Successfully');
        session()->flash('message', 'Review Deleted Successfully');
        return redirect()->route('client.blog.index');
    }


    public function rate($id)
    {
        $blog = Blog::findOrFail($id);
        $client = auth('client')->user();
        $review=Review::where([['client_id',$client->id],['blog_id',$blog->id]])->first();
        if ($review){
            return view('client.pages.blog.rateEdit', compact('blog','review'));
        }else{
            return view('client.pages.blog.rateCreate', compact('blog'));
        }
    }


    public function updateRate(Request $request)
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
                'blog_id' => 'nullable|integer|exists:blogs,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            if (isset($request->review_id)){
                $review =Review::findOrFail($request->review_id);
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
                    'blog_id' => $validatedData['blog_id'] ?? $review->blog_id,
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
                    'blog_id' => $validatedData['blog_id'],
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
            return redirect()->route('client.blog.index');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
