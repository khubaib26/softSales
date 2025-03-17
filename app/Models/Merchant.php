<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'merchants';
    protected $primaryKey = 'id'; 
    protected $guarded = [];

    public function gateway()
    {
        return $this->hasMany(PaymentGateway::class);
    }  

    // Merchant has many PaymentGateways
    public function paymentGateways()
    {
        return $this->hasMany(PaymentGateway::class, 'merchant_id');
    }
}
