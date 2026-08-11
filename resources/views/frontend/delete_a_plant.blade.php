@extends('layouts.dashboard_layout')

@section('content')

  <style>
    * { font-family: 'DM Sans', sans-serif; }

    /* ── Filter overlay ── */
    #filter-overlay {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 40;
      background: rgba(0,0,0,0.25);
      backdrop-filter: blur(2px);
    }
    #filter-overlay.open { display: block; }

    /* ── Filter panel ── */
    #filter-panel {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -48%);
      z-index: 50;
      width: 340px;
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 24px 64px rgba(0,0,0,0.18);
      animation: popIn 0.2s cubic-bezier(.34,1.56,.64,1);
    }
    #filter-panel.open { display: block; }
    @keyframes popIn {
      from { opacity: 0; transform: translate(-50%, -46%) scale(0.96); }
      to   { opacity: 1; transform: translate(-50%, -48%) scale(1); }
    }

    /* ── Filter hero image ── */
    .filter-hero {
      width: 100%;
      height: 110px;
      background: linear-gradient(135deg, #134e1c 0%, #2d7a3a 40%, #4ade80 100%);
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .filter-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='110'%3E%3Cellipse cx='80' cy='20' rx='60' ry='80' fill='%23166534' opacity='.4' transform='rotate(-20 80 20)'/%3E%3Cellipse cx='300' cy='80' rx='70' ry='90' fill='%2315803d' opacity='.35' transform='rotate(15 300 80)'/%3E%3Cellipse cx='200' cy='55' rx='50' ry='70' fill='%2316a34a' opacity='.3' transform='rotate(-10 200 55)'/%3E%3C/svg%3E") center/cover;
    }
    .filter-hero-badge {
      position: relative;
      background: rgba(255,255,255,0.92);
      border-radius: 999px;
      padding: 7px 18px;
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 12px;
      font-weight: 700;
      color: #15803d;
      letter-spacing: 0.08em;
      box-shadow: 0 2px 12px rgba(0,0,0,0.12);
    }

    /* ── Select styling ── */
    .filter-select {
      width: 100%;
      appearance: none;
      -webkit-appearance: none;
      background: #f0f9ff;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      padding: 10px 36px 10px 14px;
      font-size: 14px;
      color: #374151;
      cursor: pointer;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .filter-select:focus { border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
    .select-wrap { position: relative; }
    .select-wrap svg { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; }

    /* ── Table rows ── */
    .plant-row:hover { background: #f0fdf4; }
    .plant-row { transition: background 0.12s; }

    /* ── Health badges ── */
    .badge-excellent  { background: #dcfce7; color: #15803d; }
    .badge-stable     { background: #dcfce7; color: #15803d; }
    .badge-attention  { background: #fee2e2; color: #dc2626; }
    .badge-critical   { background: #fef9c3; color: #b45309; }

    /* ── Filter btn active ── */
    #filter-btn.active { background: #f0fdf4; border-color: #16a34a; color: #16a34a; }

    /* ── Search focus ── */
    #plant-search:focus { outline: none; box-shadow: none; }
  </style>
 
{{-- 
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans"> ********************************************************************************--}}

    <!-- CONTENT -->
  <main class="flex-1 overflow-y-auto px-8 py-7 bg-[rgb(243,250,255)]">

    <!-- Page header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-900">Delete a plant</h1>
      <p class="text-sm text-gray-500 mt-1 max-w-xl">Manage your nursery inventory. Select a specimen from the list below to permanently remove its records from the Suitable Sow system.</p>
    </div>

    <!-- Search + Filter bar -->
    <div class="flex items-center gap-3 mb-5">
      <!-- Search -->
      <div class="flex-1 flex items-center gap-2.5 bg-white border border-gray-200 rounded-xl px-4 py-2.5 shadow-sm">
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
        <input id="plant-search" type="text" placeholder="Search by name or category..." class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full" oninput="searchPlants()">
      </div>
      <!-- Filter button -->
      <button
        id="filter-btn"
        onclick="openFilter()"
        class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 shadow-sm transition-colors"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
        Filters
      </button>
    </div>

    <!-- Table card -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
      <table class="w-full text-sm">
        <thead>
          <tr class="bg-[rgb(230,246,255)] border-b border-gray-200">
            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Plant Specimen</th>
            <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Category</th>
            <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Sub-Category</th>
            <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Health Status</th>
            <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody id="plant-table-body" class="divide-y divide-gray-100">

          <!-- Row 1 -->
          <tr class="plant-row" data-name="mango" data-category="Fruit Tree" data-subcategory="Tropical">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-yellow-300 to-orange-500 flex items-center justify-center text-lg">🥭</div>
                <span class="font-semibold text-gray-800">mango</span>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-600">Fruit Tree</td>
            <td class="px-5 py-4 text-gray-600">Tropical</td>
            <td class="px-5 py-4">
              <span class="badge-excellent text-xs font-semibold px-3 py-1 rounded-full">Excellent</span>
            </td>
            <td class="px-5 py-4">
              <button onclick="confirmDelete(this, 'mango')" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors group">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </td>
          </tr>

          <!-- Row 2 -->
          <tr class="plant-row" data-name="golden pathos" data-category="Indoor" data-subcategory="Vine">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-green-300 to-green-600 flex items-center justify-center text-lg">🌿</div>
                <span class="font-semibold text-gray-800">golden pathos</span>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-600">Indoor</td>
            <td class="px-5 py-4 text-gray-600">Vine</td>
            <td class="px-5 py-4">
              <span class="badge-stable text-xs font-semibold px-3 py-1 rounded-full">Stable</span>
            </td>
            <td class="px-5 py-4">
              <button onclick="confirmDelete(this, 'golden pathos')" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </td>
          </tr>

          <!-- Row 3 -->
          <tr class="plant-row" data-name="cutton" data-category="Industrial" data-subcategory="Fiber">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-gray-200 to-gray-400 flex items-center justify-center text-lg">🌾</div>
                <span class="font-semibold text-gray-800">cutton</span>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-600">Industrial</td>
            <td class="px-5 py-4 text-gray-600">Fiber</td>
            <td class="px-5 py-4">
              <span class="badge-attention text-xs font-semibold px-3 py-1 rounded-full">Requires Attention</span>
            </td>
            <td class="px-5 py-4">
              <button onclick="confirmDelete(this, 'cutton')" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </td>
          </tr>

          <!-- Row 4 -->
          <tr class="plant-row" data-name="chilli" data-category="Vegetable" data-subcategory="Capsicum">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-red-400 to-red-700 flex items-center justify-center text-lg">🌶️</div>
                <span class="font-semibold text-gray-800">chilli</span>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-600">Vegetable</td>
            <td class="px-5 py-4 text-gray-600">Capsicum</td>
            <td class="px-5 py-4">
              <span class="badge-excellent text-xs font-semibold px-3 py-1 rounded-full">Excellent</span>
            </td>
            <td class="px-5 py-4">
              <button onclick="confirmDelete(this, 'chilli')" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </td>
          </tr>

        </tbody>
      </table>

      <!-- No results row -->
      <div id="no-results" class="hidden px-6 py-10 text-center text-gray-400 text-sm">No plants match your search or filter.</div>

      <!-- Footer -->
      <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-[rgb(230,246,255)]">
        <span id="row-count" class="text-sm text-gray-500">Showing 4 of 4 plant specimens</span>
        <div class="flex items-center gap-2">
          <button class="px-4 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition font-medium">Previous</button>
          <button class="px-4 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition font-medium">Next</button>
        </div>
      </div>
    </div>

  </main>

<!-- END MAIN -->


<!-- ═══════════════════════════════════════
     FILTER OVERLAY + PANEL
═══════════════════════════════════════ -->

<!-- Backdrop -->
<div id="filter-overlay" onclick="closeFilter()"></div>

<!-- Panel -->
<div id="filter-panel">

  <!-- Hero image area -->
  <div class="filter-hero">
    <div class="filter-hero-badge">
      <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
      REFINED SEARCH
    </div>
  </div>

  <!-- Header row -->
  <div class="flex items-center justify-between px-5 pt-4 pb-1">
    <div class="flex items-center gap-2">
      <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
      <h3 class="text-base font-bold text-gray-900">Filter Plants</h3>
    </div>
    <button onclick="closeFilter()" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors text-gray-500">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>

  <!-- Filter fields -->
  <div class="px-5 pt-3 pb-4 space-y-4">

    <!-- Category -->
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1.5">Category</label>
      <div class="select-wrap">
        <select name="category" id="filter-category" class="filter-select">
          <option value="">Select Category</option>
          <option value="Fruit Tree">Fruit Tree</option>
          <option value="Indoor">Indoor</option>
          <option value="Industrial">Industrial</option>
          <option value="Vegetable">Vegetable</option>
          <option value="Herb">Herb</option>
          <option value="Flower">Flower</option>
        </select>
        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>
    </div>

    <!-- Sub-category -->
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1.5">Sub-category</label>
      <div class="select-wrap">
        <select name="subcategory" id="filter-subcategory" class="filter-select">
          <option value="">Select Sub-category</option>
          <option value="Tropical">Tropical</option>
          <option value="Vine">Vine</option>
          <option value="Fiber">Fiber</option>
          <option value="Capsicum">Capsicum</option>
          <option value="Leafy">Leafy</option>
          <option value="Citrus">Citrus</option>
        </select>
        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>
    </div>

    <!-- Info note -->
    <div class="flex items-start gap-2 bg-blue-50 border border-blue-100 rounded-lg px-3 py-2.5">
      <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <span class="text-xs text-blue-600 font-medium">Filtering will update the Dashboard view instantly.</span>
    </div>
  </div>

  <!-- Action buttons -->
  <div class="px-5 pb-5 space-y-2">
    <button onclick="applyFilter()" class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold text-sm py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
      Apply Filter
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    </button>
    <div class="flex gap-2">
      <button onclick="clearFilter()" class="flex-1 flex items-center justify-center gap-1.5 border border-gray-300 text-sm font-medium text-gray-600 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        Clear
      </button>
      <button onclick="closeFilter()" class="flex-1 text-sm font-medium text-gray-500 py-2.5 rounded-xl hover:bg-gray-50 transition-colors border border-transparent">
        Cancel
      </button>
    </div>
  </div>
</div>
<!-- END FILTER PANEL -->


<!-- ═══ DELETE CONFIRM MODAL ═══ -->
<div id="delete-overlay" class="hidden fixed inset-0 z-40 bg-black/30 backdrop-blur-sm flex items-center justify-center">
  <div class="bg-white rounded-2xl shadow-2xl w-80 p-6 text-center animate-[popIn_0.2s_ease]">
    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
      <svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
    </div>
    <h3 class="text-base font-bold text-gray-900 mb-1">Delete <span id="delete-name" class="text-red-600"></span>?</h3>
    <p class="text-sm text-gray-500 mb-5">This will permanently remove the plant record from the system. This action cannot be undone.</p>
    <div class="flex gap-2">
      <button onclick="closeDeleteModal()" class="flex-1 border border-gray-300 text-sm font-medium text-gray-600 py-2 rounded-xl hover:bg-gray-50 transition">Cancel</button>
      <button onclick="doDelete()" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 rounded-xl transition">Yes, Delete</button>
    </div>
  </div>
</div>


<script>
  // ── Filter open/close ──────────────────────────
  function openFilter() {
    document.getElementById('filter-overlay').classList.add('open');
    document.getElementById('filter-panel').classList.add('open');
    document.getElementById('filter-btn').classList.add('active');
  }
  function closeFilter() {
    document.getElementById('filter-overlay').classList.remove('open');
    document.getElementById('filter-panel').classList.remove('open');
    document.getElementById('filter-btn').classList.remove('active');
  }

  // ── Apply filter ──────────────────────────────
  function applyFilter() {
    const cat    = document.getElementById('filter-category').value.toLowerCase();
    const subcat = document.getElementById('filter-subcategory').value.toLowerCase();
    filterRows(cat, subcat);
    closeFilter();

    /*
    ── BACKEND SWAP ──────────────────────────────
    fetch(`/plants/delete-list?category=${cat}&subcategory=${subcat}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.text())
    .then(html => {
      document.getElementById('plant-table-body').innerHTML = html;
    });
    ──────────────────────────────────────────────
    */
  }

  // ── Clear filter ──────────────────────────────
  function clearFilter() {
    document.getElementById('filter-category').value    = '';
    document.getElementById('filter-subcategory').value = '';
    filterRows('', '');
  }

  // ── Client-side row filtering ─────────────────
  function filterRows(cat, subcat) {
    const rows   = document.querySelectorAll('.plant-row');
    let   visible = 0;
    rows.forEach(row => {
      const rowCat    = row.dataset.category.toLowerCase();
      const rowSubcat = row.dataset.subcategory.toLowerCase();
      const match = (!cat || rowCat === cat) && (!subcat || rowSubcat === subcat);
      row.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('row-count').textContent =
      `Showing ${visible} of ${rows.length} plant specimens`;
    document.getElementById('no-results').classList.toggle('hidden', visible > 0);
  }

  // ── Search ────────────────────────────────────
  function searchPlants() {
    const q    = document.getElementById('plant-search').value.toLowerCase();
    const rows = document.querySelectorAll('.plant-row');
    let   visible = 0;
    rows.forEach(row => {
      const name    = row.dataset.name.toLowerCase();
      const cat     = row.dataset.category.toLowerCase();
      const subcat  = row.dataset.subcategory.toLowerCase();
      const match   = name.includes(q) || cat.includes(q) || subcat.includes(q);
      row.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('row-count').textContent =
      `Showing ${visible} of ${rows.length} plant specimens`;
    document.getElementById('no-results').classList.toggle('hidden', visible > 0);
  }

  // ── Delete confirm ────────────────────────────
  let pendingDeleteRow = null;
  function confirmDelete(btn, name) {
    pendingDeleteRow = btn.closest('tr');
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-overlay').classList.remove('hidden');
  }
  function closeDeleteModal() {
    pendingDeleteRow = null;
    document.getElementById('delete-overlay').classList.add('hidden');
  }
  function doDelete() {
    if (pendingDeleteRow) {
      pendingDeleteRow.style.transition = 'opacity 0.3s';
      pendingDeleteRow.style.opacity = '0';
      setTimeout(() => {
        pendingDeleteRow.remove();
        const total   = document.querySelectorAll('.plant-row').length;
        const visible = document.querySelectorAll('.plant-row:not([style*="display: none"])').length;
        document.getElementById('row-count').textContent =
          `Showing ${visible} of ${total} plant specimens`;
      }, 300);
    }
    closeDeleteModal();

    /*
    ── BACKEND SWAP ──────────────────────────────
    fetch(`/plants/${plantId}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
    }).then(() => { pendingDeleteRow.remove(); });
    ──────────────────────────────────────────────
    */
  }
</script>
  @endsection