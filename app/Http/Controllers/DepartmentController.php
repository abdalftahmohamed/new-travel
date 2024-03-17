<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Company;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class DepartmentController extends Controller
{

    use ImageTrait;
    public function index()
    {
        $departments = Department::get();
        return view('pages.department.index', compact('departments'));
    }


    public function create()
    {
        $companys = Company::all();
        return view('pages.department.create', compact('companys'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'status' => 'nullable|integer',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            $department = Department::create($validatedData);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $department_image = $this->saveImage($request->file('image_path'), 'attachments/departments/' . $department->id);
                $department->image_path = $department_image;
                $department->save();
            }

            DB::commit();
            session()->flash('message', 'Department Created Successfully');
            return redirect()->route('admin.department.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $department = Department::findOrFail($id);
        $invoices = $department->invoices()->get();
        $quotes = $department->quotes()->get();
        $projects = $department->projects()->get();
        return view('pages.department.show', compact('projects', 'invoices', 'quotes', 'department'));
    }


    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('pages.department.edit', compact('department'));
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'department_name' => 'required|string',
                'department_description' => 'nullable|string'
            ]);

            $department = Department::findOrFail($request->id);
            $department->update($validatedData);


            session()->flash('message', 'department Updated Successfully');
            return redirect()->route('admin.department.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $department = Department::findOrFail($request->id);

            $this->deleteFile('departments', $request->id);


            // Delete the department
            $department->delete();
            session()->flash('message', 'department Deleted Successfully');
            return redirect()->route('admin.department.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
