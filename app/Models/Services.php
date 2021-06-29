<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'hostname',
        'status',
        'password',
        'product_id',
        'nodes',
        'register_date',
        'end_date'
    ];

    public $timestamps = false;
    protected $dates = ['register_date', 'end_date'];


    public function product(){

        return $this->belongsTo(\App\Models\Products::class);

    }    public function customer(){

        return $this->belongsTo(\App\Models\User::class);

    }



}
