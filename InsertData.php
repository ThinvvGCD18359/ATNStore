<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into customer table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>Customer ID:</li><li><input type="text" name="customerid" /></li>
<li>Customer Name:</li><li><input type="text" name="customername" /></li>
<li>Customer Phone:</li><li><input type="text" name="customerphone" /></li>
<li>Address:</li><li><input type="text" name="address" /></li>
<li><input type="submit" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-52-0-155-79.compute-1.amazonaws.com;port=5432;user=uhkywoqfpojzhn;password=e9df249d095cd9b696dc315aa505ef07cfa1d5019e593b3c1a1dd2f9c99b6482;dbname=d9r7n9bel5srhd",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO customer(customer_id, customer_name, customer_phone, address) values (:id, :name, :phone, :address)');

//$stmt->bindParam(':id','C03');
//$stmt->bindParam(':name','Thong');
//$stmt->bindParam(':phone', '123456789');
//$stmt->bindParam(':address', '52 Thanh Thuy');
//$stmt->execute();
//$sql = "INSERT INTO student(customer_id, customer_name, customer_phone, address) VALUES('C03', 'Thong','123456789','52 Thanh Thuy')";
$sql = "INSERT INTO customer(customerid, customername, customerphone, address)"
        . " VALUES('$_POST[customerid]','$_POST[customername]','$_POST[customerphone]','$_POST[address]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
    if (is_null(customer_id)) {
   echo "Customer ID must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
 
?>
</body>
</html>