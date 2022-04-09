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

    public function bills()
    {
        return $this->morphMany(Bill::class, 'billable');
    }

    public function saveOrUpdateBill($request)
    {   
        return $this->bill()->create($request);
    }
}