<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'phone', 'region', 'kebele', 'user_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
