@extends('layouts.parent')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Admin</a></li>
            </ol>
        </nav>
    </div>

    Hello {{ Auth::user()->name }}
@endsection
