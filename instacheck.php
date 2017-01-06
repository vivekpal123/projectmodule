<?php

set_time_limit(0);

ini_set('default_socket_timeout',300);
session_start();

define('client_id',"0a162a4289d4486fa9360a61294c62ec");
define('Client_Secret',"64dd56e9c5304567b2a4e1b97ab41bf8");
define('RedirectURI',"http://localhost/user_module/instacheck.php");
define('ImageDirectory',"Pics/");


if(isset($_GET['code']))
{
  $code = $_GET['code'];
  $url = "https://api.instagram.com/oauth/access_token";    

$access_token_setting = array(
    'client_id'         =>client_id,
    'Client_Secret'     =>Client_Secret,
    'Grant_type'        =>'authorization_code',
    'RedirectURI'       =>RedirectURI,
    'code'              =>$code
);  
   
    
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_setting);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    
    $result = curl_exec($curl);
    curl_close($curl);
    
    $result = json_decode($result,true);
    print_r($result);
    echo $result['users']['username'];
    
}


?>

<html>
    <head></head>
    <body>
        <a href="https://instagram.com/oauth/authorize?client_id=<?php echo client_id; ?>&redirect_uri=<?php echo RedirectURI; ?>&response_type=code">Login</a>
       
        
        
        <script>
            response, content = http_object.request(url, method="POST", body=data,headers = {"Content-type": "application/x-www-form-urlencoded"})
            </script>
    </body>
</html>