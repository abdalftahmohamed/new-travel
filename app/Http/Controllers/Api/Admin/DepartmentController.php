<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Traits\ImageTrait;
use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    use ImageTrait;

    public function __construct() {
        $this->middleware('auth:adminApi');
    }

    public function index()
    {
        $departments = Department::get();
        return response()->json([
            'status' => true,
            'message' => 'data successfully show',
            'data' => DepartmentResource::collection($departments)
        ], 201);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'error validation',
                    'data' => $validator->errors(),
                ], 501);
            }
            $data = $validator->validated();
            $department = Department::create($data);

            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $department_image = $this->saveImage($request->file('image_path'), 'attachments/departments/' . $department->id);
                $department->image_path = $department_image;
                $department->save();
            }
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'department successfully created',
                'data' => new DepartmentResource($department),
            ], 201);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'error system',
                'data' => $exception->getMessage()
            ], 501);
        }
    }



    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Department retrieved successfully',
                'data' => new DepartmentResource($department)
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Error occurred while retrieving department',
                'data' => $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'error validation',
                    'data' => $validator->errors(),
                ], 501);
            }

            $data = $validator->validated();
            $department = Department::findOrFail($id);


            $department->update($data);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('departments',$id);
                $department_image = $this->saveImage($request->file('image_path'), 'attachments/departments/' . $department->id);
                $department->image_path = $department_image;
                $department->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'department updated successfully',
                'data' => new DepartmentResource($department)
            ], 200);

        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'error system',
                'data' => $exception->getMessage()
            ], 501);
        }
    }

    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $this->deleteFile('departments',$id);

            // Delete the department
            $department->delete();

            return response()->json([
                'status' => true,
                'message' => 'department deleted successfully',
                'data' => []
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'error system',
                'data' => $exception->getMessage()
            ], 501);
        }
    }

}
