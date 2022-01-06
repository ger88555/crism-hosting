<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wireguard extends Model
{
    use HasFactory;

    protected $fillable = ['pubkey', 'privkey', 'ready','customer_id','ip'];
    
    protected $casts = [
        'ready' => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
