<?php 

namespace App\Helper;

use App\Models\Address;

trait Addressable
{
    public function hasAddress()
    {
        return (bool) $this->address()->count();
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function deleteAddress()
    {
        return $this->address()->delete();
    }

    public function saveAddress($request)
    {   
        if($this->hasAddress()) {
            return $this->address()->update([
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'state' => $request->state,
                'zip_code' => $request->zip_code
            ]);
        }

        return $this->address()->create($request->all());
    }
}