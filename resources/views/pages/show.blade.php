@extends('layouts.app')

@section('content')
<h1>{{$new[0]->title}}</h1>
<p> {!! $new[0]->content !!} </p>
<hr>
<small>Created at {{$new[0]->created_at}}, by {{$new[0]->name}}</small>
<br>
<a href="{{url()->previous()}}" class="btn btn-secondary float-right">Go Back</a>
<div class="clearfix"></div>
@endsection