@extends('layouts.dashboard_layout')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Advisory Tickets</h1>
            <p class="mt-1 text-sm text-gray-500">Review plant-support requests from users and send replies.</p>
        </div>

        {{-- Status filter --}}
        <div class="flex gap-2">
            <a href="{{ route('admin.tickets') }}" class="text-xs font-medium px-3 py-1.5 rounded-full transition {{ request('status') ? 'text-gray-500 hover:bg-gray-100' : 'bg-slate-800 text-white' }}">All</a>
            <a href="{{ route('admin.tickets', ['status' => 'open']) }}" class="text-xs font-medium px-3 py-1.5 rounded-full transition {{ request('status') === 'open' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:bg-gray-100' }}">Open</a>
            <a href="{{ route('admin.tickets', ['status' => 'answered']) }}" class="text-xs font-medium px-3 py-1.5 rounded-full transition {{ request('status') === 'answered' ? 'bg-emerald-600 text-white' : 'text-gray-500 hover:bg-gray-100' }}">Answered</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-gray-200 rounded-xl bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <th class="px-5 py-3">User</th>
                    <th class="px-5 py-3">Topic</th>
                    <th class="px-5 py-3">Message</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Submitted</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50/60 transition">
                        <td class="px-5 py-3.5 text-gray-800 font-medium whitespace-nowrap">
                            {{ $ticket->user->first_name }} {{ $ticket->user->last_name }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-600 whitespace-nowrap">{{ $ticket->topic }}</td>
                        <td class="px-5 py-3.5 text-gray-500 max-w-xs truncate">{{ $ticket->message }}</td>
                        <td class="px-5 py-3.5">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $ticket->status === 'answered' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $ticket->status === 'answered' ? 'Answered' : 'Open' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-gray-400 whitespace-nowrap">{{ $ticket->created_at->diffForHumans() }}</td>
                        <td class="px-5 py-3.5 text-right whitespace-nowrap">
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-xs">
                                View & Reply →
                            </a>
                            <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete this ticket and all its replies? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 text-red-500 hover:text-red-700 font-medium text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400 text-sm">No advisory tickets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tickets->links() }}
    </div>

</div>
@endsection
