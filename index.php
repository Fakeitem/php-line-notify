<!DOCTYPE html>
<html>
    <head>
        <title>LINE Notify</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" href="" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="padding-top: 15px; padding-bottom: 15px;">
            <div class="row">
                <div class="col-xs-12">
                    <form method="post" action="index.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Input Message:</label>
                            <textarea class="form-control" rows="3" id="message" name="message" style="resize: vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if(isset($_POST['message']))
        {
            $token = 'ACCESS TOKEN'; // your access token.
            $message = $_POST["message"];
            line_notify($token, $message);
        }
        function line_notify($token, $message)
        {
            $message =  trim($message);

            //set timezone.
            date_default_timezone_set("Asia/Bangkok");

            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            //ssl use.
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_POST, 1); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, "message=$message"); 
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 

            $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer ".$token);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec($curl); 

            //check error.
            if(curl_error($curl))
            { 
                echo 'error: '.curl_error($curl); 
            }
            curl_close($curl);   
        }
        ?>
    </body>
</html>

