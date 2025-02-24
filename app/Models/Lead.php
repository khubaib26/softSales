<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leads';
    protected $primaryKey = 'id'; 
    protected $guarded = [];

    // public function status()
    // {
    //     return $this->belongsTo(LeadStatus::class);
    // }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Lead ka status
    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'status_id');
    }
}
