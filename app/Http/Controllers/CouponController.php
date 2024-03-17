<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Company;
use App\Models\Coupon;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class CouponController extends Controller
{

    use ImageTrait;
    public function index()
    {
        $coupons = Coupon::get();
        return view('pages.coupon.index', compact('coupons'));
    }


    public function create()
    {
        $trips = Trip::all();
        return view('pages.coupon.create', compact('trips'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'coupon_name' => 'required|string',
                'status' => ['required', Rule::in([0,1])],
                'coupon_amount' => 'nullable|numeric',
                'coupon_start' => 'nullable|date',
                'coupon_end' => 'nullable|date',
                'trip_id' => 'nullable|integer|exists:trips,id',
            ]);
            $coupon = Coupon::create($validatedData);
            DB::commit();
            session()->flash('message', 'Coupon Created Successfully');
            return redirect()->route('admin.coupon.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        $invoices = $coupon->invoices()->get();
        $quotes = $coupon->quotes()->get();
        $projects = $coupon->projects()->get();
        return view('pages.coupon.show', compact('projects', 'invoices', 'quotes', 'coupon'));
    }


    public function edit($id)
    {
        $trips = Trip::all();

        $coupon = Coupon::findOrFail($id);
        return view('pages.coupon.edit', compact('trips','coupon'));
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'coupon_name' => 'nullable|string',
                'status' => ['nullable', Rule::in([0,1])],
                'coupon_amount' => 'nullable|numeric',
                'coupon_start' => 'nullable|date',
                'coupon_end' => 'nullable|date',
                'trip_id' => 'nullable|integer|exists:trips,id',
            ]);

            $coupon = Coupon::findOrFail($request->id);
            $coupon->update($validatedData);


            session()->flash('message', 'coupon Updated Successfully');
            return redirect()->route('admin.coupon.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $coupon = Coupon::findOrFail($request->id);

            $this->deleteFile('coupons', $request->id);


            // Delete the coupon
            $coupon->delete();
            session()->flash('message', 'coupon Deleted Successfully');
            return redirect()->route('admin.coupon.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
