<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_month',
        'bill_year',
        'amount',
        'status',
        'billable_id',
        'billable_type'
    ];

    public function filter($request) : Collection
    {
        return $this::orderBy('id','desc')
                    ->when($request->status,function(Builder $query) use($request){
                    $query->where('status',$request->status);
                    })
                    ->get();
    }
}
