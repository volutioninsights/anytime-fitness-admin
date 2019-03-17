@extends('layouts.anytime')
@section('content')
<div class='row'>
        <div class='col-12 col-sm-6 col-md-4 col-lg-3 panel panel-primary'>
                <div class='panel-body no-padding'>
                        <table class="table">
                                <tbody>
                                        <tr>
                                                <td>Name</td>
                                                <td>{{$gym->name}}</td>
                                              </tr>     
                                              <tr>
                                                    <td>Address</td>
                                                    <td>{{$gym->address}}</td>
                                                  </tr>     
                                                  <tr>
                                                        <td>City</td>
                                                        <td>{{$gym->city}}</td>
                                                      </tr>      
                                                      <tr>
                                                            <td>Zip</td>
                                                            <td>{{$gym->zip}}</td>
                                                          </tr>     
                                                          <tr>
                                                                <td>Phone</td>
                                                                <td>{{$gym->phone}}</td>
                                                              </tr>              
                                                                                                     <tr>
                                                                    <td>Email</td>
                                                                    <td>{{$gym->email}}</td>
                                                                  </tr>       
                                </tbody>
                              </table>
                </div>
            </div>    
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

    <div class="row">
            <div class="col-sm-12">
                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#trainers" data-toggle="tab">Trainers</a></li>
                        <li><a href="#classes" data-toggle="tab">Classes</a></li>
                        <li><a href="#members" data-toggle="tab">Members</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="trainers">
                        <a href="{{route('gyms.trainer', ['gym' => $gym->id])}}" class="btn btn-primary">Add Trainer</a>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="pts">
                                        <thead>
                                            <tr>
                                                <th>PT Name</th>
                                                <th class='hidden-xs'>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gym->pts as $pt)
                                                <tr>
                                                <td>{{$pt->name}}</td>
                                                <td class='hidden-xs'>{{$pt->email}}</td>
                                                <td><a href="{{route("pt.view", ['user' => $pt->id])}}" class="btn btn-primary btn-sm">View</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                        <div class="tab-pane" id="classes">

                        </div>
                        <div class="tab-pane" id="members">
                            <a href="{{route('gyms.member', ['gym' => $gym->id])}}" class="btn btn-primary">Add Member</a>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="membersTbl">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th class='hidden-xs'>Email</th>
                                                <th>Sessions</th>
                                                <th>Revenue</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gym->members as $member)
                                                <tr>
                                                <td>{{$member->name}}</td>
                                                <td class='hidden-xs'>{{$member->email}}</td>
                                                <td>{{$member->sessions->count()}}</td>
                                                <td>₱ {{$member->sessions->sum(function ($session) {
                                                    return $session->price;
                                                })}}</td>
                                                <td><a href="{{route("gyms.member.edit", ['gym' => $member->gym_id, 'member' => $member->id])}}" class="btn btn-primary btn-sm">Edit</a><a onclick="return confirm('Are you sure you want to delete this member');" href="{{route("gyms.member.delete", ['gym' => $member->gym_id, 'member' => $member->id])}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Classes</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Class Name:</label>
                          <input type="text" class="form-control" id="class-name" placeholder="Yoga">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Class Instructor:</label>
                          <select id="instructor" class="form-control">
                            @foreach($gym->pts as $pt)
                                <option value={{$pt->id}}>{{$pt->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Class Capacity:</label>
                            <input placeholder="10" class="form-control" id="capacity" />
                        </div>

                        <input type='hidden' id='classEdit' value=0 />
                        <input type='hidden' id='classId' value=0 />
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id='deleteClass' class="btn btn-danger" data-dismiss="modal">Delete Class</button>
                      <button type="button" id='addClass' class="btn btn-primary" data-dismiss="modal">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
    @endsection

    @section('options')
        <div class="btn-group ptActions">
            <a href="{{route('gyms.edit', ['gym' => $gym->id])}}" class='btn btn-warning'> Edit Gym</a>
            <a href="{{route('gyms.trainer', ['gym' => $gym->id])}}" class='btn btn-primary'> Add Trainer</a>
        </div>
    @endsection

    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css" integrity="sha256-4qBzeX420hElp9/FzsuqUNqVobcClz1BjnXoxUDSYQ0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.css" integrity="sha256-Bie1IgCRg3BJ2YQBmzyDzPH7y9HvhB2lWq+2J2Rqh7I="
    crossorigin="anonymous" />
        <style>
            #pts_wrapper, #membersTbl_wrapper {
                margin-top: 20px;
            }
        </style>
    @endpush

    @section('js')
    @include('components.datatables')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js" integrity="sha256-VBLiveTKyUZMEzJd6z2mhfxIqz3ZATCuVMawPZGzIfA="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js" integrity="sha256-4+rW6N5lf9nslJC6ut/ob7fCY2Y+VZj2Pw/2KdmQjR0="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js" integrity="sha256-jdwX0QzXB7z7Xc7Vz0ovtIHWO5qIZWg0aLcGv44JDgE=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#classes').fullCalendar('refetchEvents');
            $('#classes').fullCalendar('render');
        });
    });
    $(function () {
        var drop = {
            start: null,
            end: null
        }

        $('#deleteClass').on('click', function(){
            $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("gyms.classes.delete", ["gym" => $gym->id]) }}/' + $('#classId').val(),
                        type: 'POST',
                        error: function (data) {
                            alert("Error");
                        },
                        success: function (result) {
                            classes.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Class has been removed');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }

                        }
                    });
        });

        $('#addClass').on('click', function(){
            editing = $('#classEdit').val();
            console.log(editing);
            if(editing === "true"){
                // Edit Class
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}/' + $('#classId').val(),
                        type: 'POST',
                        data: {
                            // start: drop.start.unix(),
                            // end: drop.end.unix(),
                            name: $('#class-name').val(),
                            trainer_id: $('#instructor').val(),
                            capacity: $('#capacity').val()
                        },
                        error: function (data) {
                            alert("Error");
                        },
                        success: function (result) {
                            classes.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Class has been updated');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }

                        }
                    });
            }else if(editing === "false"){
                // Add Class// 
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}',
                        type: 'POST',
                        data: {
                            start: drop.start.unix(),
                            end: drop.end.unix(),
                            name: $('#class-name').val(),
                            trainer_id: $('#instructor').val(),
                            capacity: $('#capacity').val()
                        },
                        error: function (data) {
                            alert("Error");
                        },
                        success: function (result) {
                            classes.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Class has been added');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }

                        }
                    });

            }

            // $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}',
            //             type: 'POST',
            //             data: {
            //                 start: drop.start.unix(),
            //                 end: drop.end.unix(),
            //                 name: $('#class-name').val(),
            //                 instructor: $('#instructor').val(),
            //                 capacity: $('#capacity').val()
            //             },
            //             error: function (data) {
            //                 alert("Error");
            //             },
            //             success: function (result) {
            //                 classes.fullCalendar('refetchEvents');
            //                 if (result) {
            //                     alert('Class has been added');
            //                 } else {
            //                     alert("There was an unexpected error, please try again");
            //                 }

            //             }
            //         });
        });

        var classes = $('#classes').fullCalendar({
            events: function (start, end, timezone, callback) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}',
                    data: {
                        start: start.unix(),
                        end: end.unix()
                    },
                    error: function (data) {
                        alert("Error");
                    },
                    success: function (data) {
                        let events = data.map(event => {
                            return {
                                event_id: event.id,
                                title: `${event.name} (${event.capacity}) with ${event.trainer.name}`,
                                start: moment(event.start),
                                end: moment(event.end),
                                ev: event
                            }
                        });
                        callback(events);
                    }
                });
            },
            select: function (start, end, allDay) {
                if (start.isBefore(moment())) {
                    classes.fullCalendar('unselect');
                    return false;
                }

                drop.start = start;
                drop.end = end;
                $('#classEdit').val(false);
                $('#classId').val("");
                $('#class-name').val("");
                $('#instructor').val("");
                $('#capacity').val("");
                $('#deleteClass').hide();
                $('#classModal').modal();  
            },
            eventRender: function (event, element) {
                let content = element.find(".fc-content");
                let title = element.find(".fc-title");
                title.prependTo(content);
            },
            eventDrop: function (event, delta, revertFunc) {
                if (event.start.isBefore(moment())) {
                    revertFunc();
                    alert("You can't move a class into the past");
                    return;
                }
                if (confirm("Are you sure about this change?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}/' + event.event_id,
                        type: 'POST',
                        data: {
                            start: event.start.unix(),
                            end: event.end.unix()
                        },
                        error: function (data) {
                            alert("Error Drop");
                        },
                        success: function (result) {
                            classes.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Class Updated.');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
                } else {
                    revertFunc();
                }
            },
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
                $('#classEdit').val(true);
                $('#classId').val(calEvent.event_id);
                $('#class-name').val(calEvent.ev.name);
                $('#instructor').val(calEvent.ev.trainer_id);
                $('#capacity').val(calEvent.ev.capacity);
                $('#deleteClass').show();
                $('#classModal').modal();  
                
                // $('#sessionId').val(calEvent.event_id);
                // $('#sessionCancelModal').modal(); 
            },
            eventResize: function (event, delta, revertFunc) {
                if (confirm("Are you sure about this change?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("gyms.classes", ["gym" => $gym->id]) }}/' + event.event_id,
                        type: 'POST',
                        data: {
                            start: event.start.unix(),
                            end: event.end.unix()
                        },
                        error: function (data) {
                            console.log(data);
                            alert("Error Resize");
                        },
                        success: function (result) {
                            console.log(classes.fullCalendar('refetchEvents'));
                            if (result) {
                                alert('Availability Updated.');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
                } else {
                    revertFunc();
                }
            },
            timeFormat: 'H:mm',
            firstDay: 1,
            slotLabelInterval: "01:00",
            slotLabelFormat: 'H:mm',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek,listWeek'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            defaultView: 'agendaWeek',
            views: {
                agendaWeek: {
                    allDaySlot: false,
                    slotDuration: '00:15:00'
                }
            },
            nowIndicator: true,
            editable: true,
            eventOverlap: false,
            selectOverlap: false,
            selectable: true,
            selectMinDistance: 1,
            selectHelper: true,
            defaultTimedEventDuration: '01:00:00',
            allDayDefault: false,
            forceEventDuration: true,
            eventColor: "#804c9e99"
        });
    });


$(document).ready(function () {
        $('#pts').DataTable({
            "columns": [
                null,
                null,
                {
                    "orderable": false
                },
            ]
        });

        $('#membersTbl').DataTable();
    });

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
                    text: 'Top 5 Highest revenue (PT)'
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
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Aug 2018"
                    },
                    {
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Sep 2018"
                    },
                    {
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Oct 2018"
                    },
                    {
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Nov 2018"
                    },
                    {
                        "y": Math.floor(Math.random() *
                            500000),
                        "name": "Dec 2018"
                    },
                    {
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Jan 2019"
                    },
                    {
                        "y": Math.floor(Math.random() * 500000),
                        "name": "Feb 2019"
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
    
            }]
        });
    </script>
@endsection