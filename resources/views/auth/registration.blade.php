<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Suitable Sow – Administrative Enrollment</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', sans-serif; background: #e9eef2; min-height: 100vh; display: flex; flex-direction: column; }

    /* Custom select arrow */
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
    }

    input::placeholder, select option[value=""] { color: #9ca3af; }
    select { color: #6b7280; }

    .input-field {
      width: 100%;
      border: 1px solid #d1dde3;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 13.5px;
      background: #f8fbfc;
      color: #1a1a1a;
      outline: none;
      transition: border-color 0.18s, box-shadow 0.18s;
      font-family: 'DM Sans', sans-serif;
    }
    .input-field:focus {
      border-color: #2e7d32;
      box-shadow: 0 0 0 3px rgba(46,125,50,0.10);
      background: #fff;
    }
    .input-error {
      border-color: #ef4444 !important;
      background: #fef2f2 !important;
    }

    .section-card {
      background: #edf3f6;
      border: 1px solid #d5e2e8;
      border-radius: 12px;
      padding: 18px 18px;
      margin-bottom: 16px;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 15px;
      font-weight: 700;
      color: #1a2e1a;
      padding-bottom: 10px;
      border-bottom: 1.5px solid #b8cdd5;
      margin-bottom: 16px;
    }

    label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 5px;
    }

    /* Left panel feature items */
    .feature-item {
      background: rgba(255,255,255,0.72);
      border-radius: 10px;
      padding: 10px 12px;
      display: flex;
      gap: 10px;
      align-items: flex-start;
    }
    .feature-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: #e8f5e9;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    /* Checkbox */
    input[type="checkbox"] {
      width: 15px;
      height: 15px;
      border: 1.5px solid #9ca3af;
      border-radius: 3px;
      cursor: pointer;
      accent-color: #2e7d32;
    }

    .btn-complete {
      background: #2e7d32;
      color: #fff;
      font-size: 13.5px;
      font-weight: 600;
      padding: 11px 24px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: background 0.18s, transform 0.12s;
      border: none;
      font-family: 'DM Sans', sans-serif;
    }
    .btn-complete:hover { background: #256427; transform: translateY(-1px); }
    .btn-complete:active { transform: translateY(0); }
  </style>
</head>

<body>

  <!-- ═══════════════════════════════════
       TOP HEADER / LOGO
  ═══════════════════════════════════ -->
  <header class="flex flex-col items-center pt-6 pb-4 bg-transparent">
    <img src="assets/icons/main_logo.png"
         alt="Suitable Sow Logo"
         class="w-[52px] h-[52px] object-contain mb-2"/>
    <p class="text-[#2e7d32] font-bold text-[16px] tracking-tight">Suitable Sow</p>
    <p class="text-[#5a6e6e] text-[10px] font-semibold tracking-[0.18em] uppercase mt-0.5">Agricultural Admin Portal</p>
  </header>

  <!-- ═══════════════════════════════════
       MAIN CONTENT
  ═══════════════════════════════════ -->
  <main class="flex-1 flex items-start justify-center px-4 pb-8">
    <div class="w-full max-w-[1140px] flex rounded-2xl overflow-hidden shadow-lg border border-[#d0dce2]"
         style="min-height: 560px;">

      <!-- ── LEFT PANEL ── -->
      <div class="relative w-[260px] flex-shrink-0 flex flex-col overflow-hidden"
           style="background: #c5d8d0;">

        <!-- Vertical background image -->
        <img src="assets/icons/signup_vertical_img.png"
             alt="Agricultural background"
             class="absolute inset-0 w-full h-full object-cover object-center"
             style="opacity: 0.55;"/>

        <!-- Content overlay -->
        <div class="relative z-10 flex flex-col h-full p-5">

          <!-- Panel heading -->
          <h2 class="text-[#0d1f0d] text-[18px] font-bold leading-tight mb-5">
            Cultivating Digital<br/>Precision
          </h2>

          <!-- Feature list -->
          <div class="flex flex-col gap-3">

            <!-- Growth Intelligence -->
            <div class="feature-item">
              <div class="feature-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                  <polyline points="16 7 22 7 22 13"/>
                </svg>
              </div>
              <div>
                <p class="text-[12.5px] font-bold text-[#1a2e1a] leading-tight">Growth Intelligence</p>
                <p class="text-[11px] text-[#3d5246] leading-snug mt-0.5">Real-time tracking of plant health and harvest projections.</p>
              </div>
            </div>

            <!-- Resource Efficiency -->
            <div class="feature-item">
              <div class="feature-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                  <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                  <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
              </div>
              <div>
                <p class="text-[12.5px] font-bold text-[#1a2e1a] leading-tight">Resource Efficiency</p>
                <p class="text-[11px] text-[#3d5246] leading-snug mt-0.5">Optimized supply planning and waste reduction protocols.</p>
              </div>
            </div>

            <!-- Team Synergy -->
            <div class="feature-item">
              <div class="feature-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <div>
                <p class="text-[12.5px] font-bold text-[#1a2e1a] leading-tight">Team Synergy</p>
                <p class="text-[11px] text-[#3d5246] leading-snug mt-0.5">Collaborative workflows for distributed agricultural units.</p>
              </div>
            </div>

          </div>

          <div class="flex-1"></div>

          <p class="text-[10.5px] italic text-[#2d4a38] font-medium leading-snug">
            "Systematic growth begins with structured data."
          </p>
        </div>
      </div>

      <!-- ── RIGHT PANEL (FORM CONTAINER) ── -->
      <div class="flex-1 bg-white flex flex-col">

        <!-- Form header -->
        <div class="flex items-center justify-between px-5 pt-6 pb-1">
          <h1 class="text-[20px] font-bold text-[#1a1a1a]">Administrative Enrollment</h1>
          <span class="text-[12px] text-[#6b7280] font-medium">Step 1 of 1</span>
        </div>

        <!-- Global error alert context placeholder if validation fails -->
        @if ($errors->any())
          <div class="mx-5 mt-2 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg">
            <strong>Please resolve the errors below before continuing.</strong>
          </div>
        @endif

        <!-- Form Element -->
         <form action="{{ route('register') }}" method="POST" class="flex-1 flex flex-col overflow-hidden">  {{-- <form action="{{ route('register') }}" --}}
          @csrf

          <!-- Scrollable form body -->
          <div class="flex-1 overflow-y-auto px-5 py-4">

            <!-- ── Row 1: Personal Info + Contact Info side by side ── -->
            <div class="flex gap-2 mb-2">

              <!-- Personal Info -->
              <div class="section-card mb-0" style="flex: 0.85;">
                <div class="section-title">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                  </svg>
                  Personal Info
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                  <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="e.g. Julian" class="input-field @error('first_name') input-error @enderror" required/>
                    @error('first_name') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                  </div>
                  <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="e.g. Vanda" class="input-field @error('last_name') input-error @enderror" required/>
                    @error('last_name') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div>
                  <label for="role">User Role</label>
                  <select id="role" name="role" class="input-field @error('role') input-error @enderror" required>
                    <option value="">Select User Role</option>
                    <option value="farmer" {{ old('role') == 'farmer' ? 'selected' : '' }}>farmer</option>
                    <option value="enthusiast" {{ old('role') == 'enthusiast' ? 'selected' : '' }}>enthusiast</option>
                  </select>
                  @error('role') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                </div>
              </div>

              <!-- Contact Info -->
              <div class="section-card mb-0" style="flex: 1.4;">
                <div class="section-title">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                  </svg>
                  Contact Info
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                  <div>
                    <label for="email">E-mail Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="julian@example.com" class="input-field @error('email') input-error @enderror" required/>
                    @error('email') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                  </div>
                  <div>
                    <label for="phone">Mobile Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+92 000-0000000" class="input-field @error('phone') input-error @enderror"/>
                    @error('phone') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                  <div>
                    <label for="password">Enter Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="input-field @error('password') input-error @enderror" required/>
                    @error('password') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                  </div>
                  <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="input-field" required/>
                  </div>
                </div>
              </div>

            </div><!-- /row 1 -->

            <!-- ── Row 2: Address full width ── -->
            <div class="section-card" style="margin-bottom: 12px;">
              <div class="section-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
                Address
              </div>

              <div class="grid grid-cols-3 gap-3 mb-3">
                <div>
                  <label for="country">Country</label>
                  <select id="country" name="country" class="input-field @error('country') input-error @enderror " required>
                    <option value="">Select Country</option>
                    <option value="us" {{ old('country') == 'us' ? 'selected' : '' }}>United States</option>
                    <option value="ca" {{ old('country') == 'ca' ? 'selected' : '' }}>Canada</option>
                    <option value="uk" {{ old('country') == 'uk' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="au" {{ old('country') == 'au' ? 'selected' : '' }}>Australia</option>
                  </select>
                  @error('country') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" value="{{ old('state') }}" placeholder="e.g. California" class="input-field @error('state') input-error @enderror" required/>
                  @error('state') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="e.g. Sacramento" class="input-field @error('city') input-error @enderror" required/>
                  @error('city') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
                </div>
              </div>

              <div>
                <label for="street_address">Street Address</label>
                <input type="text" id="street_address" name="street_address" value="{{ old('street_address') }}" placeholder="Street Address, Suite/Apt" class="input-field @error('street_address') input-error @enderror" required/>
                @error('street_address') <p class="text-red-500 text-[11px] mt-0.5">{{ $message }}</p> @enderror
              </div>
            </div>

            <!-- Terms checkbox -->
            <div class="flex items-center gap-2 mb-5">
              <input type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }} required/>
              <label for="terms" class="text-[12.5px] text-[#374151] font-normal cursor-pointer" style="margin:0;">
                I agree to the <span class="text-[#2e7d32] font-semibold cursor-pointer hover:underline">Terms &amp; Conditions</span>
              </label>
              @error('terms') <p class="text-red-500 text-[11px] ml-2">{{ $message }}</p> @enderror
            </div>

            <!-- Action row -->
            <div class="flex items-center justify-between pb-2">
               <a href="{{ route('login') }}" class="text-[13.5px] font-semibold text-[#2e7d32] hover:underline"> 
                Back to Login
              </a>
              <button type="submit" class="btn-complete">
                Complete Enrollment
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"/>
                  <polyline points="12 5 19 12 12 19"/>
                </svg>
              </button>
            </div>

          </div><!-- /form body -->
        </form>

      </div><!-- /right panel -->

    </div><!-- /main card -->
  </main>

  <!-- ═══════════════════════════════════
       FOOTER
  ═══════════════════════════════════ -->
  <footer class="flex items-center justify-between px-6 py-3 text-[11.5px] text-[#6b7280]">
    <span>© 2026 Suitable Sow. All rights reserved.</span>
    <div class="flex gap-5">
      <a href="#" class="hover:text-[#2e7d32] transition-colors">About us</a>
      <a href="#" class="hover:text-[#2e7d32] transition-colors">Contact Support</a>
      <a href="#" class="hover:text-[#2e7d32] transition-colors">Quick Links</a>
      <a href="#" class="hover:text-[#2e7d32] transition-colors">Privacy Policy</a>
    </div>
  </footer>

</body>
</html>