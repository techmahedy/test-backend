<?php 

namespace App\Helper;

use App\Models\Bill;

trait Billable
{
    public function hasBill()
    {
        return (bool) $this->bill()->count();
    }

    public function billable()
    {
        return $this->morphTo();
    }

    public function bill()
    {
        return $this->morphOne(Bill::class, 'billable');
    }

    public function saveOrUpdateBill($request)
    {   
        if($this->hasBill()) {
            return $this->bill()->update([
                'bill_month' => $request->address_one,
                'bill_year' => $request->address_two,
                'amount' => $request->state,
                'status' => $request->zip_code
            ]);
        }

        return $this->bill()->create($request->all());
    }
}