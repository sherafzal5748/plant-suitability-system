@extends('layouts.dashboard_layout')

@section('content')

  <style>
    * { font-family: 'DM Sans', sans-serif; }
    .mono { font-family: 'DM Mono', monospace; }
    .stat-card { transition: box-shadow 0.2s, transform 0.2s; }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .row-hover:hover { background: #f0fdf4; transition: background 0.15s; }
    .btn-export { background: linear-gradient(135deg, #16a34a, #15803d); }
    .btn-export:hover { background: linear-gradient(135deg, #15803d, #166534); }
    .badge-admin { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-editor { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .page-active { background: #16a34a; color: white; }
    .page-btn { width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; }
    .page-btn:hover:not(.page-active) { background: #f0fdf4; }
    .new-bar { background: #16a34a; border-radius: 4px; }

    /* Filter dropdown */
    #filter-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      z-index: 50;
      min-width: 280px;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
      overflow: hidden;
      animation: dropIn 0.18s ease;
    }
    #filter-dropdown.open { display: block; }
    @keyframes dropIn {
      from { opacity: 0; transform: translateY(-6px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .filter-select {
      width: 100%;
      appearance: none;
      -webkit-appearance: none;
      background: #f0f9ff;
      border: 1px solid #e2e8f0;
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
    #filter-btn.active { background: #f0fdf4; border-color: #16a34a; color: #16a34a; }
  </style>
  
{{-- </head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans"> ******************************************************************************************--}}

  

  <!-- MAIN -->
  <div class="flex-1 flex flex-col overflow-hidden">

    

    <!-- CONTENT -->
    <div class="flex-1 overflow-y-auto px-6 py-6">

      <!-- Page Header -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">User Management</h1>
        <p class="text-sm text-gray-500 mt-1 max-w-lg">Configure system access, manage administrative roles, and oversee regional user distribution across the Suitable Sow ecosystem.</p>
      </div>

      <!-- Stat Cards -->
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Total Users</span>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
            </div>
          </div>
          <div class="flex items-end gap-2">
            <span class="text-3xl font-bold text-gray-900">239</span>
            <span class="text-xs font-semibold text-green-600 bg-green-50 px-1.5 py-0.5 rounded mb-1">↑ 12%</span>
          </div>
        </div>
        <div class="stat-card bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Active Admins</span>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
          </div>
          <div class="flex items-end gap-2">
            <span class="text-3xl font-bold text-gray-900">12</span>
            <span class="text-xs font-medium text-gray-400 mb-1">Stable</span>
          </div>
        </div>
        <div class="stat-card bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">New This Month</span>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
          </div>
          <span class="text-3xl font-bold text-gray-900">+24</span>
          <div class="mt-2 h-1.5 bg-gray-100 rounded-full"><div class="new-bar h-1.5 w-3/5"></div></div>
        </div>
        <div class="stat-card bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">System Health</span>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
          </div>
          <div class="flex items-end gap-2">
            <span class="text-3xl font-bold text-gray-900">99%</span>
            <span class="text-xs font-semibold text-green-600 bg-green-50 px-1.5 py-0.5 rounded mb-1">Optimal</span>
          </div>
        </div>
      </div>

      <!-- Table Card -->
      <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-visible">

        <!-- Table Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
          <h2 class="text-base font-semibold text-gray-900">Registered Users</h2>
          <div class="flex items-center gap-2">

            <!-- ── FILTER BUTTON + DROPDOWN WRAPPER ── -->
            <div class="relative" id="filter-wrapper">
              <button
                id="filter-btn"
                onclick="toggleFilter(event)"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors"
              >
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                Filter
              </button>

              <!-- FILTER DROPDOWN -->
              <div id="filter-dropdown">
                <!-- Fields -->
                <div class="px-5 pt-5 pb-4 space-y-4">

                  <!-- Country -->
                  <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Country</label>
                    <div class="select-wrap">
                      <select name="country" id="filter-country" class="filter-select">
                        <option value="">All Countries</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">UK</option>
                        <option value="USA">USA</option>
                        <option value="Australia">Australia</option>
                      </select>
                      <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                  </div>

                  <!-- City -->
                  <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">City</label>
                    <div class="select-wrap">
                      <select name="city" id="filter-city" class="filter-select">
                        <option value="">All Cities</option>
                        <option value="Islamabad">Islamabad</option>
                        <option value="Toronto">Toronto</option>
                        <option value="London">London</option>
                        <option value="New York">New York</option>
                        <option value="Sydney">Sydney</option>
                      </select>
                      <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                  </div>

                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between px-5 py-3 bg-[rgb(230,246,255)] border-t border-gray-100">
                  <button onclick="closeFilter()" class="text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">Cancel</button>
                  <div class="flex items-center gap-2">
                    <button onclick="clearFilter()" class="text-sm font-medium text-gray-600 border border-gray-300 bg-white hover:bg-gray-50 px-4 py-1.5 rounded-lg transition-colors">Clear</button>
                    <button onclick="applyFilter()" class="text-sm font-semibold text-white bg-green-700 hover:bg-green-800 px-4 py-1.5 rounded-lg transition-colors">Apply Filter</button>
                  </div>
                </div>
              </div>
              <!-- END FILTER DROPDOWN -->
            </div>

            <button class="btn-export flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium text-white transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
              Export CSV
            </button>
          </div>
        </div>

        <!-- Table -->
        <table class="w-full">
          <thead>
            <tr class="bg-[rgb(230,246,255)]">
              <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider w-12">S.No</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">User</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Role</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Country</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">City</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Phone Number</th>
              <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50" id="user-table-body">
            <tr class="row-hover" data-country="Pakistan" data-city="Islamabad">
              <td class="px-6 py-4 mono text-sm text-gray-400 font-medium">01</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">SA</div>
                  <div>
                    <div class="text-sm font-semibold text-gray-800">Sher Afzal</div>
                    <div class="text-xs text-gray-400">sher.afzal@example.com</div>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4"><span class="badge-admin text-xs font-semibold px-2.5 py-1 rounded-full">Administrator</span></td>
              <td class="px-4 py-4 text-sm text-gray-700">Pakistan</td>
              <td class="px-4 py-4 text-sm text-gray-700">Islamabad</td>
              <td class="px-4 py-4 mono text-sm text-gray-700">+92 300 1234567</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="w-7 h-7 rounded-lg bg-green-50 hover:bg-green-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>
            <tr class="row-hover" data-country="Canada" data-city="Toronto">
              <td class="px-6 py-4 mono text-sm text-gray-400 font-medium">02</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-400 to-purple-600 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">AJ</div>
                  <div>
                    <div class="text-sm font-semibold text-gray-800">Arshia Javid</div>
                    <div class="text-xs text-gray-400">arshia.javid@example.com</div>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4"><span class="badge-editor text-xs font-semibold px-2.5 py-1 rounded-full">Editor</span></td>
              <td class="px-4 py-4 text-sm text-gray-700">Canada</td>
              <td class="px-4 py-4 text-sm text-gray-700">Toronto</td>
              <td class="px-4 py-4 mono text-sm text-gray-700">+1 416 555 0192</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="w-7 h-7 rounded-lg bg-green-50 hover:bg-green-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>
            <tr class="row-hover" data-country="UK" data-city="London">
              <td class="px-6 py-4 mono text-sm text-gray-400 font-medium">03</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-gradient-to-br from-sky-400 to-blue-600 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">MK</div>
                  <div>
                    <div class="text-sm font-semibold text-gray-800">Mussadiq Khan</div>
                    <div class="text-xs text-gray-400">m.khan@example.com</div>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4"><span class="badge-admin text-xs font-semibold px-2.5 py-1 rounded-full">Administrator</span></td>
              <td class="px-4 py-4 text-sm text-gray-700">UK</td>
              <td class="px-4 py-4 text-sm text-gray-700">London</td>
              <td class="px-4 py-4 mono text-sm text-gray-700">+44 20 7946 0148</td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <button class="w-7 h-7 rounded-lg bg-green-50 hover:bg-green-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Footer -->
        <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-[rgb(230,246,255)]">
          <span class="text-sm text-gray-400">Showing 1 to 10 of <span class="font-semibold text-gray-600">239</span> entries</span>
          <div class="flex items-center gap-1">
            <button class="page-btn text-gray-400 hover:bg-gray-100"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg></button>
            <button class="page-btn page-active">1</button>
            <button class="page-btn text-gray-500 hover:bg-gray-100">2</button>
            <button class="page-btn text-gray-500 hover:bg-gray-100">3</button>
            <button class="page-btn text-gray-400 hover:bg-gray-100"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></button>
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTENT -->
  </div>

  <script>
    const dropdown = document.getElementById('filter-dropdown');
    const filterBtn = document.getElementById('filter-btn');
    const filterWrapper = document.getElementById('filter-wrapper');

    // Toggle open/close
    function toggleFilter(e) {
      e.stopPropagation();
      const isOpen = dropdown.classList.contains('open');
      isOpen ? closeFilter() : openFilter();
    }

    function openFilter() {
      dropdown.classList.add('open');
      filterBtn.classList.add('active');
    }

    function closeFilter() {
      dropdown.classList.remove('open');
      filterBtn.classList.remove('active');
    }

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (!filterWrapper.contains(e.target)) {
        closeFilter();
      }
    });

    // Clear filter values
    function clearFilter() {
      document.getElementById('filter-country').value = '';
      document.getElementById('filter-city').value = '';
      // Show all rows
      document.querySelectorAll('#user-table-body tr').forEach(row => {
        row.style.display = '';
      });
    }

    // Apply filter — filters table client-side; swap this for a fetch() call for backend
    function applyFilter() {
      const country = document.getElementById('filter-country').value;
      const city    = document.getElementById('filter-city').value;

      document.querySelectorAll('#user-table-body tr').forEach(row => {
        const matchCountry = !country || row.dataset.country === country;
        const matchCity    = !city    || row.dataset.city    === city;
        row.style.display  = (matchCountry && matchCity) ? '' : 'none';
      });

      closeFilter();

      /*
      ── BACKEND SWAP ──────────────────────────────────────────────
      Replace the block above with a fetch() call when wiring up Laravel:

      fetch(`/users?country=${country}&city=${city}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(r => r.text())
      .then(html => {
        document.getElementById('user-table-body').innerHTML = html;
      });

      In your Laravel controller:
        public function index(Request $request) {
          $users = User::query()
            ->when($request->country, fn($q) => $q->where('country', $request->country))
            ->when($request->city,    fn($q) => $q->where('city',    $request->city))
            ->paginate(10);
          if ($request->ajax()) return view('partials.user_rows', compact('users'));
          return view('frontend.all_users', compact('users'));
        }
      ──────────────────────────────────────────────────────────────
      */
    }
  </script>

{{-- </body>
</html> --}}
@endsection