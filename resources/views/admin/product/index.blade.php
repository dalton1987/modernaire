@extends('layouts.app')

@push('before-css')
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
    <!--c3 CSS -->
    <link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>

    <!-- Date picker plugins css -->
    <link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- page css -->
    <link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-10 no-block">
                            <h5 class="card-title m-b-0 align-self-center">Product Management</h5>
                            <div class="ml-auto text-light-blue">
                                <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12"
                                    role="tablist">
                                    <a href="{{ url('admin/product/create') }}"
                                           class="btn waves-effect waves-light btn-rounded btn-primary">Add Product</a>
                                </ul>
                            </div>
                        </div>
                    @if($product)   
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                
                                 <tr class="text-center">
                                 
                                     <th>#</th>
                                     <th>Product Title</th>
                                     <th>Price</th>
                                     <th>Product Image</th>
                                     <!-- <th>Custom</th> -->
                                     <!-- <th>Featured</th> -->
                                     <th>Type</th>
                                     <th>Status</th>
                                     <th>Reviews</th>
                                
                                    <td class="op-0">&nbsp;</td>
                                    <td class="op-0">&nbsp;</td>
                                    <td class="op-0">&nbsp;</td>
                                </tr>
                             
                                </thead>
                                <tbody>
                                
                                 @foreach($product as $item)    
                                    <tr class="text-center">
                                    
                                        <td>{{ $item->id }}</td>
                                    
                                       <td class="text-dark weight-600"> {{ $item->product_title }} <br>
                                    </td>

                                    <td>${{$item->price}}</td>


                                    <td><img src="{{asset($item->image)}}" alt="" title=""></td>

                                        


                                    <!-- @if($item->is_custom == '1')
                                    <td style="color: green;">Yes</td>
                                    @else
                                    <td style="color: red;">No</td>
                                    @endif -->

                                    <!-- @if($item->is_featured == '1')
                                    <td style="color: green;">Yes</td>
                                    @else
                                    <td style="color: red;">No</td>
                                    @endif -->
                                   
                                    <td class="prodType">@if($item->type == 'product') Hoods @elseif($item->type == 'part') Parts @endif</td>
                                    
                                    @if($item->is_active == '1')
                                    <td style="color: green;">Active</td>
                                    @else
                                    <td style="color: red;">Inactive</td>
                                    @endif

                                        <td class="text-center"><a href="{{ url('/admin/review?id='.$item->id) }}"><i class="fas fa-comment"></i> View Reviews</a></td>


                                        <td class="text-center"><a href="{{ url('/admin/product/' . $item->id) }}"><i class="fas fa-eye"></i></a></td>

                                        <td class="text-center"><a href="{{ url('/admin/product/' . $item->id . '/edit') }}"><i class="fas fa-pencil-alt"></i></a></td>
                                        <td class="text-center">
                                            <a href="{{ route('product.delete', $item->id) }}" onclick='return confirm("Confirm delete?")'><i class="fas fa-trash-alt text-danger"></i></a>
                                        </td>
                                        
                                        
                                    
                                       
                                    </tr>
                                  @endforeach   

                                </tbody>
                            </table>
                            
                        </div>
                     @endif

                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- ============================================================== -->
        <!-- End Info box -->
        <!-- chart box two -->
        <!-- ============================================================== -->
          @include('layouts.admin.footer')
    </div>
@endsection


<style>
    .prodType{
        text-transform: capitalize;
    }
</style>



@push('js')<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--c3 JavaScript -->
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<!--jquery knob -->
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<!--Sparkline JavaScript -->
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<!--Morris JavaScript -->
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<!-- Popup message jquery -->
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>

<script>
    $(function () {
        $('#myTable').DataTable();
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 18,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });

    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>

<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush