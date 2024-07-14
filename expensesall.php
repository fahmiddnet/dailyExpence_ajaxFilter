<?php 
session_start();
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    // print_r($user_id);
};

$con = new PDO('mysql:host=localhost;dbname=expenses_trshitem', 'fahmid', '123456');
$date_t = $_POST['item_date'];

foreach ($_POST['item_title'] as $key => $value ){
    $sql = 'INSERT INTO `expenses` (`date`,`title`, `amount`, `catagory`, `note`,`user_id`) VALUES (:date_t, :title, :amount, :catagory, :note, :user_id)';
    $stmt = $con->prepare($sql);
    $stmt->execute([
        'date_t' => $date_t,
        'title' => $value,
        'amount' => $_POST['item_amount'][$key],
        'catagory' => $_POST['item_catagory'][$key],
        'note' => $_POST['item_note'][$key],
        'user_id' => $user_id,
    ]);
}

echo 'Item inserted successfully';




?>