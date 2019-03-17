@extends('layouts.anytime')
@section('content')
<div class="panel panel-primary">
    {{-- <div class="panel-heading">
        <h4>Basic Form Elements</h4>
        <div class="options">
            <a href="javascript:;"><i class="fa fa-cog"></i></a>
            <a href="javascript:;"><i class="fa fa-wrench"></i></a>
            <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div> --}}
    <div class="panel-body" style="display: block;">
        {!! Form::open(['route' => ['admin.users.view', $user->id], 'id' => 'userForm', 'class' => 'form-horizontal row-border', 'style' => 'border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;']) !!}
            <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Role</label>
                <div class="col-sm-6">
                    {{ Form::select('role', $roles, $user->isAdmin(), ['class' => 'form-control']) }}
                </div>
            </div>
        {!! Form::close() !!}
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-toolbar">
                        <button onclick="$('#userForm').submit();" class="btn-primary btn">Submit</button>
                        <button class="btn-default btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection