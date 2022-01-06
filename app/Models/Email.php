<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['password','customer_id','ready'];

    protected $casts = [
        'ready' => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the username in the conventional e-mail address format.
     *
     * @return void
     */
    public function getFullAddressAttribute()
    {
        return $this->username.'@'.config('services.apache.domain');
    }
}
