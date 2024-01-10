<!-- ============================================================== -->
<!-- All SCRIPTS AND JS LINKS BELOW  -->
<!-- ============================================================== -->

<!-- latitude/longitude -->
<form method="post" id="submitLatLong">
@csrf
  <input type="hidden" name="latitude" class="latitude">
  <input type="hidden" name="longitude" class="longitude">
</form>
<!-- latitude/longitude -->

    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/wow.js')}}"></script>
    <script src="{{asset('slick/slick.js')}}"></script>
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/fancybox.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('fontawesome5/font-awesomejs/font.js')}}"></script>
    <script src="https://rawgit.com/seiyria/bootstrap-slider/master/dist/bootstrap-slider.js"></script>


  <!-- Notification JS Below  -->

  <script src="{{ asset('/plugins/vendors/toast-master/js/jquery.toast.js') }}"></script>

  <script>

       $(document).ready(function () {

             @if(\Session::has('message')) 
                  $.toast({
                      heading: 'Success!',
                      position: 'bottom-right',
                      text:  '{{session()->get('message')}}',
                      loaderBg: '#ff6849',
                      icon: 'success',
                      hideAfter: 3000,
                      stack: 6
                  });
              @endif
              
              
              @if(\Session::has('flash_message')) 
                  $.toast({
                      heading: 'Error!',
                      position: 'bottom-right',
                      text:  '{{session()->get('flash_message')}}',
                      loaderBg: '#ff6849',
                      icon: 'error',
                      hideAfter: 3000,
                      stack: 6
                  });
              @endif

              
          })
      
  </script>



  <!-- inquiryFormContact -->
<script type="text/javascript">

$('#inquiryFormContact').submit(function( event ) {

  let form_id = $('#inquiryFormContact');
  var formData = new FormData($(this)[0]);

    event.preventDefault();
    $.ajax({
        url: '{{route('contactUsSubmit')}}',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false, 
        dataType: 'json',
        success: function( _response ){
            // Handle your response..
            console.log(_response.message);
            if(_response.status == true){
              $.toast({
                heading: 'Success!',
                position: 'bottom-right',
                text:  _response.message,
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
              });

              form_id[0].reset();
            }
            else{
              $.toast({
                  heading: 'Error!',
                  position: 'bottom-right',
                  text:  _response.message,
                  loaderBg: '#ff6849',
                  icon: 'error',
                  hideAfter: 3000,
                  stack: 6
                });

            }
            
            
        },
        error: function( _response ){
            // Handle error
            console.log(_response.message);
            $.toast({
              heading: 'Error!',
              position: 'bottom-right',
              text:  _response.message,
              loaderBg: '#ff6849',
              icon: 'error',
              hideAfter: 3000,
              stack: 6
            });
            
        }
    });
});
</script>



<!-- newsletterForm -->
<script type="text/javascript">

$('#newsletterForm').submit(function( event ) {
  let form_id = $('#newsletterForm');
  var formData = new FormData($(this)[0]);

    event.preventDefault();
    $.ajax({
        url: '{{route('newsletterSubmit')}}',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false, 
        dataType: 'json',
        success: function( _response ){
            // Handle your response..
            console.log(_response.message);
            if(_response.status == true){
              $.toast({
                heading: 'Success!',
                position: 'bottom-right',
                text:  _response.message,
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 4000,
                stack: 6
              });

              form_id[0].reset();
            }
            else{
              $.toast({
                  heading: 'Error!',
                  position: 'bottom-right',
                  text:  _response.message,
                  loaderBg: '#ff6849',
                  icon: 'error',
                  hideAfter: 4000,
                  stack: 6
                });

            }
            
            
        },
        error: function( _response ){
            // Handle error
            console.log(_response.message);
            $.toast({
              heading: 'Error!',
              position: 'bottom-right',
              text:  _response.message,
              loaderBg: '#ff6849',
              icon: 'error',
              hideAfter: 4000,
              stack: 6
            });
            
        }
    });
});
</script>


<!-- google_map location -->
{{--<script>

$(document).ready(function(){


getLocation();

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      $.toast({
        heading: 'Error!',
        position: 'bottom-right',
        text:  'Geolocation is not supported by this browser.',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 4000,
        stack: 6
      });

    }
  }

  function showPosition(position) {
    // console.log("Latitude: " + position.coords.latitude);
    // console.log("Longitude: " + position.coords.longitude);

    $('.latitude').val(position.coords.latitude);
    $('.longitude').val(position.coords.longitude);




    // submit form for lat/long
    var url = "{{route('submitLatLong')}}";

    $.ajax({
      type: "POST",
      url: url,
      data:$( "#submitLatLong" ).serialize(),
      dataType: "json", //expect html to be returned                
      success: function (response) {

      }
    });
    // submit form for lat/long

  }



});


</script>--}}
<!-- google_map location -->



<!-- website_color -->

<?php
$theme = DB::table('m_flag')->where('id', '1')->first()->flag_value;
$primary = DB::table('m_flag')->where('id', '2')->first()->flag_value;
$secondary = DB::table('m_flag')->where('id', '3')->first()->flag_value;
?>

<script type="text/javascript">
  $(document).ready(function(){
    var theme = '<?= $theme ?>';
    var primary = '<?= $primary ?>';
    var secondary = '<?= $secondary ?>';
    $('body').css('--theme-color', theme);
    $('body').css('--primary-text-color', primary);
    $('body').css('--secondary-text-color', secondary);
  });
</script>
<!-- website_color -->



