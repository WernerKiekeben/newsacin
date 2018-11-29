@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Your 10 most recent news!</h1>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($news as $new)
                            <tr>
                                <td>{{$new->title}}</td>
                                <td>{{$new->publication}}</td>
                                <td><a href="/news/{{$new->id}}/edit" class="btn btn-info">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['NewsController@destroy', $new->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
