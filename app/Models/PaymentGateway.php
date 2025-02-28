<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGateway extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_gateways';
    protected $primaryKey = 'id'; 
    protected $guarded = [];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
