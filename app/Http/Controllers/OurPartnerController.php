<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Company;
use App\Models\OurPartner;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class OurPartnerController extends Controller
{

    use ImageTrait;
    public function index()
    {
        $ourPartners = OurPartner::get();
        return view('pages.ourPartner.index', compact('ourPartners'));
    }


    public function create()
    {
        return view('pages.ourPartner.create');
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
            $ourPartner = OurPartner::create($validatedData);
            if ($request->hasFile('image_path')) {
                $ourPartner_image = $this->saveImage($request->file('image_path'), 'attachments/ourPartners/' . $ourPartner->id);
                $ourPartner->image_path = $ourPartner_image;
                $ourPartner->save();
            }

            DB::commit();
            session()->flash('message', 'OurPartner Created Successfully');
            return redirect()->route('admin.ourPartner.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $ourPartner = OurPartner::findOrFail($id);
        $invoices = $ourPartner->invoices()->get();
        $quotes = $ourPartner->quotes()->get();
        $projects = $ourPartner->projects()->get();
        return view('pages.ourPartner.show', compact('projects', 'invoices', 'quotes', 'ourPartner'));
    }


    public function edit($id)
    {
        $trips = Trip::all();

        $ourPartner = OurPartner::findOrFail($id);
        return view('pages.ourPartner.edit', compact('trips','ourPartner'));
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $ourPartner = OurPartner::findOrFail($request->id);
            $ourPartner->update($validatedData);
            if ($request->hasFile('image_path')) {
                $this->deleteFile('ourPartners',$request->id);
                $ourPartner_image = $this->saveImage($request->file('image_path'), 'attachments/ourPartners/' . $ourPartner->id);
                $ourPartner->image_path = $ourPartner_image;
                $ourPartner->save();
            }

            session()->flash('message', 'ourPartner Updated Successfully');
            return redirect()->route('admin.ourPartner.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $ourPartner = OurPartner::findOrFail($request->id);

            $this->deleteFile('ourPartners',$request->id);


            // Delete the ourPartner
            $ourPartner->delete();
            session()->flash('message', 'ourPartner Deleted Successfully');
            return redirect()->route('admin.ourPartner.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
