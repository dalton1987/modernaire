<?php
$theme = DB::table('m_flag')->where('id', '1')->first();
$primary = DB::table('m_flag')->where('id', '2')->first();
$secondary = DB::table('m_flag')->where('id', '3')->first();
?>



@extends('layouts.app')

@push('before-css')
   <link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
  
  <!--c3 CSS -->
  <link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
  <!--Toaster Popup message CSS -->
  <link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
  <!-- Page CSS -->
  <link href="{{asset('plugins/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/vendors/product-slider/product-slider.css')}}">
  <link href="{{asset('plugins/vendors/bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('plugins/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
  <link href="{{asset('plugins/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('plugins/vendors/dropify/dist/css/dropify.min.css')}}">
  <!-- page css -->
  <link href="{{asset('assets/css/pages/file-upload.css')}}" rel="stylesheet">


  <style type="text/css">
    .text-right {
       text-align: unset!important; 
    }


    .color_pallet {
      bottom: 20px;
      left: 20px;
      z-index: 99;
      padding: 12px;
      width: 40%;
      background: #fff;
      box-shadow: 0 0 20px #d3e0fc;
    }

    .color_pallet li {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 10px 0;
    }
    .color_pallet li label{
      color:#f7bb1c;
      font-weight: 600;
      font-size: 17px;
    }


    #btn-primary{
      font-size: 17px!important;
      font-weight: 700;
      padding: 9px 18px!important;
      margin-top: 12px;
      width: 145px;
      background-color: #f7bb1c!important;
      border-color: #f7bb1c!important;
      text-align: center!important;
      margin-right: 30px;
    }

    #btn-primary:hover{
      color: #000!important;
    }


    #resetColor{
      font-size: 17px!important;
      font-weight: 700;
      padding: 9px 18px!important;
      margin-top: 12px;
      width: 145px;
      text-align: center!important;
    }

    #resetColor:hover{
      color: #000!important;
    }

    .form_btn{
      display: inline-flex;
    }

  </style>

@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid logo">

      <div class="row">
      <!-- Column -->
      <div class="col-lg-12 col-md-12">
        
        <div class="card">
          <div class="card-body">
            <h3>Website Color Theme</h3>
            <div class="clearfix"></div>
            <hr>

            <ul class="color_pallet">
              <li>
                  <label for="theme-color">Select your Theme Color:</label>
                  <input type="color" id="theme-color" name="theme-color" value="{{$theme->flag_value}}">
                  
              </li>
              <li>
                  <label for="primary-text-color">Select your Primary Font Color:</label>
                  <input type="color" id="primary-text-color" name="primary-text-color" value="{{$primary->flag_value}}">
                  
              </li>
              <li>
                  <label for="secondary-text-color">Select your Secondary Font Color:</label>
                  <input type="color" id="secondary-text-color" name="secondary-text-color" value="{{$secondary->flag_value}}">
                  
              </li>

              <div class="row m-b-15">
                <div class="col-lg-4 col-md-4 text-right">

                  <form method="post" action="{{route('website_color_update')}}">
                  @csrf

                    <input type="hidden" name="theme-color" class="theme-color-input">
                    <input type="hidden" name="primary-text-color" class="primary-text-color-input">
                    <input type="hidden" name="secondary-text-color" class="secondary-text-color-input">


                    <div class="form_btn">
                      <button id="btn-primary" type="submit" class="btn btn-lg btn-primary text-right">Update</button>
                      <a href="{{route('reset_color')}}" id="resetColor" class="btn btn-lg btn-primary text-right">Reset</a>
                    </div>


                  </form>

                  
                </div>
              </div>


          </ul>
   
      
        </div>
    
      </div>
    </div>
       
    </div>
</div>
@endsection

@push('js')
  <!-- ============================================================== -->
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
  <!-- Tag input Jquery -->
  <script src="{{asset('plugins/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('plugins/vendors/switchery/dist/switchery.min.js')}}"></script>
  <script>
      $(function() {
          // Switchery
          var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
          $('.js-switch').each(function() {
              new Switchery($(this)[0], $(this).data());
          });

      });
  </script>
  <!-- product jquery -->
  <script src="{{asset('plugins/vendors/product-slider/product-slider.js')}}"></script>
  <script src="{{asset('plugins/vendors/product-slider/product-slider.init.js')}}"></script>
  <!-- jQuery file upload -->
  <script src="{{asset('plugins/vendors/dropify/dist/js/dropify.min.js')}}"></script>
  <script>
      $(function() {
          // Basic
          $('.dropify').dropify();

          // Translated
          $('.dropify-fr').dropify({
              messages: {
                  default: 'Glissez-déposez un fichier ici ou cliquez',
                  replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                  remove: 'Supprimer',
                  error: 'Désolé, le fichier trop volumineux'
              }
          });

          // Used events
          var drEvent = $('#input-file-events').dropify();

          drEvent.on('dropify.beforeClear', function(event, element) {
              return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
          });

          drEvent.on('dropify.afterClear', function(event, element) {
              alert('File deleted');
          });

          drEvent.on('dropify.errors', function(event, element) {
              console.log('Has Errors');
          });

          var drDestroy = $('#input-file-to-destroy').dropify();
          drDestroy = drDestroy.data('dropify')
          $('#toggleDropify').on('click', function(e) {
              e.preventDefault();
              if (drDestroy.isDropified()) {
                  drDestroy.destroy();
              } else {
                  drDestroy.init();
              }
          })
      });
  </script>
  <!-- ============================================================== -->
  <!-- Style switcher -->
  <!-- ============================================================== -->
  <script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>



  <script type="text/javascript">
    $(document).ready(function(){ // <-- use correct syntax
      $('#theme-color').change(function(){ // <-- use change event
        $('.theme-color-input').val($(this).val());
       }); 
       $('#primary-text-color').change(function(){ // <-- use change event
          $('.primary-text-color-input').val($(this).val());
       }); 
       $('#secondary-text-color').change(function(){ // <-- use change event
          $('.secondary-text-color-input').val($(this).val());
       }); 
    });

  </script>
@endpush
