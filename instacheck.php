<?php

set_time_limit(0);

ini_set('default_socket_timeout',300);
session_start();

define('client_id',"0a162a4289d4486fa9360a61294c62ec");
define('Client_Secret',"64dd56e9c5304567b2a4e1b97ab41bf8");
define('RedirectURI',"http://localhost/user_module/instacheck.php");
define('ImageDirectory',"Pics/");

if(isset($_GET['access_token']))
{

  $code = $_GET['access_token'];
    echo $code;exit;
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
    
    
    $result = json_decode($result,true);
    echo $result['user']['id'];
    
    
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