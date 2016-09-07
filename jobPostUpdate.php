<?php
// db connection
require_once "vendor/autoload.php";
Dotenv::load(__DIR__);

$host = env('DB_HOST', '');
$database = env('DB_DATABASE', '');
$username = env('DB_USERNAME', '');
$password = env('DB_PASSWORD', '');

$conn = mysqli_connect($host,$username,$password,$database);

// Check connection
if (mysqli_connect_errno())
{
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// for get users

$sql = "SELECT id, account_member, job_post FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Member Type: " . $row["account_member"]. " " . $row["job_post"]. "<br>";
        if($row["account_member"] == 'gold')
        {
            // new job post added with remaining
            $new_job_post = $row["job_post"] + 15;
            
            // update job post value
            $conn->query("UPDATE users SET job_post='".$new_job_post."' WHERE id=".$row['id']);
        }
        elseif($row["account_member"] == 'silver')
        {
            // new job post added with remaining
            $new_job_post = $row["job_post"] + 5;
            
            // update job post value
            $conn->query("UPDATE users SET job_post='".$new_job_post."' WHERE id=".$row['id']);
        }
    }
} else {
    echo "0 results";
}
$conn->close();

?>
