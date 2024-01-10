@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Company #{{ $service->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/service') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $service->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $service->name }} </td></tr>
                            
                            <tr><th> Representative Location </th><td> 
                            
                            <?php $rep = explode(',', $service->representative_location); ?>
                            @foreach($rep as $key=>$val)
                            <?php
                            $location = DB::table('representative_locations')->where('id', $val)->first()->Name;
                            ?>
                            {{ $location }} @if(count($rep) > 1 && $key+1 < count($rep)) , @endif
                            @endforeach
                          
                            
                            </td></tr>
                            
                            @if($service->website != '')
                            <tr><th> Website </th><td> {{ $service->website }} </td></tr>
                            @endif
                            
                            
                            <?php
                            $data = json_decode($service->representative);
                            ?>
                            <tr><th> Representations </th><td> 
                            @foreach($data as $rep)
                            <p><span class="rep_label">Name:</span> {{$rep->name}}</p>
                            <p><span class="rep_label">Email:</span> {{$rep->email}}</p>
                            <p><span class="rep_label">Phone:</span> {{$rep->phone}}</p>
                            <hr>
                            @endforeach
                            
                            </td></tr>
                            
                            
                            @if($service->image != '')
                            <tr><th> Logo </th><td> {{ asset($service->image) }} </td></tr>
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


<style>
    .rep_label{
        font-weight: 600;
    }
</style>

