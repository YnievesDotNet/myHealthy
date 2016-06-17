@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}">
@endsection

<div class="row">
    <div class="form-group col-xs-12">
        {!! Form::text('name', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=> trans('manager.service.form.name.label') )) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {!! Form::textarea('description', null,
                array('class'=>'form-control',
                    'id' => 'description',
                    'placeholder'=> trans('manager.contacts.form.description.label') )) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {!! Form::textarea('prerequisites', null,
                array('class'=>'form-control',
                    'id' => 'prerequisites',
                    'placeholder'=> trans('manager.contacts.form.prerequisites.label') )) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {!! Button::primary($submitLabel)->large()->block()->submit() !!}
        </div>
    </div>
</div>

@section('footer_scripts')
    <script type="text/javascript"
            src="{{ asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('bower_components/bootstrap3-wysihtml5-bower/dist/locales/bootstrap-wysihtml5.' .  str_replace('_', '-', substr(App::getLocale(), 0, 5))  . '.js') }}"></script>
    <script type="text/javascript">
        var locale = '{{ str_replace('_', '-', substr(App::getLocale(), 0, 5)) }}';
        $('#description').wysihtml5({locale: locale});
        $('#prerequisites').wysihtml5({locale: locale});
    </script>
@endsection