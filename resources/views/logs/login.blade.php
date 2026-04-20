@extends('layouts.master')
@section('title', 'Login Logs')
@section('content')
<div class="bg-white rounded-[32px] p-8 shadow-sm">
    <h2 class="text-2xl font-bold mb-6">Login History</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-sm uppercase tracking-wider border-b border-slate-100">
                    <th class="pb-4 font-semibold">Date & Time</th>
                    <th class="pb-4 font-semibold">IP Address</th>
                    <th class="pb-4 font-semibold">Device / Browser</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                @foreach($logs as $log)
                <tr>
                    <td class="py-4 font-medium">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                    <td class="py-4 text-slate-500">{{ $log->ip_address }}</td>
                    <td class="py-4 text-slate-500">{{ Str::limit($log->user_agent, 50) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection