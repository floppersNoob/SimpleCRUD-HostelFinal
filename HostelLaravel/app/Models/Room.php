<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_number', 'type', 'price_per_night', 'status', 'archived_stat'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'room_id');
    }
}
