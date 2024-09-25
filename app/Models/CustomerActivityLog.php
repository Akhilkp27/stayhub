<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'action', 'description', 'ip_address', 'user_agent',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
