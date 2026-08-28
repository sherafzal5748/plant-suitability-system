<aside class="w-48 bg-white border-r border-slate-200 flex flex-col justify-between h-full flex-shrink-0">
        <div>
            <div class="flex items-center gap-2.5 px-4 py-5 border-b border-slate-100">
                <img src="{{ asset('assets/icons/main_logo.png') }}" alt="Logo" class="w-10 h-10 rounded-xl object-cover bg-green-700">
                <div>
                    <p class="text-sm font-bold text-gray-900 leading-tight">Suitable Sow</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Agri-Admin</p>
                </div>
            </div>
            <div class="px-4 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Main Menu</p> 
                <nav class="flex flex-col gap-1">

                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('home') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/></svg>
                        Home
                    </a>

                    
                    <a href="{{ route('plant_catalog') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('plant_catalog') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        plant catalog
                    </a>


                    <a href="{{ route('add_a_plant') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('add_a_plant') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/></svg>
                        Add a plant
                    </a>

                    <a href="{{ route('update_a_plant') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('update_a_plant') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Update a plant
                    </a>

                    <a href="{{ route('delete_a_plant') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('delete_a_plant') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete a plant
                    </a>

                </nav>
            </div>
            <div class="px-4 pt-6">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Management</p>
                <nav class="flex flex-col gap-1">

                <a href="{{ route('all_users') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('all_users') ? 'font-semibold text-white bg-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    All Users
                </a>

                </nav>
            </div>
        </div>
        <div>
        <div class="mx-3 mb-3 bg-green-50 rounded-xl px-3 py-3 flex items-center gap-2">
            <div class="flex -space-x-2">
            <div class="w-7 h-7 rounded-full bg-green-400 border-2 border-white"></div>
            <div class="w-7 h-7 rounded-full bg-blue-400 border-2 border-white"></div>
            </div>
            <div>
            <p class="text-xs font-semibold text-gray-800 leading-tight">North Sector</p>
            <p class="text-xs text-gray-400">Enterprise Manager</p>
            </div>
        </div>
        <div class="px-4 pb-5 flex flex-col gap-1">
             <a href="{{ route('support') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/></svg>
            Support
            </a>
            
             <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 hover:bg-red-50 transition">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                    </svg>

                    Sign Out

                </button>
            </form>
        </div>
        </div>
  </aside>

 