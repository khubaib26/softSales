<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandUser extends Model
{
   use HasFactory;

   protected $table = 'brand_user';
   protected $primaryKey = 'id'; 
   protected $guarded = [];
}
