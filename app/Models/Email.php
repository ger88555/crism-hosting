<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['username','password','customer_id','ready'];

    protected $casts = [
        'ready' => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
