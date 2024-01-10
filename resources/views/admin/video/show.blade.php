@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Video #{{ $video->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/video') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $video->id }}</td>
                            </tr>
                            <tr><th> Designed By </th><td> {{ $video->designed_by }} </td></tr>

                            <tr><th> Location </th><td> {{ $video->location }} </td></tr>

                            <tr><th> Thumbnail </th><td> <img src="{{ asset($video->thumbnail) }}" style="widows: 10%;"> </td></tr>

                            <tr><th> Video </th><td> 
                                <video width="320" height="240" controls>
                                  <source src="{{ asset($video->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>
                             </td></tr>
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

