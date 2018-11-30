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
        <table class="table table-light table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">State</th>
                    <th colspan="2" class="text-center" scope="col">Actions</th>
                </tr>
            </thead>
            @if(count($news) > 0)
                <tbody>
                    @foreach($news as $new)
                    <tr data-id="{{$new->id}}">
                            <td class="firstTd" scope="row"> <strong>{{$new->title}}</strong> </td>
                            <td>{{$new->publication}}</td>
                            <td>{{$new->description}}</td>
                            {{-- Check for correct user --}}
                            @if(Auth::id() == $new->idUser || Auth::user()->name == 'Admin')
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $news->appends(\Request::except('_token'))->render() }}
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