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
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'name_ur' => 'required|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'status' => 'nullable|integer',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $departmentData = [
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
                'status' => $validatedData['status']
            ];

            $department = Department::create($departmentData);

            if ($request->hasFile('image_path')) {
                $department_image = $this->saveImage($request->file('image_path'), 'attachments/departments/' . $department->id);
                $department->image_path = $department_image;
                $department->save();
            }

            DB::commit();

            session()->flash('message', 'Department Created Successfully');
            return redirect()->route('admin.department.index');
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
//        return $request;
        try {
            $department = Department::findOrFail($request->id);
            $validatedData = $request->validate([
                'name_ar' => 'nullable|string',
                'name_en' => 'nullable|string',
                'name_ur' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'status' => 'nullable|integer',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $departmentData = [
                'name' => [
                    'ar' => $validatedData['name_ar'],
                    'en' => $validatedData['name_en'],
                    'ur' => $validatedData['name_ur']
                ],
                'description' => [
                    'ar' => $validatedData['description_ar'] ?? $department->description['ar'],
                    'en' => $validatedData['description_en'] ?? $department->description['en'],
                    'ur' => $validatedData['description_ur'] ?? $department->description['ur']
                ],
                'status' => $validatedData['status'] ?? $department->status
            ];

            // Update department data
            $department->update($departmentData);

            // Handle image update if provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('departments', $request->id);
                $image_path = $this->saveImage($request->file('image_path'), 'attachments/departments/' . $department->id);
                $department->image_path = $image_path;
                $department->save();
            }

            // Flash success message and redirect
            session()->flash('message', 'Department updated successfully');
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
