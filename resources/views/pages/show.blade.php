@extends('layouts.app')

@section('content')
<a href="{{url()->previous()}}" class="btn btn-secondary float-right">Go Back</a>
<div class="clearfix"></div>

<h1>{{$new[0]->title}}</h1>
<p> {!! $new[0]->content !!} </p>
<hr>
<small>Created at {{$new[0]->created_at}}, by {{$new[0]->name}}</small>
<br>
{!!Form::open(['action' => ['NewsController@destroy', $new[0]->id], 'method' => 'POST', 'class' => 'float-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confunction();"])}}
{!!Form::close()!!}
@endsection