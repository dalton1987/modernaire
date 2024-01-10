<?php


// get latitude/longitude from session
$current_location = Session::get('location');


$lat = isset($current_location['latitude']) ? $current_location['latitude'] : 0;

$long = isset($current_location['longitude']) ? $current_location['longitude'] : 0;



// $location = $_GET['filter_location'];

$dealers = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')
->where('latitude', '!=', null)->where('longitude', '!=', null)
->get()
->take(5)
;



foreach ($dealers as $key => $value) {
    $dealer_lat = $value->latitude;
    $dealer_long = $value->longitude;

    if (($lat == $dealer_lat) && ($long == $dealer_long)) {
        return 0;
    }
    else {
        $theta = $long - $dealer_long;

        $dist = sin(deg2rad($lat)) * sin(deg2rad($dealer_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($dealer_lat)) * cos(deg2rad($theta));
        $dist = acos($dist);

        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;


        // $unit = strtoupper($unit);

        // if ($unit == "K") {
        //   return ($miles * 1.609344);
        // } else if ($unit == "N") {
        //   return ($miles * 0.8684);
        // } else {
        //   return $miles;
        // }
    }



}



?>



<div id="map-layer"></div>

<style type="text/css">
    #map-layer {
    margin: 20px 0px;
    max-width:100%;
    min-height: 600;
}
</style>

<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>

   <script type="text/javascript">
    var map;
    var geocoder;       

    function initMap() {

        var mapLayer = document.getElementById("map-layer");
        // var centerCoordinates = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
        var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
        var defaultOptions = { center: centerCoordinates, zoom: 4 }

        map = new google.maps.Map(mapLayer, defaultOptions);
        geocoder = new google.maps.Geocoder();
        

        var count = "{{count($dealers)}}";
   
            

            for (var i = 0; i < 10; i++) {

                geocoder.geocode( { 'address': '$dealers[2]->address' }, function(LocationResult, status) {

          

                    var latitude = "{{$dealers[2]->latitude}}";
                    var longitude = "{{$dealers[2]->longitude}}";



                


                    new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude),
                        map: map,
                        title: '<?php echo $dealers[2]->address; ?>'
                    });
                });
                
            }
            
                         
    }
    </script> 





     