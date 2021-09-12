@extends('adminlte.master')

@section('content')
<div class="content-wrapper">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">เพิ่มรายการสินค้า</h3>
            </div>
            <form method="post" action="{{ route('order.store') }}">
                @csrf
                <div class="card-body">
                    <div id="dynamicProduct">
                        <div class="form-group">
                            <div class="row">
                                <label for="seo" class="control-label col-1 text-left">สินค้า :</label>
                                <div class="col-2">
                                    <select class="form-control" name="product_id[]" required id="">
                                        <option value="">กรุณาเลือก</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input name="kg[]" type="text" maxlength="150" class="form-control" required placeholder="กรุณากรอกกิโลกรัม" value="">
                                </div>
                                <div class="col-2">
                                    <input name="amount[]" type="text" maxlength="150" class="form-control" required placeholder="กรุณากรอกจำนวน" value="">
                                </div>
                                <div class="col-1">
                                    <a type="button" id="add_product" class="badge badge-success badge-pill">+</a>
                                </div>
                            </div>
                            <input type="hidden" id="hiddenProductsInput" value="{!! e(json_encode($products)) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="seo" class="control-label col-1 text-left">ผู้จัดส่ง :</label>
                            <div class="col-2">
                                <select class="form-control" name="customer_delivery_id" required id="">
                                    <option value="">กรุณาเลือก</option>
                                        @foreach($employeeDeliveries as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type='text' name="date_delivery" class="form-control date" placeholder="เลือกวันที่จัดส่ง" required id='datetimepicker' />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a type="button" href="{{ url('/') }}"><button type="button" class="form-control btn-danger">ย้อนกลับ</button></a>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript">
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'en',
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            minDate: '+1D'
            }
        })

        $(document).ready(function() {
            var i = 1;
            $('#add_product').click(function() {
                i++;
                var hiddenProductsInput = $( "#hiddenProductsInput" ).val()
                hiddenProductsInput = JSON.parse(hiddenProductsInput)

                var option = ''
                for (let index = 0; index < hiddenProductsInput.length; index++) {
                    var element = hiddenProductsInput[index];
                    option += '<option value="'+element.id+'">' + element.product_name + '</option>'
                }
                var fields =
                    '<div id="row'+i+'" class="form-group">'+
                        '<div class="row">'+
                            '<label for="seo" class="control-label col-1 text-left">สินค้า :</label>'+
                            '<div class="col-2">'+
                                '<select class="form-control" name="product_id[]" required id="">'+
                                    '<option value="">กรุณาเลือก</option>'+
                                    option +
                                '</select>'+
                            '</div>'+
                            '<div class="col-2">'+
                                '<input name="kg[]" type="text" maxlength="150" class="form-control" required placeholder="กรุณากรอกกิโลกรัม" value="">'+
                            '</div>'+
                            '<div class="col-2">'+
                                '<input name="amount[]" type="text" maxlength="150" class="form-control" required placeholder="กรุณากรอกจำนวน" value="">'+
                            '</div>'+
                            '<div class="col-1">'+
                                '<a type="button" id="'+i+'" class="badge badge-danger badge-pill removeProduct">-</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';

                $('#dynamicProduct').append(fields);

            });
            $(document).on('click', '.removeProduct', function() {
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        })
    </script>
@endsection
