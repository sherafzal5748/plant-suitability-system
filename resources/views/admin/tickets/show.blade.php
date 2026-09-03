@extends('layouts.dashboard_layout')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.tickets') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-500 hover:text-gray-700">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to all tickets
        </a>

        <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST"
            onsubmit="return confirm('Delete this ticket and all its replies? This cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700">
                Delete Ticket
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ticket detail --}}
    <div class="border border-gray-200 rounded-xl bg-white p-5 mb-6">
        <div class="flex items-start justify-between gap-3">
            <div>
                <p class="text-xs text-gray-400 mb-1">{{ $ticket->user->first_name }} {{ $ticket->user->last_name }} · {{ $ticket->user->email }}</p>
                <h1 class="text-base font-semibold text-gray-900">{{ $ticket->topic }}</h1>
                <p class="mt-1 text-xs text-gray-400">Submitted {{ $ticket->created_at->diffForHumans() }}</p>
            </div>
            <span class="flex-shrink-0 text-xs font-medium px-2.5 py-1 rounded-full {{ $ticket->status === 'answered' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                {{ $ticket->status === 'answered' ? 'Answered' : 'Open' }}
            </span>
        </div>
        <p class="mt-4 text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $ticket->message }}</p>
    </div>

    {{-- Reply thread --}}
    @if($ticket->replies->isNotEmpty())
        <div class="space-y-3 mb-6">
            @foreach($ticket->replies as $reply)
                <div class="flex gap-3">
                    <div class="flex-shrink-0 w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-semibold">B</div>
                    <div class="flex-1 bg-emerald-50/60 rounded-lg px-3.5 py-2.5">
                        <p class="text-xs font-medium text-emerald-700 mb-0.5">
                            {{ $reply->admin->first_name ?? 'Botanist Team' }} · {{ $reply->created_at->diffForHumans() }}
                        </p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $reply->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Reply form --}}
    <div class="border border-gray-200 rounded-xl bg-white p-5">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-3">Send a Reply</h2>
        <form action="{{ route('admin.tickets.reply', $ticket) }}" method="POST" class="space-y-3">
            @csrf
            <textarea
                name="message"
                required
                rows="4"
                placeholder="Write your advisory response for the user..."
                class="w-full text-sm rounded-lg border border-gray-200 px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none transition"
            >{{ old('message') }}</textarea>
            <button type="submit" class="py-2.5 px-5 text-sm font-medium rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                Send Reply
            </button>
        </form>
    </div>

</div>
@endsection
