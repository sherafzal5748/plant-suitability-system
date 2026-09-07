<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Suitable Sow – Administrative Enrollment</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- Choices.js: only used to make the Country dropdown searchable/typeable -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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

    /* Choices.js visual overrides so the Country dropdown matches .input-field styling */
    #country.choices { margin-bottom: 0; }
    #country.choices .choices__inner {
      border: 1px solid #d1dde3 !important;
      border-radius: 8px !important;
      padding: 6px 14px !important;
      min-height: unset !important;
      background: #f8fbfc !important;
      font-size: 13.5px !important;
      font-family: 'DM Sans', sans-serif !important;
    }
    #country.choices.is-focused .choices__inner {
      border-color: #2e7d32 !important;
      box-shadow: 0 0 0 3px rgba(46,125,50,0.10);
      background: #fff !important;
    }
    #country.choices .choices__list--dropdown {
      border-color: #d1dde3 !important;
      font-size: 13.5px !important;
      font-family: 'DM Sans', sans-serif !important;
      z-index: 30 !important;
    }
    #country.choices .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background-color: #e8f5e9 !important;
    }
    #country.choices[data-type*="select-one"] .choices__input {
      background: #fff !important;
      font-size: 13.5px !important;
    }
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
          <span class="text-[12px] text-[#6b7280] font-medium"></span>
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
                  <select id="country" name="country" data-old="{{ old('country') }}" class="input-field @error('country') input-error @enderror " required>
                    <option value="">Select Country</option>
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

  <!-- Populates the Country dropdown with all countries + makes it searchable/typeable.
       Country list is embedded directly here — no external file to link or fetch.
       State and City remain plain text inputs, unchanged. -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Full list of countries (ISO2 code = value, full name = label).
      // Value stays a 2-letter code (e.g. "pk", "us") so it matches the
      // original us/ca/uk/au scheme and needs no controller changes.
      var ALL_COUNTRIES = [{"value":"af","label":"Afghanistan"},{"value":"al","label":"Albania"},{"value":"dz","label":"Algeria"},{"value":"as","label":"American Samoa"},{"value":"ad","label":"Andorra"},{"value":"ao","label":"Angola"},{"value":"ai","label":"Anguilla"},{"value":"aq","label":"Antarctica"},{"value":"ag","label":"Antigua and Barbuda"},{"value":"ar","label":"Argentina"},{"value":"am","label":"Armenia"},{"value":"aw","label":"Aruba"},{"value":"au","label":"Australia"},{"value":"at","label":"Austria"},{"value":"az","label":"Azerbaijan"},{"value":"bs","label":"Bahamas"},{"value":"bh","label":"Bahrain"},{"value":"bd","label":"Bangladesh"},{"value":"bb","label":"Barbados"},{"value":"by","label":"Belarus"},{"value":"be","label":"Belgium"},{"value":"bz","label":"Belize"},{"value":"bj","label":"Benin"},{"value":"bm","label":"Bermuda"},{"value":"bt","label":"Bhutan"},{"value":"bo","label":"Bolivia, Plurinational State of"},{"value":"bq","label":"Bonaire, Sint Eustatius and Saba"},{"value":"ba","label":"Bosnia and Herzegovina"},{"value":"bw","label":"Botswana"},{"value":"bv","label":"Bouvet Island"},{"value":"br","label":"Brazil"},{"value":"io","label":"British Indian Ocean Territory"},{"value":"bn","label":"Brunei Darussalam"},{"value":"bg","label":"Bulgaria"},{"value":"bf","label":"Burkina Faso"},{"value":"bi","label":"Burundi"},{"value":"cv","label":"Cabo Verde"},{"value":"kh","label":"Cambodia"},{"value":"cm","label":"Cameroon"},{"value":"ca","label":"Canada"},{"value":"ky","label":"Cayman Islands"},{"value":"cf","label":"Central African Republic"},{"value":"td","label":"Chad"},{"value":"cl","label":"Chile"},{"value":"cn","label":"China"},{"value":"cx","label":"Christmas Island"},{"value":"cc","label":"Cocos (Keeling) Islands"},{"value":"co","label":"Colombia"},{"value":"km","label":"Comoros"},{"value":"cg","label":"Congo"},{"value":"cd","label":"Congo, The Democratic Republic of the"},{"value":"ck","label":"Cook Islands"},{"value":"cr","label":"Costa Rica"},{"value":"hr","label":"Croatia"},{"value":"cu","label":"Cuba"},{"value":"cw","label":"Curaçao"},{"value":"cy","label":"Cyprus"},{"value":"cz","label":"Czechia"},{"value":"ci","label":"Côte d'Ivoire"},{"value":"dk","label":"Denmark"},{"value":"dj","label":"Djibouti"},{"value":"dm","label":"Dominica"},{"value":"do","label":"Dominican Republic"},{"value":"ec","label":"Ecuador"},{"value":"eg","label":"Egypt"},{"value":"sv","label":"El Salvador"},{"value":"gq","label":"Equatorial Guinea"},{"value":"er","label":"Eritrea"},{"value":"ee","label":"Estonia"},{"value":"sz","label":"Eswatini"},{"value":"et","label":"Ethiopia"},{"value":"fk","label":"Falkland Islands (Malvinas)"},{"value":"fo","label":"Faroe Islands"},{"value":"fj","label":"Fiji"},{"value":"fi","label":"Finland"},{"value":"fr","label":"France"},{"value":"gf","label":"French Guiana"},{"value":"pf","label":"French Polynesia"},{"value":"tf","label":"French Southern Territories"},{"value":"ga","label":"Gabon"},{"value":"gm","label":"Gambia"},{"value":"ge","label":"Georgia"},{"value":"de","label":"Germany"},{"value":"gh","label":"Ghana"},{"value":"gi","label":"Gibraltar"},{"value":"gr","label":"Greece"},{"value":"gl","label":"Greenland"},{"value":"gd","label":"Grenada"},{"value":"gp","label":"Guadeloupe"},{"value":"gu","label":"Guam"},{"value":"gt","label":"Guatemala"},{"value":"gg","label":"Guernsey"},{"value":"gn","label":"Guinea"},{"value":"gw","label":"Guinea-Bissau"},{"value":"gy","label":"Guyana"},{"value":"ht","label":"Haiti"},{"value":"hm","label":"Heard Island and McDonald Islands"},{"value":"va","label":"Holy See (Vatican City State)"},{"value":"hn","label":"Honduras"},{"value":"hk","label":"Hong Kong"},{"value":"hu","label":"Hungary"},{"value":"is","label":"Iceland"},{"value":"in","label":"India"},{"value":"id","label":"Indonesia"},{"value":"ir","label":"Iran, Islamic Republic of"},{"value":"iq","label":"Iraq"},{"value":"ie","label":"Ireland"},{"value":"im","label":"Isle of Man"},{"value":"il","label":"Israel"},{"value":"it","label":"Italy"},{"value":"jm","label":"Jamaica"},{"value":"jp","label":"Japan"},{"value":"je","label":"Jersey"},{"value":"jo","label":"Jordan"},{"value":"kz","label":"Kazakhstan"},{"value":"ke","label":"Kenya"},{"value":"ki","label":"Kiribati"},{"value":"kp","label":"Korea, Democratic People's Republic of"},{"value":"kr","label":"Korea, Republic of"},{"value":"kw","label":"Kuwait"},{"value":"kg","label":"Kyrgyzstan"},{"value":"la","label":"Lao People's Democratic Republic"},{"value":"lv","label":"Latvia"},{"value":"lb","label":"Lebanon"},{"value":"ls","label":"Lesotho"},{"value":"lr","label":"Liberia"},{"value":"ly","label":"Libya"},{"value":"li","label":"Liechtenstein"},{"value":"lt","label":"Lithuania"},{"value":"lu","label":"Luxembourg"},{"value":"mo","label":"Macao"},{"value":"mg","label":"Madagascar"},{"value":"mw","label":"Malawi"},{"value":"my","label":"Malaysia"},{"value":"mv","label":"Maldives"},{"value":"ml","label":"Mali"},{"value":"mt","label":"Malta"},{"value":"mh","label":"Marshall Islands"},{"value":"mq","label":"Martinique"},{"value":"mr","label":"Mauritania"},{"value":"mu","label":"Mauritius"},{"value":"yt","label":"Mayotte"},{"value":"mx","label":"Mexico"},{"value":"fm","label":"Micronesia, Federated States of"},{"value":"md","label":"Moldova, Republic of"},{"value":"mc","label":"Monaco"},{"value":"mn","label":"Mongolia"},{"value":"me","label":"Montenegro"},{"value":"ms","label":"Montserrat"},{"value":"ma","label":"Morocco"},{"value":"mz","label":"Mozambique"},{"value":"mm","label":"Myanmar"},{"value":"na","label":"Namibia"},{"value":"nr","label":"Nauru"},{"value":"np","label":"Nepal"},{"value":"nl","label":"Netherlands"},{"value":"nc","label":"New Caledonia"},{"value":"nz","label":"New Zealand"},{"value":"ni","label":"Nicaragua"},{"value":"ne","label":"Niger"},{"value":"ng","label":"Nigeria"},{"value":"nu","label":"Niue"},{"value":"nf","label":"Norfolk Island"},{"value":"mk","label":"North Macedonia"},{"value":"mp","label":"Northern Mariana Islands"},{"value":"no","label":"Norway"},{"value":"om","label":"Oman"},{"value":"pk","label":"Pakistan"},{"value":"pw","label":"Palau"},{"value":"ps","label":"Palestine, State of"},{"value":"pa","label":"Panama"},{"value":"pg","label":"Papua New Guinea"},{"value":"py","label":"Paraguay"},{"value":"pe","label":"Peru"},{"value":"ph","label":"Philippines"},{"value":"pn","label":"Pitcairn"},{"value":"pl","label":"Poland"},{"value":"pt","label":"Portugal"},{"value":"pr","label":"Puerto Rico"},{"value":"qa","label":"Qatar"},{"value":"ro","label":"Romania"},{"value":"ru","label":"Russian Federation"},{"value":"rw","label":"Rwanda"},{"value":"re","label":"Réunion"},{"value":"bl","label":"Saint Barthélemy"},{"value":"sh","label":"Saint Helena, Ascension and Tristan da Cunha"},{"value":"kn","label":"Saint Kitts and Nevis"},{"value":"lc","label":"Saint Lucia"},{"value":"mf","label":"Saint Martin (French part)"},{"value":"pm","label":"Saint Pierre and Miquelon"},{"value":"vc","label":"Saint Vincent and the Grenadines"},{"value":"ws","label":"Samoa"},{"value":"sm","label":"San Marino"},{"value":"st","label":"Sao Tome and Principe"},{"value":"sa","label":"Saudi Arabia"},{"value":"sn","label":"Senegal"},{"value":"rs","label":"Serbia"},{"value":"sc","label":"Seychelles"},{"value":"sl","label":"Sierra Leone"},{"value":"sg","label":"Singapore"},{"value":"sx","label":"Sint Maarten (Dutch part)"},{"value":"sk","label":"Slovakia"},{"value":"si","label":"Slovenia"},{"value":"sb","label":"Solomon Islands"},{"value":"so","label":"Somalia"},{"value":"za","label":"South Africa"},{"value":"gs","label":"South Georgia and the South Sandwich Islands"},{"value":"ss","label":"South Sudan"},{"value":"es","label":"Spain"},{"value":"lk","label":"Sri Lanka"},{"value":"sd","label":"Sudan"},{"value":"sr","label":"Suriname"},{"value":"sj","label":"Svalbard and Jan Mayen"},{"value":"se","label":"Sweden"},{"value":"ch","label":"Switzerland"},{"value":"sy","label":"Syrian Arab Republic"},{"value":"tw","label":"Taiwan, Province of China"},{"value":"tj","label":"Tajikistan"},{"value":"tz","label":"Tanzania, United Republic of"},{"value":"th","label":"Thailand"},{"value":"tl","label":"Timor-Leste"},{"value":"tg","label":"Togo"},{"value":"tk","label":"Tokelau"},{"value":"to","label":"Tonga"},{"value":"tt","label":"Trinidad and Tobago"},{"value":"tn","label":"Tunisia"},{"value":"tm","label":"Turkmenistan"},{"value":"tc","label":"Turks and Caicos Islands"},{"value":"tv","label":"Tuvalu"},{"value":"tr","label":"Türkiye"},{"value":"ug","label":"Uganda"},{"value":"ua","label":"Ukraine"},{"value":"ae","label":"United Arab Emirates"},{"value":"gb","label":"United Kingdom"},{"value":"us","label":"United States"},{"value":"um","label":"United States Minor Outlying Islands"},{"value":"uy","label":"Uruguay"},{"value":"uz","label":"Uzbekistan"},{"value":"vu","label":"Vanuatu"},{"value":"ve","label":"Venezuela, Bolivarian Republic of"},{"value":"vn","label":"Viet Nam"},{"value":"vg","label":"Virgin Islands, British"},{"value":"vi","label":"Virgin Islands, U.S."},{"value":"wf","label":"Wallis and Futuna"},{"value":"eh","label":"Western Sahara"},{"value":"ye","label":"Yemen"},{"value":"zm","label":"Zambia"},{"value":"zw","label":"Zimbabwe"},{"value":"ax","label":"Åland Islands"}];

      var countrySelectEl = document.getElementById('country');
      var oldCountry = (countrySelectEl.dataset.old || '').toLowerCase();

      var countryChoices = new Choices(countrySelectEl, {
        searchEnabled: true,
        itemSelectText: '',
        shouldSort: false,
        placeholder: true,
        placeholderValue: 'Select or type a country',
        searchPlaceholderValue: 'Search country...',
      });

      countryChoices.setChoices(ALL_COUNTRIES, 'value', 'label', true);

      if (oldCountry) {
        countryChoices.setChoiceByValue(oldCountry);
      }
    });
  </script>

</body>
</html>