@extends('layouts.anytime')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body collapse in">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped datatables" id="users">
                    <thead>
                        <tr>
                            {{-- <th class='hidden-xs'>ID</th> --}}
                            <th>Gym Name</th>
                            <th class='hidden-xs'>City</th>
                            <th class='hidden-xs'># PTs</th>
                            <th># Sessions</th>
                            <th class='hidden-xs'># Members</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gyms as $gym)
                        <tr>
                            {{-- <td class='hidden-xs'>{{$gym->id}}</td> --}}
                            <td>{{$gym->name}}</td>
                            <td class='hidden-xs'>{{$gym->city}}</td>
                            <td class='hidden-xs'>{{$gym->pts->count()}}</td>
                            <td>{{$gym->sessions}}</td>
                            <td class='hidden-xs'>{{$gym->members->count()}}</td>
                            <td><a href="{{route("gyms.view", ['gym' => $gym->id])}}" class="btn btn-primary btn-sm">View</a>
                                <a onclick="return confirm('Are you sure you want to delete this Gym? This is irreversible.')" href="{{route("gyms.delete", ['gym' => $gym->id])}}" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('options')
<div class="btn-group ptActions">
    <a href="{{route('gyms.new')}}" class='btn btn-default'> Add Gym</a>
</div>
@endsection

@section('js')
@include('components.datatables')
<script type="text/javascript">
    $(document).ready(function () {
        // $('#deleteGym').click(function(){
        //     if(confirm("Are you sure you want to delete this gym? This is irreversible")){

        //     }
        // });


        $('#users').DataTable({
            "columns": [
                null,
                null,
                null,
                null, 
                null,
                {
                    "orderable": false
                },
            ]
        });
    });
</script>
@endsection