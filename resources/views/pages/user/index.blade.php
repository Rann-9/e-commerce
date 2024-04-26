@extends('layouts.parent')

@section('title', 'Dashboard - Home')

@section('content')
    Hello {{ Auth::user()->name }}
@endsection