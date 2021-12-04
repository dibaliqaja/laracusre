@extends('layouts.main')

@section('title_page', 'Employees')
@section('content')    
    <div id="app" style="flex: 0 0 100%;max-width: 100%;">
        <router-view></router-view>
    </div>
@endsection