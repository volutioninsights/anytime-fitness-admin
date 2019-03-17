@extends('layouts.anytime')
@section('title', 'Dashboard')
@section('content')
<div class='row'>
@include('components.stats')
</div>

<div class="row">
    <div class="col-12 col-md">
        <div class="panel panel-primary">
            <div id="revenue" class="panel-body text-center"></div>
        </div>
    </div>

    <div class="col-12 col-md">
        <div class="panel panel-primary">
            <div id="wc-conv" class="panel-body text-center">

            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-12 col-md">
        <div class="panel panel-primary">
            <div id="convpie" class="panel-body text-center">

            </div>
        </div>
    </div>

    <div class="col-12 col-md">
            <div class="panel panel-primary">
                <div id="class-pie" class="panel-body text-center">
    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md">
                <div class="panel panel-primary">
                    <div id="top-gyms" class="panel-body text-center">
                        
                    </div>
                </div>
            </div>

            <div class="col-12 col-md">
                    <div class="panel panel-primary">
                        <div id="top-pts" class="panel-body text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md">
                    <div class="panel panel-primary">
                        <div id="reassesment" class="panel-body text-center">
                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="panel panel-primary">
                        <div id="reassesmentConv" class="panel-body text-center">
                            
                        </div>
                    </div>
                </div>
</div>
@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script type='text/javascript' src='/assets/plugins/sparklines/jquery.sparklines.min.js'></script>
<script type="text/javascript">

Highcharts.chart('reassesmentConv', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Reassessment PT Conversion'
        },
        subtitle: {
            text: 'Amount of reassessments converted into booked PT'
        },
        xAxis: {
            type: "category",
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sessions'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                pointPadding: 0,
                groupPadding: 0.2,
                shadow: false
            }
        },
        series: [{
            name: 'Reassessments',
            data: [
                ["Aug", {{rand(200,400)}}],
                ["Sep", {{rand(200,400)}}],
                ["Oct", {{rand(200,400)}}],
                ["Nov", {{rand(200,400)}}],
                ["Dec", {{rand(200,400)}}],
                ["Jan", {{rand(200,400)}}]
            ],
            color: "#53a8e2"
        }, {
            name: 'Resulting Sessions',
            data: [
                ["Aug", {{rand(100,200)}}],
                ["Sep", {{rand(100,200)}}],
                ["Oct", {{rand(100,200)}}],
                ["Nov", {{rand(100,200)}}],
                ["Dec", {{rand(100,200)}}],
                ["Jan", {{rand(100,200)}}]
            ],
            color: "#2D7FBE"
        }]
    });

