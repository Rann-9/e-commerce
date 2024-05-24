@extends('layouts.parent')

@section('title', 'My Transaction')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Transaction</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                    <li class="breadcrumb-item active">My Transaction</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-title"><i class="bi bi-cart"></i> List Transaction</div>

            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Account</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($myTransaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ number_format($row->total_price) }}</td>
                            <td>
                                @if ($row->status == 'Expired')
                                    <span class="badge bg-danger">Expired</span>
                                @elseif ($row->status == 'PENDING')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($row->status == 'SETTLEMENT')
                                    <span class="badge bg-info">Settlement</span>
                                @else
                                    <span class="badge bg-success">Success</span>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('admin.my-transaction.showDataBySlugAndId', [$row->slug, $row->id]) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                @else
                                <a href="{{ route('user.my-transaction.showDataBySlugAndId', [$row->slug, $row->id]) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
