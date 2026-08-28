{{-- ═══════════════════════════════════════════════
     COMPONENT: detailpage_quick_strips.blade.php
     Fields used:
       $plant->suitability, $plant->growth_period
       $plant->sunlight_requirement, $plant->growing_season
     ═══════════════════════════════════════════════ --}}

<style>
    .strip-card { transition: box-shadow .2s, transform .2s; }
    .strip-card:hover { box-shadow: 0 6px 20px rgba(22,163,74,.1); transform: translateY(-2px); }
</style>

<div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

    {{-- Suitability --}}
    <div class="strip-card bg-white rounded-2xl border border-gray-100 p-4 flex items-center gap-3 shadow-sm">
        <span class="text-2xl">🌱</span>
        <div>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Suitability</p>
            <p class="text-sm font-bold text-gray-800 mt-0.5">{{ ucfirst($plant->suitability ?? '—') }}</p>
        </div>
    </div>

    {{-- Growth Period --}}
    <div class="strip-card bg-white rounded-2xl border border-gray-100 p-4 flex items-center gap-3 shadow-sm">
        <span class="text-2xl">⏱️</span>
        <div>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Growth Period</p>
            <p class="text-sm font-bold text-gray-800 mt-0.5">
                {{ $plant->growth_period ? $plant->growth_period . ' months' : '—' }}
            </p>
        </div>
    </div>

    {{-- Sunlight --}}
    <div class="strip-card bg-white rounded-2xl border border-gray-100 p-4 flex items-center gap-3 shadow-sm">
        <span class="text-2xl">☀️</span>
        <div>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Sunlight</p>
            <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $plant->sunlight_requirement ?? '—' }}</p>
        </div>
    </div>

    {{-- Season --}}
    <div class="strip-card bg-white rounded-2xl border border-gray-100 p-4 flex items-center gap-3 shadow-sm">
        <span class="text-2xl">🌿</span>
        <div>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Season</p>
            <p class="text-sm font-bold text-gray-800 mt-0.5">{{ ucfirst($plant->growing_season ?? '—') }}</p>
        </div>
    </div>

</div>