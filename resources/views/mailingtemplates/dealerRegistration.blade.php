
	<html>
        <body>
            <style type="text/css">
                .btn{
                    padding: 8px 16px;
                    background-color: #000;
                    border-color: #000;
                    margin: 15px 0px;
                    color: #fff;
                    font-size: 15px;
                    text-decoration: none;
                    border: 1px solid #000;
                    transition: 0.2s ease-in;
                    line-height: 1.5;
                    border-radius: 0.25rem
                }

                .btn:hover{
                    padding: 8px 16px;
                    background-color: transparent;
                    border-color: #000;
                    margin: 15px 0px;
                    color: #000;
                    font-size: 15px;
                    text-decoration: none;
                    border: 1px solid #000;
                    transition: 0.2s ease-in;
                    line-height: 1.5;
                    border-radius: 0.25rem
                }


            </style>
        <div align="center">
             <div style="max-width: 680px; min-width: 500px; border: 2px solid #e3e3e3; border-radius:5px; margin-top: 20px">   
        	    <div style="background: #f3f3f3">
        	        <!--<img src="{{asset($logo->img_path)}}" width="250" alt="Sepico" border="0" style='width: 25%; padding: 15px; margin: 0px auto;' />-->
        	    </div> 
        	    <div  style="background-color: #fbfcfd; border-top: thick double #cccccc; text-align: left;">
        	        <div style="margin: 30px;">
             	        <p>
                           
                     	        
                     	        Welcome to Modernaire!<br> <br>
                     	        Your account as a dealer has successfully been created. Please login to your dashboard with the credentials given below. <br>
                            
             	        </p>


                      
                        <table style="text-align: left;">
                          
                            <tr>
                                <td colspan="2">
                                    <h3 style=" font-size: 22px; padding: 0px; margin: 0px;">
                                        Account Details:
                                    </h3>
                                </td>
                            </tr>
                           
                            
                            <tr>
                                <th>
                                    Email:
                                </th>
                                <td>
                                    {{$send_email['email']}}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Password:
                                </th>
                                <td>
                                    {{$send_email['password']}}
                                </td>
                            </tr>
                       <!-- end  -->
                        </table>
             	        <br>  
                        
                            <a class="btn" href="{{route('signin')}}">Click Here to Login</a><br><br>
             	            You can also change your password by clicking on the button given below:<br><br>
                            <a class="btn" href="{{ url('password/reset') }}" target="_blank">Change Password</a><br><br>
             	            Please Contact Modernaire if you have any questions.<br><br>
                            
                        
             	        <div style="text-align: Right;">
             	            With warm regards,<br>
                            Modernaire Team
             	        </div>
             	    </div>
        	    </div>   
        	</div>   
    	</div>
  	    
    	</body>
	</html>	
