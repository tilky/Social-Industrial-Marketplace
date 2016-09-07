<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="quotetek";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br/>";

    $file="techincal-services.csv";
    if (!file_exists($file)) die($file. " does not exist!");
    
    if (file_exists($file)){
        
        try{
            $handle = fopen($file, 'r');
        
            $t=0;
            $cnt = 0;
            while (!feof($handle)) {
                
                $csv_data = fgetcsv($handle, 1024);
                $t++;
                if($t > 2 && $t < 1400)
                {
                    $tech = $csv_data[0];
                    if($tech != '')
                    {
                        $cnt++;
                        echo $cnt.'=>'.$tech.'<br/>';
                        mysqli_query($conn,"INSERT INTO technical_service (name,is_active) VALUES ('$tech',1)");
                    }
                }
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
mysqli_close($conn);
?>
