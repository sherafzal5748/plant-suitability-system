@extends('layouts.dashboard_layout')

@section('content')

  <!-- ───────────── MAIN ───────────── -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- CONTENT -->
    <main class="flex-1 overflow-y-auto px-8 py-6">

      <!-- Page Header -->
      <div class="flex items-start justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Plant Catalog</h1>
          <p class="text-sm text-gray-500 mt-1">Manage and monitor your full botanical database across all facilities.</p>
        </div>
        <div class="flex gap-3">
          <button class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition">Export CSV</button>
          <button class="bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Bulk Update</button>
        </div>
      </div>

    <!-- Stat Cards -->
<div class="grid grid-cols-3 gap-4 mb-6">

  <!-- Total Plants -->
  <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
        <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Total Plants</p>
            <p class="text-3xl font-bold text-gray-900">1,284</p>
        </div>
        <!-- Top right icon -->
        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center flex-shrink-0">
            <img src="assets/icons/plant_catalog/total_palnts_icon.png" alt="Total Plants Icon" class="w-8 h-8 object-contain">
        </div>
        </div>

        <!-- Bottom right background watermark icon — half cut off, top edge touches the icon above -->
        <div class="absolute" style="width: 90px; height: 90px; bottom: -40px; right: -10px;">
        <img src="assets/icons/plant_catalog/total_palnts_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
        </div>
  </div>

  <!-- All Categories -->
  <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">All Categories</p>
            <p class="text-3xl font-bold text-gray-900">12</p>
        </div>
        <!-- Top right icon -->
        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
            <img src="assets/icons/plant_catalog/all_categories_icon.png" alt="All Categories Icon" class="w-8 h-8 object-contain">
        </div>
        </div>

        <!-- Bottom right background watermark icon -->
        <div class="absolute" style="width: 90px; height: 90px; bottom: -30px; right: -20px;">
        <img src="assets/icons/plant_catalog/all_categories_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
        </div>
  </div>

  <!-- Sub-Categories -->
  <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
        <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Sub-Categories</p>
            <p class="text-3xl font-bold text-gray-900">48</p>
        </div>
        <!-- Top right icon -->
        <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center flex-shrink-0">
            <img src="assets/icons/plant_catalog/sub_categories_icon.png" alt="Sub Categories Icon" class="w-8 h-8 object-contain">
        </div>
        </div>

        <!-- Bottom right background watermark icon -->
        <div class="absolute" style="width: 90px; height: 90px; bottom: -30px; right: -10px;">
        <img src="assets/icons/plant_catalog/sub_categories_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
        </div>
  </div>

</div>

      <!-- Plant Database Table -->
      <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <!-- Table Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
          <h2 class="text-base font-bold text-gray-900">Plant Database</h2>
          <div class="flex items-center gap-3">
            <div class="flex items-center gap-1 border border-slate-200 rounded-lg px-3 py-1.5 text-sm text-gray-600 cursor-pointer bg-[rgb(230,246,255)] hover:bg-gray-200">
              All Categories
              <svg class="w-4 h-4 text-gray-400 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </div>
            <button class="flex items-center gap-1.5 text-sm text-gray-600 border border-slate-200 rounded-lg px-3 py-1.5 hover:bg-gray-50">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
              Filters
            </button>
          </div>
        </div>

        <!-- Table -->
        <table class="w-full text-sm">
          <thead class="bg-gray-50 border-b border-slate-200">
            <tr class="bg-[rgb(230,246,255)]">
              <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">S.No</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Plant Name</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Sub-Category</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Health Status</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">

            <!-- Row 1 -->
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-500">1</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-green-100 overflow-hidden flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xs">🌿</div>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Spinach Viroflay</p>
                    <p class="text-xs text-gray-400">ID: SS-7234-A</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4 text-gray-600">Leafy Greens</td>
              <td class="px-4 py-4 text-gray-600">Iron-Rich Cultivars</td>
              <td class="px-4 py-4">
                <span class="flex items-center gap-1.5 text-green-600 font-medium">
                  <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                  Optimal Growth
                </span>
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="text-gray-400 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Row 2 -->
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-500">2</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-red-100 overflow-hidden flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white text-xs">🍅</div>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Heirloom Tomato</p>
                    <p class="text-xs text-gray-400">ID: SS-5129-C</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4 text-gray-600">Fruit Bearers</td>
              <td class="px-4 py-4 text-gray-600">Solanaceae</td>
              <td class="px-4 py-4">
                <span class="flex items-center gap-1.5 text-green-600 font-medium">
                  <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                  Monitoring
                </span>
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="text-gray-400 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Row 3 -->
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-500">3</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-purple-100 overflow-hidden flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white text-xs">🥕</div>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Dragon Purple Carrot</p>
                    <p class="text-xs text-gray-400">ID: SS-9932-B</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4 text-gray-600">Root Vegetables</td>
              <td class="px-4 py-4 text-gray-600">Daucus Carota</td>
              <td class="px-4 py-4">
                <span class="flex items-center gap-1.5 text-green-600 font-medium">
                  <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                  Optimal Growth
                </span>
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="text-gray-400 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Row 4 -->
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-500">4</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-green-100 overflow-hidden flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center text-white text-xs">🥬</div>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Lacinato Dino Kale</p>
                    <p class="text-xs text-gray-400">ID: SS-1024-D</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4 text-gray-600">Leafy Greens</td>
              <td class="px-4 py-4 text-gray-600">Brassica Oleracea</td>
              <td class="px-4 py-4">
                <span class="flex items-center gap-1.5 text-red-500 font-medium">
                  <span class="w-2 h-2 rounded-full bg-red-500 inline-block"></span>
                  Critical Attention
                </span>
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="text-gray-400 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>

          </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex items-center justify-between px-6 py-4 border-t border-slate-100 bg-[rgb(230,246,255)]">
            <p class="text-sm text-gray-500">Showing 1 to 4 of 1,284 plants</p>
            <div class="flex items-center gap-2">

                <!-- Left arrow in rounded box -->
                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-400 hover:bg-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <!-- Page 1 active -->
                <button class="w-9 h-9 rounded-xl bg-green-700 text-white text-sm font-semibold flex items-center justify-center">1</button>

                <!-- Page 2 -->
                <button class="w-9 h-9 rounded-xl text-gray-500 text-sm hover:bg-gray-200 flex items-center justify-center transition">2</button>

                <!-- Page 3 -->
                <button class="w-9 h-9 rounded-xl text-gray-500 text-sm hover:bg-gray-200 flex items-center justify-center transition">3</button>

                <!-- Dots -->
                <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">...</span>

                <!-- Page 321 -->
                <button class="w-9 h-9 rounded-xl text-gray-500 text-sm hover:bg-gray-200 flex items-center justify-center transition">321</button>

                <!-- Right arrow in rounded box -->
                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-400 hover:bg-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>

            </div>
        </div>

      </div>

    </main>
  </div>

@endsection