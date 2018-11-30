<h1>Search</h1>
<hr>

{!! Form::open(['method' => 'POST']) !!}
<div class="form-group row">
    {{Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label'])}}
    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
</div>
<div class="form-group row">
    {{Form::label('date', 'Date', ['class' => 'col-sm-2 col-form-label']) }}
    {{-- {{Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control'])}} --}}
    <input type="date" id="date" name="date" class="form-control" max=<?=date('Y-m-d');?>>
</div>
<div class="form-group row">
    {{Form::label('state', 'State', ['class' => 'col-sm-2 col-form-label'])}}
    {{Form::select('state', array('' => 'Option', '1' => 'Published', '2' => 'Unpublished'), null, ['class' => 'form-control'])}}
</div>
<div class="form-group row float-right">
    {{Form::Submit('Search', ['class' => 'form-control btn btn-primary', 'id' => 'srchBtn'])}}
</div>

{!! Form::close() !!}