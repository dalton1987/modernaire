
<style type="text/css">

.welcome{
	text-align: center;
}

.account{
	font-style: normal;
	margin-bottom: -5px;
}

.detail{
	font-style: normal;
	line-height: 10px;
}
</style>

<div style=""> <!-- main Div -->

	<div style="margin: 50px auto; color: #2a3342; border:7px solid #eee; ">

		<div style=" padding: 20px 0 20px 0;">
					 
  
  
			<img src="{{asset($logo->img_path)}}" width="200px;" style="display: block; margin-left: auto; margin-right: auto;">

			<h2 class="welcome" style="text-align: center;">Welcome {{$send_email['name']}} {{$send_email['last_name']}}!</h2>

			<div style="width: 20%; height: 1px; background-color: #68b7a4; margin: 10px auto 10px auto;"></div>

		</div>

		<div style="padding: 0 40px 20px 40px;"> 
		<h2 style="font-size: 16px; font-weight: inherit;">Hi, You have successfully registered on Modernaire. We are excited to have you on board. Below are your account details:</h2>

		<address class="c_details">
		    <h2 class="account" style="font-style: normal; margin-bottom: -5px;">Account Detail:</h2>
			<p class="detail" style="font-style: normal; line-height: 10px;"><b>User Name</b>: {{$send_email['name']}} {{$send_email['last_name']}}</p>
			<p class="detail" style="font-style: normal; line-height: 10px;"><b>Email Address</b>:{{$send_email['email']}}</p>
		</address>


	
	<!--	<b><p style="font-size: 16px; font-weight: inherit;"></p><b>-->
		</div>

		<br><br>


	</div>

</div>