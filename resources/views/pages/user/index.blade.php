@extends('layouts.parent')

@section('title', 'Dashboard - Home')

@section('content')
    <div class="section dashboard">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Dashboard <span class="badge bg-primary text-white"><i class="bi bi-person-fill"></i>
                        Admin</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span class="text-danger small pt-1 fw-bold">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section dashboard">
        <div class="row">
            <div class="col-md-3">
                <div class="card info-card sales-card">
                    {{-- User Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Total Expired</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $expired }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card info-card sales-card">
                    {{-- User Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Total Pending</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pending }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card info-card sales-card">
                    {{-- User Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Total Settlement</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $settlement }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card info-card sales-card">
                    {{-- User Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Total Success</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $success }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
