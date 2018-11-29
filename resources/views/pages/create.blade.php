@extends('layouts.app')

@section('content')
<br>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="/news">List of News</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/create">Create News</a>
    </li>
</ul>

<div id="content">
    <div id="create_field">
        @include('inc.create')
    </div>
</div>

@endsection