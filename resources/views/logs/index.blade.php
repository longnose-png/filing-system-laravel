@extends('layouts.master')
@section('content')
<h2 class="fw-bold mb-4">Activity Logs</h2>
<div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td><span class="badge bg-primary">{{ $log->action }}</span></td>
                    <td>{{ $log->details }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection