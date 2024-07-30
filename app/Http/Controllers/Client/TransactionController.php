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
            'years' => Year::where('status', 'active')->get(),
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

        $nowYear = date('Y');
        $getRegNoLast = Order::where('user_id', auth()->user()->id)->latest()->first();
        if (!$getRegNoLast) {
            $regNo = 'TRX/' . $nowYear . '/00001';
        } else {
            $regNo = 'TRX/' . $nowYear . '/' . str_pad($getRegNoLast->id + 1, 5, '0', STR_PAD_LEFT);
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


}
