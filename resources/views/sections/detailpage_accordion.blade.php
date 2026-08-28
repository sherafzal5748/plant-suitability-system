{{-- ═══════════════════════════════════════════════
     SECTION: detailpage_accordion.blade.php
     Fields used:
       $plant->detail->flowering_fruiting_season, growing_season
       $plant->detail->ideal_temperature, min_temperature, max_temperature, ideal_environment
       $plant->detail->fertilizing_schedule, repotting_frequency
       $plant->detail->organic_control_methods, preventive_measures
       $plant->detail->common_mistakes, support_needed
     ═══════════════════════════════════════════════ --}}

<style>
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height .38s cubic-bezier(.4,0,.2,1);
    }
    .accordion-open .accordion-content { max-height: 600px; }
    .accordion-open .accordion-icon    { transform: rotate(180deg); }
    .accordion-icon { transition: transform .3s ease; }
</style>

<div class="space-y-3">

    @if($plant->detail)

        {{-- 1. Flowering & Fruiting Seasonality --}}
        @if($plant->detail->flowering_fruiting_season || $plant->detail->growing_season)
        <div class="accordion accordion-open bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition text-left">
                <span class="text-sm font-semibold text-gray-700">🌸 Flowering &amp; Fruiting Seasonality</span>
                <svg class="accordion-icon w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="accordion-content">
                <div class="px-5 py-4 text-sm text-gray-700 leading-7 space-y-2">
                    @if($plant->detail->flowering_fruiting_season)
                        <p>{{ $plant->detail->flowering_fruiting_season }}</p>
                    @endif
                    @if($plant->detail->growing_season)
                        <p class="text-gray-500"><strong>Growing Season:</strong> {{ $plant->detail->growing_season }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- 2. Temperature & Climate Details --}}
        @if($plant->detail->ideal_temperature || $plant->detail->min_temperature || $plant->detail->max_temperature || $plant->detail->ideal_environment)
        <div class="accordion bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition text-left">
                <span class="text-sm font-semibold text-gray-700">🌡️ Temperature &amp; Climate Details</span>
                <svg class="accordion-icon w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="accordion-content">
                <div class="px-5 py-4 text-sm text-gray-700 leading-7 space-y-2">
                    @if($plant->detail->ideal_temperature)
                        <p><strong>Ideal:</strong> {{ $plant->detail->ideal_temperature }}</p>
                    @endif
                    @if($plant->detail->min_temperature)
                        <p><strong>Min:</strong> {{ $plant->detail->min_temperature }}</p>
                    @endif
                    @if($plant->detail->max_temperature)
                        <p><strong>Max:</strong> {{ $plant->detail->max_temperature }}</p>
                    @endif
                    @if($plant->detail->ideal_environment)
                        <p class="text-gray-500"><strong>Ideal Environment:</strong> {{ $plant->detail->ideal_environment }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- 3. Fertilizing & Care Schedule --}}
        @if($plant->detail->fertilizing_schedule || $plant->detail->repotting_frequency)
        <div class="accordion bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition text-left">
                <span class="text-sm font-semibold text-gray-700">🧫 Fertilizing &amp; Care Schedule</span>
                <svg class="accordion-icon w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="accordion-content">
                <div class="px-5 py-4 text-sm text-gray-700 leading-7 space-y-2">
                    @if($plant->detail->fertilizing_schedule)
                        <p>{{ $plant->detail->fertilizing_schedule }}</p>
                    @endif
                    @if($plant->detail->repotting_frequency)
                        <p class="text-gray-500"><strong>Repotting:</strong> {{ $plant->detail->repotting_frequency }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- 4. Organic Control Protocols --}}
        @if($plant->detail->organic_control_methods || $plant->detail->preventive_measures)
        <div class="accordion bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition text-left">
                <span class="text-sm font-semibold text-gray-700">🌿 Organic Control Protocols</span>
                <svg class="accordion-icon w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="accordion-content">
                <div class="px-5 py-4 text-sm text-gray-700 leading-7 space-y-2">
                    @if($plant->detail->organic_control_methods)
                        <p>{{ $plant->detail->organic_control_methods }}</p>
                    @endif
                    @if($plant->detail->preventive_measures)
                        <p class="text-gray-500"><strong>Prevention:</strong> {{ $plant->detail->preventive_measures }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- 5. Common Mistakes & Support --}}
        @if($plant->detail->common_mistakes || $plant->detail->support_needed)
        <div class="accordion bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition text-left">
                <span class="text-sm font-semibold text-gray-700">⚠️ Common Mistakes &amp; Support Needed</span>
                <svg class="accordion-icon w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="accordion-content">
                <div class="px-5 py-4 text-sm text-gray-700 leading-7 space-y-2">
                    @if($plant->detail->common_mistakes)
                        <p>{{ $plant->detail->common_mistakes }}</p>
                    @endif
                    @if($plant->detail->support_needed)
                        <p class="text-gray-500"><strong>Support:</strong> {{ $plant->detail->support_needed }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

    @else
        <div class="p-5 text-center text-sm text-gray-400 border border-dashed border-gray-200 rounded-2xl bg-white">
            No extended care profiles or accordions found for this record database.
        </div>
    @endif

</div>