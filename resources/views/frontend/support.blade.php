@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.dashboard_layout' : 'layouts.home_layout')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-xl font-semibold text-gray-900">Plant Support & Advisory</h1>
        <p class="mt-1 text-sm text-gray-500">Get expert advice, diagnose plant health issues, or find the perfect flora for your space.</p>
    </div>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Search --}}
    <div class="mb-8">
        <div class="relative">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
            </svg>
            <input
                type="text"
                placeholder="Search for plant types, soil guides, or symptoms…"
                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
            />
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">

        {{-- Suitability Guide --}}
        <a href="#" class="group flex items-start gap-3.5 p-4 rounded-xl border border-gray-200 bg-white hover:border-emerald-300 hover:shadow-sm transition">
            <div class="mt-0.5 flex-shrink-0 w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition">
                <svg class="w-4.5 h-4.5 text-emerald-600" style="width:18px;height:18px" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3M12 5.5a6.5 6.5 0 016.5 6.5v2.5a1 1 0 01-1 1h-11a1 1 0 01-1-1V12A6.5 6.5 0 0112 5.5z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-800 group-hover:text-emerald-600 transition">Zone & Climate Guide</p>
                <p class="mt-0.5 text-xs text-gray-500 leading-relaxed">Check soil pH, hardiness zones, and sunlight needs.</p>
            </div>
        </a>

        {{-- Plant Diagnostics --}}
        <a href="#" class="group flex items-start gap-3.5 p-4 rounded-xl border border-gray-200 bg-white hover:border-amber-300 hover:shadow-sm transition">
            <div class="mt-0.5 flex-shrink-0 w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition">
                <svg class="w-4.5 h-4.5 text-amber-600" style="width:18px;height:18px" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-800 group-hover:text-amber-600 transition">Pest & Disease Checker</p>
                <p class="mt-0.5 text-xs text-gray-500 leading-relaxed">Identify yellow leaves, root rot, or spots.</p>
            </div>
        </a>

        {{-- Community Garden --}}
        <a href="#" class="group flex items-start gap-3.5 p-4 rounded-xl border border-gray-200 bg-white hover:border-teal-300 hover:shadow-sm transition">
            <div class="mt-0.5 flex-shrink-0 w-9 h-9 rounded-lg bg-teal-50 flex items-center justify-center group-hover:bg-teal-100 transition">
                <svg class="w-4.5 h-4.5 text-teal-600" style="width:18px;height:18px" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-800 group-hover:text-teal-600 transition">Grower Forums</p>
                <p class="mt-0.5 text-xs text-gray-500 leading-relaxed">Share regional propagation tips with others.</p>
            </div>
        </a>

    </div>

    {{-- Two Column: FAQ + Contact --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- FAQ Accordion --}}
        <div class="lg:col-span-3">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Frequently Asked Questions</h2>

            <div class="divide-y divide-gray-100 border border-gray-200 rounded-xl bg-white overflow-hidden">

                @php
                    $faqs = [
                        ['q' => 'How does the plant suitability algorithm work?',  'a' => 'We cross-reference your geolocation data, local USDA hardiness zone maps, current seasonal weather forecasts, and soil type inputs against our botanical database to rank viability percentages.'],
                        ['q' => 'What is the best way to find my soil type?',       'a' => 'You can do a quick "jar test" at home (separating sand, silt, and clay) or buy a cheap digital pH/moisture probe. Enter these values into your profile for fine-tuned suggestions.'],
                        ['q' => 'How often should I update my garden logs?',      'a' => 'Updating watering status weekly and tracking growth phases (sprout, bloom, harvest) every 2 weeks ensures our dynamic recommendation engine stays accurate.'],
                        ['q' => 'What should I do if a recommended plant dies?',   'a' => 'Plant failure can happen due to anomalous localized frost, hidden pests, or overwatering. Use our Disease Checker tool or submit a photo ticket to our botanist team below.'],
                        ['q' => 'Can I track indoor microclimates?',              'a' => 'Yes. When adding a new plant layout, toggle the "Indoor" option to replace regional climate data with custom room parameters like humidity percentages and grow-light tracking.'],
                    ];
                @endphp

                @foreach($faqs as $i => $faq)
                <details class="group" {{ $i === 0 ? 'open' : '' }}>
                    <summary class="flex items-center justify-between px-5 py-4 cursor-pointer select-none list-none">
                        <span class="text-sm font-medium text-gray-800">{{ $faq['q'] }}</span>
                        <svg class="flex-shrink-0 ml-3 w-4 h-4 text-gray-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <div class="px-5 pb-4">
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </details>
                @endforeach

            </div>
        </div>

        {{-- Contact Card --}}
        <div class="lg:col-span-2 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Consult a Botanist</h2>

            {{-- Contact Form --}}
            <div class="border border-gray-200 rounded-xl bg-white p-5">
                <p class="text-sm text-gray-500 mb-4 leading-relaxed">Having trouble keeping your green friends alive? Send details about your environment, and our horticultural specialists will review it.</p>

                <form action="{{ route('advisory.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Issue Focus Area</label>
                        <select name="topic" required class="w-full text-sm rounded-lg border border-gray-200 px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white transition">
                            <option value="">Select a topic…</option>
                            <option value="Incorrect Suitability Matching" @selected(old('topic') === 'Incorrect Suitability Matching')>Incorrect Suitability Matching</option>
                            <option value="Plant Pathology (Sick/Dying Plant)" @selected(old('topic') === 'Plant Pathology (Sick/Dying Plant)')>Plant Pathology (Sick/Dying Plant)</option>
                            <option value="Soil / Fertilizer Advisory" @selected(old('topic') === 'Soil / Fertilizer Advisory')>Soil / Fertilizer Advisory</option>
                            <option value="Account & Dashboard Setup" @selected(old('topic') === 'Account & Dashboard Setup')>Account & Dashboard Setup</option>
                            <option value="Other / Feedback" @selected(old('topic') === 'Other / Feedback')>Other / Feedback</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Environmental Symptoms / Message</label>
                        <textarea
                            name="message"
                            required
                            rows="4"
                            placeholder="Describe your plant type, indoor/outdoor setup, watering habits, and symptoms..."
                            class="w-full text-sm rounded-lg border border-gray-200 px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none transition"
                        >{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 px-4 text-sm font-medium rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                        Submit Advisory Ticket
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- My Tickets & Botanist Replies --}}
    <div id="my-tickets" class="mt-10 scroll-mt-6">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">My Advisory Tickets</h2>

        @if($tickets->isEmpty())
            <div class="border border-dashed border-gray-200 rounded-xl bg-white p-6 text-center text-sm text-gray-400">
                You haven't submitted any advisory tickets yet.
            </div>
        @else
            <div class="space-y-4">
                @foreach($tickets as $ticket)
                    <div class="border border-gray-200 rounded-xl bg-white p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $ticket->topic }}</p>
                                <p class="mt-1 text-xs text-gray-400">Submitted {{ $ticket->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="flex-shrink-0 text-xs font-medium px-2.5 py-1 rounded-full {{ $ticket->status === 'answered' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $ticket->status === 'answered' ? 'Answered' : 'Awaiting reply' }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm text-gray-500 leading-relaxed">{{ $ticket->message }}</p>

                        @if($ticket->replies->isNotEmpty())
                            <div class="mt-4 pt-4 border-t border-gray-100 space-y-3">
                                @foreach($ticket->replies as $reply)
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-semibold">B</div>
                                        <div class="flex-1 bg-emerald-50/60 rounded-lg px-3.5 py-2.5">
                                            <p class="text-xs font-medium text-emerald-700 mb-0.5">Botanist reply · {{ $reply->created_at->diffForHumans() }}</p>
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $reply->message }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

{{-- Smooth accordion animation --}}
<style>
    details > summary { list-style: none; }
    details > summary::-webkit-details-marker { display: none; }
</style>
@endsection
