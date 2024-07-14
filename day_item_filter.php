<?php 
    session_start(); 
    $user_info = $_SESSION['id'];
    

    include('func/filter_functions.php');
    if(isset($_POST['taskOptionitem'])){
        $taskOptionitem = $_POST['taskOptionitem'];
        $filter_sql_day = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE date = '$taskOptionitem' AND user_id = '$user_info'  GROUP BY catagory";
        highchartData($filter_sql_day);
    };

    if(isset($_POST['taskOption_month'])){
        $taskOption_month_item = $_POST['taskOption_month'];
        /*=========================================
        START::FIlter by month 
        ===========================================*/
        $selected_month = date('m', strtotime($taskOption_month_item));
        $selected_year = date('Y', strtotime($taskOption_month_item));
        $filter_month = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$selected_year' AND MONTH(date) = '$selected_month' AND user_id = '$user_info' GROUP BY catagory";
        highchart_month_Data($filter_month);
    };

    if(isset($_POST['taskOption_year'])){
        $taskOption_year_item = $_POST['taskOption_year'];
        $filter_year = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$taskOption_year_item' AND user_id = '$user_info' GROUP BY catagory";
        highchart_year_Data($filter_year);
    };



?>






