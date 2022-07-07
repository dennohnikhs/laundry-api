<?php
include './database/config.php';

$conn = new Connection();

if(isset($_POST['book-order'])){
    $full_name = $_POST['full-name'];
    $phone_number = $_POST['phone-number'];
    $location = $_POST['location'];
    $baskets = $_POST['laundry-baskets'];
    $pick_from_home = isset($_POST['pick-from-home'])?1:0;
    $customer_id = null;
    
    $result = $conn->execute_query("SELECT * FROM customers WHERE phone_number='$phone_number'");
    
    if(mysqli_num_rows($result) > 0){
        //customers exists so get the id
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['id'];
    }
    else{
        //customer does not exist, insert and get id
        $sql = "INSERT INTO customers (name,location,phone_number) VALUES('$full_name','$location','$phone_number')";
        $conn->execute_query($sql);

        //customer inserted, now get the inserted customer id
        $result = $conn->execute_query("SELECT id FROM customers ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['id'];
    }

    $sql = "INSERT INTO orders (customer_id,number_baskets,pick_from_home) VALUES($customer_id,$baskets,$pick_from_home)";

    if($conn->execute_query($sql)){
        echo '<script>alert("Booked successfully, please await for the admin to call you for further details. Thanks");window.history.back()</script>';
    }
    else{
        echo '<script>alert("An error occurred while trying to place your order, please try again later.");window.history.back()</script>';
    }
}