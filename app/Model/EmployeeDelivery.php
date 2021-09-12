<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

Class EmployeeDelivery extends Model {
    protected $table = 'tb_employee_delivery';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'car_registration',
        'price'
    ];
}