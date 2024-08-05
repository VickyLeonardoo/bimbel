<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
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
