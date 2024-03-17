<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Traits\ImageTrait;
use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
{
    use ImageTrait;

    public function __construct() {
        $this->middleware('auth:adminApi');
    }

    public function index()
    {
        $citys = City::get();
        return response()->json([
            'status' => true,
            'message' => 'data successfully show',
            'data' => CityResource::collection($citys)
        ], 201);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'country_id' => 'required|integer|exists:countries,id',
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
            $city = City::create($data);

            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
                $city->image_path = $city_image;
                $city->save();
            }
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'city successfully created',
                'data' => new CityResource($city),
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
            $city = City::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'City retrieved successfully',
                'data' => new CityResource($city)
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'City not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Error occurred while retrieving city',
                'data' => $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string',
                'country_id' => 'nullable|integer|exists:countries,id',
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
            $city = City::findOrFail($id);


            $city->update($data);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('citys',$id);
                $city_image = $this->saveImage($request->file('image_path'), 'attachments/citys/' . $city->id);
                $city->image_path = $city_image;
                $city->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'city updated successfully',
                'data' => new CityResource($city)
            ], 200);

        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'City not found',
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
            $city = City::findOrFail($id);
            $this->deleteFile('citys',$id);

            // Delete the city
            $city->delete();

            return response()->json([
                'status' => true,
                'message' => 'city deleted successfully',
                'data' => []
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'City not found',
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
