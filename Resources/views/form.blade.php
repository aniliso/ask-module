<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg modal-btn" data-toggle="modal" data-target="#askModal">
    <span class="question-icon"><i class="fa fa-question" aria-hidden="true"></i></span>
    {{ trans('themes::ask.button') }}
</button>

<!-- Modal -->
<div class="modal fade" id="askModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ trans('themes::ask.title') }}</h4>
            </div>
            {!! Form::open(['@submit.prevent'=>'submitForm', 'route' => 'ask.question.store', 'files'=>true, 'method'=>'post', 'id'=>'ask']) !!}
            <pnotify v-if="success" title="{{ trans('ask::questions.messages.success title') }}" type="success" content="{{ trans('ask::questions.messages.success message') }}"></pnotify>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.first_name }">
                            {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder' => trans('ask::questions.form.first_name'), 'v-model'=>'formInputs.first_name']) !!}
                            <span v-for="error in formErrors.first_name" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.last_name }">
                            {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder' => trans('ask::questions.form.last_name'), 'v-model'=>'formInputs.last_name']) !!}
                            <span v-for="error in formErrors.last_name" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.phone }">
                            {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder' => trans('ask::questions.form.phone'), 'v-model'=>'formInputs.phone']) !!}
                            <span v-for="error in formErrors.phone" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.email }">
                            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder' => trans('ask::questions.form.email'),'v-model'=>'formInputs.email']) !!}
                            <span v-for="error in formErrors.email" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.question }">
                            {!! Form::textarea('message',old('message'),['placeholder' => trans('ask::questions.form.question'), 'v-model'=>'formInputs.question', 'class'=>'form-control']) !!}
                            <span v-for="error in formErrors.question" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="form-group" :class="{ 'has-error' : formErrors.captcha_ask }">
                            {!! Captcha::image('captcha_ask') !!}
                            <span v-for="error in formErrors.captcha_ask" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="fileinput fileinput-new pull-right-xs" data-provides="fileinput" :class="{ 'has-error' : formErrors.attachment }">
                                <span class="btn btn-default btn-file"><span>{{ trans('ask::questions.form.attachment') }}</span>
                                    <input type="file" name="attachment" v-on:change="onFileChange"/>
                                </span>
                            <span class="fileinput-filename"></span><span class="fileinput-new">{{ trans('ask::questions.messages.file not selected') }}</span>
                            <span v-for="error in formErrors.attachment" class="help-block validMessage">@{{ error }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="modalClose">{{ trans('global.buttons.close') }}</button>
                {!! Form::submit(trans('global.buttons.send'), ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{!! Asset::add(mix('assets/js/manifest.js')->toHtml()) !!}
{!! Asset::add(mix('assets/js/vendor.js')->toHtml()) !!}
{!! Asset::add('assets/vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
{!! Asset::add('assets/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
{!! Asset::add('assets/vendor/jquery-loadingoverlay/loadingoverlay.min.js') !!}
{!! Asset::add('assets/vendor/jquery-loadingoverlay/loadingoverlay_progress.min.js') !!}
{!! Asset::add('assets/vendor/pnotify/pnotify.css') !!}
{!! Asset::add('assets/vendor/pnotify/pnotify.js') !!}

@push('js_inline')
<script src="{!! Module::asset('ask:js/ask.js') !!}"></script>
{!! Captcha::setLang(locale())->scriptWithCallback(['captcha_ask']) !!}
@endpush