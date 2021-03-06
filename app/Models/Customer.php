<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'second_last_name',
        'username',
        'password',
        'plan_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function domain()
    {
        return $this->hasOne(Domain::class);
    }

    public function hosting()
    {
        return $this->hasOne(Hosting::class);
    }

    public function email()
    {
        return $this->hasOne(Email::class);
    }

    public function wireguard()
    {
        return $this->hasOne(Wireguard::class);
    }
}
