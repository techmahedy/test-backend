<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Helper\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    use HasApiResponse;
    
    public function create(CreateCustomerRequest $request, Customer $customer)
    {   
        DB::beginTransaction();
        try {
            $customer = $customer->saveCustomer($request)
                            ->saveAddress($request);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Customer create action failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpCreated($customer, "Customer created successfully");
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {   
        DB::beginTransaction();
        try {
            $customer = $customer->updateCustomer($customer, $request)
                            ->saveAddress($request);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Customer update action failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpCreated($customer, "Customer updated successfully");
    }

    public function allBills()
    {
        $customer = auth()->guard('customer-api')->user();
        return $customer->bills;
    }
    
}