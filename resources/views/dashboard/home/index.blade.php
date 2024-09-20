@extends('layouts.dashboardmaster')


@section('content')

<h1>{{ auth()->user()->name }} - {{ auth()->user()->email }}</h1>

@endsection
