<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

   protected $table = 'brands';
   protected $primaryKey = 'id'; 
   protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class, 'brand_user', 'brand_id', 'user_id');
    }

     // Brand belongs to a team
     public function team()
     {
         return $this->belongsTo(Team::class);
     }

    // Brand has many clients
    public function clients()
    {
        return $this->hasMany(Client::class, 'brand_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'brand_id');
    }

    
}
