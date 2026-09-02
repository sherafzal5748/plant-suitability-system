
@php
    // Forces Laravel to spin up a fresh, valid CSRF token specifically for this page load
    session()->regenerateToken();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Suitable Sow – Log In</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', sans-serif; }

    /* ── Fade-up animation ── */
    @keyframes fade-up {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: fade-up 0.5s ease both; animation-delay: 0.05s; }
    .anim-2 { animation: fade-up 0.5s ease both; animation-delay: 0.15s; }
    .anim-3 { animation: fade-up 0.5s ease both; animation-delay: 0.25s; }
    .anim-4 { animation: fade-up 0.5s ease both; animation-delay: 0.35s; }
    .anim-5 { animation: fade-up 0.5s ease both; animation-delay: 0.45s; }
    .anim-6 { animation: fade-up 0.5s ease both; animation-delay: 0.55s; }
    .anim-7 { animation: fade-up 0.5s ease both; animation-delay: 0.65s; }

    /* ── Input styling ── */
    .input-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      border: 1.5px solid #d1dae0;
      border-radius: 10px;
      padding: 11px 14px;
      background: #fff;
      transition: border-color 0.18s, box-shadow 0.18s;
    }
    .input-wrap:focus-within {
      border-color: #2e7d32;
      box-shadow: 0 0 0 3px rgba(46,125,50,0.10);
    }
    .input-wrap input {
      flex: 1;
      border: none;
      outline: none;
      font-size: 14px;
      color: #1a1a1a;
      background: transparent;
      font-family: 'DM Sans', sans-serif;
    }
    .input-wrap input::placeholder { color: #9ca3af; }

    /* ── Login button ── */
    .btn-login {
      width: 100%;
      background: #1f5c24;
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      padding: 13px 24px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      border: none;
      font-family: 'DM Sans', sans-serif;
      transition: background 0.18s, transform 0.12s;
      letter-spacing: 0.01em;
    }
    .btn-login:hover  { background: #174d1c; transform: translateY(-1px); }
    .btn-login:active { transform: translateY(0); }

    /* ── Dark mode toggle ── */
    .dark-toggle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #f0f4f6;
      border: 1px solid #d8e2e6;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.18s;
    }
    .dark-toggle:hover { background: #e2eaed; }

    /* ── Checkbox ── */
    input[type="checkbox"] {
      width: 16px;
      height: 16px;
      border: 1.5px solid #9ca3af;
      border-radius: 4px;
      cursor: pointer;
      accent-color: #2e7d32;
      flex-shrink: 0;
    }

    /* ── Left panel feature cards ── */
    .feature-card {
      background: rgba(0,0,0,0.38);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 12px;
      padding: 14px 16px;
    }
  </style>
</head>

<body class="min-h-screen flex bg-[#f0f5f7]">

  <!-- ═══════════════════════════════════════
       LEFT PANEL — full-height image + overlay
  ═══════════════════════════════════════ -->
  <div class="relative w-[48%] flex-shrink-0 flex flex-col overflow-hidden"
       style="min-height: 100vh;">

    <!-- Background vertical image -->
    <img src="{{ asset('assets/icons/signup_vertical_img.png') }}"
         alt="Agricultural field"
         class="absolute inset-0 w-full h-full object-cover object-center"/>

    <!-- Dark gradient overlay — heavier at bottom for text legibility -->
    <div class="absolute inset-0"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.10) 40%, rgba(0,0,0,0.55) 70%, rgba(0,0,0,0.72) 100%);"></div>

    <!-- Content on top of image -->
    <div class="relative z-10 flex flex-col h-full p-7">

      <!-- Top-left logo + brand -->
      <div class="flex items-center gap-3">
        <img src="{{ asset('assets/icons/main_logo.png') }}"
             alt="Suitable Sow"
             class="w-[38px] h-[38px] object-contain rounded-lg"/>
        <span class="text-white text-[17px] font-bold tracking-tight">Suitable Sow</span>
      </div>

      <!-- Spacer pushes feature cards to bottom -->
      <div class="flex-1"></div>

      <!-- Feature cards at bottom -->
      <div class="flex flex-col gap-3 pb-2">

        <!-- Growth Intelligence -->
        <div class="feature-card">
          <div class="flex items-center gap-2 mb-1.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6fcf7a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
              <polyline points="16 7 22 7 22 13"/>
            </svg>
            <p class="text-white text-[11px] font-bold tracking-[0.12em] uppercase">Growth Intelligence</p>
          </div>
          <p class="text-[#c8dcc8] text-[11.5px] leading-snug">
            Real-time data modeling for optimized crop yield and soil health monitoring using advanced drone optics.
          </p>
        </div>

        <!-- Resource Efficiency -->
        <div class="feature-card">
          <div class="flex items-center gap-2 mb-1.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6fcf7a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
              <path d="M12 6v6l4 2"/>
            </svg>
            <p class="text-white text-[11px] font-bold tracking-[0.12em] uppercase">Resource Efficiency</p>
          </div>
          <p class="text-[#c8dcc8] text-[11.5px] leading-snug">
            Precision irrigation and nutrient delivery systems designed to minimize waste and maximize sustainability.
          </p>
        </div>

        <!-- Team Synergy -->
        <div class="feature-card">
          <div class="flex items-center gap-2 mb-1.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6fcf7a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <p class="text-white text-[11px] font-bold tracking-[0.12em] uppercase">Team Synergy</p>
          </div>
          <p class="text-[#c8dcc8] text-[11.5px] leading-snug">
            Centralized administrative control for managing agricultural personnel across multiple geographic map regions.
          </p>
        </div>

      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════
       RIGHT PANEL — login form
  ═══════════════════════════════════════ -->
  <div class="flex-1 flex flex-col bg-[#f0f5f7] relative">

   

    <!-- Vertically + horizontally centred form -->
    <div class="flex-1 flex items-center justify-center px-10">
      <div class="w-full max-w-[380px]">
          @if (session('success'))
              <div class="p-3 mb-4 text-xs text-green-700 bg-green-50 border border-green-200 rounded-lg">
                  {{ session('success') }}
              </div>
          @endif

          @if (session('error'))
              <div class="p-3 mb-4 text-xs text-red-700 bg-red-50 border border-red-200 rounded-lg">
                  {{ session('error') }}
              </div>
          @endif

        <!-- Heading -->
        <h1 class="anim-1 text-[#0f1e0f] text-[32px] font-bold leading-tight text-center mb-2"
            style="font-family: 'DM Serif Display', serif;">
          Log In to Your Account
        </h1>
        <p class="anim-2 text-[#6b8080] text-[13.5px] text-center mb-8">
          Access the Suitable Sow administrative dashboard
        </p>

        <!-- Backend Form Start -->
         <form method="POST" action="{{ route('login') }}"> 
          @csrf

          <!-- Email Address -->
          <div class="anim-3 mb-4">
            <label for="email" class="block text-[12.5px] font-semibold text-[#374151] mb-1.5">Email Address</label>
            <div class="input-wrap @error('email') border-red-500 focus-within:border-red-500 focus-within:box-shadow-[0_0_0_3px_rgba(239,68,68,0.1)] @enderror">
              <!-- Envelope icon -->
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="admin@suitablesow.com"/>
            </div>
            @error('email')
                <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
            @enderror
          </div>

          <!-- Password -->
          <div class="anim-4 mb-5">
            <div class="flex items-center justify-between mb-1.5">
              <label for="passwordInput" class="text-[12.5px] font-semibold text-[#374151]">Password</label>
              <a href="{{ route('forgot_password') }}" class="text-[12.5px] font-semibold text-[#2e7d32] hover:underline">Forgot Password?</a>
            </div>
            <div class="input-wrap @error('password') border-red-500 focus-within:border-red-500 focus-within:box-shadow-[0_0_0_3px_rgba(239,68,68,0.1)] @enderror">
              <!-- Lock icon -->
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <input type="password" id="passwordInput" name="password" required autocomplete="current-password" placeholder="••••••••••••"/>
              <!-- Eye toggle -->
              <button type="button" onclick="togglePassword()" class="flex-shrink-0 focus:outline-none" aria-label="Toggle password visibility">
                <svg id="eyeIcon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
            @error('password')
                <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
            @enderror
          </div>

          <!-- Remember me -->
          <div class="anim-5 flex items-center gap-2.5 mb-6">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}/>
            <label for="remember" class="text-[13px] text-[#4b5563] cursor-pointer" style="margin:0; font-weight:400;">
              Remember me 
            </label>
          </div>

          <!-- Login button -->
          <button type="submit" class="anim-6 btn-login mb-5">
            Log In
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"/>
              <polyline points="12 5 19 12 12 19"/>
            </svg>
          </button>
        </form>
        <!-- Backend Form End -->

        <!-- Sign up link -->
        <p class="anim-6 text-center text-[13px] text-[#6b7280] mb-8">
          Don't have an account?
          <a href="{{ route('register') }}" class="text-[#2e7d32] font-bold hover:underline ml-1">Sign Up Now</a>
        </p>

        <!-- Secure badge -->
        <div class="anim-7 flex items-center justify-center gap-1.5">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          <span class="text-[12px] text-[#9ca3af]">Secure, encrypted connection</span>
        </div>

      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('passwordInput');
      const icon  = document.getElementById('eyeIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
          <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
          <line x1="1" y1="1" x2="23" y2="23"/>`;
      } else {
        input.type = 'password';
        icon.innerHTML = `
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>`;
      }
    }
  </script>

</body>
</html>