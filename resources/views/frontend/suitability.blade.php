<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>suitability</title>
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

  /* UPDATED: Added a subtle border to match the design */
  .param-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 14px 16px;
    flex: 1;
    min-width: 0;
  }

  /* NEW: Added highlight circle background for card icons */
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
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-xl space-y-3">

  <div class="bg-white rounded-2xl p-4 flex items-center justify-between shadow-sm">
    <div class="flex items-center gap-3">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Wheat-hadrianus.jpg/320px-Wheat-hadrianus.jpg"
        alt="Wheat"
        class="w-14 h-14 rounded-xl object-cover"
        onerror="this.src='https://placehold.co/56x56/c8e6c9/1a6b2f?text=🌾'"
      />
      <div>
        <div class="flex items-center gap-2 mb-0.5">
          <h1 class="text-2xl font-bold text-gray-900">Wheat</h1>
          <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17 8C8 10 5.9 16.17 3.82 21L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-8 2 3-4 5-3 5-3C12 2 7 6 7 10c0 2 1 3 1 3 .97-.99 1.75-2.14 2.3-3.4L17 8z"/></svg>
          <span class="badge-suitable">SUITABLE</span>
        </div>
        <p class="text-green-600 text-xs flex items-center gap-1">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          This plant matches your location perfectly.
        </p>
      </div>
    </div>
    <div class="score-ring">
      <span class="text-[9px] text-gray-400 uppercase tracking-wider">Score</span>
      <span class="text-2xl font-bold text-gray-900 leading-none">94%</span>
    </div>
  </div>

  <div class="bg-white rounded-2xl p-4 shadow-sm">
    <div class="flex items-center gap-2 mb-4">
      <span class="text-lg">🌡️</span>
      <h2 class="font-semibold text-gray-800 text-sm">Environmental Comparison</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Temperature (°C)</p>
        <div class="space-y-2">
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Requirement (15-25°C)</span>
              <span class="text-green-600 font-medium">Optimal</span>
            </div>
            <div class="bar-track"><div class="bar-fill-dark" style="width:75%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Local Area (22°C)</span>
              <span class="font-medium text-gray-700">22°C</span>
            </div>
            <div class="bar-track"><div class="bar-fill-light" style="width:60%"></div></div>
          </div>
        </div>
      </div>

      <div>
        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Rainfall (mm/yr)</p>
        <div class="space-y-2">
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Requirement (500-900mm)</span>
              <span class="text-green-600 font-medium">Optimal</span>
            </div>
            <div class="bar-track"><div class="bar-fill-dark" style="width:80%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-[10px] text-gray-400 mb-1">
              <span>Local Area (854mm)</span>
              <span class="font-medium text-gray-700">854mm</span>
            </div>
            <div class="bar-track"><div class="bar-fill-light" style="width:75%"></div></div>
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

  <div class="bg-white rounded-2xl p-4 shadow-sm">
    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Parameter Breakdown</p>
    
    <div class="grid grid-cols-2 sm:flex sm:flex-row gap-2">

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">🌡️</span></div>
          <span class="font-semibold text-gray-800 text-sm">Temp</span>
        </div>
        <p class="text-[11px] text-gray-400">Current: 22°C</p>
        <span class="badge-good whitespace-nowrap">Good Match</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">💧</span></div>
          <span class="font-semibold text-gray-800 text-sm">Rainfall</span>
        </div>
        <p class="text-[11px] text-gray-400">Current: 854mm</p>
        <span class="badge-good whitespace-nowrap">Good Match</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight"><span class="text-sm">❄️</span></div>
          <span class="font-semibold text-gray-800 text-sm">Frost</span>
        </div>
        <p class="text-[11px] text-gray-400">Risk: Low</p>
        <span class="badge-good whitespace-nowrap">Good Match</span>
      </div>

      <div class="param-card sm:flex-shrink-0 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5">
          <div class="icon-highlight" style="background: #fdfbeb;"><span class="text-sm">🪴</span></div>
          <span class="font-semibold text-gray-800 text-sm">Soil pH</span>
        </div>
        <p class="text-[11px] text-gray-400">Current: <span class="text-yellow-600 font-medium">6.8 pH</span></p>
        <span class="badge-acceptable whitespace-nowrap">Acceptable</span>
      </div>

    </div>
  </div>

  <div class="bg-[#1a4d2e] rounded-2xl p-5 shadow-sm">
    <div class="flex items-center gap-2 mb-3">
      <span class="text-lg">💡</span>
      <h2 class="font-bold text-white text-base">Actionable Recommendation</h2>
    </div>

    <div class="flex flex-col md:flex-row gap-3">
      <div class="flex-1">
        <p class="text-green-100 text-sm leading-relaxed mb-3">
          Soil is slightly acidic (pH 6.8). While acceptable for wheat, you can further optimize yields with a minor adjustment.
        </p>
        <div class="bg-[#245c38] rounded-xl p-3 flex gap-2">
          <div class="w-7 h-7 rounded-lg bg-[#1a4d2e] flex items-center justify-center flex-shrink-0">
            <span class="text-sm">⚗️</span>
          </div>
          <div>
            <p class="text-white font-semibold text-xs mb-0.5">Target Adjustment</p>
            <p class="text-green-200 text-[11px] leading-relaxed">Raising pH to 7.2 will increase phosphorus availability for robust root development.</p>
          </div>
        </div>
      </div>

      <div class="w-full md:w-36 flex-shrink-0 flex flex-col">
        <p class="text-green-300 text-[10px] font-semibold uppercase tracking-wider mb-1">Next Step</p>
        <p class="text-white font-semibold text-sm mb-2">Apply Agricultural Lime</p>
        <p class="text-green-200 text-[10px] leading-relaxed mb-3">Consider adding 2 tons per hectare of fine-ground limestone before next sowing.</p>
        <button class="bg-[#5cb85c] hover:bg-[#4caa4c] text-white text-xs font-semibold px-3 py-2 rounded-xl flex items-center gap-1 transition-colors mt-auto w-full justify-center md:justify-start">
          Order Supplies 🛒
        </button>
      </div>
    </div>



  </div>

<!-- Cancel Button Row -->
 <div class="flex justify-end">
    <button class="bg-[#1a3a1a] text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-[#274f27] transition-colors">
      Cancel
    </button>
  </div>
  <p class="text-center text-[11px] text-gray-400 pb-2">
    Last updated today at 10:45 AM &bull; Suitable Sow Analysis Engine v2.4
  </p>

</div>
</body>
</html>