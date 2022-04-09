<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helper\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Bill;

class BillController extends Controller
{   
    use HasApiResponse;

    public function bill(Customer $customer, Request $request)
    {  
        $month = Carbon::createFromFormat('d/m/Y', $request->date)->format('F');
        $year = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y');
        
        $request = [
            'bill_month' => $month,
            'bill_year' => $year,
            'amount' => $request->amount,
            'status' => $request->status
        ];

        DB::beginTransaction();
        try {
            $customer = $customer->saveOrUpdateBill($request);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Bill action failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpCreated($customer, "Bill created successfully");
    }

    public function filter(Bill $bill, Request $request)
    {
        return response()->json([
            'data' => $bill->filter($request)
        ],200);
    }
}
