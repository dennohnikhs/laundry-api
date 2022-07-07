<?php
include '../database/config.php';
$conn = new Connection();
$orders = $conn->execute_query("SELECT o.*, c.name, c.location, c.phone_number FROM orders o INNER JOIN customers c ON c.id = o.customer_id ORDER BY o.created_at DESC;");

function get_status($status){
    switch($status){
        case 0:
           return "Pending";
        case 1:
            return "Laundry Received";
        case 2:
            return "Laundry Done";
        case 3:
            return "Closed";
            
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../admin/view-orders.php" />
    <link rel="stylesheet" href="../assets/css/panel.css" /> 
</head>

<body>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid white;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: black;
        color: white;
    }
    </style>

    <body>

        <h2 style="font-size :40px;">Orders</h2>

        <table style="width: 100%;font-size:xx-large;
            font-family: sans-serif;
            padding-bottom :10px;
            padding-top :10px;
            border-radius:10px;
            background-color:grey;
            color:black;
            margin-top:5px;
            font-size:20px;
            border-collapse: collapse;
            ">
         <thead>
         <tr>
            <th>CUSTOMER</th>
            <th>LOCATION</th>
            <th>NUMBER OF BASKETS</th>
            <th>PAYMENT</th>
            <th>STATUS</th>
            <th>ACTION</th>
            </tr>
         </thead>
         <tbody>
             <?php 
             while($order = mysqli_fetch_assoc($orders)){
                 ?>
                 <tr>
                     <td>
                         <?=$order['name']?>
                         <div><?=$order['phone_number']?></div>
                     </td>
                     <td><?=$order['location']?></td>
                     <td><?=$order['number_baskets']?></td>
                     <td>
                         Ksh <?=$order['amount']?>
                         <div><?=$order['is_paid']?'Paid':'Not Paid'?></div>
                     </td>
                     <td><?=get_status($order['status'])?></td>
                     <td>
                         <button>Mark Received</button>
                     </td>
                 </tr>
                <?php 
             }
             ?>
         </tbody>
        </table>



    </body>

</html>

</body>

</html>