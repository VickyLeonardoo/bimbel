<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
    public function checkDiscount(Request $request)
    {
        $code = $request->input('code');
        $discount = Discount::where('code', $code)->where('status', true)->where('date_valid', '>=', now())->first();

        if ($discount) {
            return response()->json(['status' => 'valid', 'discount' => $discount]);
        } else {
            return response()->json(['status' => 'invalid']);
        }
    }
}
