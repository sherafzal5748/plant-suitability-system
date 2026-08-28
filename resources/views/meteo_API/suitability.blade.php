<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>{{ $plant->plant_name }} Suitability</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet"/>
<style>
  body { font-family: 'DM Sans', sans-serif; background: #f0f4f0; }

  .score-ring {
    width: 80px; height: 80px;
    border-radius: 50%;
    border: 3px solid #1a6b2f;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    background: white;
  }

  .bar-track {
    height: 10px; border-radius: 999px;
    background: #d6e8d6; overflow: hidden;
  }
  .bar-fill-dark {
    height: 100%; border-radius: 999px;
    background: #1a6b2f;
  }
  .bar-fill-light {
    height: 100%; border-radius: 999px;
    background: #7bc47f;
  }

  .param-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 14px 16px;
    flex: 1;
    min-width: 0;
  }

  .icon-highlight {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f0f7f0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .badge-suitable {
    background: #d4edda; color: #1a6b2f;
    font-size: 10px; font-weight: 700;
    padding: 2px 8px; border-radius: 999px;
    letter-spacing: 0.05em; text-transform: uppercase;
  }
  .badge-acceptable-status {
    background: #fff3cd; color: #856404;
    font-size: 10px; font-weight: 700;
    padding: 2px 8px; border-radius: 999px;
    letter-spacing: 0.05em; text-transform: uppercase;
  }
  .badge-not-suitable {
    background: #f8d7da; color: #842029;
    font-size: 10px; font-weight: 700;
    padding: 2px 8px; border-radius: 999px;
    letter-spacing: 0.05em; text-transform: uppercase;
  }
  .badge-good {
    border: 1px solid #b6d9b6; color: #1a6b2f;
    font-size: 12px; font-weight: 500;
    padding: 4px 14px; border-radius: 8px;
    background: white; display: inline-block; margin-top: 10px;
  }
  .badge-acceptable {
    border: 1px solid #ccc; color: #555;
    font-size: 12px; font-weight: 500;
    padding: 4px 14px; border-radius: 8px;
    background: white; display: inline-block; margin-top: 10px;
  }
  .badge-poor {
    border: 1px solid #eab6b6; color: #a33;
    font-size: 12px; font-weight: 500;
    padding: 4px 14px; border-radius: 8px;
    background: white; display: inline-block; margin-top: 10px;
  }
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

@php
    // Map each status word to the badge class + param-badge class used below
    $statusBadgeClass = match($status) {
        'Suitable' => 'badge-suitable',
        'Acceptable' => 'badge-acceptable-status',
        default => 'badge-not-suitable',
    };

    $paramBadgeClass = fn($level) => match($level) {
        'Good Match' => 'badge-good',
        'Acceptable' => 'badge-acceptable',
        'Poor Match' => 'badge-poor',
        default => 'badge-acceptable',
    };
@endphp

<div class="w-full max-w-xl space-y-3">

  @if(session('error'))
    <div class="bg-red-100 text-red-700 text-sm rounded-xl p-3">
      {{ session('error') }}
    </div>
  @endif

  {{-- Header --}}
  <div class="bg-white rounded-2xl p-4 flex items-center justify-between shadow-sm">
    <div class="flex items-center gap-3">
      <img
        src="{{ asset('assets/images/home_plants/' . $plant->image) }}"
        alt="{{ $plant->plant_name }}"
        class="w-14 h-14 rounded-xl object-cover"
        onerror="this.src='https://placehold.co/56x56/c8e6c9/1a6b2f?text=🌱'"
      />
      <div>
        <div class="flex items-center gap-2 mb-0.5">
          <h1 class="text-2xl font-bold text-gray-900">{{ $plant->plant_name }}</h1>
          <span class="{{ $statusBadgeClass }}">{{ strtoupper($status) }}</span>
        </div>
        <p class="text-green-600 text-xs flex items-center gap-1">
          {{ $matchMessage }}
        </p>
        <p class="text-gray-400 text-[11px]">{{ $cityName }}, {{ $country }}</p>
      </div>
    </div>
    <div class="score-ring">
      <span class="text-[9px] text-gray-400 uppercase tracking-wider">Score</span>
      <span class="text-2xl font-bold text-gray-900 leading-none">{{ $overallScore }}%</span>
    </div>
  </div>

  {{-- Environmental Comparison --}}
  <div class="bg-white rounded-2xl p-4 shadow-sm">
    <div class="flex items-center gap-2 mb-4">
      <span class="text-lg">🌡️</span>
      <h2 class="font-semibold text-gray-800 text-sm">Environmental Comparison</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      {{-- Temperature --}}
      <div>
        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Temperature (°C)</p>
        <div class="space-y-2">
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>
                Requirement
                @if($detail && $detail->ideal_temp_min_c && $detail->ideal_temp_max_c)
                  ({{ $detail->ideal_temp_min_c }}-{{ $detail->ideal_temp_max_c }}°C)
                @endif
              </span>
              <span class="text-green-600 font-medium">{{ $tempMatch }}</span>
            </div>
            <div class="bar-track"><div class="bar-fill-dark" style="width:{{ $tempReqWidth }}%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Local Area</span>
              <span class="font-medium text-gray-700">{{ $idealTemperature }}°C</span>
            </div>
            <div class="bar-track"><div class="bar-fill-light" style="width:{{ $tempLocalWidth }}%"></div></div>
          </div>
        </div>
      </div>

      {{-- Rainfall --}}
      <div>
        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Rainfall (mm/yr)</p>
        <div class="space-y-2">
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>
                Requirement
                @if($detail && $detail->annual_rainfall_min_mm && $detail->annual_rainfall_max_mm)
                  ({{ $detail->annual_rainfall_min_mm }}-{{ $detail->annual_rainfall_max_mm }}mm)
                @endif
              </span>
              <span class="text-green-600 font-medium">{{ $rainMatch }}</span>
            </div>
            <div class="bar-track"><div class="bar-fill-dark" style="width:{{ $rainReqWidth }}%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Local Area</span>
              <span class="font-medium text-gray-700">{{ $annualRainfall }}mm</span>
            </div>
            <div class="bar-track"><div class="bar-fill-light" style="width:{{ $rainLocalWidth }}%"></div></div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex items-center gap-4 mt-4">
      <div class="flex items-center gap-1.5">
        <span class="w-2.5 h-2.5 rounded-full bg-[#1a6b2f] inline-block"></span>
        <span class="text-[11px] text-gray-500">Plant Req.</span>
      </div>
      <div class="flex items-center gap-1.5">
        <span class="w-2.5 h-2.5 rounded-full bg-[#7bc47f] inline-block"></span>
        <span class="text-[11px] text-gray-500">User Local</span>
      </div>
    </div>
  </div>

  {{-- Parameter Breakdown --}}
  <div class="bg-white rounded-2xl p-4 shadow-sm">
    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Parameter Breakdown</p>

    <div class="grid grid-cols-2 sm:flex sm:flex-row gap-2">

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">🌡️</span></div>
          <span class="font-semibold text-gray-800 text-sm">Temp</span>
        </div>
        <p class="text-[11px] text-gray-400">Current: {{ $idealTemperature }}°C</p>
        <span class="{{ $paramBadgeClass($tempMatch) }} whitespace-nowrap">{{ $tempMatch }}</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">💧</span></div>
          <span class="font-semibold text-gray-800 text-sm">Rainfall</span>
        </div>
        <p class="text-[11px] text-gray-400">Current: {{ $annualRainfall }}mm</p>
        <span class="{{ $paramBadgeClass($rainMatch) }} whitespace-nowrap">{{ $rainMatch }}</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">❄️</span></div>
          <span class="font-semibold text-gray-800 text-sm">Frost</span>
        </div>
        <p class="text-[11px] text-gray-400">Risk: {{ $localFrostRisk }}</p>
        <span class="{{ $paramBadgeClass($frostMatch) }} whitespace-nowrap">{{ $frostMatch }}</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight" style="background: #fdfbeb;"><span class="text-sm">🪴</span></div>
          <span class="font-semibold text-gray-800 text-sm">Soil pH</span>
        </div>
        <p class="text-[11px] text-gray-400">
          Preferred: <span class="text-yellow-600 font-medium">{{ $detail->soil_ph_range ?? 'N/A' }}</span>
        </p>
        <span class="badge-acceptable whitespace-nowrap">Not Measured</span>
      </div>

    </div>
  </div>

  {{-- Recommendation --}}
  <div class="bg-[#1a4d2e] rounded-2xl p-5 shadow-sm">
    <div class="flex items-center gap-2 mb-3">
      <span class="text-lg">💡</span>
      <h2 class="font-bold text-white text-base">Recommendation</h2>
    </div>

    <p class="text-green-100 text-sm leading-relaxed mb-3">
      @if($status === 'Suitable')
        Your local climate matches {{ $plant->plant_name }}'s requirements well. You can proceed with confidence.
      @elseif($status === 'Acceptable')
        {{ $plant->plant_name }} can grow in your area, but keep an eye on
        @if($tempMatch !== 'Good Match') temperature @endif
        @if($rainMatch !== 'Good Match') rainfall @endif
        @if($frostMatch !== 'Good Match') frost exposure @endif
        conditions and adjust care accordingly.
      @else
        Your local climate falls outside {{ $plant->plant_name }}'s tolerable range. Consider greenhouse growing or an alternative plant better suited to your conditions.
      @endif
    </p>
  </div>

  <div class="flex justify-end">
    <a href="{{ url()->previous() }}" class="bg-[#1a3a1a] text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-[#274f27] transition-colors inline-block">
      Back
    </a>
  </div>
  <p class="text-center text-[11px] text-gray-400 pb-2">
    Last updated {{ now()->format('M d, Y \a\t g:i A') }} &bull; Suitable Sow Analysis Engine v2.4
  </p>

</div>
</body>
</html>