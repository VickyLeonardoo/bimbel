<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    
    public function index(){
        return view('admin.discount.index',[
            'title' => 'Discount List',
            'discounts' => Discount::all(),
        ]);
    } 

    public function create(){
        return view('admin.discount.create',[
            'title' => 'Create Discount',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'total' => 'required',
            'type' => 'required',
            'date_valid' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'total' => $request->total,
            'type' => $request->type,
            'date_valid' => $request->date_valid,
        ];

        Discount::create($data);
        return redirect()->route('admin.discount')->with('success','Discount Created Successfully');
    }

    public function edit(Request $request, $id){
        return view('admin.discount.edit',[
            'title' => 'Edit Discount',
            'discount' => Discount::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'total' => 'required',
            'type' => 'required',
            'date_valid' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'total' => $request->total,
            'type' => $request->type,
            'date_valid' => $request->date_valid,
        ];

        Discount::find($id)->update($data);
        return redirect()->route('admin.discount')->with('success','Discount Updated Successfully');
    }

    public function delete(Request $request, $id){
        Discount::find($id)->delete();
        return redirect()->route('admin.discount')->with('success','Discount Deleted Successfully');
    }

    public function updateStatus($id){
        $discount = Discount::find($id);
        $dateNow = Carbon::now();
        if ($discount->status == true) {
            $discount->status = false;
        } else {
            if ($discount->date_valid < $dateNow) {
                return redirect()->back()->with('error','Discount Expired, you need to create a new discount or update the valid date');
            }else{
                $discount->status = true;
            }
        }
        $discount->save();
        return redirect()->route('admin.discount')->with('success','Discount Status Updated Successfully');
    }




    public function checkDiscount(Request $request)
    {
        $code = $request->input('code');
        $discount = Discount::where('code', $code)->first();

        if ($discount && $discount->status && Carbon::now()->lte(Carbon::parse($discount->date_valid))) {
            return response()->json([
                'status' => 'valid',
                'discount' => [
                    'total' => $discount->total,
                    'type' => $discount->type,
                    'date_valid' => $discount->date_valid,
                ],
            ]);
        }

        return response()->json(['status' => 'invalid']);
    }
}
