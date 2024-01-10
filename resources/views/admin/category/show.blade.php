@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Category #{{ $category->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/category') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr><th> Category </th><td> {{ $category->category }} </td></tr><tr><th> Slug </th><td> {{ $category->slug }} </td></tr><tr><th> Is Active </th><td> {{ $category->is_active }} </td></tr>
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

