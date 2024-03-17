<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Address;
use App\Models\Company;
use App\Models\Department;
use App\Models\Image;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class TripController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $trips = Trip::whereStatus(1)->get();
        return view('client.pages.trip.index', compact('trips'));
    }



    public function cartOlder(Request $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
//        attach
        $trip->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->price,
                'date' => $request->date,
            ],
        ]);
        session()->flash('message', 'Trip Added To Cart Successfully');
        return redirect()->route('client.trip.show',$trip->id);
    }

    public function cartYounger(Request $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
//        attach
        $trip->cartClients()->syncWithoutDetaching([
            auth('client')->user()->id => [
                'total' => $request->young_price,
            ],
        ]);
        session()->flash('message', 'Trip Added To Cart Successfully');
        return redirect()->route('client.trip.show',$trip->id);
    }


    public function create()
    {
        $companys = Company::all();
        $departments = Department::all();
        return view('client.pages.trip.create', compact('companys','departments'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::commit();

            session()->flash('message', 'Trip Created Successfully');
            return redirect()->route('admin.trip.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        $addresses = $trip->addresses()->get();
        $images = $trip->images()->get();
        return view('client.pages.trip.show', compact('images', 'addresses', 'trip'));
    }


    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('client.pages.trip.edit', compact('trip'));
    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }

}
