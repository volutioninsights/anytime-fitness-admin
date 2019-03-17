@extends('layouts.anytime')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body collapse in">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped datatables" id="members">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Gym</th>
                            <th>Email</th>
                            <th>Amount of Sessions</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{$member->name}}</td>
                        <td><a href="{{route('gyms.view', ['gym' => @$member->gym->id])}}">{{@$member->gym->name}}</a></td>
                            <td><a href="mailto:{{$member->email}}">{{$member->email}}</a></td>
                            <td>{{$member->sessions->count()}}</td>
                            <td>₱ {{$member->sessions->sum(function ($session) {
                                return $session->price;
                            })}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('components.datatables')
<script type="text/javascript">
    $(document).ready(function () {
        $('#members').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('members.get') }}",
    //         columns: [
    //     { name: 'name' },
    //     { name: 'gym.name' },
    //     { name: 'email' },
    //     { name: 'sessions.count', searchable: false },
    //     { name: 'sessions.revenue', searchable: false }
    // ],
        });
    });
</script>
@endsection