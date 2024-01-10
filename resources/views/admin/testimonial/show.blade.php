@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Testimonial #{{ $testimonial->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/testimonial') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $testimonial->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $testimonial->title }} </td></tr>

                            <tr><th> Designation </th><td> {{ $testimonial->designation }} </td></tr>

                            <tr><th> Comment </th><td> {{ $testimonial->comment }} </td></tr>
                            <tr><th> Status </th>
                                @if($testimonial->is_active == '1')
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

