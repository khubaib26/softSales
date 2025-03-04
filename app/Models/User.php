<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'pseudonym',
        'designation',
        'phone',
        'hod',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function credits()
    {
        return $this->hasMany(UserCredit::class)->latest();
    } 

    public function leads()
    {
        return $this->hasMany(Lead::class);
    } 

     // Converted Leads relationship
    public function convertedLeads()
    {
         return $this->hasMany(Lead::class)->where('status_id', '2');
    }

    // Define the relationship with brands
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_user');
    }

    public function ledTeams()
    {
        return $this->hasMany(Team::class, 'team_lead_id');
    }
}
