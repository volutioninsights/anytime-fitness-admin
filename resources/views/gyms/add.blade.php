@extends('layouts.anytime')
@section('content')
{!! Form::open(['route' => ['gyms.new'], 'id' => 'gymForm', 'class' => 'form-horizontal row-border', 'style' =>
'border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;']) !!}
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label">Gym Name</label>
            <div class="col-sm-6">
                {!! Form::text('name', '', ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>
            <div class="col-sm-6">
                {!! Form::text('address', '', ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">City</label>
            <div class="col-sm-6">
                {!! Form::text('city', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Zip</label>
            <div class="col-sm-6">
                {!! Form::text('zip', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-6">
                {!! Form::text('phone', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                {!! Form::text('email', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-toolbar">
                        <button onclick="$('#gymForm').submit();" class="btn-primary btn">Create</button>
                        <button class="btn-default btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('js')
<script src="/assets/plugins/parsley/parsley.js"></script>
<script>
    $(function () {

        $('#gymForm').parsley({
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
    });
</script>
@endsection