@extends('layouts.anytime')
@section('content')
{!! Form::open(['id' => 'ptForm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data', 'style'
=>
'border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;']) !!}
<div class='row'>
    <div class='col-md-12'>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class='col-md-5 col-sm-12'>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Avatar</label>
                        <div class="col-sm-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new" data-trigger="fileinput">Select image</span>
                                        <span class="fileinput-exists" data-trigger="fileinput">Change</span>
                                        <input type="file" name="avatar"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-7 col-sm-12'>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-6">
                            {!! Form::text('name', @$data['name'], ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            {!! Form::email('email', @$data['email'], ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-6">
                            {!! Form::text('phone', @$data['phone'], ['class' => 'form-control',
                            'data-parsley-type' => 'digits']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Education & Certification</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('education', @$data['education'], ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Expertise</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('expertise', @$data['expertise'], ['class' => 'form-control',
                            'id' => 'specialities'])
                            !!}
                        </div>
                    </div>
                </div>
            </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                                <button onclick="$('#ptForm').submit();" class="btn-primary btn">Create</button>
                                <button class="btn-default btn">Cancel</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css"
    integrity="sha256-4qBzeX420hElp9/FzsuqUNqVobcClz1BjnXoxUDSYQ0=" crossorigin="anonymous" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js" integrity="sha256-l6+Sy1aRcXA+XZ/kFMXGnQcAEpB8Hlx4SCCpQ5TpyEs="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js" integrity="sha256-zrKYjrV5tdhLTivmOO9TAI5x6i5dcMVO4YOi/zUAqrk="
    crossorigin="anonymous"></script>
<script>
    $(function () {

        $('#ptForm').parsley({
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