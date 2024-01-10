@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Gallery #{{ $gallery->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/gallery') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $gallery->id }}</td>
                            </tr>
                            <tr><th> Image </th><td> <img src="{{ asset($gallery->image) }}" style="width: 20%;"> </td></tr><tr><th> Active </th>

                                @if($gallery->is_active == '1')
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

