<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCredit extends Model
{
   use HasFactory, SoftDeletes;

   protected $table = 'user_credits';
   protected $primaryKey = 'id'; 
   protected $guarded = [];

   public function user()
   {
        return $this->belongsTo(User::class);
   }

}
