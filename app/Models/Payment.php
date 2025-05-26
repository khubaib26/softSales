<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id'; 
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Invoice belongs to a PaymentGateway
    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'gateway_id');
    }


    
}
