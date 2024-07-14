<?php 
function getData($sql){
    include('../db/connect.php');
    $result = mysqli_query($conn,$sql); 
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dateString = array($row['date']);
            foreach($dateString as $day_item){
                $day = strtotime($day_item); 
                $day_v = date('l jS F Y', $day);
                $output .='<option selected value='.$day_item.'>'. $day_v .'</option>';
            };
        }
    }
    echo $output;
}


function getMonthData($sql){
    include('../db/connect.php');
    $result = mysqli_query($conn,$sql); 
    // print_r($result);
    $outputMonth = '';
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dateString = array($row['MY_time']);
            // print_r($dateString);
            foreach(array_unique($dateString) as $day_item){
                // print_r($day_item);
                $day = strtotime($day_item);
                $day_v = date('F Y', $day);
                $outputMonth .='<option selected value='.$day_item.'>'. $day_v .'</option>';
            };
        }
    }
    echo $outputMonth;
}


function getYearData($sql){
    include('../db/connect.php');
    $result = mysqli_query($conn,$sql); 
    $outputYear = '';
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $dateString = array($row['MY_time']);
            // print_r($dateString);
            foreach($dateString as $day_item){
                // $valueItem = $day_item;
                // $selected_year = date('Y', strtotime($day_item));
                $outputYear .='<option selected value='.$day_item.'>'. $day_item .'</option>';
            };
        }
        print_r($selected_year);
    }
    echo $outputYear;
}


function highchartData($filter_sql_day){
    include('db/connect.php');
    $filter_res = mysqli_query($conn,$filter_sql_day); 
        if (mysqli_num_rows($filter_res) > 0) {
            while($filter_row = mysqli_fetch_assoc($filter_res)) {
                    // print_r($filter_row);
                    $data[] = array('name'=>$filter_row["catagory"] , 'y'=>(int)$filter_row["total_price"]);
                }
            }
        mysqli_close($conn);
        $json_data = json_encode($data);
        // print_r($json_data);
        echo $json_data;
    };


function highchart_month_Data($filter_month){
    include('db/connect.php');
    $filter_res = mysqli_query($conn,$filter_month); 
        if (mysqli_num_rows($filter_res) > 0) {
            while($filter_row = mysqli_fetch_assoc($filter_res)) {
                    // print_r($filter_row);
                    $monthdata[] = array('name'=>$filter_row["catagory"] , 'y'=>(int)$filter_row["total_price"]);
                }
            }
        mysqli_close($conn);
        $json_monthdata = json_encode($monthdata);
        // print_r($json_data);
        echo $json_monthdata;
    }

function highchart_year_Data($filter_year){
    include('db/connect.php');
    $filter_res = mysqli_query($conn,$filter_year); 
        if (mysqli_num_rows($filter_res) > 0) {
            while($filter_row = mysqli_fetch_assoc($filter_res)) {
                    // print_r($filter_row);
                    $yeardata[] = array('name'=>$filter_row["catagory"] , 'y'=>(int)$filter_row["total_price"]);
                }
            }
        mysqli_close($conn);
        $json_yeardata = json_encode($yeardata);
        // print_r($json_data);
        echo $json_yeardata;
    }

?>
