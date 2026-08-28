{{-- ═══════════════════════════════════════════════
     COMPONENT: detailpage_top_tabs.blade.php
     Tabs: Climate & Water | Soil | Growth | Pest Control
     Fields used: $plant->detail (details table)
     ═══════════════════════════════════════════════ --}}

<style>
    .tab-active {
        background: #ffffff;
        color: #111827;
        font-weight: 600;
        border-bottom: 2px solid #16a34a;
    }
    .content-hidden { display: none; }
    .info-card-hover { transition: box-shadow .2s, transform .2s; }
    .info-card-hover:hover { box-shadow: 0 6px 20px rgba(22,163,74,.1); transform: translateY(-2px); }

    /* Temperature progress bars */
    .progress-bar-inner { transition: width 1s cubic-bezier(.4,0,.2,1); }
</style>

<div class="bg-[#f8f9fa] rounded-2xl border border-gray-200 overflow-hidden shadow-sm">

    {{-- ── Tab Bar ─────────────────────────────────── --}}
    <div class="flex items-center border-b border-gray-200 bg-[#f2f2f2] overflow-x-auto">
        <button class="tab-btn tab-active px-5 py-3 text-sm transition whitespace-nowrap" data-tab="climate">
            Climate & Water
        </button>
        <button class="tab-btn px-5 py-3 text-sm text-gray-500 hover:text-black transition whitespace-nowrap" data-tab="soil">
            Soil
        </button>
        <button class="tab-btn px-5 py-3 text-sm text-gray-500 hover:text-black transition whitespace-nowrap" data-tab="growth">
            Growth
        </button>
        <button class="tab-btn px-5 py-3 text-sm text-gray-500 hover:text-black transition whitespace-nowrap" data-tab="pest">
            Pest Control
        </button>
    </div>

    <div class="p-5">

        @if($plant->detail)

            {{-- ══════════════════════════════════════════
                 TAB 1 — CLIMATE & WATER
                 ══════════════════════════════════════════ --}}
            <div class="tab-content" id="climate">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    {{-- Annual Rainfall --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">🌧️</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Rainfall</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Annual Rainfall</p>
                        <p class="text-lg font-bold text-gray-800">
                            {{ $plant->detail->annual_rainfall_min_mm ?? '—' }}
                            @if($plant->detail->annual_rainfall_max_mm) – {{ $plant->detail->annual_rainfall_max_mm }} mm @endif
                        </p>
                        @if($plant->detail->annual_rainfall)
                            <p class="text-[11px] text-gray-400 mt-1 leading-snug line-clamp-2">{{ $plant->detail->annual_rainfall }}</p>
                        @endif
                    </div>

                    {{-- Humidity --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">💧</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Humidity</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Humidity Preference</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->humidity ?? '—' }}</p>
                    </div>

                    {{-- Soil Moisture --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">🌊</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Soil Moisture</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->soil_moisture ?? '—' }}</p>
                    </div>

                    {{-- Drainage --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">🧪</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">Drainage</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Drainage Requirement</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->drainage ?? '—' }}</p>
                    </div>

                    {{-- Monsoon Tolerance --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">⛈️</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Monsoon Tolerance</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->monsoon_tolerance ?? '—' }}</p>
                    </div>

                    {{-- Drought Tolerance --}}
                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">🏜️</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">Drought</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Drought Tolerance</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->drought_tolerance ?? '—' }}</p>
                    </div>

                </div>

                {{-- Watering Info Box --}}
                @if($plant->detail->watering_frequency || $plant->detail->water_amount || $plant->detail->season_watering || $plant->detail->soil_check_method)
                <div class="mt-4 bg-blue-50 rounded-2xl p-4 border border-blue-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-blue-700 mb-3">💦 Watering Guide</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-700">
                        @if($plant->detail->watering_frequency)
                            <p><span class="font-semibold text-gray-600">Frequency:</span> {{ $plant->detail->watering_frequency }}</p>
                        @endif
                        @if($plant->detail->water_amount)
                            <p><span class="font-semibold text-gray-600">Amount:</span> {{ $plant->detail->water_amount }}</p>
                        @endif
                        @if($plant->detail->season_watering)
                            <p><span class="font-semibold text-gray-600">Seasonal:</span> {{ $plant->detail->season_watering }}</p>
                        @endif
                        @if($plant->detail->soil_check_method)
                            <p><span class="font-semibold text-gray-600">Soil Check:</span> {{ $plant->detail->soil_check_method }}</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>


            {{-- ══════════════════════════════════════════
                 TAB 2 — SOIL
                 ══════════════════════════════════════════ --}}
            <div class="tab-content content-hidden" id="soil">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <div class="w-9 h-9 rounded-full bg-amber-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Soil Type</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->soil_type ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🧫</span>
                        <p class="text-xs text-gray-400 mb-1">Preferred Soil Type</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->preferred_soil_type ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">⚗️</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-green-100 text-green-700 px-2 py-0.5 rounded-full">pH</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Soil pH Range</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $plant->detail->soil_ph_range ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🌿</span>
                        <p class="text-xs text-gray-400 mb-1">Texture Requirement</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->texture_requirement ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">♻️</span>
                        <p class="text-xs text-gray-400 mb-1">Organic Matter Need</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->organic_matter_need ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">💊</span>
                        <p class="text-xs text-gray-400 mb-1">Nutrient Preference</p>
                        <p class="text-sm text-gray-700 leading-snug">{{ $plant->detail->nutrient_preference ?? '—' }}</p>
                    </div>

                </div>

                @if($plant->detail->ground_soil_preparation)
                <div class="mt-4 bg-amber-50 rounded-2xl p-4 border border-amber-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-700 mb-2">🛠 Soil Preparation</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->ground_soil_preparation }}</p>
                </div>
                @endif
            </div>


            {{-- ══════════════════════════════════════════
                 TAB 3 — GROWTH
                 ══════════════════════════════════════════ --}}
            <div class="tab-content content-hidden" id="growth">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🔄</span>
                        <p class="text-xs text-gray-400 mb-1">Lifecycle</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->lifecycle ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-2xl">⚡</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Rate</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1">Growth Rate</p>
                        <p class="text-lg font-bold text-gray-800">{{ $plant->detail->growth_rate ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">📏</span>
                        <p class="text-xs text-gray-400 mb-1">Mature Size</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->mature_size ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🌸</span>
                        <p class="text-xs text-gray-400 mb-1">Flowering / Fruiting Season</p>
                        <p class="text-sm text-gray-700 leading-snug">{{ $plant->detail->flowering_fruiting_season ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🗓️</span>
                        <p class="text-xs text-gray-400 mb-1">Growing Season</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->growing_season ?? '—' }}</p>
                    </div>

                    <div class="info-card-hover bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                        <span class="text-2xl block mb-3">🏡</span>
                        <p class="text-xs text-gray-400 mb-1">Indoor / Outdoor</p>
                        <p class="text-base font-bold text-gray-800">{{ $plant->detail->indoor_outdoor_suitability ?? '—' }}</p>
                    </div>

                </div>

                {{-- Temperature Range Bars --}}
                @if($plant->detail->ideal_temp_min_c !== null || $plant->detail->ideal_temp_max_c !== null)
                <div class="mt-4 bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">🌡️ Temperature Ranges</h3>
                    @php
                        $tempRows = [
                            ['label' => 'Minimum Survival', 'val' => $plant->detail->min_temp_c,       'color' => 'bg-blue-400'],
                            ['label' => 'Ideal Min',         'val' => $plant->detail->ideal_temp_min_c, 'color' => 'bg-green-400'],
                            ['label' => 'Ideal Max',         'val' => $plant->detail->ideal_temp_max_c, 'color' => 'bg-green-600'],
                            ['label' => 'Maximum Tolerance', 'val' => $plant->detail->max_temp_c,       'color' => 'bg-red-400'],
                        ];
                    @endphp
                    <div class="space-y-3">
                        @foreach($tempRows as $t)
                            @if($t['val'] !== null)
                            <div>
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>{{ $t['label'] }}</span>
                                    <span class="font-bold">{{ $t['val'] }}°C</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="{{ $t['color'] }} h-2 rounded-full progress-bar-inner"
                                         style="width: {{ min(100, ($t['val'] / 50) * 100) }}%"></div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Season / Frost / Heat Tolerance --}}
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @if($plant->detail->season_preference)
                    <div class="bg-amber-50 rounded-2xl p-4 border border-amber-100">
                        <p class="text-xs font-bold text-amber-700 mb-1 uppercase">Season Preference</p>
                        <p class="text-sm text-gray-700">{{ $plant->detail->season_preference }}</p>
                    </div>
                    @endif
                    @if($plant->detail->frost_tolerance)
                    <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                        <p class="text-xs font-bold text-blue-700 mb-1 uppercase">❄️ Frost Tolerance</p>
                        <p class="text-sm text-gray-700">{{ $plant->detail->frost_tolerance }}</p>
                    </div>
                    @endif
                    @if($plant->detail->heat_tolerance)
                    <div class="bg-red-50 rounded-2xl p-4 border border-red-100">
                        <p class="text-xs font-bold text-red-600 mb-1 uppercase">🔥 Heat Tolerance</p>
                        <p class="text-sm text-gray-700">{{ $plant->detail->heat_tolerance }}</p>
                    </div>
                    @endif
                </div>
            </div>


            {{-- ══════════════════════════════════════════
                 TAB 4 — PEST CONTROL
                 ══════════════════════════════════════════ --}}
            <div class="tab-content content-hidden" id="pest">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    @if($plant->detail->common_pests)
                    <div class="info-card-hover bg-white rounded-2xl border border-red-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-red-600 mb-2">🐛 Common Pests</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->common_pests }}</p>
                    </div>
                    @endif

                    @if($plant->detail->signs_of_infestation)
                    <div class="info-card-hover bg-white rounded-2xl border border-amber-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-amber-700 mb-2">🔍 Signs of Infestation</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->signs_of_infestation }}</p>
                    </div>
                    @endif

                    @if($plant->detail->organic_control_methods)
                    <div class="info-card-hover bg-white rounded-2xl border border-green-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-green-700 mb-2">🌿 Organic Control</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->organic_control_methods }}</p>
                    </div>
                    @endif

                    @if($plant->detail->chemical_control)
                    <div class="info-card-hover bg-white rounded-2xl border border-purple-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-purple-700 mb-2">🧴 Chemical Control</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->chemical_control }}</p>
                    </div>
                    @endif

                    @if($plant->detail->spray_intervals)
                    <div class="info-card-hover bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">🕐 Spray Intervals</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->spray_intervals }}</p>
                    </div>
                    @endif

                    @if($plant->detail->preventive_measures)
                    <div class="info-card-hover bg-white rounded-2xl border border-teal-100 p-4 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-teal-700 mb-2">🛡️ Prevention</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->preventive_measures }}</p>
                    </div>
                    @endif

                </div>

                @if($plant->detail->soil_borne_disease_signs)
                <div class="mt-4 bg-red-50 rounded-2xl p-4 border border-red-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-red-600 mb-2">⚠️ Soil-Borne Disease Signs</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $plant->detail->soil_borne_disease_signs }}</p>
                </div>
                @endif
            </div>

        @else
            {{-- Fallback container if 1-1 details don't exist yet --}}
            <div class="text-center py-12">
                <span class="text-4xl">📋</span>
                <p class="mt-2 text-sm text-gray-500">No extended profile data loaded for this specimen matrix.</p>
            </div>
        @endif

    </div>{{-- /tab panel wrapper --}}

</div>{{-- /tabs card --}}