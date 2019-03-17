@extends('layouts.anytime')
@section('content')
<div class="row">
    <div id="info" class="col-xs-6 col-sm-3">
        @if($avatar != null)
            <img class="avatar-img" src="{{asset('storage/avatars/'.$avatar->fileName)}}" />
        @else
            <img class="avatar-img" src="{{asset('assets/img/avatar.png')}}" />
        @endif
        
        <div class='panel panel-primary'>
            <div class='panel-body no-padding'>
                    <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan=2 style='text-align: center;'><span style='font-size: 18px;font-weight: bold;color:{{ $pt->disabled ? "red" : "green"}}'>{{ $pt->disabled ? "Disabled" : "Active"}}</span></td>
                                </tr>
                              <tr>
                                <td>Gym</td>
                                <td>{{$pt->gym->name}}</td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td>{{$pt->email}}</td>
                              </tr>
                              <tr>
                                    <td>Phone</td>
                                    <td>{{$pt->phone}}</td>
                                  </tr>
                                  <tr>
                                        <td>DOB</td>
                                        <td>{{@$pt->details->dob}}</td>
                                      </tr>
                                  <tr>
                                        <td>Employee Number</td>
                                        <td>{{@$pt->details->employee_number}}</td>
                                      </tr>
                                      <tr>
                                            <td>Job Title</td>
                                            <td>{{@$pt->details->job_title}}</td>
                                          </tr>
                                          <tr>
                                                <td>Contract Type</td>
                                                <td>{{@$pt->details->contract_type}}</td>
                                              </tr>
                                              <tr>
                                                    <td>Status</td>
                                                    <td>{{@$pt->details->status}}</td>
                                                  </tr>
                                                  <tr>
                                                        <td>Employment Date</td>
                                                        <td>{{@$pt->details->employment_date}}</td>
                                                      </tr>
                                                      
                            </tbody>
                          </table>
            </div>
            <div class='panel-footer'>
                        <div class="btn-group ptActions">
                                <a href="{{route('pt.edit', ['pt' => $pt->id])}}" class='btn btn-default'> Edit</a>
                                <a href="{{route('pt.delete', ['pt' => $pt->id])}}" onclick="return confirm('Are you sure you want to delete this Trainer?')" class='btn btn-danger'> Delete</a>
                                    @if(@$pt->disabled)
                                        <a href="{{route('pt.toggle', ['pt' => $pt->id])}}" class='btn btn-success'>Enable</a>
                                    @else
                                    <a href="{{route('pt.toggle', ['pt' => $pt->id])}}" class='btn btn-warning'>Disable</a>
                                    @endif
                            </div>
            </div>
        </div>
    </div>
    <div class="col">
        @include('components.stats')
        <div class="row">
            <div class="col-12">
                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#clients" data-toggle="tab">Client List</a></li>
                        <li><a href="#avail" data-toggle="tab">Availability</a></li>
                        <li><a href="#cal" data-toggle="tab">Calendar</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="clients">
                            <table class="table table-striped table-bordered datatables dataTable" id="client-list">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Phone</th>
                                        <th>Package Type</th>
                                        <th>Total Sessions</th>
                                        <th>Date Purchased</th>
                                        <th>Expiry</th>
                                        <th>Payment Mode</th>
                                        <th>Used Sessions</th>
                                        <th>Package Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client[0]->client->id}}</td>
                                        <td>{{$client[0]->client->name}}</td>
                                        <td>{{$client[0]->client->email}}</td>
                                        <td>{{$client[0]->client->phone}}</td>
                                        <td class="sessionType">{{$client[0]->sessions_type}}</td>
                                        <td>{{$client[0]->total_sessions}}</td>
                                        <td>{{$client[0]->date_purchased}}</td>
                                        
                                        <td>{{$client[0]->expiry}}</td>
                                        <td>{{$client[0]->payment_mode}}</td>
                                    <td>{{sizeof($client)}}</td>
                                    <td>₱ {{$client[0]->client->sessions->sum(function ($session) {
                                        return $session->price;
                                    })}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="avail">

                        </div>
                        <div class="tab-pane" id="cal">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Session</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Client:</label>
                <select style="width: 100%;padding: 10px 5px;" id='session-client' class='form-control'>
                    @foreach($pt->gym->members as $mem)
                        <option value={{$mem->id}}>
                        {{$mem->name}}
                        </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Session Type:</label>
                <select id='session-type' class='form-control'>
                    <option value='single'>Single Session</option>
                    <option value='wc1'>Wellness Consultation 1</option>
                    <option value='wc2'>Wellness Consultation 2</option>
                    <option value='senior'>Senior Citizens</option>
                    <option value='ra'>Reassessment</option>
                    <option value='kickstart'>Kickstart 5 Sessions (₱3750)</option>
                    <option value='p12'>Package 12 Sessions (₱10900)</option>
                    <option value='p24'>Package 24 Sessions (₱20400)</option>
                    <option value='p30'>Package 30 Sessions (₱23900)</option>
                    <option value='p50'>Package 40 + 10 Sessions (₱34999)</option>
                </select>
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Price:</label>
                    <div class="input-group">
                          <input type="text" class="form-control" id="session-price" placeholder="50">
                      <span class="input-group-addon">₱</span>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Total Sessions:</label>
                          <input type="text" class="form-control" id="total-sessions" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Session Number:</label>
                          <input type="text" class="form-control" id="session-number" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Payment Mode:</label>
                          <input type="text" class="form-control" id="payment-mode" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Date Purchased:</label>
                          <input type="text" class="form-control" id="date-purchased" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Expiry Date:</label>
                          <input type="text" class="form-control" id="expiry" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Sessions Left:</label>
                          <input type="text" class="form-control" id="sessions-left" placeholder="">
                  </div>
                  <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Notes:</label>
                              <input type="text" class="form-control" id="session-notes" placeholder="">
                      </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id='addSession' class="btn btn-primary" data-dismiss="modal">Add Session</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="sessionCancelModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Session Actions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                  <input type="hidden" id='sessionId' />
                    <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Cancellation Reason (if applicable):</label>
                            <select id='cancel-reason' class='form-control'>
                                <option value='noshow'>No Show</option>
                                <option value='cancel'>Cancelled Session</option>
                            </select>
                          </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id='cancelSession' class="btn btn-danger" data-dismiss="modal">Cancel Session</button>
              <button type="button" id='completeSession' class="btn btn-success" data-dismiss="modal">Complete Session</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.css" integrity="sha256-Bie1IgCRg3BJ2YQBmzyDzPH7y9HvhB2lWq+2J2Rqh7I="
    crossorigin="anonymous" />
<style>
    .avatar-img { 
        width: 100%;
        border: 4px solid #804c9e;
    }

    #info h3 {
        font-size: 22px;
        margin: 0;
    }

    #info p {
        margin: 0;
        font-size: 14px
    }

    .openRow {
        cursor: pointer !important;
        padding: 2px 15px !important;
    }
    
    td.details-control::before  {
        content : '\2b';
        font-size: 16px;
    }

    tr.shown td.details-control::before {
        content : '\2212';
        font-size: 16px;
    }

    .details-row th, .details-row td {
        padding: 5px;
    }

    .fc-title, .fc-time {
        text-align: center;
    }

    .fc-time span {
        font-size: 14px;
    }

    .fc-time-grid .fc-bgevent {
        border: 2px solid black;
    },
    .ptActions: {
        margin: 0 auto;
        /* padding: 10px 0; */
    }

    .fc-title {
        font-size: 0.8em;
    }

    /* .fc-time-grid .fc-slats td {
        height: 2em;
    } */
