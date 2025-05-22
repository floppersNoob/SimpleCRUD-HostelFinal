<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'amount_paid', 'payment_method', 'payment_date', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

