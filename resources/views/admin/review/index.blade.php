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
                    <h3 class="box-title pull-left">Review</h3>
                    
<!--                         <a class="btn btn-success pull-right" href="{{ url('/admin/review/create') }}"><i
                                    class="icon-plus"></i> Add Testimonial</a> -->
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table color-table table-bordered product-table table-hover dataTable no-footer" role="grid" aria-describedby="myTable_info" id="myTable">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th><th>Email</th><th>Stars</th><th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($review as $key=>$item)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->star }}<i class="fa fa-star"></i></td>

                                    <!-- @if($item->is_active)
                                    <td style="color: green;">Active</td>
                                    @else
                                    <td style="color: red;">Inactive</td>
                                    @endif -->
                                    <td><select data-id="{{$item->id}}" class="form-control active_status" name="status_update">
                                        <option  
                                         @if($item->is_active == '1') selected @endif value="1">Active</option>
                                        
                                        <option
                                         @if($item->is_active == '0') selected @endif value="0">Inactive</option>
                                    </select></td>

                                    <td>

                                            <a href="{{ url('/admin/review/' . $item->id) }}"
                                               title="View Review">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"> </i> View
                                                </button>
                                            </a>

                                        
                                          <!--   <a href="{{ url('/admin/review/' . $item->id . '/edit') }}"
                                               title="Edit Testimonial">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit
                                                </button>
                                            </a> -->
                                        

                                        
                                            {!! Form::open([
                                       'method'=>'DELETE',
                                       'url' => ['/admin/review', $item->id],
                                       'style' => 'display:inline'
                                   ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Review',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $review->appends(['search' => Request::get('search')])->render() !!} </div>
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



    <script type="text/javascript">
        $('.active_status').change(function() {
            
            if($(this).val() == '1'){
                var id = $(this).data('id');
                var url ='{{ route('status.active',[status_id ]) }}';
                url = url.replace('status_id', id);
                window.location.href = url;
            }
            else if($(this).val() == '0'){
                var id = $(this).data('id');
                var url='{{ route('status.inactive',[status_id ]) }}';
                url = url.replace('status_id', id);
                window.location.href = url;
            }


        });
    </script>

@endpush