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
                    <table class="table table-light table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach($news as $new)
                        <tbody>
                            <tr data-id="{{$new->id}}">
                                <td scope="row">
                                    <a href="/news/{{$new->id}}">
                                        <strong>{{$new->title}}</strong> 
                                    </a>
                                </td>
                                <td> {{$new->publication}} </td>
                                {{-- Check for correct user --}}
                                @if(Auth::id() == $new->idUser)
                                    <td>
                                        <a class="btn btn-outline-info" href="/news/{{$new->id}}/edit">
                                            <i class="fas fa-edit fa-lg"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['NewsController@destroy', $new->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger', 'onclick' => "return confunction();"])}}
                                        {!!Form::close()!!}
                                    </td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
