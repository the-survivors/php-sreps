$(document).ready(function () {

    function update_sales_count() {
        $('#sales_counter').animate({
            counter: counter1
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Number(now).toFixed(2));
            },
            complete: update_sales_count
        });
    };
    update_sales_count();

    function update_items_count() {
        $('#items_counter').animate({
            counter: counter2
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_items_count
        });
    };
    update_items_count();

    function update_today_sales_count() {
        $('#today_total_counter').animate({
            counter: counter3
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_today_sales_count
        });
    };
    update_today_sales_count();

    
    function update_items_low_on_stock_count() {
        $('#items_low_on_stock').animate({
            counter: counter3
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_items_low_on_stock_count
        });
    };
    update_items_low_on_stock_count();
    
    // Area Chart Example
    var ctx = document.getElementById("salesChartArea");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sept","Oct","Nov","Dec"],
            datasets: [{
                label: "Total Sales (RM)",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [Jan, Feb, Mar, Apr, May, Jun, Jul,Aug,Sept,Oct,Nov,Dec],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 10,
                        padding: 10,

                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                       // return datasetLabel+' '+ datasetLabel2 +': ' + number_format(tooltipItem.yLabel);
                        return datasetLabel +': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

    
    
}); // end of ready function