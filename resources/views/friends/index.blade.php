@extends('layouts.master')
@section('content')
<div class="row">
    <!-- My Friends List -->
    <div class="col-md-6">
        <h4 class="fw-bold mb-4">My Contacts</h4>
        <div class="card border-0 shadow-sm">
            <ul class="list-group list-group-flush">
                @forelse($friends as $friend)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $friend->name }}</strong><br>
                        <small class="text-muted">{{ $friend->email }}</small>
                    </div>
                    <span class="badge bg-success rounded-pill">Contact</span>
                </li>
                @empty
                <li class="list-group-item text-center py-4 text-muted">No contacts added yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Add New Friends -->
    <div class="col-md-6">
        <h4 class="fw-bold mb-4">Find People</h4>
        <div class="card border-0 shadow-sm p-3">
            <table class="table align-middle">
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td class="text-end">
                            <form action="{{ route('friends.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                <button class="btn btn-sm btn-primary">Add Contact</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection