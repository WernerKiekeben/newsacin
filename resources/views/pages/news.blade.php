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
        @include('inc.table')
    </div>
</div>

@endsection