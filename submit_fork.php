<?php
$connection_string = "postgresql://postgres:HukFinn12%21%40@db.tniedfokspjebxiyyyxh.supabase.co:5432/postgres";

$conn = pg_connect($connection_string);

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$user_name    = isset($_POST['name']) ? $_POST['name'] : '';
$user_phone   = isset($_POST['phone']) ? $_POST['phone'] : '';
$user_email   = isset($_POST['email']) ? $_POST['email'] : '';
$user_message = isset($_POST['message']) ? $_POST['message'] : '';

$user_name    = pg_escape_string($conn, $user_name);
$user_phone   = pg_escape_string($conn, $user_phone);
$user_email   = pg_escape_string($conn, $user_email);
$user_message = pg_escape_string($conn, $user_message);

$sql = "INSERT INTO \"Customers\" (\"Name\", \"Phone\", \"Email\", \"Message\", \"CreatedAt\") 
        VALUES ('$user_name', '$user_phone', '$user_email', '$user_message', NOW())";

$result = pg_query($conn, $sql);

if ($result) {
    echo "<div style='background-color: #212529; color: white; text-align: center; padding: 50px; font-family: sans-serif; height: 100vh;'>";
    echo "<h1 style='color: #dc3545;'>Success! Your quote request has been submitted.</h1>";
    echo "<p>We will be in touch with you shortly.</p>";
    echo "<a href='index.html' style='color: white; border: 1px solid #dc3545; padding: 10px 20px; text-decoration: none; font-weight: bold; background-color: transparent;'>Return Home</a>";
    echo "</div>";
} else {
    echo "Error in query: " . pg_last_error($conn);
}

pg_close($conn);
?>