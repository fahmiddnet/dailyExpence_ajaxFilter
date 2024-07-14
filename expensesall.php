<?php 
    session_start(); 
    if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ 
    include('Layout/header.php'); 
    $user_info = $_SESSION['id']; 
?>



<!-- START::Highchart area  -->
<script src="js/highcharts.js"></script>
<!-- <script src="js/exporting.js"></script> -->
<script src="js/accessibility.js"></script>


<div class="heighchart-area my-3">
    <div class="container">
        <div class="row">
            
            <!-- START::FIlter by day section  -->
            <div class="col-md-6">
                <form id="dayItemFilter" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Day</label>
                    <select class="form-select" name="taskOptionitem" id="taskOption" aria-label="Multiple select example">  
                    </select>
                    <input type="submit" value="Filter" class="btn btn-info">
                </form>
                <figure class="highcharts-figure">
                    <div id="containerDay"></div>
                </figure>

            </div>
             <!-- END::Filter by day section  -->

             <!-- START::FIlter by month section  -->
            <div class="col-md-6">
                <form id="monthItemFilter" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Month</label>
                    <select class="form-select" name="taskOption_month" id="taskOption_month" aria-label="Multiple select example">
                    </select>
                    <input type="submit"  name="monthSubmit" value="Filter" class="btn btn-info">
                </form>

                <figure class="highcharts-figure">
                    <div id="container_month"></div>
                </figure>
            </div>
            <!-- END::FIlter by month section  -->

            <!-- START::FIlter by Yearly section  -->
            <div class="col-md-6">
                <form id="yearItemFilter" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Year</label>
                    <select class="form-select" name="taskOption_year" id="taskOption_year" aria-label="Multiple select example">

                    </select>
                    <input type="submit" name="yearSubmit" value="Filter" class="btn btn-info">
                </form>

                <figure class="highcharts-figure">
                    <div id="containerYear"></div>
                </figure>
            </div>
            <!-- END::FIlter by yearly section  -->


        </div>
    </div>
</div>


<script>

// taskOption

fetchDayData();

function fetchDayData(){
    var action = "fetchdayData";
    $.ajax({
        url: "query/filter_query.php",
        method:"POST",
        data:{action:action},
        success:function(data){
            // alert(data);
            $('#taskOption').html(data);
        }
    })
};

fetchMonthData();

function fetchMonthData(){
    var action = "fetchMonthData";
    $.ajax({
        url: "query/filter_query.php",
        method:"POST",
        data:{action:action},
        success:function(data){
            // alert(data);
            $('#taskOption_month').html(data);
        }
    })
};

fetchYearData();

function fetchYearData(){
    var action = "fetchYearData";
    $.ajax({
        url: "query/filter_query.php",
        method:"POST",
        data:{action:action},
        success:function(data){
            // alert(data);
            $('#taskOption_year').html(data);
        }
    })
};


$(document).ready(function(){
    $('#dayItemFilter').submit(function(e){
        e.preventDefault();

        var taskOption = $('#taskOption').val();

        if(taskOption != ""){
           var Pidata =  $.ajax({
                url: 'day_item_filter.php',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    obj = JSON.parse(data)
                        var arr_data = []
                        for(var i in obj){
                            arr_data.push({
                                name: obj[i].name,
                                y:obj[i].y
                            })
                        }
                        dayHighchart(arr_data)
                }
            })
        }
    });


    // Mont filter item 
    $('#monthItemFilter').submit(function(e){
        e.preventDefault();

        var taskOption_month = $('#taskOption_month').val();

        if(taskOption_month != ""){
           var Pidata =  $.ajax({
                url: 'day_item_filter.php',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    // alert(data)
                    obj = JSON.parse(data)
                        var arr_month_data = []
                        for(var i in obj){
                            arr_month_data.push({
                                name: obj[i].name,
                                y:obj[i].y
                            })
                        }
                        monthHighchart(arr_month_data)
                }
            })
        }
    });

    // Year filter item 
    $('#yearItemFilter').submit(function(e){
        e.preventDefault();

        var taskOption_year = $('#taskOption_year').val();

        if(taskOption_year != ""){
            var Pidata = $.ajax({
                url: 'day_item_filter.php',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    // alert(data)
                    obj = JSON.parse(data)
                        var arr_year_data = []
                        for(var i in obj){
                            arr_year_data.push({
                                name: obj[i].name,
                                y:obj[i].y
                            })
                        }
                        yearHighchart(arr_year_data);
                }
            })
        }
    })
});




</script>



<!-- START::Highchart area  -->

<script>
// filter by day
function dayHighchart(arr_data){
   const chart = Highcharts.chart('containerDay', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits:{
            enabled:false
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
            name: 'Brands',
            colorByPoint: true,
            data:arr_data
        }]
    });
    var taskOption = $('#taskOption').val();
                var day = taskOption;
                chart.setTitle({ text:'Estimate date: ' + day});
}



// filter by month 
function monthHighchart(arr_month_data){
    const chart = Highcharts.chart('container_month', {
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
                        text: '8 July, 2024',
                        align: 'center'
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
                                distance: -50,
                                format: '{point.percentage:.1f}%',
                                style: {
                                        fontSize: '.7em',
                                        textOutline: 'none',
                                        opacity: 1
                                    },
                            }]},
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
                        data: arr_month_data
                    }]
                });
                var taskOption_month = $('#taskOption_month').val();
                var month = taskOption_month.slice(0,7);
                chart.setTitle({ text:'Estimate date: ' + month});
}

// filter by Year 

function yearHighchart(arr_year_data){
    const chart = Highcharts.chart('containerYear', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    credits:{
                        enabled:false
                    },
                    subtitle: {
                        text: 'Here is your data for the selected year'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.y}$</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '$'
                        }
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: -50,
                                format: '{point.percentage:.1f}%',
                                style: {
                                        fontSize: '.7em',
                                        textOutline: 'none',
                                        opacity: 1
                                    },
                            }]},
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
                        data: arr_year_data
                    }]
                });
                var taskOption_year = $('#taskOption_year').val();
                var year = taskOption_year.slice(0,4);
                chart.setTitle({ text:'Estimate year: ' + year});
}

 </script>
<!-- END::Highchart area  -->



<!-- Footer area  -->
<?php include('Layout/footer.php'); ?>


<!-- If session not working  -->
<?php 
    } else {
        header('location: index.php');
    }
?>
