<?php 
    session_start(); 
    if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ 
        $user_info = $_SESSION['id'];
?>

<?php 
    include('db/connect.php'); 
    include('Layout/header.php'); 
?>

<?php 
    $sql_data = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE user_id = '$user_info'  GROUP BY catagory";
    $result = mysqli_query($conn,$sql_data); 
    // Prepare data for Highchatts 
    $data = array();
    $data2 = array();
    $current_day_date = array();
    $currentDayTotalAmount = 0;
    $Total_cost_amount = 0;
    $currentMontTotalAmount = 0;
    // print_r($result2);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $data[] = array($row["catagory"], (int)$row["total_price"]);
            $Total_cost_amount +=$row["total_price"];
        }
    };
    // print_r($Total_cost_amount);

    // Encode data to JSON format
    $json_data = json_encode($data);
    //   print_r($json_data);

    // Current day data filter 
    $current_month = date('m');
    $current_date_year = date('Y');
    $current_date_day = date('d');
    $expenses_sql_current_day = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$current_date_year' AND MONTH(date) = '$current_month' AND DAY(date) = '$current_date_day' AND user_id = '$user_info'  GROUP BY catagory";
    $current_day_result = mysqli_query($conn,$expenses_sql_current_day); 
    if (mysqli_num_rows($current_day_result) > 0) {
        while($current_day_row = mysqli_fetch_assoc($current_day_result)) {
            // print_r($current_month_row);
            $current_day_date[] = array($current_day_row["catagory"], (int)$current_day_row["total_price"]);
            $currentDayTotalAmount += $current_day_row["total_price"];
        }
    }
    $json_current_day_data = json_encode($current_day_date);


    // Month data filter 
    $current_month = date('m');
    $current_date_year = date('Y');
    $expenses_sql_current_month = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$current_date_year' AND MONTH(date) = '$current_month' AND user_id = '$user_info'  GROUP BY catagory";
    $current_month_result = mysqli_query($conn,$expenses_sql_current_month); 
    if (mysqli_num_rows($current_month_result) > 0) {
        while($current_month_row = mysqli_fetch_assoc($current_month_result)) {
            // print_r($current_month_row);
            $data2[] = array($current_month_row["catagory"], (int)$current_month_row["total_price"]);
            $currentMontTotalAmount += $current_month_row["total_price"];
        }
    }
    $json_data2 = json_encode($data2);



    // Current year 

    $currentyear = date('Y');
    $sql_current_year = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$currentyear' AND user_id = '$user_info' GROUP BY catagory";
    $current_year_res = mysqli_query($conn,$sql_current_year); 
    $Total_cost_for_current_year = 0;
    $current_year = array();
    if (mysqli_num_rows($current_year_res) > 0) {
        while($current_year_row = mysqli_fetch_assoc($current_year_res)) {
            // print_r($current_year_row);
            $current_year[] = array($current_year_row["catagory"], (int)$current_year_row["total_price"]);
            $Total_cost_for_current_year +=$current_year_row["total_price"];
        }
    };

    $json_current_year = json_encode($current_year);

?>


<!-- START::Highchart area  -->
<script src="js/highcharts.js"></script>
<!-- <script src="js/exporting.js"></script> -->
<script src="js/accessibility.js"></script>


<div class="heighchart-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php 
                    if(isset($_GET['success'])){
                        echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                <strong>WOW!</strong> Your data succesfully updated.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }              
                    ?>
                </div>
                <div class="col-md-4">
                    <?php 
                    if(isset($_GET['success'])){
                        echo '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <img src="..." class="rounded me-2" alt="...">
                                    <strong class="me-auto">Bootstrap</strong>
                                    <small>11 mins ago</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Hello, world! This is a toast message.
                                </div>
                               </div>';
                    }              
                    ?>
                </div>
            </div>

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container_today"></div>
                </figure>
            </div>

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container_total_expenses"></div>
                </figure>
            </div>

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">

Highcharts.chart('container_today', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    credits:{
        enabled:false
    },
    title: {
        text: 'Today expenses: <?php echo $currentDayTotalAmount ?>$',
        align: 'center'
    },
    subtitle: {
        align: 'center',
        text: 'All data selected from your previous costing'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}$</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1em',
                    textOutline: 'none',
                    opacity: 0.7
                }
            }]
        },
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Cost',
        colorByPoint: true,
        data: <?php echo $json_current_day_data; ?>
    }]
});

Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    credits:{
        enabled:false
    },
    tooltip: {
        valueSuffix: '💲'
    },
    subtitle: {
        text:
        'All data selected from your previous costing'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1em',
                    textOutline: 'none',
                    opacity: 0.7
                }
            }]
        },
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    title: {
        text: 'This Month Expenses: <?php echo $currentMontTotalAmount ?>$'
    },
    series: [{
        type: 'pie',
        name: 'Cost',
        colorByPoint: true,
            data: <?php echo $json_data2; ?>
    }]
});

Highcharts.chart('container2', {
    credits:{
        enabled:false
    },
    title: {
        text: '<?php echo $currentyear; ?> EXPENSE: <?php echo $Total_cost_for_current_year ?>$'
    },
    subtitle: {
        text:
        'All data selected from your previous costing'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '0.7em',
                    textOutline: 'none',
                    opacity: 0.9
                }
            }]
        },
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    tooltip: {
        pointFormat: '{series.name}:  <b>{point.y}</b><br/>' +
            'Total spend: <b><?php echo $Total_cost_for_current_year ?></b>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '40%',
        zMin: 0,
        name: 'Amount',
        borderRadius: 5,
        type: 'pie',
        colorByPoint: true,
            data: <?php echo $json_current_year; ?>
    }]
 });


Highcharts.chart('container_total_expenses', {
    chart: {
        type: 'column'
    },
    credits:{
        enabled:false
    },
    title: {
        align: 'center',
        text: 'TOTAL EXPENSE: <?php echo $Total_cost_amount ?>$'
    },
    subtitle: {
        align: 'center',
        text: 'All data selected from your previous costing'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Expenses'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.y}$'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">Total {series.name} : <strong><?php echo $Total_cost_amount ?>$ </strong> </span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b>{point.y}$</b><br/>'
    },

    series: [
        {
            name: 'Amount',
            colorByPoint: true,
            data: <?php echo $json_data; ?>
        }
    ],
});





var date_input = document.getElementById('date_input');
date_input.valueAsDate = new Date();

date_input.onchange = function(){
   console.log(this.value);
}
</script>

<!-- END::Highchart area  -->
<?php include('Layout/footer.php'); ?>



<?php 
    mysqli_close($conn);
    } else {
        header('location: index.php');
    }
?>