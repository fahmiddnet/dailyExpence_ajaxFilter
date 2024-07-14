<?php 
session_start(); 
$user_info = $_SESSION['id'];
include('../func/filter_functions.php');

if(isset($_POST['action'])){
    $output = '';
    if($_POST['action'] == 'fetchdayData'){
        $sql = "SELECT DISTINCT date FROM expenses WHERE user_id = '$user_info'";
        getData($sql);
    }
    if($_POST['action'] == 'fetchMonthData'){
        $sql = "SELECT DISTINCT date FROM expenses WHERE user_id = '$user_info'";
        getMonthData($sql);
    }
    if($_POST['action'] == 'fetchYearData'){
        $sql = "SELECT DISTINCT date FROM expenses WHERE user_id = '$user_info'";
        getYearData($sql);
    }


}
?>