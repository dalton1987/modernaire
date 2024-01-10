@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Dealer Account #{{ $dealeraccount->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/dealer-account') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $dealeraccount->id }}</td>
                            </tr>
                            <tr><th> Dealer ID </th><td> {{ $dealeraccount->dealer_id }} </td></tr>
                            <tr><th> User ID </th><td> {{ $dealeraccount->user_id }} </td></tr>
                            <tr><th> Name </th><td> {{ $dealeraccount->name }} </td></tr>
                            
                            <tr><th> Email </th><td> {{ $dealeraccount->email }} </td></tr>
                            
                            
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

