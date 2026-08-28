<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logged Out </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'DM Sans', sans-serif; }

    /* Blurred plants background */
    .field-bg {
      position: relative;
      overflow: hidden;
      background: #c8dbbe;
    }
    .field-bg::before {
      content: '';
      position: absolute;
      inset: -10px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='600' viewBox='0 0 900 600'%3E%3Crect width='900' height='600' fill='%23b5cfa0'/%3E%3C!-- Sky gradient --%3E%3Crect width='900' height='320' fill='url(%23sky)'/%3E%3Cdefs%3E%3ClinearGradient id='sky' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0%25' stop-color='%23d4e8f5'/%3E%3Cstop offset='100%25' stop-color='%23c2dba8'/%3E%3C/linearGradient%3E%3ClinearGradient id='ground' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0%25' stop-color='%23a8c87a'/%3E%3Cstop offset='100%25' stop-color='%2378a050'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect y='300' width='900' height='300' fill='url(%23ground)'/%3E%3C!-- Crop rows --%3E%3Crect x='0' y='310' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='330' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='350' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='370' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='390' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='410' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='430' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='450' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='470' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='490' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='510' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='530' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='550' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3C!-- Left foreground plants --%3E%3Cg opacity='.9'%3E%3Cellipse cx='60' cy='520' rx='22' ry='90' fill='%2352883a' transform='rotate(-12,60,520)'/%3E%3Cellipse cx='40' cy='500' rx='18' ry='75' fill='%235e9e42' transform='rotate(8,40,500)'/%3E%3Cellipse cx='80' cy='510' rx='16' ry='80' fill='%234a7a34' transform='rotate(-5,80,510)'/%3E%3Cellipse cx='20' cy='540' rx='14' ry='65' fill='%23609645' transform='rotate(15,20,540)'/%3E%3Cellipse cx='100' cy='530' rx='12' ry='70' fill='%234d8438' transform='rotate(-18,100,530)'/%3E%3C/g%3E%3C!-- Right foreground plants --%3E%3Cg opacity='.9'%3E%3Cellipse cx='840' cy='515' rx='22' ry='90' fill='%2352883a' transform='rotate(12,840,515)'/%3E%3Cellipse cx='860' cy='500' rx='18' ry='75' fill='%235e9e42' transform='rotate(-8,860,500)'/%3E%3Cellipse cx='820' cy='525' rx='16' ry='80' fill='%234a7a34' transform='rotate(5,820,525)'/%3E%3Cellipse cx='880' cy='535' rx='14' ry='65' fill='%23609645' transform='rotate(-15,880,535)'/%3E%3Cellipse cx='800' cy='520' rx='12' ry='70' fill='%234d8438' transform='rotate(18,800,520)'/%3E%3C/g%3E%3C!-- Mid background plants --%3E%3Cg opacity='.55'%3E%3Cellipse cx='200' cy='370' rx='14' ry='55' fill='%2368a84c' transform='rotate(-8,200,370)'/%3E%3Cellipse cx='230' cy='360' rx='11' ry='48' fill='%2374b856' transform='rotate(5,230,360)'/%3E%3Cellipse cx='680' cy='365' rx='14' ry='55' fill='%2368a84c' transform='rotate(8,680,365)'/%3E%3Cellipse cx='710' cy='355' rx='11' ry='48' fill='%2374b856' transform='rotate(-5,710,355)'/%3E%3Cellipse cx='430' cy='355' rx='10' ry='42' fill='%2368a84c' transform='rotate(-3,430,355)'/%3E%3Cellipse cx='460' cy='350' rx='9' ry='38' fill='%2374b856' transform='rotate(6,460,350)'/%3E%3C/g%3E%3C!-- Sunlight glow --%3E%3Cellipse cx='450' cy='80' rx='200' ry='80' fill='%23fff8e0' opacity='.18'/%3E%3C/svg%3E");
      background-size: cover;
      background-position: center;
      filter: blur(5px) brightness(1.05);
      transform: scale(1.04);
      z-index: 0;
    }
    .field-bg > * { position: relative; z-index: 1; }

    /* Card pop-in */
    .card-enter {
      animation: cardIn 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    @keyframes cardIn {
      from { opacity: 0; transform: translateY(22px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0)   scale(1); }
    }

    /* Lock icon bounce */
    .icon-bounce {
      animation: iconBounce 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s both;
    }
    @keyframes iconBounce {
      from { opacity: 0; transform: scale(0.5); }
      to   { opacity: 1; transform: scale(1); }
    }

    /* Button hover lift */
    .btn-lift { transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .btn-lift:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0,0,0,0.12); }
    .btn-lift:active { transform: translateY(0); box-shadow: none; }

    /* Divider fade-in */
    .divider-fade {
      animation: fadein 0.6s ease 0.6s both;
    }
    @keyframes fadein {
      from { opacity: 0; } to { opacity: 1; }
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- ── NAVBAR ── -->
  <header class="w-full bg-white border-b border-gray-100 shadow-sm z-10">
    <div class="max-w-7xl mx-auto px-5 h-14 flex items-center">
      <a href="#" class="flex items-center gap-2 select-none">
        <img src="assets/icons/main_logo.png"
             alt="SuitableSOW logo"
             class="h-8 w-auto object-contain" />
        <!-- Fallback text logo shown when image is missing (dev env) -->
        <span class="text-[15px] font-semibold tracking-tight text-gray-800 leading-none">
          Suitable<span class="text-emerald-500">SOW</span>
        </span>
      </a>
    </div>
  </header>

  <!-- ── MAIN ── -->
  <main class="flex-1 field-bg flex items-center justify-center px-4 py-16">
    <div class="card-enter bg-white rounded-2xl shadow-xl w-full max-w-md px-10 py-10 flex flex-col items-center text-center">

      <!-- Lock icon -->
      <div class="icon-bounce w-16 h-16 rounded-full bg-emerald-400 flex items-center justify-center shadow-md mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
      </div>

      <!-- Heading -->
      <h1 class="text-[26px] font-bold text-gray-900 mb-3 leading-tight">
        You are <span class="text-emerald-500">logged out</span>
      </h1>

      <!-- Sub-copy -->
      <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
        You are now safely logged out. To access your account again, please sign in.
        Don't have an account?&nbsp;<span class="text-gray-600 font-medium">Sign up to join our community.</span>
      </p>

      <!-- Divider above buttons -->
      <hr class="divider-fade w-full border-gray-200 mt-7 mb-6" />

      <!-- CTA buttons -->
      <div class="flex gap-3 w-full">
        <a href="{{ route('login') }}"
           class="btn-lift flex-1 bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold py-2.5 rounded-lg transition-colors">
          LOG IN
        </a>
        <a href="{{ route('register.form') }}"
           class="btn-lift flex-1 border border-gray-300 hover:border-gray-400 text-gray-700 text-sm font-semibold py-2.5 rounded-lg transition-colors">
          SIGN UP
        </a>
      </div>
    </div>
  </main>

  <!-- ── FOOTER ── -->
  <footer class="bg-white border-t border-gray-100 py-6">
    <div class="flex flex-col items-center gap-3">

      <!-- Social icons -->
      <div class="flex items-center gap-5 text-gray-400">
        <!-- X / Twitter -->
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="X">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
        <!-- YouTube -->
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="YouTube">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
          </svg>
        </a>
        <!-- Chat / Forum -->
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="Community">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
        </a>
        <!-- Instagram -->
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="Instagram">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
          </svg>
        </a>
      </div>

      <!-- Legal links -->
      <p class="text-[11px] text-gray-400">
        © 2024 AgriPulse Precision Agriculture. All rights reserved.
      </p>
      <div class="flex items-center gap-4 text-[11px] text-gray-400">
        <a href="#" class="hover:text-gray-600 transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-gray-600 transition-colors">Terms of Service</a>
        <a href="#" class="hover:text-gray-600 transition-colors">Support</a>
      </div>
    </div>
  </footer>

</body>
</html>