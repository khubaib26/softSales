<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'id'; 
    protected $guarded = [];

    // Client belongs to a brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }

    
    
}
