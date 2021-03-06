<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ready', 'customer_id'];

    protected $casts = [
        'ready' => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the absolute URL to this domain.
     *
     * @return void
     */
    public function getAbsoluteUrlAttribute()
    {
        return $this->name.'.'.config('services.apache.domain');
    }
}
