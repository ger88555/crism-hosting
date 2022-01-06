<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $casts = [
        'hosting'   => 'boolean',
        'domain'    => 'boolean',
        'email'     => 'boolean',
        'wireguard'       => 'boolean',
    ];
    
    protected $fillable = ['name', 'email', 'wireguard', 'domain', 'hosting', 'hosting_space'];

    public function customers()
    {
        return $this->hastMany(Customer::class);
    }
}
