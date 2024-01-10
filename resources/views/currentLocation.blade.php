<?php


// get latitude/longitude from session
$current_location = Session::get('location');


$lat = isset($current_location['latitude']) ? $current_location['latitude'] : 0;

$long = isset($current_location['longitude']) ? $current_location['longitude'] : 0;



// $location = $_GET['filter_location'];

$dealers = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')
->where('latitude', '!=', null)->where('longitude', '!=', null)
->get()
->take(13)
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
        var centerCoordinates = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
        // var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
        var defaultOptions = { center: centerCoordinates, zoom: 4 }

        map = new google.maps.Map(mapLayer, defaultOptions);
        geocoder = new google.maps.Geocoder();
        
        <?php
        if (! empty($dealers)) {
            foreach ($dealers as $k => $v) {

                if($v->latitude != '' || $v->longitude != ''){



                    ?>  
                        geocoder.geocode( { 'address': '<?php echo $dealers[$k]->address.' '.$dealers[$k]->city.' '.$dealers[$k]->state.' '.$dealers[$k]->zip_code; ?>' }, function(LocationResult, status) {

                      
                            console.log(LocationResult);

                            if (status == google.maps.GeocoderStatus.OK) {
                                var latitude = LocationResult[0].geometry.location.lat();
                                var longitude = LocationResult[0].geometry.location.lng();


                            }

                           console.log(latitude+'   '+longitude);

                                    new google.maps.Marker({
                                    position: new google.maps.LatLng(latitude, longitude),
                                    map: map,
                                    title: '<?php echo $dealers[$k]->address.' '.$dealers[$k]->city.' '.$dealers[$k]->state.' '.$dealers[$k]->zip_code; ?>'
                                });
                        });
                    <?php
                }
                else{ ?>

                 

                <?php
                }
            }
        }
        ?>      
    }
    </script> 





    