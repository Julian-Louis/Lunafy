<?php

namespace App\Models;

use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'billing_name',
        'dashboard_display',
        'stock',
        'price',
        'nameserver1',
        'nameserver2',
        'type'

    ];



}
