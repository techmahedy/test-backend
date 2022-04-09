<?php

namespace App\Models;

use App\Helper\Addressable;
use App\Helper\Billable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Addressable, Billable;
    
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password'
    ];

    public function saveCustomer($request) : self
    {   
        $this->user_id = auth()->id();
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->save();
        
        return $this;
    }

    public function updateCustomer($customer, $request) : self
    {   
        $customer->update([
           'name' => $request->name,
           'email' => $request->email
        ]);

        return $this;
    }
}
