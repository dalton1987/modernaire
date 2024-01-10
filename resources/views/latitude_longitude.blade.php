<?php



$dealers = DB::table('dealers')
// ->where('id', '22')
->where('deleted_at', null)->where('is_active', '1')->orderBy('id', 'DESC')
->get()
;


foreach ($dealers as $value) {
	$address = $value->address.' '.$value->city.' '.$value->state.' '.$value->zip_code;
	$output = geoLocate($address);





	$updateDealer[latitude] =  $output[lat];
	$updateDealer[longitude] = $output[long];

	$update = DB::table('dealers')->where('id', $value->id)->update($updateDealer);


}



function geoLocate($address)
{

    try {
        $lat = 0;
        $lng = 0;

        $data_location = "https://maps.google.com/maps/api/geocode/json?key=".env('GOOGLE_API_KEY')."&address=".str_replace(" ", "+", $address)."&sensor=false";

        
        $data = file_get_contents($data_location);
        

        usleep(200000);
        // turn this on to see if we are being blocked
        // echo $data;
        $data = json_decode($data);


        if ($data->status=="OK") {



            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;

            if($lat && $lng) {

            	$output = array(
                    'status' => true,
                    'lat' => $lat, 
                    'long' => $lng, 
                    'google_place_id' => $data->results[0]->place_id
                );


                return $output;


            }
        }
        if($data->status == 'OVER_QUERY_LIMIT') {

        	
        	$output = array(
                'status' => false, 
                'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            );

            return $output;
        }

    } catch (Exception $e) {

    	

    }


    $output = array('lat' => null, 'long' => null, 'status' => false);

    return $output;
}
