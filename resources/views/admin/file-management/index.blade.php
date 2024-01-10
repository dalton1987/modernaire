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
                    <h3 class="box-title pull-left">File Management</h3>
                    
                        {{--<a class="btn btn-success pull-right" href="{{ url('/admin/file-management/create') }}"><i
                                    class="icon-plus"></i> Add File</a>--}}
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table color-table table-bordered product-table table-hover dataTable no-footer" role="grid" aria-describedby="myTable_info" id="myTable">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Page Name</th>
                                <th>Title</th><th>File</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($filemanagement as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id }}</td><td>{{ $item->page_name }}</td>
                                    <td>{{ $item->title }}</td>
                                    
                                    <td>
                                        <a target="_blank" href="{{asset($item->file)}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-file-pdf" aria-hidden="true"> </i> View File
                                        </a>
                                    </td>
                                    
                                    <td>

                                            <!--<a href="{{ url('/admin/file-management/' . $item->id) }}"-->
                                            <!--   title="View FileManagement">-->
                                            <!--    <button class="btn btn-primary btn-sm">-->
                                            <!--        <i class="fa fa-eye" aria-hidden="true"> </i> View-->
                                            <!--    </button>-->
                                            <!--</a>-->

                                        
                                            <a href="{{ url('/admin/file-management/' . $item->id . '/edit') }}"
                                               title="Edit FileManagement">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit
                                                </button>
                                            </a>
                                        

                                        
                                        {{--    {!! Form::open([
                                       'method'=>'DELETE',
                                       'url' => ['/admin/file-management', $item->id],
                                       'style' => 'display:inline'
                                   ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete FileManagement',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        
                                        {!! Form::close() !!}
                                        --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $filemanagement->appends(['search' => Request::get('search')])->render() !!} </div>
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