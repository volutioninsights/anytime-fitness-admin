@extends('layouts.anytime')
@section('content')

@if (@$success)
    <h4>Password Changed!</h4>
@endif

@foreach (@$errors as $e)
<h4>{{$e}}</h4>
@endforeach

{!! Form::open(['id' => 'userForm', 'class' => 'form-horizontal row-border', 'style'
=>
'border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;']) !!}
<div class='row'>
    <div class='col-12 col-md-6'>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class='col-12'>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Current Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('currentPW', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">New Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('newPW', ['class' => 'form-control', 'required', "id" => "newPW"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('newPWConfirm', ['class' => 'form-control', 'required', 'data-parsley-equalto' => '#newPW']) !!}
                        </div>
                    </div>
                </div>
            </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                                <button onclick="$('#userForm').submit();" class="btn-primary btn">Save</button>
                                <a href="{{ route('dash')}}" class="btn-default btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik="
    crossorigin="anonymous" />
<style>
    .select2-container--default .select2-selection--multiple {
        border-radius: 0;
        border-color: #d2d3d6;
    }

    .has-error .select2-selection {
        border-color: #a81515;
    }
</style>
@endsection

@section('js')
<script src="/assets/plugins/parsley/parsley.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM="
    crossorigin="anonymous"></script>
    <script>
    $(function () {
        $('#userForm').parsley({
            successClass: 'has-success',
            errorClass: 'has-error',
            classHandler: function (Field) {
                let f = Field.$element.closest('.form-group');
                if (!$(f).hasClass('has-error')) {
                    return f;
                }
            },
            errorsContainer: function (Field) {
                console.log(Field.$element.closest('.form-group').find('div'));
                return Field.$element.closest('.form-group').find('>div');
            },
            errorsWrapper: '<ul class=\"help-block list-unstyled\"></ul>',
            errorTemplate: '<li></li>'
        });

        // $('.mask').inputmask();
    });
</script>
@endsection