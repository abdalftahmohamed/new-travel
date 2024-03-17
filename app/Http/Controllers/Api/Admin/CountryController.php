<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Traits\ImageTrait;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{
    use ImageTrait;

    public function __construct() {
        $this->middleware('auth:adminApi');
    }

    public function index()
    {
        $countries = Country::get();
        return response()->json([
            'status' => true,
            'message' => 'data successfully show',
            'data' => CountryResource::collection($countries)
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
            $country = Country::create($data);

            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $country_image = $this->saveImage($request->file('image_path'), 'attachments/countrys/' . $country->id);
                $country->image_path = $country_image;
                $country->save();
            }
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'country successfully created',
                'data' => new CountryResource($country),
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
            $country = Country::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Country retrieved successfully',
                'data' => new CountryResource($country)
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Country not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Error occurred while retrieving country',
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
            $country = Country::findOrFail($id);


            $country->update($data);
            // Check if an image was provided
            if ($request->hasFile('image_path')) {
                $this->deleteFile('countrys',$id);
                $country_image = $this->saveImage($request->file('image_path'), 'attachments/countrys/' . $country->id);
                $country->image_path = $country_image;
                $country->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'country updated successfully',
                'data' => new CountryResource($country)
            ], 200);

        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Country not found',
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
            $country = Country::findOrFail($id);
            $this->deleteFile('countrys',$id);

            // Delete the country
            $country->delete();

            return response()->json([
                'status' => true,
                'message' => 'country deleted successfully',
                'data' => []
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Country not found',
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
