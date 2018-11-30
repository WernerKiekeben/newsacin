@extends('layouts.app')

@section('content')
<a href="{{url()->previous()}}" class="btn btn-secondary float-right">Go Back</a>
<div class="clearfix"></div>
<h1>Edit Post</h1>



{!! Form::open(['action' => ['NewsController@updateNews', $new->id], 'method' => 'POST']) !!}

<div class="form-group row">
    {{Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label'])}}
    {{Form::text('title', $new->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
</div>

<div class="form-group row">
    {{Form::label('state', 'State', ['class' => 'col-sm-2 col-form-label'])}}
    {{Form::select('state', array('1' => 'Published', '2' => 'Unpublished'), null, ['class' => 'form-control'])}}
</div>

<div class="form-group row">
    {{Form::textarea('body', $new->content, ['class' => 'form-control'])}}
</div>

{{Form::hidden('_method', 'PUT')}}
<div class="form-group row float-right">
    {{Form::Submit('Submit', ['class' => 'btn btn-primary'])}}
</div>

{!! Form::close() !!}

 @endsection