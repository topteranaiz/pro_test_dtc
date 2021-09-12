<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

Class Product extends Model {
    protected $table = 'tb_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_name',
    ];
}