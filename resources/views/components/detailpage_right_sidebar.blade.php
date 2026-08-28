{{-- ═══════════════════════════════════════════════
     COMPONENT: detailpage_right_sidebar.blade.php
     Fields used:
       $plant->detail->watering_frequency, light, preferred_soil_type
       $plant->detail->common_pests, fertilizing_schedule
       $plant->detail->ideal_environment
       $plant->detail->lifecycle, mature_size, season_preference
       $plant->detail->frost_tolerance, min_temp_c, max_temp_c
       $plant->detail->soil_ph_range, support_needed
       $plant->sunlight_requirement
     ═══════════════════════════════════════════════ --}}

<aside class="w-full lg:w-[320px] flex-shrink-0 bg-white border-l border-gray-100 p-5 flex flex-col gap-5">

    {{-- ── 1. MANAGEMENT GUIDELINES ────────────────── --}}
    <div class="bg-[#f0fdf4] rounded-2xl border border-green-100 p-5 shadow-sm">

        <h2 class="text-sm font-bold text-gray-800 mb-5">Management Guidelines</h2>

        <div class="space-y-4">

            {{-- Water & Humidity --}}
            <div class="flex gap-3">
                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 21c-4.418 0-8-3.582-8-8 0-4.418 8-13 8-13s8 8.582 8 13c0 4.418-3.582 8-8 8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-gray-800 mb-0.5">Water & Humidity</h3>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        {{ Str::limit($plant->detail->watering_frequency ?? 'See the Climate tab for watering details.', 90) }}
                    </p>
                </div>
            </div>

            {{-- Soil & Light --}}
            <div class="flex gap-3">
                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-gray-800 mb-0.5">Soil & Light</h3>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        {{ $plant->detail->light ?? $plant->sunlight_requirement ?? '—' }}.
                        @if($plant->detail && $plant->detail->preferred_soil_type)
                            {{ Str::limit($plant->detail->preferred_soil_type, 55) }}.
                        @endif
                    </p>
                </div>
            </div>

            {{-- Pest Protection — highlighted --}}
            <div class="bg-red-50 border border-red-100 rounded-2xl px-4 py-3 flex gap-3">
                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-white border border-red-100 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-gray-800 mb-0.5">Pest Protection</h3>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        {{ Str::limit($plant->detail->common_pests ?? 'Monitor regularly for common pests.', 80) }}
                    </p>
                </div>
            </div>

            {{-- Fertilizing --}}
            <div class="flex gap-3">
                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-gray-800 mb-0.5">Fertilizing Schedule</h3>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        {{ Str::limit($plant->detail->fertilizing_schedule ?? '—', 90) }}
                    </p>
                </div>
            </div>

        </div>

        <hr class="my-5 border-green-100">

        {{-- Expert Tip --}}
        <div class="relative rounded-2xl p-5 overflow-hidden shadow-md"
             style="background: linear-gradient(135deg, #065f46 0%, #047857 60%, #059669 100%)">
            <div class="absolute -bottom-4 -right-4 opacity-10">
                <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="text-green-200 text-[9px] font-bold tracking-[.18em] uppercase mb-2 block">Expert Tip</span>
            <p class="text-white text-xs font-medium leading-relaxed italic relative z-10">
                "{{ $plant->detail->ideal_environment ?? 'Prepare soil thoroughly before planting for the best results.' }}"
            </p>
        </div>

    </div>

    {{-- ── 2. AT A GLANCE ───────────────────────────── --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">

        <h3 class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-4">At a Glance</h3>

        @php
            $glanceItems = [
                ['label' => 'Lifecycle',       'value' => $plant->detail->lifecycle ?? '—'],
                ['label' => 'Mature Size',     'value' => $plant->detail->mature_size ?? '—'],
                ['label' => 'Season Pref.',    'value' => $plant->detail->season_preference ?? '—'],
                ['label' => 'Frost Tolerance', 'value' => $plant->detail->frost_tolerance ?? '—'],
                ['label' => 'Min Temp',        'value' => ($plant->detail && $plant->detail->min_temp_c !== null) ? $plant->detail->min_temp_c . '°C' : '—'],
                ['label' => 'Max Temp',        'value' => ($plant->detail && $plant->detail->max_temp_c !== null) ? $plant->detail->max_temp_c . '°C' : '—'],
                ['label' => 'Soil pH',         'value' => $plant->detail->soil_ph_range ?? '—'],
                ['label' => 'Support Needed',  'value' => Str::limit($plant->detail->support_needed ?? '—', 38)],
            ];
        @endphp

        <div class="space-y-0">
            @foreach($glanceItems as $item)
            <div class="flex items-center justify-between py-2.5 text-xs
                        {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                <span class="text-gray-400">{{ $item['label'] }}</span>
                <span class="font-semibold text-gray-700 text-right max-w-[55%] leading-snug">
                    {{ $item['value'] }}
                </span>
            </div>
            @endforeach
        </div>

    </div>

    {{-- ── 3. AI ADVISORY CARD ──────────────────────── --}}
    <div class="bg-[#1a2e3a] rounded-2xl p-6 shadow-xl">

        <div class="flex items-center gap-2 mb-4">
            <div class="p-1.5 bg-[#5EDC85]/10 rounded-lg">
                <svg class="w-4 h-4 text-[#5EDC85]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-[#94A3B8] text-[9px] font-bold tracking-[.18em] uppercase">AI Advisory</span>
        </div>

        <h3 class="text-white text-lg font-bold mb-2 tracking-tight">Maximize Yield</h3>
        <p class="text-[#94A3B8] text-xs leading-relaxed mb-5">
            Based on this plant's soil type, temperature range, and water needs, our AI can suggest an optimised care plan for your local conditions.
        </p>

        <button class="w-full bg-[#5EDC85] text-[#1a2e3a] text-[10px] font-bold py-3 rounded-xl
                       hover:bg-[#4cc974] transition-all active:scale-95 uppercase tracking-widest">
            Get My Plan
        </button>

    </div>

</aside>