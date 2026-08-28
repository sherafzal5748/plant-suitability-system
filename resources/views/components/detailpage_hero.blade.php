{{-- ═══════════════════════════════════════════════
     COMPONENT: detailpage_hero.blade.php
     Fields used:
       $plant->image, $plant->category, $plant->growing_season
       $plant->plant_name, $plant->scientific_name
     ═══════════════════════════════════════════════ --}}

<header class="relative rounded-[28px] overflow-hidden h-[280px] flex items-end p-8">

    {{-- Background Image --}}
    <img
        src="{{ asset('assets/images/home_plants/' . $plant->image) }}"
        onerror="this.src='https://images.unsplash.com/photo-1501430654243-c936cc5e1d73?auto=format&fit=crop&q=80&w=2000'"
        class="absolute inset-0 w-full h-full object-cover"
        alt="{{ $plant->plant_name }}"
    >

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent"></div>

    {{-- Content --}}
    <div class="relative z-10 text-white space-y-2 w-full">

        {{-- Badges --}}
        <div class="flex items-center gap-3 flex-wrap">
            <span class="bg-[#16a34a] text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                {{ $plant->category }}
            </span>
            @if($plant->growing_season)
                <span class="bg-white/15 backdrop-blur text-[10px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full border border-white/20">
                    {{ $plant->growing_season }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <h1 class="text-5xl font-bold tracking-tight">{{ $plant->plant_name }}</h1>
        <p class="text-gray-300 text-sm italic">{{ $plant->scientific_name }}</p>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-3 pt-2">
            
            <a href="{{ route('plant.suitability', $plant->id) }}"
                    class="bg-[#16a34a] hover:bg-[#15803d] px-7 py-2.5 rounded-full font-bold text-sm transition-all shadow-lg active:scale-95 inline-block">
                Check Local Suitability
            </a>

            <form action="{{ route('whitelist.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plant_id" value="{{ $plant->id }}">
                <input type="hidden" name="plant_name" value="{{ $plant->plant_name }}">
                <input type="hidden" name="scientific_name" value="{{ $plant->scientific_name }}">
                <input type="hidden" name="category" value="{{ $plant->category }}">
                <input type="hidden" name="image" value="{{ $plant->image }}">

                <button type="submit" class="bg-white/10 hover:bg-white/20 px-7 py-2.5 rounded-full font-bold text-sm backdrop-blur-md transition-all border border-white/20">
                    Add to My Crops
                </button>
            </form>

        </div> 

    </div>
</header>