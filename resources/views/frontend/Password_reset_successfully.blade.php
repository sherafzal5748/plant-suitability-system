<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Security Updated</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'DM Sans', sans-serif; }

    @keyframes pop-in {
      0% { transform: scale(0.6); opacity: 0; }
      70% { transform: scale(1.08); }
      100% { transform: scale(1); opacity: 1; }
    }
    @keyframes fade-up {
      0% { opacity: 0; transform: translateY(18px); }
      100% { opacity: 1; transform: translateY(0); } 
    }
    @keyframes checkmark {
      0% { stroke-dashoffset: 50; }
      100% { stroke-dashoffset: 0; }
    }

    .anim-pop { animation: pop-in 0.55s cubic-bezier(.34,1.56,.64,1) both; }
    .anim-fade-1 { animation: fade-up 0.5s ease both; animation-delay: 0.25s; }
    .anim-fade-2 { animation: fade-up 0.5s ease both; animation-delay: 0.38s; }
    .anim-fade-3 { animation: fade-up 0.5s ease both; animation-delay: 0.50s; }
    .anim-fade-4 { animation: fade-up 0.5s ease both; animation-delay: 0.62s; }
    .anim-fade-5 { animation: fade-up 0.5s ease both; animation-delay: 0.74s; }

    .check-path {
      stroke-dasharray: 50;
      stroke-dashoffset: 50;
      animation: checkmark 0.45s ease forwards;
      animation-delay: 0.3s;
    }

    .watermark-img {
      pointer-events: none;
      user-select: none;
    }

    .btn-dashboard {
      background: linear-gradient(135deg, #1a6e2e 0%, #2d9144 100%);
      transition: filter 0.2s, transform 0.15s;
    }
    .btn-dashboard:hover {
      filter: brightness(1.08);
      transform: translateY(-1px);
    }
    .btn-dashboard:active {
      transform: translateY(0);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-[#e8f2f5] relative overflow-hidden">

  <!-- Top-left watermark icon -->
  <div class="watermark-img absolute top-0 left-0 w-48 h-48 opacity-[0.13] -translate-x-6 -translate-y-6">
    <img src="assets/icons/main_logo/total_palnts_icon_bg.png"
         alt=""
         class="w-full h-full object-contain"
         aria-hidden="true"/>
  </div>

  <!-- Bottom-right watermark icon -->
  <div class="watermark-img absolute bottom-0 right-0 w-52 h-52 opacity-[0.13] translate-x-8 translate-y-8">
    <img src="assets/icons/plant_catalog/total_palnts_icon_bg.png"
         alt=""
         class="w-full h-full object-contain"
         aria-hidden="true"/>
  </div>

  <!-- Main card -->
  <div class="relative z-10 bg-white rounded-2xl shadow-xl px-10 py-10 w-full max-w-sm flex flex-col items-center text-center mx-4">

    <!-- Checkmark circle -->
    <div class="anim-pop mb-5 w-[72px] h-[72px] rounded-full bg-[#e6f4ea] flex items-center justify-center shadow-sm">
      <div class="w-[52px] h-[52px] rounded-full bg-[#2d9144] flex items-center justify-center shadow-md">
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path class="check-path" d="M5.5 13.5L10.5 18.5L20.5 8" stroke="white" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <!-- Title -->
    <h1 class="anim-fade-1 text-[#0f2117] text-2xl font-bold leading-snug mb-0.5">
      Your Password Updated
    </h1>
    <h2 class="anim-fade-1 text-[#2d9144] text-2xl font-bold leading-snug mb-4">
      Successfully
    </h2>

    <!-- Description -->
    <p class="anim-fade-2 text-[#5a7066] text-sm leading-relaxed mb-7 max-w-[260px]">
      Your account is now secure with your new password. You've been logged out of other devices to ensure complete protection.
    </p>

    <!-- CTA Button -->
    <a href="{{ route('login') }}" class="anim-fade-3 btn-dashboard w-full py-3.5 rounded-xl text-white text-sm font-semibold tracking-widest uppercase shadow-md mb-4 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
      Log In 
    </a>

    <!-- Secondary link -->
    <a href="/" class="anim-fade-4 text-[#0f2117] text-sm font-medium hover:text-[#2d9144] transition-colors duration-200">
      Return to welcome page
    </a>

  </div>

  <!-- Bottom info cards -->
  <div class="anim-fade-5 relative z-10 mt-5 flex gap-4 w-full max-w-sm px-4">

    <!-- Recent Activity -->
    <div class="flex-1 bg-white rounded-xl shadow-sm px-4 py-3.5 flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-[#e6f4ea] flex items-center justify-center flex-shrink-0">
        <!-- Clock icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2d9144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9"/>
          <polyline points="12 7 12 12 15.5 14.5"/>
        </svg>
      </div>
      <div>
        <p class="text-[#0f2117] text-xs font-semibold leading-tight">Recent Activity</p>
        <p class="text-[#7a9a8a] text-[11px] leading-tight mt-0.5">Password changed 2m ago</p>
      </div>
    </div>

    <!-- Protection Level -->
    <div class="flex-1 bg-white rounded-xl shadow-sm px-4 py-3.5 flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-[#e6f4ea] flex items-center justify-center flex-shrink-0">
        <!-- Shield icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2d9144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <div>
        <p class="text-[#0f2117] text-xs font-semibold leading-tight">Protection Level</p>
        <p class="text-[#7a9a8a] text-[11px] leading-tight mt-0.5">Account status: High</p>
      </div>
    </div>

  </div>

</body>
</html>