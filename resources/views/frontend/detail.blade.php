{{--
    show.blade.php — Main entry point
    Variables: $plant (plants table), $detail (details table, 1-1)
--}}

@extends(auth()->user() && auth()->user()->role === 'admin' ? 'layouts.dashboard_layout' : 'layouts.home_layout')

@section('content')

<style>
    body { font-family: 'Inter', sans-serif; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
</style>

{{--Start toast message (this message will be shown when plant already present in whitelist or when a plant added to whitelist)--}}

<div class="fixed top-10 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm px-4">

    @if(session('success'))
        <div id="mini-success-alert" class="flex items-center justify-between gap-3 p-3 bg-white border border-green-100 rounded-xl shadow-lg transition-all duration-300 transform translate-y-0 opacity-100" role="alert">
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-7 h-7 bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-800">{{ session('success') }}</p>
            </div>
            <button onclick="dismissAlert('mini-success-alert')" type="button" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg transition-colors">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2"><path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>

        <script>
            // Automatically close the success alert after 3000ms (3 seconds)
            setTimeout(() => { dismissAlert('mini-success-alert'); }, 3000);
        </script>
    @endif

    @if(session('info'))
        <div id="mini-info-alert" class="flex items-center justify-between gap-3 p-3 bg-white border border-blue-100 rounded-xl shadow-lg transition-all duration-300 transform translate-y-0 opacity-100" role="alert">
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-7 h-7 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-800">{{ session('info') }}</p>
            </div>
            <button onclick="dismissAlert('mini-info-alert')" type="button" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg transition-colors">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2"><path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>

        <script>
            // Automatically close the info alert after 3000ms (3 seconds)
            setTimeout(() => { dismissAlert('mini-info-alert'); }, 3000);
        </script>
    @endif

</div>

<script>
function dismissAlert(alertId) {
    const alertEl = document.getElementById(alertId);
    if (alertEl) {
        // Apply Tailwind sliding transition classes
        alertEl.classList.add('-translate-y-4', 'opacity-0');
        // Wait for the 300ms transition to finish before removing from the DOM entirely
        setTimeout(() => { alertEl.remove(); }, 300);
    }
}
</script>
{{--End toast message--}}

<div class="max-w-[1440px] mx-auto min-h-screen flex flex-col lg:flex-row">

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-4 lg:p-8 space-y-6 min-w-0">

        {{-- 1. Hero Header --}}
        @include('components.detailpage_hero')

        {{-- 2. Quick Stat Strip --}}
        @include('components.detailpage_quick_strips')

        {{-- 3. Top Tabs (Climate & Water | Soil | Growth | Pest Control) --}}
        @include('components.detailpage_top_tabs')

        {{-- 4. Scientific Parameters Table --}}
        @include('sections.detailpage_scientific_parameter_table')

        {{-- 5. Accordions --}}
        @include('sections.detailpage_accordion')

    </main>

    {{-- RIGHT SIDEBAR --}}
    @include('components.detailpage_right_sidebar')

</div>

@include('partials.footer')

{{-- Tab + Accordion JS --}}
@include('partials.detailpage_scripts')

@endsection