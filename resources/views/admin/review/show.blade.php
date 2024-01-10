@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Review #{{ $review->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/product') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $review->id }}</td>
                            </tr>

                            <tr>
                                <th>User ID</th>
                                <td>{{ $review->user_id }}</td>
                            </tr>


                            <tr><th> Name </th><td> {{ $review->name }} </td></tr>

                            <tr><th> Email </th><td> {{ $review->email }} </td></tr>
                            <tr><th> Stars </th><td> {{ $review->star }}<i class="fa fa-star"></i> </td></tr>

                            <tr><th> Comment </th><td> {{ $review->comments }} </td></tr>
                            <tr><th> Status </th>
                                @if($review->is_active == '1')
                                <td style="color: green;">Active</td>
                                @else
                                <td style="color: red;">Inactive</td>
                                @endif
                            </tr>
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

