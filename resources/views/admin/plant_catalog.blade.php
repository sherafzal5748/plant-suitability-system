@extends('layouts.dashboard_layout')

@section('content')

  <div class="flex-1 flex flex-col overflow-hidden">

    <main class="flex-1 overflow-y-auto px-8 py-6">

      @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center justify-between text-sm transition">
          <div class="flex items-center gap-2">
            <span>✨</span>
            <span>{{ session('success') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 font-bold">&times;</button>
        </div>
      @endif

      <div class="flex items-start justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Plant Catalog</h1>
          <p class="text-sm text-gray-500 mt-1">Manage and monitor your full botanical database across all facilities.</p>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('plants.export', request()->input()) }}" class="border border-gray-300 bg-white text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
            Export CSV
          </a>
          <a href="{{ route('add_a_plant') }}" class="bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-800 transition">Add a Plant</a>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
          <div class="flex items-start justify-between">
            <div>
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Total Plants</p>
              <p class="text-3xl font-bold text-gray-900">{{ number_format($totalPlantsCount) }}</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center flex-shrink-0">
              <img src="assets/icons/plant_catalog/total_palnts_icon.png" alt="Total Plants Icon" class="w-8 h-8 object-contain">
            </div>
          </div>
          <div class="absolute" style="width: 90px; height: 90px; bottom: -40px; right: -10px;">
            <img src="assets/icons/plant_catalog/total_palnts_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
          </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
          <div class="flex items-start justify-between">
            <div>
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">All Categories</p>
              <p class="text-3xl font-bold text-gray-900">{{ $totalCategoriesCount }}</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
              <img src="assets/icons/plant_catalog/all_categories_icon.png" alt="All Categories Icon" class="w-8 h-8 object-contain">
            </div>
          </div>
          <div class="absolute" style="width: 90px; height: 90px; bottom: -30px; right: -20px;">
            <img src="assets/icons/plant_catalog/all_categories_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
          </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 relative overflow-hidden" style="min-height: 110px;">
          <div class="flex items-start justify-between">
            <div>
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Highly Suitable Plants</p>
              <p class="text-3xl font-bold text-gray-900">{{ $highlySuitableCount }}</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center flex-shrink-0">
              <img src="assets/icons/plant_catalog/sub_categories_icon.png" alt="Sub Categories Icon" class="w-8 h-8 object-contain">
            </div>
          </div>
          <div class="absolute" style="width: 90px; height: 90px; bottom: -30px; right: -10px;">
            <img src="assets/icons/plant_catalog/sub_categories_icon_bg.png" alt="" class="w-full h-full object-contain opacity-10">
          </div>
        </div>

      </div>

      <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        
        <form action="{{ route('plant_catalog') }}" method="GET" id="filterForm">
          <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h2 class="text-base font-bold text-gray-900">Plant Database</h2>
            <div class="flex items-center gap-3">
              
              <div class="relative flex items-center border border-slate-200 rounded-lg px-2 py-1 text-sm text-gray-600 bg-[rgb(230,246,255)] hover:bg-blue-100 transition">
                <select name="category" onchange="document.getElementById('filterForm').submit();" class="bg-transparent focus:outline-none pr-6 pl-1 py-0.5 font-medium text-gray-700 appearance-none cursor-pointer">
                  <option value="">All Categories</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                  @endforeach
                </select>
                <div class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>
              </div>

              <div class="relative flex items-center border border-slate-200 rounded-lg px-2 py-1 text-sm text-gray-600 bg-white hover:bg-gray-50 transition">
                <select name="season" onchange="document.getElementById('filterForm').submit();" class="bg-transparent focus:outline-none pr-6 pl-1 py-0.5 text-gray-700 appearance-none cursor-pointer">
                  <option value="">All Seasons</option>
                  @foreach($seasons as $season)
                    <option value="{{ $season }}" {{ request('season') == $season ? 'selected' : '' }}>{{ $season }}</option>
                  @endforeach
                </select>
                <div class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 8h10M11 12h2"/></svg>
                </div>
              </div>

              @if(request()->filled('category') || request()->filled('season'))
                <a href="{{ route('plant_catalog') }}" class="text-xs text-red-600 hover:underline font-semibold pl-1">Clear Filters</a>
              @endif

            </div>
          </div>
        </form>

        <table class="w-full text-sm">
          <thead class="bg-gray-50 border-b border-slate-200">
            <tr class="bg-[rgb(230,246,255)]">
              <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">S.No</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Plant Name</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Growing Season</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Suitability Status</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            @forelse($plants as $index => $plant)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-500">{{ $plants->firstItem() + $index }}</td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-slate-100">
                      @if($plant->image && file_exists(public_path('assets/images/home_plants/' . $plant->image)))
                        <img 
                          src="{{ asset('assets/images/home_plants/' . $plant->image) }}" 
                          alt="{{ $plant->plant_name }}" 
                          class="w-full h-full object-cover"
                        >
                      @else
                        <div class="w-full h-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xs">
                          🌿
                        </div>
                      @endif
                    </div>

                    <div class="flex flex-col justify-center">
                      <p class="font-semibold text-gray-900 leading-tight mb-0.5">
                        {{ $plant->plant_name ?? 'Unknown Plant' }}
                      </p>
                      <p class="text-xs text-gray-400">
                        Code: {{ $plant->plant_code ?? 'SS-'.(1000 + $plant->id).'-X' }}
                      </p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-4 text-gray-600">{{ $plant->category }}</td>
                <td class="px-4 py-4 text-gray-600">{{ $plant->growing_season }}</td>
                <td class="px-4 py-4">
                  @php
                    $status = $plant->suitability ?? 'Monitoring';
                    
                    $isOptimal = Str::contains(strtolower($status), ['optimal', 'high']);
                    $statusColor = $isOptimal ? 'text-green-600' : 'text-amber-600';
                    $dotColor = $isOptimal ? 'bg-green-500' : 'bg-amber-500';
                  @endphp
                  <span class="flex items-center gap-1.5 {{ $statusColor }} font-medium">
                    <span class="w-2 h-2 rounded-full {{ $dotColor }} inline-block"></span>
                    {{ ucfirst($status) }}
                  </span>
                </td>
                <td class="px-4 py-4">
                  @php
                    $status = $plant->suitability ?? 'Monitoring';
                    
                    $isOptimal = Str::contains(strtolower($status), ['optimal', 'high']);
                    $statusColor = $isOptimal ? 'text-green-600' : 'text-amber-600';
                    $dotColor = $isOptimal ? 'bg-green-500' : 'bg-amber-500';
                  @endphp
                  <span class="flex items-center gap-1.5 {{ $statusColor }} font-medium">
                    <span class="w-2 h-2 rounded-full {{ $dotColor }} inline-block"></span>
                    {{ ucfirst($status) }}
                  </span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-2">
                    
                    <a href="{{ route('admin.update_a_plant', ['category' => $plant->category, 'id' => $plant->id]) }}" class="text-gray-400 hover:text-indigo-600 transition" title="Edit Plant Matrix">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                      </svg>
                    </a>
                    
                    <form action="{{ route('plants.destroy', $plant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant profile from the Suitable Sow database?');" class="inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Delete Plant">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50">
                  No plant matching the selected filtration parameters was discovered.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div class="flex items-center justify-between px-6 py-4 border-t border-slate-100 bg-[rgb(230,246,255)]">
            <p class="text-sm text-gray-500">
              Showing {{ $plants->firstItem() ?? 0 }} to {{ $plants->lastItem() ?? 0 }} of {{ number_format($plants->total()) }} plants
            </p>
            
            @if($plants->hasPages())
              <div class="flex items-center gap-2">
                @if($plants->onFirstPage())
                  <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-300 bg-gray-50 cursor-not-allowed" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                  </button>
                @else
                  <a href="{{ $plants->previousPageUrl() }}" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-500 bg-white hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                  </a>
                @endif

                @foreach ($plants->getUrlRange(max(1, $plants->currentPage() - 2), min($plants->lastPage(), $plants->currentPage() + 2)) as $page => $url)
                  @if ($page == $plants->currentPage())
                    <button class="w-9 h-9 rounded-xl bg-green-700 text-white text-sm font-semibold flex items-center justify-center">{{ $page }}</button>
                  @else
                    <a href="{{ $url }}" class="w-9 h-9 rounded-xl text-gray-500 text-sm hover:bg-gray-200 flex items-center justify-center transition bg-white border border-slate-100">{{ $page }}</a>
                  @endif
                @endforeach

                @if($plants->currentPage() < $plants->lastPage() - 2)
                  <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">...</span>
                  <a href="{{ $plants->url($plants->lastPage()) }}" class="w-9 h-9 rounded-xl text-gray-500 text-sm hover:bg-gray-200 flex items-center justify-center transition bg-white border border-slate-100">{{ $plants->lastPage() }}</a>
                @endif

                @if($plants->hasMorePages())
                  <a href="{{ $plants->nextPageUrl() }}" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-500 bg-white hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                  </a>
                @else
                  <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-gray-300 bg-gray-50 cursor-not-allowed" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                  </button>
                @endif
              </div>
            @endif
        </div>

      </div>

    </main>
  </div>

@endsection