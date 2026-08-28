{{-- if user is Admin then inherit Dashboard Layout
@extends('layouts.dashboard_layout') 

if user is NOT Admin then inherit Home Layout
@extends('layouts.home_layout') --}}

{{-- Dynamically inherit layout based on the user's role --}}
@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.dashboard_layout' : 'layouts.home_layout')

@section('content') 

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', sans-serif; background: #f4f7f5; color: #1a1a1a; }

    /* ── Filter bar dropdowns ── */
    select {
      -webkit-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
    }

    /* ── Hero overlay gradient ── */
    .hero-overlay {
      background: linear-gradient(to bottom,
        rgba(0,0,0,0.30) 0%,
        rgba(0,0,0,0.15) 40%,
        rgba(0,0,0,0.55) 80%,
        rgba(0,0,0,0.70) 100%);
    }

    /* ── Suitability badge colours ── */
    .badge-high   { background: #1a7a2e; color: #fff; }
    .badge-mod    { background: #e8a317; color: #fff; }

    /* ── Plant card hover ── */
    .plant-card { transition: transform 0.18s, box-shadow 0.18s; display: block; }
    .plant-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.13); }

    /* ── Pagination ── */
    .page-btn {
      width: 32px; height: 32px;
      border-radius: 6px;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 500;
      cursor: pointer;
      border: 1px solid #d1dae0;
      background: #fff;
      color: #374151;
      transition: background 0.15s, color 0.15s;
    }
    .page-btn:hover  { background: #e8f5e9; }
    .page-btn.active { background: #1f5c24; color: #fff; border-color: #1f5c24; }

    /* ── View toggle buttons ── */
    .view-btn { padding: 6px 8px; border-radius: 6px; cursor: pointer; transition: background 0.15s; }
    .view-btn.active { background: #e8f5e9; }
    .view-btn:hover  { background: #f0f7f1; }

    /* ── Suitability pill filter ── */ 
    .suit-pill {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12.5px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s, color 0.15s;
    }
    .suit-pill.active { background: #1f5c24; color: #fff; }
    .suit-pill:not(.active) { background: #fff; color: #374151; border: 1px solid #d1dae0; }
  </style>


  <!-- ══════════════════════════════
       FILTER BAR
  ══════════════════════════════ -->
  <form method="GET" action="{{ route('homedata') }}" id="mainFilterForm">

    {{-- Hidden input that holds the suitability value for form submission --}}
    <input type="hidden" name="suitability" id="suitabilityInput" value="{{ request('suitability', 'All') }}">

    <div class="relative bg-white border-b border-[#e2eaed] px-6 py-3 flex items-center gap-6 flex-wrap">
      <!-- Category -->
      <div class="flex items-center gap-2">
        <span class="text-[12.5px] font-600 text-[#374151]" style="font-weight:600;">Category:</span>
        <select name="category" id="barCategory" onchange="document.getElementById('mainFilterForm').submit()" class="text-[12.5px] font-semibold text-[#1f5c24] border border-[#c8dfc8] rounded-full px-3 py-1.5 pr-7 bg-[#edf7ee]">
          <option value="All Plants" {{ request('category', 'All Plants') === 'All Plants' ? 'selected' : '' }}>All Plants</option>
          <option value="Fruit"      {{ request('category') === 'Fruit'      ? 'selected' : '' }}>Fruit</option>
          <option value="Vegetables" {{ request('category') === 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
          <option value="Crops"      {{ request('category') === 'Crops'      ? 'selected' : '' }}>Crops</option>
          <option value="Evergreen"  {{ request('category') === 'Evergreen'  ? 'selected' : '' }}>Evergreen</option>
        </select>
      </div>

      <!-- Growth Period -->
      <div class="flex items-center gap-2">
        <span class="text-[12.5px] font-semibold text-[#374151]">Growth Period:</span>
        <select name="growth_period" id="barGrowth" onchange="document.getElementById('mainFilterForm').submit()" class="text-[12.5px] font-semibold text-[#374151] border border-[#d1dae0] rounded-full px-3 py-1.5 pr-7 bg-white">
          <option value="Any Duration" {{ request('growth_period', 'Any Duration') === 'Any Duration' ? 'selected' : '' }}>Any Duration</option>
          <option value="3 months"     {{ request('growth_period') === '3 months'     ? 'selected' : '' }}>3 months</option>
          <option value="6 months"     {{ request('growth_period') === '6 months'     ? 'selected' : '' }}>6 months</option>
          <option value="12 months"    {{ request('growth_period') === '12 months'    ? 'selected' : '' }}>12 months</option>
          <option value="12+ months"   {{ request('growth_period') === '12+ months'   ? 'selected' : '' }}>12+ months</option>
        </select>
      </div>

      <!-- Suitability pills -->
      <div class="flex items-center gap-2">
        <span class="text-[12.5px] font-semibold text-[#374151]">Suitability:</span>
        <button type="button" data-value="All"      class="suit-pill {{ request('suitability', 'All') === 'All'      ? 'active' : '' }}">All</button>
        <button type="button" data-value="Low"      class="suit-pill {{ request('suitability') === 'Low'      ? 'active' : '' }}">Low</button>
        <button type="button" data-value="High"     class="suit-pill {{ request('suitability') === 'High'     ? 'active' : '' }}">High</button>
        <button type="button" data-value="medium" class="suit-pill {{ request('suitability') === 'medium' ? 'active' : '' }}">Medium</button>
      </div>

      <!-- Spacer -->
      <div class="flex-1"></div>

      <!-- View toggles + dropdown -->
      <div class="relative">

      <!-- Toggle buttons -->
      <div class="flex items-center gap-1 border border-[#d1dae0] rounded-lg p-0.5 bg-white">

          <!-- Grid -->
          <button type="button" class="view-btn active">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
              stroke="#2e7d32" stroke-width="2.2"
              stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="7" height="7"/>
              <rect x="14" y="3" width="7" height="7"/>
              <rect x="3" y="14" width="7" height="7"/>
              <rect x="14" y="14" width="7" height="7"/>
          </svg>
          </button>

          <!-- Dropdown button -->
          <button type="button" id="filterBtn" class="view-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
              stroke="#6b7280" stroke-width="2.2"
              stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
          </button>

      </div>

      <!-- FILTER DROPDOWN -->
      <div
          id="filterDropdown"
          class="hidden absolute right-0 top-[48px] w-[270px]
              bg-[#f7f7f5] border border-[#d2d2d2]
              rounded-xl shadow-xl overflow-hidden z-50"
      >

          <div class="p-4 space-y-4">

          <!-- Plant Category -->
          <div>
              <label class="block text-[10px] font-bold uppercase tracking-wide text-[#4b4b4b] mb-2">
              Plant Category
              </label>

              {{-- Synced to #barCategory via JS so the named input submits --}}
              <select id="popupCategory"
              class="w-full h-9 rounded-md border border-[#bfd0d7]
                      bg-[#eaf5fb] px-3 text-[12px] text-[#4a4a4a]">
              <option value="All Plants" {{ request('category', 'All Plants') === 'All Plants' ? 'selected' : '' }}>All Plants</option>
              <option value="Fruit"      {{ request('category') === 'Fruit'      ? 'selected' : '' }}>Fruit</option>
              <option value="Vegetables" {{ request('category') === 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
              <option value="Crops"      {{ request('category') === 'Crops'      ? 'selected' : '' }}>Crops</option>
              <option value="Evergreen"  {{ request('category') === 'Evergreen'  ? 'selected' : '' }}>Evergreen</option>
              </select>
          </div>

          <!-- Growth -->
          <div>
              <label class="block text-[10px] font-bold uppercase tracking-wide text-[#4b4b4b] mb-2">
              Growth Period
              </label>

              {{-- Synced to #barGrowth via JS so the named input submits --}}
              <select id="popupGrowth"
              class="w-full h-9 rounded-md border border-[#bfd0d7]
                      bg-[#eaf5fb] px-3 text-[12px] text-[#4a4a4a]">
              <option value="Any Duration" {{ request('growth_period', 'Any Duration') === 'Any Duration' ? 'selected' : '' }}>Any Duration</option>
              <option value="3 months"     {{ request('growth_period') === '3 months'     ? 'selected' : '' }}>3 months</option>
              <option value="6 months"     {{ request('growth_period') === '6 months'     ? 'selected' : '' }}>6 months</option>
              <option value="12 months"    {{ request('growth_period') === '12 months'    ? 'selected' : '' }}>12 months</option>
              <option value="12+ months"   {{ request('growth_period') === '12+ months'   ? 'selected' : '' }}>12+ months</option>
              </select>
          </div>

          <!-- Suitability -->
          <div>

              <label class="block text-[10px] font-bold uppercase tracking-wide text-[#4b4b4b] mb-2">
              Suitability Level
              </label>

              <div class="flex gap-2">

              <button 
                    type="button"
                    data-value="All"
                    class="suitability-btn px-3 h-6 rounded-full
                              {{ request('suitability', 'All') === 'All' ? 'bg-[#8bd66c] text-[#24411a]' : 'border border-[#c9d6db] bg-[#eef5f7] text-[#555]' }}">
                  All
              </button>

              <button 
                    type="button"
                    data-value="High"
                    class="suitability-btn px-3 h-6 rounded-full
                              {{ request('suitability') === 'High' ? 'bg-[#8bd66c] text-[#24411a]' : 'border border-[#c9d6db] bg-[#eef5f7] text-[#555]' }}
                              text-[11px] font-medium">
                  High
              </button>

              <button 
                    type="button"
                    data-value="medium"
                    class="suitability-btn px-3 h-6 rounded-full
                              {{ request('suitability') === 'medium' ? 'bg-[#8bd66c] text-[#24411a]' : 'border border-[#c9d6db] bg-[#eef5f7] text-[#555]' }}
                              text-[11px] font-medium">
                  Medium
              </button>

              <button 
                    type="button"
                    data-value="Low"
                    class="suitability-btn px-3 h-6 rounded-full
                              {{ request('suitability') === 'Low' ? 'bg-[#8bd66c] text-[#24411a]' : 'border border-[#c9d6db] bg-[#eef5f7] text-[#555]' }}
                              text-[11px] font-medium">
                  Low
              </button>

              </div>
          </div>

          <!--  Growing Season -->
          <div>

              <label class="block text-[10px] font-bold uppercase tracking-wide text-[#4b4b4b] mb-3">
              Growing Season
              </label>

              <div class="grid grid-cols-2 gap-y-3 text-[11px] text-[#4f4f4f]">

              <label class="flex items-center gap-2">
                  <input type="checkbox" name="season[]" value="Spring" class="risk-checkbox w-3.5 h-3.5" {{ in_array('Spring', (array) request('season', [])) ? 'checked' : '' }}>
                  Spring
              </label>

              <label class="flex items-center gap-2">
                  <input type="checkbox" name="season[]" value="Summer" class="risk-checkbox w-3.5 h-3.5" {{ in_array('Summer', (array) request('season', [])) ? 'checked' : '' }}>
                  Summer
              </label>

              <label class="flex items-center gap-2">
                  <input type="checkbox" name="season[]" value="Autumn" class="risk-checkbox w-3.5 h-3.5" {{ in_array('Autumn', (array) request('season', [])) ? 'checked' : '' }}>
                  Autumn
              </label>

              <label class="flex items-center gap-2">
                  <input type="checkbox" name="season[]" value="Winter" class="risk-checkbox w-3.5 h-3.5" {{ in_array('Winter', (array) request('season', [])) ? 'checked' : '' }}>
                  Winter
              </label>

              </div>
          </div>

          <!-- Sunlight -->
          <div>

              <label class="block text-[10px] font-bold uppercase tracking-wide text-[#4b4b4b] mb-2">
              Sunlight Requirement
              </label>

              <select name="sunlight" id="sunlight"
              class="w-full h-9 rounded-md border border-[#bfd0d7]
                      bg-[#eaf5fb] px-3 text-[12px] text-[#4a4a4a]">
              <option value="">Any</option>
              <option value="Full Sun"      {{ request('sunlight') === 'Full Sun'      ? 'selected' : '' }}>Full Sun</option>
              <option value="Partial Shade" {{ request('sunlight') === 'Partial Shade' ? 'selected' : '' }}>Partial Shade</option>
              </select>

          </div>

          </div>

          <!-- Footer -->
          <div class="bg-[#e6f5fb] border-t border-[#d3e6ec]
                      px-4 py-3 flex items-center justify-between">

          <button type="button" id="cancelBtn"
              class="text-[12px] text-[#555] font-medium">
              Cancel
          </button>

          <div class="flex items-center gap-2">

              <button type="button" id="resetBtn"
              class="px-4 h-8 rounded-md border border-[#aebcc2]
                      bg-[#edf4f7] text-[12px] text-[#555] font-medium">
              Reset
              </button>

              <button
                type="submit"
                class="px-4 h-8 rounded-md bg-[#0b7d24]
                      text-white text-[12px] font-medium">
                Apply Filter
              </button>

          </div>
          </div>

      </div>
      </div>
    </div>
  </form>

  <!-- ══════════════════════════════
       HERO BANNER
  ══════════════════════════════ -->
  <div class="relative w-full overflow-hidden" style="height: 340px;">

    <!-- Hero background -->
    <div class="absolute inset-0 bg-[#2d5a27]">
      <img src="assets/images/home_plants/home_image.png"> 
    </div>

    <!-- Overlay -->
    <div class="hero-overlay absolute inset-0"></div>

    <!-- Suitable Sow floating card (top right) -->
    <div class="absolute top-5 right-6 flex items-center gap-2.5
                bg-white/20 backdrop-blur-md border border-white/30
                rounded-xl px-3.5 py-2.5 shadow-lg">
      <img src="assets/icons/main_logo.png" alt="Suitable Sow" class="w-[28px] h-[28px] object-contain rounded-md"/>
      <div>
        <p class="text-white text-[13px] font-bold leading-tight">Suitable SOW</p>
        <p class="text-white/70 text-[10px] leading-tight">Data Driven Plant Suitability System</p>
      </div>
    </div>

    <!-- Hero text -->
    <div class="relative z-10 h-full flex flex-col items-start justify-end px-8 pb-10">
      <h1 class="text-white font-bold leading-tight mb-1"
          style="font-family:'DM Serif Display',serif; font-size:clamp(22px,3vw,36px);">
        Grow Smarter. Harvest Better.
      </h1>
      <h2 class="text-white/90 font-semibold mb-2"
          style="font-size:clamp(16px,2.2vw,26px);">
        Your Personalized Plant Partner
      </h2>
      <p class="text-white/75 text-[13px] mb-5 max-w-[420px] leading-relaxed">
        Unlock AI-powered plant recommendations tailored to your soil, climate, and sustainability goals—for smarter, greener farming.
      </p>
      <button class="bg-[#2e7d32] hover:bg-[#256427] text-white text-[13.5px] font-semibold
                     px-6 py-2.5 rounded-full shadow-md transition-all duration-200 hover:-translate-y-0.5">
        Find Your Perfect Plant Now
      </button>
    </div>

    <!-- Scroll indicator dot -->
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 w-2.5 h-2.5 rounded-full bg-white/80"></div>
  </div>

  <!-- ══════════════════════════════
       PLANT GRID
  ══════════════════════════════ -->
  <div class="px-6 py-6"> 
    <div class="grid grid-cols-4 gap-4">

      @foreach($plants as $plant)

      <a href="{{ route('detail', $plant->id) }}"
        class="plant-card bg-white rounded-xl overflow-hidden shadow-sm border border-[#e4eee6]">

          <div class="relative h-[160px] overflow-hidden">

              <img
                  src="{{ asset('assets/images/home_plants/'.$plant->image) }}"
                  alt="{{ $plant->plant_name }}"
                  class="w-full h-full object-cover"/>

              @php

                  $badgeClass = 'badge-mod';
                  $badgeText = strtoupper($plant->suitability);

                  if(strtolower($plant->suitability) == 'high')
                  {
                      $badgeClass = 'badge-high';
                      $badgeText = 'HIGHLY SUITABLE';
                  }

              @endphp

              <span class="{{ $badgeClass }}
                          absolute top-2.5 left-2.5
                          text-[9.5px] font-bold
                          px-2 py-0.5 rounded-sm tracking-wide">

                  {{ $badgeText }}

              </span>

          </div>

          <div class="px-3 pt-2.5 pb-3">

              <div class="flex items-start justify-between mb-0.5">

                  <div>

                      <p class="text-[14px] font-bold text-[#1a1a1a]">
                          {{ $plant->plant_name }}
                      </p>

                      <p class="text-[11.5px] text-[#6b7280]">
                          {{ $plant->category }}
                      </p>

                  </div>

              </div>

              <div class="flex items-center justify-between mt-2">

                  <div class="flex items-center gap-1 text-[11.5px] text-[#6b7280]">

                      {{ $plant->growth_period }}

                  </div>

                  <span class="text-[11.5px] font-semibold text-[#2e7d32]">
                      View Details
                  </span>

              </div>

          </div>

      </a>

      @endforeach

      @if($plants->count() == 0)

        <div class="col-span-4 text-center py-20">

            <h3 class="text-xl font-semibold text-gray-600">
                No Plants Found
            </h3>

        </div>

      @endif

    </div><!-- /grid -->

    <!-- ── Pagination ── -->
    <div class="flex items-center justify-between mt-6 px-1">
      <p class="text-[12.5px] text-[#6b7280]">
        Showing
        {{ $plants->firstItem() ?? 0 }}
        -
        {{ $plants->lastItem() ?? 0 }}
        of
        {{ $plants->total() }}
        plants
      </p>
      <div class="flex items-center gap-1.5">
        <div class="flex justify-center mt-10">
            {{ $plants->links() }}
        </div>
      </div>
    </div>

  </div><!-- /plant grid section -->

  @include('partials.footer')

  <!-- ── Interactivity Scripts ── -->
  <script>

  /* ── Suitability bar pills → update hidden input + auto-submit ── */
  document.querySelectorAll('.suit-pill').forEach(btn => {
    btn.addEventListener('click', () => {
      // Update active state visually
      document.querySelectorAll('.suit-pill').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // Sync the hidden input and the popup suitability buttons
      const value = btn.dataset.value;
      document.getElementById('suitabilityInput').value = value;
      syncPopupSuitBtns(value);

      // Submit the form immediately
      document.getElementById('mainFilterForm').submit();
    });
  });

  /* ── View toggle (cosmetic only) ── */
  document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  /* ── Filter dropdown open/close ── */
  const filterBtn = document.getElementById("filterBtn");
  const dropdown  = document.getElementById("filterDropdown");

  filterBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdown.classList.toggle("hidden");
  });

  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target) && !filterBtn.contains(e.target)) {
      dropdown.classList.add("hidden");
    }
  });

  /* ── Popup suitability buttons → update hidden input + bar pills ── */
  const suitabilityInput = document.getElementById("suitabilityInput");

  function syncPopupSuitBtns(value) {
    document.querySelectorAll(".suitability-btn").forEach((b) => {
      const isActive = b.dataset.value === value;
      b.classList.toggle("bg-[#8bd66c]",      isActive);
      b.classList.toggle("text-[#24411a]",    isActive);
      b.classList.toggle("border",           !isActive);
      b.classList.toggle("border-[#c9d6db]", !isActive);
      b.classList.toggle("bg-[#eef5f7]",     !isActive);
      b.classList.toggle("text-[#555]",      !isActive);
    });
  }

  document.querySelectorAll(".suitability-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const value = btn.dataset.value;
      suitabilityInput.value = value;
      syncPopupSuitBtns(value);

      // Also sync the bar pills visually
      document.querySelectorAll('.suit-pill').forEach(p => {
        p.classList.toggle('active', p.dataset.value === value);
      });
    });
  });

  /* ── Popup category/growth selects → sync to bar selects ── */
  document.getElementById("popupCategory").addEventListener("change", function () {
    document.getElementById("barCategory").value = this.value;
  });

  document.getElementById("popupGrowth").addEventListener("change", function () {
    document.getElementById("barGrowth").value = this.value;
  });

  /* ── Reset button ── */
  document.getElementById("resetBtn").addEventListener("click", () => {
    // Reset bar selects
    document.getElementById("barCategory").value = "All Plants";
    document.getElementById("barGrowth").value   = "Any Duration";

    // Reset popup selects
    document.getElementById("popupCategory").value = "All Plants";
    document.getElementById("popupGrowth").value   = "Any Duration";

    // Reset sunlight
    document.getElementById("sunlight").value = "";

    // Reset season checkboxes
    document.querySelectorAll(".risk-checkbox").forEach(c => c.checked = false);

    // Reset suitability → All
    suitabilityInput.value = "All";
    syncPopupSuitBtns("All");
    document.querySelectorAll('.suit-pill').forEach(p => {
      p.classList.toggle('active', p.dataset.value === 'All');
    });
  });

  /* ── Cancel button ── */
  document.getElementById("cancelBtn").addEventListener("click", () => {
    dropdown.classList.add("hidden");
  });

  </script>

@endsection