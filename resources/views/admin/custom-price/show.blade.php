@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">CustomPrice #{{ $customprice->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/custom-price') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $customprice->id }}</td>
                            </tr>
                            <tr><th> Product Id </th><td> {{ $customprice->product_id }} </td></tr><tr><th> Attribute Id </th><td> {{ $customprice->attribute_id }} </td></tr><tr><th> Value Price </th><td> {{ $customprice->value_price }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')
</div>
@endsection

