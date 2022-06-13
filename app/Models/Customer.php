<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'email',
        'desired_budget',
        'message',
        'wordpress_profile_status',
        'status'
    ];
}
