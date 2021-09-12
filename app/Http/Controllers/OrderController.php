<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Model\Order;
use App\Model\Orderdetail;
use App\Model\Product;
use App\Model\EmployeeDelivery;
use Carbon\Carbon;
use DB;

class OrderController extends Controller {

    public function index() {

        $order = new Order;
        $product = new Product;
        $empDelivery = new EmployeeDelivery;

        $inputs = request()->input();

        if (isset($inputs['search_emp']) && !empty($inputs['search_emp'])) {
            $order = $order->where('customer_delivery_id', $inputs['search_emp']);
        }

        if (isset($inputs['date_delivery']) && !empty($inputs['date_delivery'])) {
            $order = $order->whereDate('date_delivery', '=', $inputs['date_delivery']);
        }


        if (isset($inputs['search_pro']) && !empty($inputs['search_pro'])) {
            $idpro = $inputs['search_pro'];
            $order = $order->whereHas('getOrderDetail', function($q) use($idpro){
                $q->where('product_id', $idpro);
            });
        }

        $this->data['products'] = $product->get();
        $this->data['empDeliveries'] = $empDelivery->get();
        $this->data['orders'] = $order->get();

        return view('order.index', $this->data);

    }

    public function create() {

        $product = new Product;
        $employeeDelivery = new EmployeeDelivery;

        $this->data['products'] = $product->get();
        $this->data['employeeDeliveries'] = $employeeDelivery->get();

        return view('order.create', $this->data);
    }

    public function store(Request $req, Order $order, Orderdetail $orderdetail, EmployeeDelivery $employeeDelivery) {

        try {
            DB::beginTransaction();

            $inputs = $req->all();
            $countkm = 0;
            foreach($inputs['kg'] as $kg) {
                $countkm += $kg;
            }

            $countamount = 0;
            foreach($inputs['amount'] as $amount) {
                $countamount += $amount;
            }

            $result_array = array();
            foreach ($inputs['product_id'] as $key=> $val) {
                $result_array[$key] = array($inputs['product_id'][$key],$inputs['kg'][$key],$inputs['amount'][$key]);
            }

            $dataEmpDelivery = $employeeDelivery->find($inputs['customer_delivery_id']);

            $dataOrder['product_amount'] = $countamount;
            $dataOrder['product_kg'] = $countkm;
            $dataOrder['customer_delivery_id'] = $inputs['customer_delivery_id'];
            $dataOrder['price_delivery'] = $dataEmpDelivery->price * $countkm;
            $dataOrder['date_delivery'] = $inputs['date_delivery'];
            $dataOrder['created_at'] = Carbon::now();

            $newObj = $order->create($dataOrder);

            foreach($result_array as $item) {
                $dataOrderDetail['order_id'] = $newObj->id;
                $dataOrderDetail['product_id'] = $item[0];
                $dataOrderDetail['kg'] = $item[1];
                $dataOrderDetail['amount'] = $item[2];

                $orderdetail->create($dataOrderDetail);
            }

            DB::commit();
            return redirect('/');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('warning', $e->getMessage());
        }
    }

    public function preview($id, Orderdetail $orderdetail) {

        $dataDetails = $orderdetail->where('order_id', $id)->get();
        $this->data['orderDetails'] = $dataDetails;

        return view('order.preview', $this->data);
    }
}
