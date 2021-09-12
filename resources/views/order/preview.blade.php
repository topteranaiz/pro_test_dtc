@extends('adminlte.master')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">รายการรายละเอียดสินค้า</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <a type="button" href="{{ url('/') }}"><button type="button" class="form-control btn-danger">ย้อนกลับ</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวนสินค้า</th>
                                    <th>จำนวนกิโลกรัม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $keyDetail => $item)
                                <tr>
                                    <td>{{ $keyDetail + 1 }}</td>
                                    <td>{{ $item->getProduct->product_name }}</td>
                                    <td>{{ $item->amount }} ถุง</td>
                                    <td>{{ $item->kg }} กิโลกรัม</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop