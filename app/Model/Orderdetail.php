<?php

namespace App\Model;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

Class Orderdetail extends Model {
    protected $table = 'tb_order_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'kg',
        'amount',
        'order_id'
    ];

    public function getProduct() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}