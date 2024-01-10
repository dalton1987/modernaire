@extends('layouts.app')

@push('before-css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Representation Location</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/representative-location/create') }}"><i
                                    class="icon-plus"></i> Add New</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table color-table table-bordered product-table table-hover dataTable no-footer" role="grid" aria-describedby="myTable_info" id="myTable">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th><th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($representativelocation as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->Name }}</td>
                                    
                                    
                                    @if($item->is_active)
                                    <td style="color: green;">Active</td>
                                    @else
                                    <td style="color: red;">Inactive</td>
                                    @endif
                                    
                                    
                                    <td>

                                            {{--<a href="{{ url('/admin/representative-location/' . $item->id) }}"
                                               title="View RepresentativeLocation">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"> </i> View
                                                </button>
                                            </a>--}}

                                        
                                            <a href="{{ url('/admin/representative-location/' . $item->id . '/edit') }}"
                                               title="Edit RepresentativeLocation">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit
                                                </button>
                                            </a>
                                        

                                        
                                            {!! Form::open([
                                       'method'=>'DELETE',
                                       'url' => ['/admin/representative-location', $item->id],
                                       'style' => 'display:inline'
                                   ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete RepresentativeLocation',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $representativelocation->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        
    </div>

@endsection



@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>

@endpush