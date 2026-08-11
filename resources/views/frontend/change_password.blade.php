<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password – SuitableSOW</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'DM Sans', sans-serif; }

    /* ── Blurred plants background (shared) ── */
    .field-bg {
      position: relative;
      overflow: hidden;
      background: #c8dbbe;
    }
    .field-bg::before {
      content: '';
      position: absolute;
      inset: -10px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='600' viewBox='0 0 900 600'%3E%3Crect width='900' height='600' fill='%23b5cfa0'/%3E%3Crect width='900' height='320' fill='url(%23sky)'/%3E%3Cdefs%3E%3ClinearGradient id='sky' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0%25' stop-color='%23d4e8f5'/%3E%3Cstop offset='100%25' stop-color='%23c2dba8'/%3E%3C/linearGradient%3E%3ClinearGradient id='ground' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0%25' stop-color='%23a8c87a'/%3E%3Cstop offset='100%25' stop-color='%2378a050'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect y='300' width='900' height='300' fill='url(%23ground)'/%3E%3Crect x='0' y='310' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='330' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='350' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='370' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='390' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='410' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='430' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='450' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='470' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='490' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='510' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='530' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Crect x='0' y='550' width='900' height='6' fill='%2390b860' opacity='.6'/%3E%3Cg opacity='.9'%3E%3Cellipse cx='60' cy='520' rx='22' ry='90' fill='%2352883a' transform='rotate(-12,60,520)'/%3E%3Cellipse cx='40' cy='500' rx='18' ry='75' fill='%235e9e42' transform='rotate(8,40,500)'/%3E%3Cellipse cx='80' cy='510' rx='16' ry='80' fill='%234a7a34' transform='rotate(-5,80,510)'/%3E%3Cellipse cx='20' cy='540' rx='14' ry='65' fill='%23609645' transform='rotate(15,20,540)'/%3E%3Cellipse cx='100' cy='530' rx='12' ry='70' fill='%234d8438' transform='rotate(-18,100,530)'/%3E%3C/g%3E%3Cg opacity='.9'%3E%3Cellipse cx='840' cy='515' rx='22' ry='90' fill='%2352883a' transform='rotate(12,840,515)'/%3E%3Cellipse cx='860' cy='500' rx='18' ry='75' fill='%235e9e42' transform='rotate(-8,860,500)'/%3E%3Cellipse cx='820' cy='525' rx='16' ry='80' fill='%234a7a34' transform='rotate(5,820,525)'/%3E%3Cellipse cx='880' cy='535' rx='14' ry='65' fill='%23609645' transform='rotate(-15,880,535)'/%3E%3Cellipse cx='800' cy='520' rx='12' ry='70' fill='%234d8438' transform='rotate(18,800,520)'/%3E%3C/g%3E%3Cg opacity='.55'%3E%3Cellipse cx='200' cy='370' rx='14' ry='55' fill='%2368a84c' transform='rotate(-8,200,370)'/%3E%3Cellipse cx='230' cy='360' rx='11' ry='48' fill='%2374b856' transform='rotate(5,230,360)'/%3E%3Cellipse cx='680' cy='365' rx='14' ry='55' fill='%2368a84c' transform='rotate(8,680,365)'/%3E%3Cellipse cx='710' cy='355' rx='11' ry='48' fill='%2374b856' transform='rotate(-5,710,355)'/%3E%3Cellipse cx='430' cy='355' rx='10' ry='42' fill='%2368a84c' transform='rotate(-3,430,355)'/%3E%3Cellipse cx='460' cy='350' rx='9' ry='38' fill='%2374b856' transform='rotate(6,460,350)'/%3E%3C/g%3E%3Cellipse cx='450' cy='80' rx='200' ry='80' fill='%23fff8e0' opacity='.18'/%3E%3C/svg%3E");
      background-size: cover;
      background-position: center;
      filter: blur(5px) brightness(1.05);
      transform: scale(1.04);
      z-index: 0;
    }
    .field-bg > * { position: relative; z-index: 1; }

    /* ── Card animation ── */
    .card-enter {
      animation: cardIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    @keyframes cardIn {
      from { opacity: 0; transform: translateY(20px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── Icon bounce ── */
    .icon-bounce {
      animation: iconBounce 0.65s cubic-bezier(0.34, 1.56, 0.64, 1) 0.25s both;
    }
    @keyframes iconBounce {
      from { opacity: 0; transform: scale(0.5); }
      to   { opacity: 1; transform: scale(1); }
    }

    /* ── Input focus ring ── */
    .pw-input:focus {
      outline: none;
      border-color: #22c55e;
      box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
    }

    /* ── Submit button ── */
    .btn-green {
      transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
    }
    .btn-green:hover {
      background-color: #16a34a;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(22,163,74,0.35);
    }
    .btn-green:active { transform: translateY(0); box-shadow: none; }

    /* ── Eye toggle ── */
    .eye-btn { transition: color 0.15s ease; }
    .eye-btn:hover { color: #374151; }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <header class="w-full bg-white border-b border-gray-100 shadow-sm z-10">
    <div class="max-w-7xl mx-auto px-5 h-14 flex items-center">
      <a href="#" class="flex items-center gap-2 select-none">
        <img src="assets/icons/main_logo.png"
             alt="SuitableSOW logo"
             class="h-8 w-auto object-contain" />
        <span class="text-[15px] font-semibold tracking-tight text-gray-800 leading-none">
          Suitable<span class="text-emerald-500">SOW</span>
        </span>
      </a>
    </div>
  </header>

  <main class="flex-1 field-bg flex items-center justify-center px-4 py-14">
    <div class="card-enter bg-white rounded-2xl shadow-xl w-full max-w-sm px-8 py-9 flex flex-col items-center">

      <div class="icon-bounce relative mb-5">
        <div class="w-16 h-16 rounded-full bg-emerald-400 flex items-center justify-center shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2.2"
               stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>
        <span class="absolute -top-0.5 -right-0.5 w-5 h-5 rounded-full bg-green-600 flex items-center justify-center shadow">
          <svg class="w-2.5 h-2.5 text-white" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="8" cy="15" r="5"/>
            <path d="M13 9l8-4M17 5l2 2"/>
          </svg>
        </span>
      </div>

      <h1 class="text-[22px] font-bold text-gray-900 mb-2 text-center">Change password</h1>

      <p class="text-[13px] text-gray-500 text-center leading-relaxed mb-7 max-w-[260px]">
        To change your password, please fill in the fields below. Your password must contain at least six characters, including capital letters, digits, and special characters.
      </p>

      

      @if ($errors->any())
        <div class="w-full bg-rose-50 border border-rose-100 text-rose-500 rounded-lg p-3 text-xs font-medium mb-4">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}" class="w-full flex flex-col gap-4">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-1.5">
          <label class="text-[12px] font-semibold text-gray-700 tracking-wide">Current Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
            </span>
            <input id="current-pw" name="current_password" type="password" placeholder="Current password" required
              class="pw-input w-full border border-gray-200 rounded-lg pl-9 pr-10 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-gray-50 transition-all" />
            <button type="button" onclick="togglePw('current-pw', this)"
              class="eye-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4 eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col gap-1.5">
          <label class="text-[12px] font-semibold text-gray-700 tracking-wide">New Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
              </svg>
            </span>
            <input id="new-pw" name="password" type="password" placeholder="New password" required
              class="pw-input w-full border border-gray-200 rounded-lg pl-9 pr-10 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-gray-50 transition-all" />
            <button type="button" onclick="togglePw('new-pw', this)"
              class="eye-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4 eye-on" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col gap-1.5">
          <label class="text-[12px] font-semibold text-gray-700 tracking-wide">Confirm New Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <polyline points="9 12 11 14 15 10"/>
              </svg>
            </span>
            <input id="confirm-pw" name="password_confirmation" type="password" placeholder="Confirm new password" required
              class="pw-input w-full border border-gray-200 rounded-lg pl-9 pr-10 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-gray-50 transition-all" />
            <button type="button" onclick="togglePw('confirm-pw', this)"
              class="eye-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4 eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
        </div>

        <button type="submit"
          class="btn-green mt-2 w-full bg-green-500 text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2 shadow-sm">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="9 12 11 14 15 10"/>
          </svg>
          Change Password
        </button>

        <a href="{{ route('profile') }}"
           class="text-center text-[13px] text-gray-500 hover:text-gray-700 transition-colors mt-1 font-medium">
          Cancel &amp; Return to Profile
        </a>

      </form>
    </div>
  </main>

  <footer class="bg-white border-t border-gray-100 py-6">
    <div class="flex flex-col items-center gap-3">
      <div class="flex items-center gap-5 text-gray-400">
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="X">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="YouTube">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93-.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
          </svg>
        </a>
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="Community">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
        </a>
        <a href="#" class="hover:text-gray-600 transition-colors" aria-label="Instagram">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
          </svg>
        </a>
      </div>
      <p class="text-[11px] text-gray-400">© 2024 AgriPulse Precision Agriculture. All rights reserved.</p>
      <div class="flex items-center gap-4 text-[11px] text-gray-400">
        <a href="#" class="hover:text-gray-600 transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-gray-600 transition-colors">Terms of Service</a>
        <a href="#" class="hover:text-gray-600 transition-colors">Support</a>
      </div>
    </div>
  </footer>

  <script>
    function togglePw(id, btn) {
      const input = document.getElementById(id);
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      btn.innerHTML = isHidden
        ? `<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`
        : `<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
    }
  </script>

</body>
</html>