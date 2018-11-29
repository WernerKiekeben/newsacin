@extends('layouts.app')

@section('content')
<br>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="/news">List of News</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/create">Create News</a>
    </li>
</ul>

<div id="content">
    <div id="search_field">
        @include('inc.search')
    </div>

    <div id="tables">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">State</th>
                    <th colspan="2" class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            @if(count($news) > 0)
                <tbody>
                    @foreach($news as $new)
                        <tr>
                            <td>
                                <a href="/new/{{$new->id}}">
                                    {{$new->title}}
                                </a>
                            </td>
                            <td>{{$new->publication}}</td>
                            <td>{{$new->description}}</td>
                            <td>
                                <a href="/news/{{$new->id}}/edit">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                            </td>
                            <td>
                                {!!Form::open(['action' => ['NewsController@destroy', $new->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$news->links()}}
            @else
                <tr>
                    <td colspan="4" class="alert alert-warning text-center">
                        No news
                    </td>
                </tr>
            </table>
            @endif
    </div>
</div>

@endsection