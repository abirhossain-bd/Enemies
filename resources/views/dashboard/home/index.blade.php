@extends('layouts.dashboardmaster')

@section('title')
Home

@endsection

@section('content')
<x-breadcum title="Home page"></x-breadcum>


<h1>{{ auth()->user()->name }} - {{ auth()->user()->email }}</h1>

@endsection