</style>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js" integrity="sha256-VBLiveTKyUZMEzJd6z2mhfxIqz3ZATCuVMawPZGzIfA="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js" integrity="sha256-4+rW6N5lf9nslJC6ut/ob7fCY2Y+VZj2Pw/2KdmQjR0="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


@include('components.datatables')
<script type="text/javascript">
    $(document).ready(function () {
        $(".sessionType").each(function() {

            var t = $(this).html()
            var amt = 0;
            switch(t){
                                case "wc1":
        type = "Wellness Consultation 1";
        break;
        case "wc2":
        type = "Wellness Consultation 2";
        break;
        case "kickstart":
        type = "Kickstart 5";
        break;
        case "p12":
        type = "Package 12";
        amt = 12;
        break;
        case "p24":
        type = "Package 24";
        amt = 24
        break;
        case "p30":
        type = "Package 30";
        amt = 30
        break;
        case "p50":
        type = "Package 40 + 10";
        amt = 50
        break;
        case "senior":
        type = "Senior Citizens";
        break;
        case "ra":
        type = "Reassesment";
        break;
        default:
        type = "Single Session";
        break;
        }
        $(this).html(type)
    });




        $('#session-client').select2({
            theme: "classic",
            dropdownParent: $('#sessionModal')
        });


        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // console.log(e);
            $('#cal').fullCalendar('refetchEvents');
            $('#cal').fullCalendar('render');

            $('#avail').fullCalendar('rerenderEvents');
            $('#avail').fullCalendar('render');

            // $('#avail').fullCalendar('render');
        });
    });
    $(function () {
        var avail = $('#avail').fullCalendar({
            events: function (start, end, timezone, callback) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("pt.availability", ["pt" => $pt->id]) }}',
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
                                title: "Availability",
                                start: moment(event.start),
                                end: moment(event.end)
                            }
                        });
                        callback(events);
                    }
                });
            },
            select: function (start, end, allDay) {
                if (start.isBefore(moment())) {
                    avail.fullCalendar('unselect');
                    return false;
                }
                var title = "Availability";
                if (confirm("Set Availability")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.availability", ["pt" => $pt->id]) }}',
                        type: 'POST',
                        data: {
                            start: start.unix(),
                            end: end.unix()
                        },
                        error: function (data) {
                            alert("Error");
                        },
                        success: function (result) {
                            avail.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Availability Set.');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
                }
                avail.fullCalendar('unselect');
            },
            eventRender: function (event, element) {
                let content = element.find(".fc-content");
                let title = element.find(".fc-title");
                title.prependTo(content);
            },
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
                if (confirm("Are you sure you want to remove this availability?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.availability", ["pt" => $pt->id]) }}/' + calEvent.event_id,
                        type: 'POST',
                        data: {
                            action: "delete"
                        },
                        error: function (data) {
                            console.log(data);
                        },
                        success: function (result) {
                            avail.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Availability has been removed');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
                } else {
                    revertFunc();
                }
            },
            eventDrop: function (event, delta, revertFunc) {
                if (event.start.isBefore(moment())) {
                    revertFunc();
                    alert("You can't move an availability into the past");
                    return;
                }
                if (confirm("Are you sure about this change?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.availability", ["pt" => $pt->id]) }}/' + event.event_id,
                        type: 'POST',
                        data: {
                            start: event.start.unix(),
                            end: event.end.unix()
                        },
                        error: function (data) {
                            alert("Error Drop");
                        },
                        success: function (result) {
                            avail.fullCalendar('refetchEvents');
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
            eventResize: function (event, delta, revertFunc) {
                if (confirm("Are you sure about this change?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.availability", ["pt" => $pt->id]) }}/' + event.event_id,
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
                            console.log(avail.fullCalendar('refetchEvents'));
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
    $(function () {
        var drop = {
            start: null,
            end: null
        }


        $('#addSession').on('click', function(){

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.session", ["pt" => $pt->id]) }}',
                        type: 'POST',
                        data: {
                            start: drop.start.unix(),
                            end: drop.start.add(1, 'hour').unix(),
                            price: $('#session-price').val(),
                            client_id: $('#session-client').val(),
                            sessions_type: $('#session-type').val(),
                            notes: $('#session-notes').val(),
                            total_sessions: $('#total-sessions').val(),
                            session_number: $('#session-number').val(),
                            payment_mode: $('#payment-mode').val(),
                            date_purchased: $('#date-purchased').val(),
                            expiry: $('#expiry').val(),
                            sessions_left: $('#sessions-left').val(),
                        },
                        error: function (data) {
                            alert("Error");
                        },
                        success: function (result) {
                            cal.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Session has been added');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
            });


            $('#cancelSession').on('click', function(){
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.session.remove", ["pt" => $pt->id]) }}/' + $('#sessionId').val(),
                        type: 'POST',
                        data: {
                            reason: $('#cancel-reason').val()
                        },
                        error: function (data) {
                            console.log(data);
                        },
                        success: function (result) {
                            cal.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Session has been changed');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
            });


            $('#completeSession').on('click', function(){
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.session.complete", ["pt" => $pt->id]) }}/' + $('#sessionId').val(),
                        type: 'POST',
                        error: function (data) {
                            console.log(data);
                        },
                        success: function (result) {
                            cal.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Session has been completed');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
            });

        var cal = $('#cal').fullCalendar({
            events: function (start, end, timezone, callback) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("pt.cal", ["pt" => $pt->id]) }}',
                    data: {
                        start: start.unix(),
                        end: end.unix()
                    },
                    error: function (data) {
                        alert("Error");
                    },
                    success: function (data) {
                        // console.log(data);

                        let d = [];

                        data.availability.forEach(event => {
                            d.push({
                                event_id: event.id,
                                title: "Availability",
                                start: moment(event.start),
                                end: moment(event.end),
                                rendering: 'background'
                            });
                        });

                        data.sessions.forEach(event => {

                            let type;
                            switch(event.sessions_type){
                                case "wc1":
        type = "Wellness Consultation 1";
        break;
        case "wc2":
        type = "Wellness Consultation 2";
        break;
        case "kickstart":
        type = "Kickstart 5";
        break;
        case "p12":
        type = "Package 12";
        break;
        case "p24":
        type = "Package 24";
        break;
        case "p30":
        type = "Package 30";
        break;
        case "p50":
        type = "Package 40 + 10";
        break;
        case "senior":
        type = "Senior Citizens";
        break;
        case "ra":
        type = "Reassesment";
        break;
        default:
        type = "Single Session";
        break;
                            }

                            d.push({
                                event_id: event.id,
                                title: '(₱'+(event.price || 0 )+') '+ type +'\n /w '+ event.client.name + '\n' + (event.notes || ''),
                                sessionId: event.id,
                                start: moment(event.when)
                            });
                        });

                        data.completeSessions.forEach(event => {

let type;
switch(event.sessions_type){
        case "wc1":
        type = "Wellness Consultation 1";
        break;
        case "wc2":
        type = "Wellness Consultation 2";
        break;
        case "p12":
        type = "Package 12";
        break;
        case "p24":
        type = "Package 24";
        break;
        case "p30":
        type = "Package 30";
        break;
        case "p50":
        type = "Package 40 + 10";
        break;
        case "senior":
        type = "Senior Citizens";
        break;
        case "ra":
        type = "Reassesment";
        break;
        default:
        type = "Single Session";
        break;
}

d.push({
    event_id: event.id,
    title: 'Completed (₱'+(event.price || 0 )+') '+ type +'\n /w '+ event.client.name + '\n' + (event.notes || ''),
    sessionId: event.id,
    start: moment(event.when),
    color: "#85c744",
    // editable: false,
    startEditable: false,
    durationEditable: false
});
});

                        callback(d);
                    }
                });
            },
            eventRender: function (event, element) {
                let content = element.find(".fc-content");
                let title = element.find(".fc-title");
                title.prependTo(content);
            },
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
                $('#sessionId').val(calEvent.event_id);
                $('#sessionCancelModal').modal(); 
                // if (confirm("Are you sure you want to remove this session?")) {
                //     $.ajax({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         url: '{{ route("pt.session.remove", ["pt" => $pt->id]) }}/' + calEvent.event_id,
                //         type: 'POST',
                //         error: function (data) {
                //             console.log(data);
                //         },
                //         success: function (result) {
                //             cal.fullCalendar('refetchEvents');
                //             if (result) {
                //                 alert('Session has been removed');
                //             } else {
                //                 alert("There was an unexpected error, please try again");
                //             }
                //         }
                //     });
                // } else {
                //     revertFunc();
                // }
            },
            eventDrop: function (event, delta, revertFunc) {
                if (event.start.isBefore(moment())) {
                    revertFunc();
                    alert("You can't move a session into the past");
                    return;
                }
                if (confirm("Are you sure about this change?")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("pt.session.change", ["pt" => $pt->id]) }}/' + event.event_id,
                        type: 'POST',
                        data: {
                            start: event.start.unix(),
                            end: event.end.unix()
                        },
                        error: function (data) {
                            alert("Error Drop");
                        },
                        success: function (result) {
                            console.log(result);
                            cal.fullCalendar('refetchEvents');
                            if (result) {
                                alert('Session Updated.');
                            } else {
                                alert("There was an unexpected error, please try again");
                            }
                        }
                    });
                } else {
                    revertFunc();
                }
            },
            // editable: true,
            eventStartEditable: true,
            // eventOverlap: false,
            // selectOverlap: false,
            selectable: true,
            select: function (start, end, allDay) {
                if (start.isBefore(moment())) {
                    cal.fullCalendar('unselect');
                    return false;
                }

                drop.start = start;
                drop.end = end;
                $('#sessionModal').modal();  
            },
            // select: function(startDate, endDate, allDay) {
            //     if (start.isBefore(moment())) {
            //         cal.fullCalendar('unselect');
            //         return false;
            //     }
            //     if (confirm("Are you sure you want to ")) {
            //         $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url: '{{ route("pt.availability", ["pt" => $pt->id]) }}',
            //             type: 'POST',
            //             data: {
            //                 start: start.unix(),
            //                 end: end.unix()
            //             },
            //             error: function (data) {
            //                 alert("Error");
            //             },
            //             success: function (result) {
            //                 avail.fullCalendar('refetchEvents');
            //                 if (result) {
            //                     alert('Availability Set.');
            //                 } else {
            //                     alert("There was an unexpected error, please try again");
            //                 }
            //             }
            //         });
            //     }
            //     alert('selected ' + startDate.format() + ' to ' + endDate.format());
            // },
            eventTextColor: '#000',
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
            defaultTimedEventDuration: '01:00:00',
            allDayDefault: false,
            forceEventDuration: true,
            eventColor: "#804c9e99"
        });
    });

    $(document).ready(function () {
        $('#client-list').DataTable({});

        // var table = $('#client-list').DataTable({
        //     order: [
        //         [2, "asc"]
        //     ],
        //     columns: [{
        //             className: 'details-control',
        //             defaultContent: '',
        //             data: null,
        //             orderable: false
        //         },
        //         {
        //             data: 'client.id'
        //         },
        //         {
        //             data: 'client.name'
        //         },
        //         {
        //             data: 'client.email'
        //         },
        //         {
        //             data: 'type.name'
        //         }
        //     ],
        //     data: @json($pt['packages'])
        // });


        $('#client-list tbody').on('click', 'tr', function () {
            var tr = $(this).closest('tr'),
                row = table.row(tr);

            if (row.child.isShown()) {
                tr.next('tr').removeClass('details-row');
                row.child.hide();
                tr.removeClass('shown');
            } else {
                if (table.row('.shown').length) {
                    $('.details-control', table.row('.shown').node()).click();
                }
                row.child(format(row.data())).show();
                tr.next('tr').addClass('details-row');
                tr.addClass('shown');
            }
        });
    });



    function format(d) {
        // `d` is the original data object for the row
        return `
        <div class='details-row'>
            <div class='col-sm-12'>
                <table width="100%">
                    <tr>
                        <td rowspan=4 style="max-width: 50px;" ><img class='avatar-img' src="/assets/img/avatar.png" /></td>
                        <th>Package Type</th>
                        <td>${d.type.name}</td>
                        <th>Expiry</th>
                        <td>${d.expiry}</td>
                    </tr>
                    <tr>
                        <th>Used Sessions</th>
                        <td>${d.sessionsUsed}</td>
                        <th>Last Wellness Consultation</th>
                        <td>${d.lastWC}</td>
                    </tr>
                    <tr>
                        <th>Remaining Sessions</th>
                        <td>${d.type.sessions - d.sessionsUsed}</td>
                        <th>Next Wellness Consultation</th>
                        <td>${d.nextWC}</td>
                    </tr>
                    <tr>
                        <th>Next Session</th>
                        <td>${d.nextSession ? d.nextSession.session_date : "No Upcoming Session" }</td>
                    </tr>
                </table>
            </div>      
            <div class='col-sm-6'>
                
            </div>        
        </div>
        `;
    }
</script>
@endsection