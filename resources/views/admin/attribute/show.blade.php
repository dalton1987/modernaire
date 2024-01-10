@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Attribute #{{ $attribute->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/attribute') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $attribute->id }}</td>
                            </tr>
                            <tr><th> Attribute </th><td> {{ $attribute->attribute }} </td></tr><tr><th> Slug </th><td> {{ $attribute->slug }} </td></tr><tr><th> Value </th><td> {{ $attribute->value }} </td></tr>
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

