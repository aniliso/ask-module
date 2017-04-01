@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ask::questions.title.edit question') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ask.question.index') }}">{{ trans('ask::questions.title.questions') }}</a></li>
        <li class="active">{{ trans('ask::questions.title.edit question') }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
@stop

@section('content')
    {!! Form::open(['route' => ['admin.ask.question.update', $question->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::normalInput("first_name", trans('ask::questions.form.first_name'), $errors, $question) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::normalInput("last_name", trans('ask::questions.form.last_name'), $errors, $question) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::normalInput("email", trans('ask::questions.form.email'), $errors, $question) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::normalInput("phone", trans('ask::questions.form.phone'), $errors, $question) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! BSForm::label(trans('ask::questions.form.question')) !!}
                            {!! BSForm::textarea('question', $question->question, ['class'=>'textarea']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::normalTextarea('answer', trans('ask::questions.form.answer'), $errors, $question) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ask.question.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.ask.question.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@stop
