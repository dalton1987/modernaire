@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Page #{{ $page->id }}</h3>
               
                        <a class="btn btn-success pull-right" href="{{ url('/admin/page') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                 
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $page->id }}</td>
                            </tr>

                            <tr><th> Page Name </th><td> {{ $page->page_name }} </td></tr>

                            <tr><th> Title </th><td> <?= html_entity_decode($page->title) ?> </td></tr>

                            @if($page->sub_title != '')
                            <tr><th> Sub Title </th><td> <?= html_entity_decode($page->sub_title) ?> </td></tr>
                            @endif

                            @if($page->content != '')
                            <tr><th> Content </th><td> <?= html_entity_decode($page->content) ?> </td></tr>
                            @endif

                            @if($page->extra_content != '')
                            <tr><th> Extra Content </th><td> <?= html_entity_decode($page->extra_content) ?> </td></tr>
                            @endif

                            @if($page->image != '')
                            <tr><th> Image </th><td> <img src="{{ asset($page->image) }}" style="width: 20%;"> </td></tr>
                            @endif

                            @if($page->sub_image != '')
                            <tr><th> Sub Image </th><td> <img src="{{ asset($page->sub_image) }}" style="width: 20%;"> </td></tr>
                            @endif

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

