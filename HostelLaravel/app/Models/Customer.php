<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Payment;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'room_id', 'check_in_date', 'check_out_date', 
        'total_payment', 'payment_status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id'); 
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
