<?php

namespace App\Http\Controllers\Client;

use App\Models\Year;
use App\Models\Order;
use App\Models\Course;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->order->map(function ($order) {
            $order->unique_courses = $order->course->unique('name');
            return $order;
        });
    
        return view('client.transaction.index',compact('orders'));
    }

    public function create()
    {
        return view('client.transaction.create',[
            'title' => 'Transaction',
            'course' => Course::all(),
            'years' => Year::where('is_published', true)->get(),
        ]);
    }

    public function show($id){
        $order = Order::findOrFail($id);
        $order->unique_courses = $order->course->unique('name');
        $order->unique_child = $order->child->unique('name');
        // return $order;
        return view('client.transaction.show',compact('order'));
    }

    public function store(Request $request){
        $request->validate([
            'course_year' => 'required',
            'child_id' => 'required|array',
            'child_id.*' => 'exists:children,id',
            'course_id' => 'required|array',
            'course_id.*' => 'exists:courses,id',
            'total' => 'required|numeric',
        ]);
        $nowDate = date('Y-m-d');
        $discount_code = $request->discount_code;
        $discount_amount = $request->discount_amount;
        $nowYear = date('Y');
        $use_disc = false;
        $discount_obj = null;

        if ($discount_code) {
            $discount_obj = Discount::where('code', $discount_code)->first();
            if ($discount_obj->status == true && $discount_obj->date_valid >= $nowDate) {
                $use_disc = true;
            }
        } else {
            $discount_obj = null;
        }

        $year_id = $request->course_year;

        foreach ($request->course_id as $course) {
            foreach ($request->child_id as $child) {
                // Check if the combination of course_id, child_id, and year_id already exists in order_items
                $exists = OrderItem::where('course_id', $course)
                    ->where('child_id', $child)
                    ->whereHas('order', function($query) use ($year_id) {
                        $query->where('year_id', $year_id)->where('status', 'payment_received');
                    })
                    ->exists();
        
                if ($exists) {
                    return redirect()->back()->with('error', 'Course already exists for this child and year.');
                } else {
                    // Get the last order in the system
                    $lastOrder = Order::latest()->first();
                    
                    // Generate the new reg_no
                    $nowYear = date('Y');
                    if (!$lastOrder) {
                        $regNo = 'TRX/' . $nowYear . '/00001';
                    } else {
                        $lastOrderId = $lastOrder->id;
                        $regNo = 'TRX/' . $nowYear . '/' . str_pad($lastOrderId + 1, 5, '0', STR_PAD_LEFT);
                    }
        
                    DB::beginTransaction();
                    try {
                        $order = Order::create([
                            'user_id' => auth()->user()->id,
                            'year_id' => $request->course_year,
                            'reg_no' => $regNo,
                            'date_order' => date('Y-m-d'),
                            'total' => $request->total,
                            'status' => 'draft',
                            'discount_id' => $discount_obj ? $discount_obj->id : null,
                            'use_disc' => $use_disc,
                            'discount_amount' => $discount_amount,
                        ]);
        
                        foreach ($request->child_id as $child) {
                            foreach ($request->course_id as $course) {
                                $data2 = [
                                    'order_id' => $order->id,
                                    'child_id' => $child,
                                    'course_id' => $course,
                                    'price' => Course::find($course)->price,
                                ];
                                OrderItem::create($data2);
                            }
                        }
        
                        DB::commit();
                        return redirect()->route('client.transaction')->with('success', 'Order has been successfully created.');
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error('Error creating order: ' . $e->getMessage());
                        return back()->withErrors(['error' => 'An error occurred while creating the order. Please try again.'])->withInput();
                    }
                }
            }
        }
    }

    public function viewUpload($id){
        $order = Order::findOrFail($id);
        return view('client.transaction.upload',compact('order'));
    }

    public function upload(Request $request, $id){
        $request->validate([
            'payment_image' => 'required|mimes:jpeg,jpg,png',
        ]);
    
        $order = Order::findOrFail($id);
    
        if ($request->hasFile('payment_image')) {
            if ($order->payment_image) {
                // unlink(storage_path('app/public/transaction/'.$order->payment_image));
                Storage::delete('public/transaction/' . $order->payment_image);
            }
    
            // Store the new image
            $image = $request->file('payment_image');
            $hashName = $image->hashName();
            $image->storeAs('public/transaction', $hashName);
            $order->payment_image = $hashName;
            $order->status = 'confirmed';
        }
        $order->save();
        return redirect()->route('client.transaction')->with('success', 'Payment proof uploaded successfully.');
    }

    public function cancel($id){
        $order = Order::findOrFail($id);
        if ($order->status == 'draft') {
            $order->status = 'cancelled';
            $order->save();
        }
        return redirect()->route('client.transaction')->with('success', 'Transaction has been successfully cancelled.');
    }

}
