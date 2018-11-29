
{!! Form::open(['action' => 'NewsController@storeNews', 'method' => 'POST']) !!}
<div id="leftdiv" class="float-left">
    <div class="form-group row">
        {{Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label'])}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    
    <div class="form-group row">
        {{Form::label('state', 'State', ['class' => 'col-sm-2 col-form-label'])}}
        {{Form::select('state', array('1' => 'Published', '2' => 'Unpublished'), null, ['class' => 'form-control'])}}
    </div>
</div>

<div class="clearfix"></div>

<div class="form-group row">
    {{Form::textarea('body', '', ['class' => 'form-control'])}}
</div>


<div class="form-group row float-right">
    {{Form::Submit('Submit', ['class' => 'btn btn-primary'])}}
</div>

{!! Form::close() !!}