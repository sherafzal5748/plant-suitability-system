{{-- resources/views/plants/delete.blade.php --}}
@extends('layouts.dashboard_layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  * { font-family: 'DM Sans', sans-serif; }

  #filter-overlay {
    display: none; position: fixed; inset: 0; z-index: 40;
    background: rgba(0,0,0,0.25); backdrop-filter: blur(2px);
  }
  #filter-overlay.open { display: block; }

  #filter-panel {
    display: none; position: fixed; top: 50%; left: 50%;
    transform: translate(-50%, -48%); z-index: 50; width: 340px;
    background: white; border-radius: 20px; overflow: hidden;
    box-shadow: 0 24px 64px rgba(0,0,0,0.18);
    animation: popIn 0.2s cubic-bezier(.34,1.56,.64,1);
  }
  #filter-panel.open { display: block; }
  @keyframes popIn {
    from { opacity: 0; transform: translate(-50%, -46%) scale(0.96); }
    to   { opacity: 1; transform: translate(-50%, -48%) scale(1); }
  }

  .filter-hero {
    width: 100%; height: 110px;
    background: linear-gradient(135deg, #134e1c 0%, #2d7a3a 40%, #4ade80 100%);
    position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden;
  }
  .filter-hero::before {
    content: ''; position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='110'%3E%3Cellipse cx='80' cy='20' rx='60' ry='80' fill='%23166534' opacity='.4' transform='rotate(-20 80 20)'/%3E%3Cellipse cx='300' cy='80' rx='70' ry='90' fill='%2315803d' opacity='.35' transform='rotate(15 300 80)'/%3E%3C/svg%3E") center/cover;
  }
  .filter-hero-badge {
    position: relative; background: rgba(255,255,255,0.92); border-radius: 999px;
    padding: 7px 18px; display: flex; align-items: center; gap: 7px;
    font-size: 12px; font-weight: 700; color: #15803d; letter-spacing: 0.08em;
    box-shadow: 0 2px 12px rgba(0,0,0,0.12);
  }

  .filter-select {
    width: 100%; appearance: none; -webkit-appearance: none;
    background: #f0f9ff; border: 1.5px solid #e2e8f0; border-radius: 10px;
    padding: 10px 36px 10px 14px; font-size: 14px; color: #374151;
    cursor: pointer; outline: none; transition: border-color 0.15s, box-shadow 0.15s;
  }
  .filter-select:focus { border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
  .select-wrap { position: relative; }
  .select-wrap svg { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; }

  .plant-row:hover { background: #f0fdf4; }
  .plant-row { transition: background 0.12s; }

  .badge-high   { background: #dcfce7; color: #15803d; }
  .badge-medium { background: #dbeafe; color: #1d4ed8; }
  .badge-low    { background: #fee2e2; color: #dc2626; }

  #filter-btn.active { background: #f0fdf4; border-color: #16a34a; color: #16a34a; }
  #plant-search:focus { outline: none; box-shadow: none; }

  #toast {
    position: fixed; bottom: 28px; right: 28px; z-index: 999;
    display: flex; align-items: center; gap: 10px;
    background: #15803d; color: white; font-size: 13.5px; font-weight: 600;
    padding: 12px 20px; border-radius: 14px; box-shadow: 0 8px 30px rgba(0,0,0,0.18);
    transform: translateY(80px); opacity: 0;
    transition: all 0.3s cubic-bezier(.34,1.56,.64,1);
    pointer-events: none;
  }
  #toast.show  { transform: translateY(0); opacity: 1; }
  #toast.error { background: #dc2626; }

  .skeleton-bar {
    height: 13px; border-radius: 6px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.2s infinite;
  }
  @keyframes shimmer { from { background-position: 200% 0; } to { background-position: -200% 0; } }

  .spinner {
    width: 15px; height: 15px; border: 2px solid rgba(255,255,255,0.35);
    border-top-color: white; border-radius: 50%;
    animation: spin 0.6s linear infinite; display: inline-block;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
</style>

<main class="flex-1 overflow-y-auto px-8 py-7 bg-[rgb(243,250,255)]">

  @if(session('success'))
  <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm font-medium px-4 py-3 rounded-xl">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif

  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Delete a plant</h1>
    <p class="text-sm text-gray-500 mt-1 max-w-xl">Manage your nursery inventory. Select a specimen from the list below to permanently remove its records from the Suitable Sow system.</p>
  </div>

  <div class="flex items-center gap-3 mb-5">
    <div class="flex-1 flex items-center gap-2.5 bg-white border border-gray-200 rounded-xl px-4 py-2.5 shadow-sm">
      <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
      <input id="plant-search" type="text" placeholder="Search by name or category..."
             class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full"
             oninput="handleSearch(this.value)">
    </div>
    <button id="filter-btn" onclick="openFilter()"
        class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 shadow-sm transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
      Filters
      <span id="filter-dot" class="hidden w-2 h-2 rounded-full bg-green-600"></span>
    </button>
  </div>

  <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
      <thead>
        <tr class="bg-[rgb(230,246,255)] border-b border-gray-200">
          <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Plant Specimen</th>
          <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Category</th>
          <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Growing Season</th>
          <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Suitability Status</th>
          <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody id="plant-table-body" class="divide-y divide-gray-100"></tbody>
    </table>

    <div id="no-results" class="hidden px-6 py-10 text-center text-gray-400 text-sm">
      <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      No plants match your search or filter.
    </div>

    <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-[rgb(230,246,255)]">
      <span id="row-count" class="text-sm text-gray-500">Loading…</span>
      <div class="flex items-center gap-2">
        <button id="btn-prev" onclick="loadPage('prev')" disabled
            class="px-4 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition font-medium disabled:opacity-40 disabled:cursor-not-allowed">Previous</button>
        <button id="btn-next" onclick="loadPage('next')" disabled
            class="px-4 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition font-medium disabled:opacity-40 disabled:cursor-not-allowed">Next</button>
      </div>
    </div>
  </div>

</main>


<!-- FILTER OVERLAY -->
<div id="filter-overlay" onclick="closeFilter()"></div>

<div id="filter-panel">
  <div class="filter-hero">
    <div class="filter-hero-badge">
      <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
      REFINED SEARCH
    </div>
  </div>
  <div class="flex items-center justify-between px-5 pt-4 pb-1">
    <div class="flex items-center gap-2">
      <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
      <h3 class="text-base font-bold text-gray-900">Filter Plants</h3>
    </div>
    <button onclick="closeFilter()" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors text-gray-500">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="px-5 pt-3 pb-4 space-y-4">
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1.5">Category</label>
      <div class="select-wrap">
        <select id="filter-category" class="filter-select">
          <option value="">All Categories</option>
          <option value="Fruit">Fruit</option>
          <option value="Crops">Crops</option>
          <option value="Vegetables">Vegetables</option>
          <option value="Evergreen">Evergreen</option>
        </select>
        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1.5">Growing Season</label>
      <div class="select-wrap">
        <select id="filter-season" class="filter-select">
          <option value="">All Seasons</option>
          <option value="spring">Spring</option>
          <option value="summer">Summer</option>
          <option value="autumn">Autumn</option>
          <option value="winter">Winter</option>
        </select>
        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>
    </div>
    <div class="flex items-start gap-2 bg-blue-50 border border-blue-100 rounded-lg px-3 py-2.5">
      <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <span class="text-xs text-blue-600 font-medium">Filtering updates the list instantly from the database.</span>
    </div>
  </div>
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
      <button onclick="closeFilter()" class="flex-1 text-sm font-medium text-gray-500 py-2.5 rounded-xl hover:bg-gray-50 transition-colors border border-transparent">Cancel</button>
    </div>
  </div>
</div>


<!-- DELETE CONFIRM MODAL -->
<div id="delete-overlay" class="hidden fixed inset-0 z-40 bg-black/30 backdrop-blur-sm flex items-center justify-center">
  <div class="bg-white rounded-2xl shadow-2xl w-80 p-6 text-center">
    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
      <svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
    </div>
    <h3 class="text-base font-bold text-gray-900 mb-1">Delete <span id="delete-name" class="text-red-600"></span>?</h3>
    <p class="text-sm text-gray-500 mb-5">This will permanently remove the plant record from the system. This action cannot be undone.</p>
    <div class="flex gap-2">
      <button id="btn-cancel-delete" onclick="closeDeleteModal()"
          class="flex-1 border border-gray-300 text-sm font-medium text-gray-600 py-2 rounded-xl hover:bg-gray-50 transition">Cancel</button>
      <button id="btn-confirm-delete" onclick="doDelete()"
          class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 rounded-xl transition flex items-center justify-center gap-2">
        Yes, Delete
      </button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div id="toast">
  <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
  <span id="toast-msg"></span>
</div>


<script>
const ENDPOINT = "{{ route('plants.delete') }}";
const CSRF     = document.querySelector('meta[name=csrf-token]').content;

let state = { search:'', category:'', growing_season:'', page:1, prevPage:null, nextPage:null };
let pendingId = null, pendingRow = null, searchTimer = null, toastTimer = null;

// ── INIT
document.addEventListener('DOMContentLoaded', fetchPlants);

// ── FETCH from backend
function fetchPlants() {
  const tbody = document.getElementById('plant-table-body');
  tbody.innerHTML = skeletonRows();
  document.getElementById('no-results').classList.add('hidden');

  const p = new URLSearchParams({ page: state.page });
  if (state.search)         p.set('search',         state.search);
  if (state.category)       p.set('category',       state.category);
  if (state.growing_season) p.set('growing_season', state.growing_season);

  fetch(`${ENDPOINT}?${p}`, { headers:{ 'X-Requested-With':'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
      state.prevPage = data.prevPage;
      state.nextPage = data.nextPage;
      renderRows(data.rows);
      updateFooter(data.from, data.to, data.total, data.showing);
    })
    .catch(() => { tbody.innerHTML = ''; showToast('Failed to load plants. Please refresh.', true); });
}

// ── RENDER rows from JSON
function renderRows(rows) {
  const tbody = document.getElementById('plant-table-body');
  if (!rows || rows.length === 0) {
    tbody.innerHTML = '';
    document.getElementById('no-results').classList.remove('hidden');
    return;
  }
  const emojiMap = { fruit:'🍎', crops:'🌾', vegetables:'🥦', evergreen:'🌲' };
  const badgeMap = {
    high:   { cls:'badge-high',   label:'Excellent' },
    medium: { cls:'badge-medium', label:'Stable' },
    low:    { cls:'badge-low',    label:'Requires Attention' },
  };
  tbody.innerHTML = rows.map(p => {
    const emoji = emojiMap[(p.category||'').toLowerCase()] || '🌱';
    const badge = badgeMap[(p.suitability||'').toLowerCase()] || { cls:'badge-medium', label:'Unknown' };
    const season = p.growing_season ? p.growing_season.charAt(0).toUpperCase()+p.growing_season.slice(1) : '—';
    const img = p.image
      ? `<img src="{{ asset('assets/images/home_plants/') }}/${p.image}" alt="${esc(p.plant_name)}" class="w-10 h-10 rounded-xl object-cover flex-shrink-0" onerror="this.outerHTML='<div class=\'w-10 h-10 rounded-xl bg-gradient-to-br from-green-300 to-green-600 flex items-center justify-center text-lg flex-shrink-0\'>${emoji}</div>'">`
      : `<div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-300 to-green-600 flex items-center justify-center text-lg flex-shrink-0">${emoji}</div>`;
    return `
    <tr class="plant-row" data-id="${p.id}">
      <td class="px-6 py-4"><div class="flex items-center gap-3">${img}
        <div><span class="font-semibold text-gray-800">${esc(p.plant_name)}</span>
          <p class="text-xs text-gray-400 italic">${esc(p.scientific_name||'')}</p></div>
      </div></td>
      <td class="px-5 py-4 text-gray-600">${esc(p.category)}</td>
      <td class="px-5 py-4 text-gray-600">${season}</td>
      <td class="px-5 py-4"><span class="${badge.cls} text-xs font-semibold px-3 py-1 rounded-full">${badge.label}</span></td>
      <td class="px-5 py-4">
        <button onclick="confirmDelete(${p.id},'${esc(p.plant_name)}')"
            class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
          <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
          </svg>
        </button>
      </td>
    </tr>`;
  }).join('');
}

// ── SKELETON
function skeletonRows() {
  return Array(6).fill(0).map(() => `
    <tr class="border-b border-gray-100">
      <td class="px-6 py-4"><div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl skeleton-bar flex-shrink-0"></div>
        <div class="skeleton-bar w-28 h-3"></div></div></td>
      <td class="px-5 py-4"><div class="skeleton-bar w-20 h-3"></div></td>
      <td class="px-5 py-4"><div class="skeleton-bar w-16 h-3"></div></td>
      <td class="px-5 py-4"><div class="skeleton-bar w-24 h-3 rounded-full"></div></td>
      <td class="px-5 py-4"><div class="skeleton-bar w-8 h-8 rounded-lg"></div></td>
    </tr>`).join('');
}

// ── FOOTER
function updateFooter(from, to, total, showing) {
  document.getElementById('row-count').textContent =
    showing > 0 ? `Showing ${from}–${to} of ${total} plant specimens` : 'No plant specimens found';
  document.getElementById('btn-prev').disabled = !state.prevPage;
  document.getElementById('btn-next').disabled = !state.nextPage;
}
function loadPage(dir) {
  if (dir === 'prev' && state.prevPage) state.page = state.prevPage;
  if (dir === 'next' && state.nextPage) state.page = state.nextPage;
  fetchPlants();
  window.scrollTo({ top:0, behavior:'smooth' });
}

// ── SEARCH (debounced)
function handleSearch(val) {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => { state.search = val.trim(); state.page = 1; fetchPlants(); }, 350);
}

// ── FILTER
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
function applyFilter() {
  state.category       = document.getElementById('filter-category').value;
  state.growing_season = document.getElementById('filter-season').value;
  state.page = 1;
  document.getElementById('filter-dot').classList.toggle('hidden', !state.category && !state.growing_season);
  fetchPlants(); closeFilter();
}
function clearFilter() {
  document.getElementById('filter-category').value = '';
  document.getElementById('filter-season').value   = '';
  state.category = ''; state.growing_season = ''; state.page = 1;
  document.getElementById('filter-dot').classList.add('hidden');
  fetchPlants(); closeFilter();
}

// ── DELETE
function confirmDelete(id, name) {
  pendingId  = id;
  pendingRow = document.querySelector(`tr[data-id="${id}"]`);
  document.getElementById('delete-name').textContent = name;
  document.getElementById('delete-overlay').classList.remove('hidden');
}
function closeDeleteModal() {
  pendingId = null; pendingRow = null;
  document.getElementById('delete-overlay').classList.add('hidden');
  document.getElementById('btn-confirm-delete').disabled = false;
  document.getElementById('btn-confirm-delete').innerHTML = 'Yes, Delete';
  document.getElementById('btn-cancel-delete').disabled  = false;
}
function doDelete() {
  if (!pendingId) return;
  const confirmBtn = document.getElementById('btn-confirm-delete');
  const cancelBtn  = document.getElementById('btn-cancel-delete');
  confirmBtn.disabled = cancelBtn.disabled = true;
  confirmBtn.innerHTML = '<span class="spinner"></span> Deleting…';

  fetch(`/plants/${pendingId}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN':CSRF, 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
  })
  .then(r => { if (!r.ok) throw new Error(); return r.json(); })
  .then(data => {
    if (pendingRow) {
      pendingRow.style.transition = 'opacity 0.25s, transform 0.25s';
      pendingRow.style.opacity = '0';
      pendingRow.style.transform = 'translateX(16px)';
      setTimeout(() => { pendingRow.remove(); fetchPlants(); }, 280);
    }
    closeDeleteModal();
    showToast(data.message || 'Plant deleted successfully.');
  })
  .catch(() => { closeDeleteModal(); showToast('Something went wrong. Try again.', true); });
}

// ── HELPERS
function esc(s) {
  return String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
function showToast(msg, isError=false) {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  t.classList.toggle('error', isError);
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 3200);
}
</script>

@endsection