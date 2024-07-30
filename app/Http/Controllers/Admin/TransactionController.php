<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah parameter 'archive' ada dan bernilai true
        $showArchive = $request->has('archive') && $request->archive == 'true';

        // Ambil semua order jika 'archive' dicentang, jika tidak hanya ambil order yang aktif
        if ($showArchive) {
            $orders = Order::orderBy('id', 'desc')->get();
        } else {
            $orders = Order::where('is_active', true)->orderBy('id', 'desc')->get();
        }

        return view('admin.transaction.index', [
            'title' => 'Application List',
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->unique_courses = $order->course->unique('name');
        $order->unique_child = $order->child->unique('name');
        $title = 'Application Detail';
        // return $order;
        return view('admin.transaction.show',compact(['order','title']));

        // return view('admin.transaction.show',[
        //     'title' => 'Application Detail',
        //     'order' => Order::find($id),
        // ]);
    }

    public function setCancel($id){
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        return redirect()->route('admin.transaction', $id)->with('success','Application Cancelled Successfully');
    }

    public function setPaymentReceive($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'payment_received'; 
        $order->save();

        // Pastikan relasi orderItems sudah ada dan didefinisikan di model Order
        foreach ($order->orderItems as $item) {
            $data = [
                'order_id' => $id,
                'course_id' => $item->course_id,
                'year_id' => $order->year_id, // Pastikan year_id ada di orderItems jika diperlukan
                'child_id' => $item->child_id, // Mengambil child_id dari orderItems
                'status' => 'approved'
            ];

            // Simpan data enrollment
            Enrollment::create($data);
        }
        return redirect()->route('admin.transaction')->with('success','Payment Received Successfully');
    }


    public function setArchive($id){
        $order = Order::findOrFail($id);
        $order->is_active = false;
        $order->save();
        return redirect()->route('admin.transaction', $id)->with('success','Application Archived Successfully');
    }

    
}
