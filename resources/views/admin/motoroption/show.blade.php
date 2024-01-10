@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Motor Option #{{ $motoroption->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/motoroption') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $motoroption->id }}</td>
                            </tr>
							
							<? $category_name =  DB::table('categories')->where('deleted_at', NULL)->where('type' , 'motor-option')->where('is_active', 1)->where('id', $motoroption->category)->first();   ?>
                          
						  
							<tr><th> Category </th>
                            <td> {{ $category_name->category }} </td></tr>
							
                            <tr><th> Title </th><td> {{ $motoroption->title }} </td></tr>

                              
                            <!-- <tr><th> Image </th><td> {{ $motoroption->image }} </td></tr> -->

                            <tr><th> Description </th><td> {{ $motoroption->description }} </td></tr>
                            <tr><th> Image </th>
                                <td> <img src="{{ asset($motoroption->image) }}" style="width: 20%;"> </td>
                            </tr>
							
							
							
							<tr>
                                <th> Status </th>
                                @if($motoroption->is_active == '1')
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

