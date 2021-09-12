@extends('adminlte.master')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="get">
                        <div class="card-header">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="txtname">ค้นหาจากชื่อผู้จัดส่ง : </label>
                                    <select class="form-control" name="search_emp" id="">
                                        <option value="">กรุณาเลือก</option>
                                            @foreach($empDeliveries as $emp)
                                                <option {{ request()->input('search_emp') == $emp->id ? 'selected' : '' }} value="{{ $emp->id }}">{{ $emp->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtname">ค้นหาจากวันที่ : </label>
                                    <input type='text' name="date_delivery" value="{{ (request()->input('date_delivery') !== NULL ? request()->input('date_delivery') : NULL) }}" autocomplete="off" class="form-control date" placeholder="เลือกวันที่จัดส่ง" id='datetimepicker' />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtname">ค้นหาจากสินค้า : </label>
                                    <select class="form-control" name="search_pro" id="">
                                        <option value="">กรุณาเลือก</option>
                                            @foreach($products as $product)
                                                <option {{ request()->input('search_pro') == $product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 d-flex justify-content-center">
                                            <button type="submit" class="filter btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>&nbsp
                                            <a href="{{url('/')}}"><button type="button" class="btn btn-warning">ล้างคำค้นหา</button></a>&nbsp
                                            <a type="button" href="{{ route('order.create') }}"><button type="button" class="form-control btn-success">เพิ่มรายการสินค้า</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อผู้จัดส่ง</th>
                                    <th>วันที่จัดส่ง</th>
                                    <th>จำนวนออเดอร์</th>
                                    <th>น้ำหนักรวมที่จัดส่ง</th>
                                    <th>ค่าจัดส่ง</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $keyOrder => $item)
                                <tr>
                                    <td>{{ $keyOrder + 1 }}</td>
                                    <td>{{ $item->getEmployeeDelivery->name }}</td>
                                    <td>{{ $item->date_delivery }}</td>
                                    <td>{{ $item->product_amount }} ถุง</td>
                                    <td>{{ $item->product_kg }} กิโลกรัม</td>
                                    <td>{{ $item->price_delivery }} บาท</td>
                                    <td><a type="button" href="{{ url('/order/preview', $item->id) }}"><button type="button" class="form-control btn-warning">รายละเอียด</button></a></td>
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
@section('js')
    <script type="text/javascript">
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'en',
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            minDate: '+1D'
            }
        })
    </script>
@endsection