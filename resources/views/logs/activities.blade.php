@extends('layouts.master')

@section('title', 'Account Activities')

@section('content')
<div class="flex flex-col gap-6">
    <div class="px-2">
        <h2 class="text-2xl font-bold text-[#26282A]">Account Activities</h2>
        <p class="text-sm text-slate-500">History of actions performed on your account.</p>
    </div>

    <div class="bg-white rounded-[32px] p-8 shadow-sm">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-xs uppercase border-b border-slate-50">
                    <th class="pb-5 px-4">Action</th>
                    <th class="pb-5 px-4">Details</th>
                    <th class="pb-5 px-4 text-right">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($logs as $log)
                <tr>
                    <td class="py-5 px-4 font-bold text-sm text-[#26282A]">{{ $log->action }}</td>
                    <td class="py-5 px-4 text-sm text-slate-500 italic">{{ $log->details }}</td>
                    <td class="py-5 px-4 text-right text-sm text-slate-400">{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="py-10 text-center text-slate-400">No activities found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">{{ $logs->links() }}</div>
    </div>
</div>
@endsection