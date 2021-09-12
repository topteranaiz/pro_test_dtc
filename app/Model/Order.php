<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use App\Model\EmployeeDelivery;
use App\Model\Orderdetail;

Class Order extends Model {
    protected $table = 'tb_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'product_amount',
        'product_kg',
        'customer_delivery_id',
        'price_delivery',
        'date_delivery',
        'created_at',
    ];

    public function getEmployeeDelivery() {
        return $this->belongsTo(EmployeeDelivery::class, 'customer_delivery_id', 'id');
    }

    public function getOrderDetail() {
        return $this->hasMany(Orderdetail::class, 'order_id', 'id');
    }
}