const rePie = Highcharts.chart('reassesment', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Reassessment Balance'
        },
        subtitle: {
            text: "Comparison between outstanding & booked reassessments"
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                innerSize: "30%",
                showInLegend: true,
                dataLabels: {
                enabled: true,
                format: '{point.percentage:.1f}%',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            },
            }
        },
        tooltip: {
            pointFormat: 'Total <b>{point.y:.0f}</b> ({point.percentage:.0f}%)'
        },
        series: [{
            name: 'Percentage',
            data: [{
                name: 'Booked',
                y: {{rand(100, 150)}},
                sliced: true,
                selected: true,
                color: "#2D7FBE"
            }, {
                name: 'Outstanding',
                y: {{rand(80, 120)}},
                color: "#53a8e2"
            }]
        }]
    });

        $('#top-pts').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Top 5 Highest Revenue (PT)'
            },
            xAxis: {
                categories: ['S. Evans', 'A. Norton', 'M. Macleod', 'E. Rigby', 'T. Strong']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Revenue'
                }
            },
            legend: {
                reversed: true
            },
            series: [{
                name: 'Revenue',
                color: "#2D7FBE",
                data: [{{rand(150000, 130000)}}, {{rand(110000, 100000)}}, {{rand(85000, 95000)}}, {{rand(76000, 84000)}}, {{rand(65000, 75000)}}]
            }]
        });

    $('#top-gyms').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Top 5 Highest Revenue (Gym)'
            },
            xAxis: {
                categories: ['Manilla Ctr', 'Eastwood', 'Los Penos', 'Kamil', 'Visto City']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Revenue'
                }
            },
            legend: {
                reversed: true
            },
            series: [{
                name: 'Revenue',
                color: "#2D7FBE",
                data: [{{rand(3500000, 4000000)}}, {{rand(3200000, 3500000)}}, {{rand(2500000, 3400000)}}, {{rand(2100000, 2500000)}}, {{rand(1800000, 2000000)}}]
            }]
        });

        $('#top-pts').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Top 5 Highest Revenue (PT)'
            },
            xAxis: {
                categories: ['S. Evans', 'A. Norton', 'M. Macleod', 'E. Rigby', 'T. Strong']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Revenue'
                }
            },
            legend: {
                reversed: true
            },
            series: [{
                name: 'Revenue',
                color: "#2D7FBE",
                data: [{{rand(150000, 130000)}}, {{rand(110000, 100000)}}, {{rand(85000, 95000)}}, {{rand(76000, 84000)}}, {{rand(65000, 75000)}}]
            }]
        });


    Highcharts.chart('wc-conv', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Wellness Consultation Effectiveness'
        },
        subtitle: {
            text: 'PT Conversions vs Conducted Wellness Consultations'
        },
        xAxis: {
            type: "category",
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sessions'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                pointPadding: 0,
                groupPadding: 0.2,
                shadow: false
            }
        },
        series: [{
            name: 'Wellness Consultations',
            data: [
                ["Aug", {{rand(200,400)}}],
                ["Sep", {{rand(200,400)}}],
                ["Oct", {{rand(200,400)}}],
                ["Nov", {{rand(200,400)}}],
                ["Dec", {{rand(200,400)}}],
                ["Jan", {{rand(200,400)}}]
            ],
            color: "#53a8e2"
        }, {
            name: 'PT Conversions',
            data: [
                ["Aug", {{rand(100,200)}}],
                ["Sep", {{rand(100,200)}}],
                ["Oct", {{rand(100,200)}}],
                ["Nov", {{rand(100,200)}}],
                ["Dec", {{rand(100,200)}}],
                ["Jan", {{rand(100,200)}}]
            ],
            color: "#2D7FBE"
        }]
    });

    const classPie = Highcharts.chart('class-pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Class Attendance'
        },
        subtitle: {
            text: "Class bookings against actual attendance"
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                innerSize: "30%",
                showInLegend: true,
                dataLabels: {
                enabled: true,
                format: '{point.percentage:.1f}%',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            },
            }
        },
        tooltip: {
            pointFormat: 'Total <b>{point.y:.0f}</b> ({point.percentage:.0f}%)'
        },
        series: [{
            name: 'Percentage',
            data: [{
                name: 'Attendance',
                y: {{rand(800, 1000)}},
                sliced: true,
                selected: true,
                color: "#2D7FBE"
            }, {
                name: 'No Show',
                y: {{rand(100, 200)}},
                color: "#53a8e2"
            }]
        }]
    });



    // Build the chart
    const pie = Highcharts.chart('convpie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Trainer Metrics'
        },
        subtitle: {
            text: "New PT Sales vs Renewals"
        },
        tooltip: {
            pointFormat: 'Total <b>{point.y:.0f}</b> ({point.percentage:.0f}%)'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                innerSize: "30%",
                dataLabels: {
                enabled: true,
                format: '{point.percentage:.1f}%',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            },
                showInLegend: true
            }
        },
        series: [{
            name: 'Amount',
            data: [{
                name: 'New PT',
                y: {{rand(500, 800)}},
                sliced: true,
                selected: true,
                color: "#2D7FBE"
            }, {
                name: 'Renewals',
                y: {{rand(600, 1000)}},
                color: "#53a8e2"
            }]
        }]
    });

    // pie.showLoading();


    const chart = Highcharts.chart('revenue', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Revenue Metrics'
        },
        subtitle: {
            text: "Visualisation of overall revenue month on month (Gym Revenue Breakdown)"
        },
        legend: {

        },
        xAxis: {
            type: 'category',
            labels: {
                style: {
                    fontSize: '13px',
                    'color': 'black'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Revenue (PHP)'
            }
        },
        tooltip: {
            pointFormat: 'Revenue: <b>{point.y:,.0f} PHP</b>'
        },
        series: [{
            "name": 'Monthly Overall Revenue',
            "data": [{
                    "drilldown": "August",
                    "y": Math.floor(Math.random() * 500000),
                    "name": "August 18"
                },
                {
                    "drilldown": "September",
                    "y": Math.floor(Math.random() * 500000),
                    "name": "September 18"
                },
                {
                    "drilldown": "October",
                    "y": Math.floor(Math.random() * 500000),
                    "name": "October 18"
                },
                {
                    "drilldown": "November",
                    "y": Math.floor(Math.random() * 500000),
                    "name": "November 18"
                },
                {
                    "drilldown": "December",
                    "y": Math.floor(Math.random() *
                        500000),
                    "name": "December 18"
                },
                {
                    "drilldown": "January",
                    "y": Math.floor(Math.random() * 500000),
                    "name": "January 19"
                },
            ],
            color: {
                linearGradient: {
                    x1: 0,
                    x2: 0,
                    y1: 0,
                    y2: 1
                },
                stops: [
                    [0, '#53a8e2'],
                    [1, '#2D7FBE']
                ]
            }

        }],
        "drilldown": {
            "activeAxisLabelStyle": {
                "color": "black",
                "text-decoration": "none"
            },
            "drillUpButton": {
                relativeTo: 'spacingBox',
                position: {
                    y: -10,
                    x: -10
                },
                theme: {
                    fill: 'white',
                    'stroke-width': 1,
                    stroke: 'silver',
                    // r: 0
                }

            },
            "series": [{
                "name": "Gym specific revenue",
                "id": "January",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }, {
                "name": "Gym specific revenue",
                "id": "August",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }, {
                "name": "Gym specific revenue",
                "id": "September",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }, {
                "name": "Gym specific revenue",
                "id": "October",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }, {
                "name": "Gym specific revenue",
                "id": "November",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }, {
                "name": "Gym specific revenue",
                "id": "December",
                // "borderColor": "#804c9e",
                // "borderWidth": 2,
                "data": [
                    ['Spinningfield', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Great Northern', Math
                        .floor(Math.random() *
                            30000) + 1
                    ],
                    ['NQ Gym', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Salford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Alt', Math.floor(Math
                        .random() *
                        30000) + 1],
                    ['Trafford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['St Peters', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Oxford', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Ashton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Hyde', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Duki', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Atherton', Math.floor(
                        Math.random() *
                        30000) + 1],
                    ['Stockport', Math.floor(
                        Math.random() *
                        30000) + 1]
                ]
            }]
        }
    });
</script>
@endsection