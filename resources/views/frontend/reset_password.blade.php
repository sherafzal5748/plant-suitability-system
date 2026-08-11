<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  <title>Reset Password – SuitableSOW</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'DM Sans', sans-serif; background-color: #e8f0f7; }

    /* ── Card animation ── */
    .card-enter {
      animation: cardIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    @keyframes cardIn {
      from { opacity: 0; transform: translateY(18px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── Input focus ── */
    .pw-input:focus {
      outline: none;
      border-color: #16a34a;
      box-shadow: 0 0 0 3px rgba(22,163,74,0.13);
    }

    /* ── Reset button ── */
    .btn-reset {
      transition: background-color 0.15s ease, transform 0.15s ease, box-shadow 0.15s ease;
    }
    .btn-reset:hover {
      background-color: #15803d;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(21,128,61,0.35);
    }
    .btn-reset:active { transform: translateY(0); box-shadow: none; }

    /* ── Requirement item ── */
    .req-item { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #6b7280; }
    .req-dot {
      width: 14px; height: 14px; border-radius: 50%;
      border: 1.5px solid #d1d5db;
      background: white;
      flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      transition: all 0.2s ease;
    }
    .req-dot.met {
      border-color: #16a34a;
      background: #16a34a;
    }
    .req-dot.met::after {
      content: '';
      width: 5px; height: 3px;
      border-left: 1.5px solid white;
      border-bottom: 1.5px solid white;
      transform: rotate(-45deg) translateY(-1px);
      display: block;
    }
    .req-item.met { color: #15803d; }

    /* ── Bottom info panel ── */
    .info-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .info-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- ── MAIN CONTENT ── -->
  <main class="flex-1 flex flex-col items-center px-4 pt-12 pb-0">

    <!-- ── RESET CARD ── -->
    <div class="card-enter bg-white rounded-2xl shadow-lg w-full max-w-md px-10 py-9 flex flex-col items-center mb-12">

      <!-- Icon -->
      <div class="mb-4">
        <div class="w-12 h-12 rounded-full border-2 border-green-600 bg-white flex items-center justify-center">
          <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
          </svg>
        </div>
      </div>

      <!-- Title & sub-copy -->
      <h1 class="text-[20px] font-bold text-gray-900 mb-1.5 text-center">Reset Password</h1>
      <p class="text-[13px] text-gray-500 text-center leading-relaxed mb-6 max-w-[260px]">
        Enter a secure new password for your Suitable Sow administrator account.
      </p>
    
      <!-- Form fields -->
      <div class="w-full flex flex-col gap-4">
        <form action="{{ route('password_update') }}" method="POST">
        @csrf
        @method('PUT')
        {{-- This block displays the error if passwords don't match or fail validation --}}
        @error('password')
          <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 text-sm rounded-xl text-center">
            {{ $message }}
          </div>
        @enderror

          <!-- New Password -->
          <div class="flex flex-col gap-1">
            <div class="flex items-center gap-1.5">
              <label class="text-[12px] font-semibold text-gray-700">New Password</label>
              <!-- Info icon -->
              <svg class="w-3.5 h-3.5 text-gray-400" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
              </svg>
            </div>
            <div class="relative">
              <input id="new-pw" type="password" placeholder="••••••••" name="password" required
                class="pw-input w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-white transition-all pr-10" />
              <button type="button" onclick="togglePw('new-pw',this)"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
            <p class="text-[11px] text-gray-400 mt-0.5">Minimum 8 characters with at least one number.</p>
          </div>

          <!-- Confirm New Password -->
          <div class="flex flex-col gap-1">
            <label class="text-[12px] font-semibold text-gray-700">Confirm New Password</label>
            <div class="relative">
              <input id="confirm-pw" type="password" placeholder="••••••••" name="password_confirmation" required
                class="pw-input w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-white transition-all pr-10" />
              <button type="button" onclick="togglePw('confirm-pw',this)"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Reset Button -->
          <button type="submit"
            class="btn-reset mt-1 w-full bg-green-700 text-white text-sm font-semibold py-3 rounded-lg flex items-center justify-center gap-2 shadow">
            Reset Password
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"/>
              <polyline points="12 5 19 12 12 19"/>
            </svg>
          </button>
        </form>

        <!-- Back to Login -->
        <a href="{{ route('login') }}" class="text-center text-[13px] text-green-700 hover:text-green-800 font-medium transition-colors mt-0.5">
          Back to Login
        </a>

        <!-- Divider below Back to Login -->
        <hr class="border-gray-200 mt-2" />

        <!-- Security Requirements -->
        <div class="flex flex-col gap-2 pt-1">
          <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-1">Security Requirements</p>

          <div class="req-item met" id="req-length">
            <div class="req-dot met"></div>
            At least 8 characters long
          </div>
          <div class="req-item" id="req-mix">
            <div class="req-dot"></div>
            Mix of letters and numbers
          </div>
          <div class="req-item" id="req-match">
            <div class="req-dot"></div>
            Passwords must match
          </div>
        </div>

      </div>
    </div>

    <!-- ── BOTTOM THREE-PANEL INFO BAR ── -->
    <div class="w-full max-w-3xl grid grid-cols-3 gap-4 pb-10 px-2">

      <!-- Panel 1 – Text info -->
      <div class="info-card bg-green-50 rounded-xl p-5 flex flex-col justify-between shadow-sm">
        <div>
          <h3 class="text-[13px] font-bold text-gray-800 mb-2 leading-snug">Securing your Agricultural Data</h3>
          <p class="text-[11.5px] text-gray-500 leading-relaxed">
            Our multi-factor authentication and strict password policies ensure that your regional suitability maps remain confidential and precise.
          </p>
        </div>
      </div>

      <!-- Panel 2 – Plant image -->
      <div class="info-card rounded-xl overflow-hidden shadow-sm bg-gray-200 min-h-[120px] relative">
        <img src="assets/images/other_images/passwor_rest_page_img.png"
             alt="Plant growth"
             class="w-full h-full object-cover absolute inset-0" />
        <!-- Fallback gradient shown when image missing -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-200 via-green-300 to-green-500 flex items-end justify-center pb-4 img-fallback">
          <svg class="w-16 h-16 text-green-700 opacity-60" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22V12"/>
            <path d="M12 12C12 12 7 9 7 5a5 5 0 0 1 10 0c0 4-5 7-5 7z"/>
            <path d="M12 17c0 0-4-1-5-4"/>
            <path d="M12 19c0 0 4-1 5-4"/>
          </svg>
        </div>
      </div>

      <!-- Panel 3 – Need help -->
      <div class="info-card bg-white rounded-xl p-5 flex items-start gap-3 shadow-sm border border-gray-100">
        <div class="w-9 h-9 rounded-full bg-green-400 flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">
          <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
        </div>
        <div>
          <p class="text-[13px] font-bold text-gray-800 mb-0.5">Need help?</p>
          <p class="text-[12px] text-gray-500">Contact System Administrator</p>
        </div>
      </div>

    </div>
  </main>

  <script>
    // Toggle password visibility
    function togglePw(id, btn) {
      const input = document.getElementById(id);
      const show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      btn.innerHTML = show
        ? `<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`
        : `<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
    }

    // Hide fallback div once real image loads
    document.querySelectorAll('.info-card img').forEach(img => {
      img.addEventListener('load', () => {
        const fb = img.nextElementSibling;
        if (fb && fb.classList.contains('img-fallback')) fb.style.display = 'none';
      });
      img.addEventListener('error', () => { /* fallback stays visible */ });
    });

    // Live security requirement checks
    const newPw    = document.getElementById('new-pw');
    const confirmPw = document.getElementById('confirm-pw');

    function updateReqs() {
      const val  = newPw.value;
      const conf = confirmPw.value;
      setReq('req-length', val.length >= 8);
      setReq('req-mix',    /[a-zA-Z]/.test(val) && /[0-9]/.test(val));
      setReq('req-match',  val.length > 0 && val === conf);
    }

    function setReq(id, met) {
      const el  = document.getElementById(id);
      const dot = el.querySelector('.req-dot');
      el.classList.toggle('met', met);
      dot.classList.toggle('met', met);
    }

    newPw.addEventListener('input', updateReqs);
    confirmPw.addEventListener('input', updateReqs);
  </script>
</body>
</html>