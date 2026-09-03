

<header class="bg-[rgb(243,250,255)] border-b border-slate-200 px-6 py-3 flex items-center gap-4">
    <!-- Brand Logo -->
    @if(auth()->check() && auth()->user()->role !== 'admin')
    <a href="{{ route('home') }}">
    <div class="flex items-center gap-3 ">
        <img src="{{asset('assets/icons/main_logo.png')}}" alt="Suitable Sow"
            class="w-[40px] h-[40px] object-contain rounded-lg"/>
        <div>
        <p class="text-[15px] font-bold text-[#1a1a1a] leading-tight">Suitable Sow</p>
        <p class="text-[11px] text-[#9ca3af]">sttable Ic.</p>
        </div>
    </div>
    </a>
    @endif 

    <!-- ______Live(Dynamic) Search Bar ____________-->

    @include('components.searchbar')
    {{--End Dynamic searchbar--------}}
    
    <div class="flex items-center gap-4 ml-auto">

        <!-- Notification Icon 
        ______showing notification icon only to Admin ____________
        -->

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.messages') }}" 
                id="notification-bell" 
                class="relative w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition flex-shrink-0 border border-[rgb(190,202,185)]"> 

                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6"/>
                    </svg>

                    {{-- Red dot — shown/hidden by JS --}} 
                    <span id="notif-dot" 
                        class="absolute top-2 right-2.5 w-2.5 h-2.5 rounded-full bg-red-500 transition-opacity duration-300" 
                        style="display:none;"> 
                    </span> 
                </a>

                <script>
                (function() {
                const UNREAD_URL = "{{ route('messages.unread.count') }}";
                const dot        = document.getElementById('notif-dot');

                function refreshDot() {
                    fetch(UNREAD_URL, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(r => r.json())
                    .then(data => {
                        dot.style.display = data.count > 0 ? 'block' : 'none';
                    })
                    .catch(() => {});
                }

                // Run on page load and then every 60 seconds
                refreshDot();
                setInterval(refreshDot, 60000);

                // Also react instantly when the messages page signals a change
                window.addEventListener('unread-count-changed', e => {
                    dot.style.display = e.detail.count > 0 ? 'block' : 'none';
                });
                })();
                </script>
            @endif

        <!-- Like Icon -->
        <a href="{{ route('whitelist.index') }}" class="relative text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
            </svg>
            
            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold leading-none">
                {{ Auth::check() ? Auth::user()->whitelists()->count() : 0 }}
            </span>
        </a>

        <div class="flex items-center gap-2">
            <div class="text-right">
                <p class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                @if (auth()->user()->role === 'admin')
                <p class="text-xs text-gray-400">Super Admin</p>
                @endif
            </div>

            <!-- profile picture -->
           <a href="{{ route('profile') }}">
            <div class="w-9 h-9 rounded-full overflow-hidden flex items-center justify-center text-white font-bold text-sm shadow-sm transition {{ auth()->user()->role === 'admin' ? 'bg-slate-800 hover:bg-slate-900' : 'bg-green-600 hover:bg-green-700' }}">
                @if(!empty(auth()->user()->image) && auth()->user()->image !== 'null')
                    <img 
                        src="{{ asset('storage/' . auth()->user()->image) }}" 
                        class="w-full h-full object-cover" 
                        alt="profile"
                    >
                @else
                    <!-- Option B: Traditional Neutral Silhouette Asset (Alternative) -->
                    <img 
                        src="{{ asset('avator.png') }}" 
                        class="w-full h-full object-cover" 
                        alt="default profile"
                    > 
                   
                @endif
            </div>
            </a>

        </div>

    </div>

</header>