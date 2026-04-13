@extends('layouts.master')
@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- My Friends List -->
    <div>
        <h4 class="text-xl font-bold text-[#26282A] mb-6">My Contacts</h4>
        <div class="bg-white rounded-[32px] p-6 shadow-sm">
            <div class="space-y-4">
                @forelse($friends as $friend)
                <div class="flex items-center justify-between p-4 rounded-2xl border border-slate-100 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($friend->name) }}&background=random&color=fff" class="w-10 h-10 rounded-full">
                        <div>
                            <strong class="block text-[#26282A] text-sm">{{ $friend->name }}</strong>
                            <small class="text-slate-500">{{ $friend->email }}</small>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-100">Contact</span>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="bi bi-people text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 text-sm">No contacts added yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add New Friends -->
    <div>
        <h4 class="text-xl font-bold text-[#26282A] mb-6">Find People</h4>
        <div class="bg-white rounded-[32px] p-6 shadow-sm">
            <div class="space-y-4">
                @forelse($users as $user)
                <div class="flex items-center justify-between p-4 rounded-2xl border border-slate-100 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="bg-slate-100 p-2.5 rounded-full text-slate-400">
                            <i class="bi bi-person-fill text-lg"></i>
                        </div>
                        <span class="font-medium text-[#26282A] text-sm">{{ $user->name }}</span>
                    </div>
                    <form action="{{ route('friends.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="friend_id" value="{{ $user->id }}">
                        <button type="submit" class="px-4 py-2 bg-[#26282A] hover:bg-[#151617] text-white text-xs font-medium rounded-xl transition-colors shadow-sm">
                            Add Contact
                        </button>
                    </form>
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-slate-500 text-sm">No new users found to add.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection