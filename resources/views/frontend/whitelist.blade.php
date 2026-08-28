<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Your Whitelist</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&family=DM+Sans:wght@400;500;600&display=swap');
  body { font-family: 'DM Sans', sans-serif; background: #f4f5f0; }
  h1 { font-family: 'Cormorant Garamond', serif; letter-spacing: -0.5px; }
  h2 { font-family: 'DM Sans', sans-serif; }
  .latin-name { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 0.95rem; }
  .badge-indoor { background: #e6f4e6; color: #2e7d32; }
  .plant-card { transition: box-shadow 0.2s; }
  .plant-card:hover { box-shadow: 0 4px 24px rgba(0,0,0,0.10); }
  .delete-btn { transition: background 0.15s; }
  .delete-btn:hover { background: #fde8e8; }
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-xl bg-[#f4f5f0] rounded-2xl py-8 px-4">

    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-[#1a3a1a] mb-2">Your Whitelist</h1>
      <p class="text-gray-500 text-sm max-w-xs mx-auto leading-relaxed">
        Manage the collection of plants currently approved for your digital garden and botanical library.
      </p>
    </div>

    <p class="text-gray-500 text-sm mb-4">
      Showing {{ $whitelists->count() }} {{ Str::plural('plant', $whitelists->count()) }} in your list
    </p>

    <div class="space-y-4">

      @forelse($whitelists as $item)
        <div class="plant-card bg-white rounded-2xl p-4 flex items-center gap-4 shadow-sm">
          
          <img src="{{ asset('assets/images/home_plants/' . $item->image) }}" 
               onerror="this.src='https://images.unsplash.com/photo-1501430654243-c936cc5e1d73?auto=format&fit=crop&q=80&w=2000'" 
               alt="{{ $item->plant_name }}" 
               class="w-20 h-20 rounded-xl object-cover flex-shrink-0 bg-gray-100"/>
          
          <div class="flex-1 min-w-0">
            <h2 class="font-semibold text-gray-900 text-base">{{ $item->plant_name }}</h2>
            <p class="latin-name text-green-700 mb-2">{{ $item->scientific_name }}</p>
            <div class="flex gap-2 flex-wrap">
              <span class="badge-indoor text-xs font-semibold px-2 py-0.5 rounded-full uppercase tracking-wide">
                {{ $item->category }}
              </span>
            </div>
          </div>

          <form action="{{ route('whitelist.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this plant from your crops?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn w-9 h-9 flex items-center justify-center rounded-full bg-red-50 text-red-400 flex-shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
              </svg>
            </button>
          </form>
        </div>
      @empty
        <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-300">
          <p class="text-gray-400 text-sm font-medium">No plants added to your crops yet.</p>
        </div>
      @endforelse

    </div>

    <hr class="my-6 border-gray-200" />

    <div class="flex justify-end">
      <a href="{{ route('home') }}">
        <button class="bg-[#1a3a1a] text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-[#274f27] transition-colors">
          Back
        </button>
      </a>
    </div>

  </div>
</body>
</html>