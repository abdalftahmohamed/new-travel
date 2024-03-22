<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\AttachmentVideo;
use App\Models\Company;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class BlogController extends Controller
{

    use ImageTrait;
    public function index()
    {
        $blogs = Blog::get();
        return view('pages.blog.index', compact('blogs'));
    }


    public function create()
    {
        $trips = Trip::get();
        return view('pages.blog.create', compact('trips'));
    }

    public function store(Request $request)
    {
//        return $request;
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'images[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'videos[]' => 'nullable|mimetypes:video/*|max:50048',
                'documents[]' => 'nullable|mimes:pdf,doc,docx|max:50048',
            ]);

            $blogData = [
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
            ];

            $blog = Blog::create($blogData);

            if ($request->filled('trip_id')) {
                $blog->tripShow()->syncWithoutDetaching($validatedData['trip_id']);
            }
            if ($request->hasFile('image_path')) {
                $blog_image = $this->saveImage($request->file('image_path'), 'attachments/blogs/' . $blog->id);
                $blog->image_path = $blog_image;
                $blog->save();
            }

            if ($request->hasfile('images') || $request->hasfile('video') || $request->hasfile('documents')) {
                $Attachment = new Attachment();
                $Attachment->blog_id = $blog->id;
                $Attachment->save();

                // insert video
                if ($request->hasfile('videos')) {
                    foreach ($request->file('videos') as $value) {
                        $video_path = $this->saveImage($value, 'attachments/videos/blogs/' . $blog->id . '/' . $Attachment->id);
                        // insert in InvoiceMedia
                        $image = new AttachmentVideo();
                        $image->attachment_id = $Attachment->id;
                        $image->video_path = $video_path;
                        $image->save();
                    }
                }

                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value) {
                        $image_path = $this->saveImage($value, 'attachments/images/blogs/' . $blog->id . '/' . $Attachment->id);
                        // insert in InvoiceMedia
                        $image = new AttachmentImage();
                        $image->attachment_id = $Attachment->id;
                        $image->image_path = $image_path;
                        $image->save();
                    }
                }

                // insert img
                if ($request->hasfile('documents')) {
                    foreach ($request->file('documents') as $value) {
                        $document_path = $this->saveImage($value, 'attachments/documents/blogs/' . $blog->id . '/' . $Attachment->id);
                        // insert in InvoiceMedia
                        $image = new AttachmentDocument();
                        $image->attachment_id = $Attachment->id;
                        $image->document = $document_path;
                        $image->save();
                    }
                }
            }



            $addressLists = json_decode($request->input('List_Address'), true);
            if ($addressLists !== null) {
                foreach ($addressLists as $address) {
                    $blog->addresses()->create([
                        'name'=>['ar'=>$address['name_address_ar'],'en'=>$address['name_address_en'],'ur'=>$address['name_address_ur'],],
                        'description'=>['ar'=>$address['description_address_ar'],'en'=>$address['description_address_en'],'ur'=>$address['description_address_ur'],],
                    ]);
                }
            }

            DB::commit();

            session()->flash('message', 'Blog Created Successfully');
            return redirect()->route('admin.blog.index');
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
        $blog = Blog::findOrFail($id);
        $invoices = $blog->invoices()->get();
        $quotes = $blog->quotes()->get();
        $projects = $blog->projects()->get();
        return view('pages.blog.show', compact('projects', 'invoices', 'quotes', 'blog'));
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $trips = Trip::get();
        return view('pages.blog.edit', compact('trips','blog'));
    }

    public function update(Request $request)
    {
        try {
            $blog = Blog::findOrFail($request->id);
            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
                'videos.*' => 'nullable|mimetypes:video/*|max:50048',
                'documents.*' => 'nullable|mimes:pdf,doc,docx|max:50048',
            ]);

            $blogData = [
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
            ];

            // Update blog data
            $blog->update($blogData);
            if ($request->filled('trip_id')) {
                $blog->tripShow()->detach();
                $blog->tripShow()->syncWithoutDetaching($validatedData['trip_id']);
            }
            // Handle image update if provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('blogs', $request->id);
                $blog_image = $this->saveImage($request->file('image_path'), 'attachments/blogs/' . $blog->id);
                $blog->image_path = $blog_image;
                $blog->save();
            }

            session()->flash('message', 'Blog updated successfully');
            return redirect()->route('admin.blog.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $blog = Blog::findOrFail($request->id);

            $this->deleteFile('blogs', $request->id);

            $id_attachment = $blog->attachments()->first();

            if ($id_attachment) {

                #Images_Delete
                $images = AttachmentImage::where('attachment_id', $id_attachment->id)->first();
                if ($images) {
                    $this->deleteFile('images/blogs', $request->id . '/' . $id_attachment->id);
                    $images->delete();
                }
                #Document_Delete
                $Documents = AttachmentDocument::where('attachment_id', $id_attachment->id)->first();
                if ($Documents) {
                    $this->deleteFile('documents/blogs', $request->id . '/' . $id_attachment->id);
                    $Documents->delete();
                }
                #Video_Delete
                $videos = AttachmentVideo::where('attachment_id', $id_attachment->id)->first();
                if ($videos) {
                    $this->deleteFile('videos/blogs', $request->id . '/' . $id_attachment->id);
                    $videos->delete();
                }
                $id_attachment->delete();
            }

            // Delete the blog
            $blog->delete();
            session()->flash('message', 'blog Deleted Successfully');
            return redirect()->route('admin.blog.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
