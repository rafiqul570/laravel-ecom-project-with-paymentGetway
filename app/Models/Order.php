<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use  Notifiable;

     protected $fillable = [
        'invoice_no', 'user_id', 'amount',
        'payment_method', 'payment_id', 'trx_id', 'status',
    ];

    // ✅ Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relation to OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ✅ Relation to Billing Address
    public function billing()
    {
        return $this->hasOne(Billing::class);
    }
}
