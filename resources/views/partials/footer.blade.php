
<style>
 /* ── Contact form inputs ── */
    .cf-input {
      width: 100%;
      border: 1px solid #d1dae0;
      border-radius: 8px;
      padding: 10px 13px;
      font-size: 13px;
      font-family: 'DM Sans', sans-serif;
      background: #fff;
      color: #1a1a1a;
      outline: none;
      transition: border-color 0.18s, box-shadow 0.18s;
    }
    .cf-input::placeholder { color: #9ca3af; }
    .cf-input:focus { border-color: #2e7d32; box-shadow: 0 0 0 3px rgba(46,125,50,0.10); }
</style>




<div class="bg-white border-t border-[#e2eaed] mt-4">
    <div class="w-full px-10 py-8 flex items-start justify-between">

      <!-- Contact Us form -->
      {{--
        DROP-IN REPLACEMENT for the Contact Us block inside your footer.
        Replace your existing <div class="w-[280px] flex-shrink-0"> block with this.
      --}}

      <div class="w-[280px] flex-shrink-0">
        <h3 class="text-[17px] font-bold text-[#1a1a1a] mb-1">Contact Us</h3>
        <p class="text-[12.5px] text-[#6b7280] mb-4">We are always here to help you whenever you want.</p>

        {{-- Success message --}}
        <div id="cf-success" class="hidden mb-3 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold px-3 py-2.5 rounded-lg">
          <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
          Message sent! We'll get back to you soon.
        </div>

        {{-- Error summary --}}
        <div id="cf-errors" class="hidden mb-3 bg-red-50 border border-red-200 text-red-600 text-xs px-3 py-2.5 rounded-lg"></div>

        <div class="flex flex-col gap-3">
          <input id="cf-name"    type="text"  placeholder="Full Name"     class="cf-input"/>
          <input id="cf-email"   type="email" placeholder="Email Address" class="cf-input"/>
          <textarea id="cf-msg"  placeholder="Message" rows="3"
                    class="cf-input resize-none" style="height:80px;"></textarea>
        </div>

        <button id="cf-submit" onclick="submitContactForm()"
            class="mt-4 flex items-center gap-2 bg-[#1f5c24] hover:bg-[#174d1c]
                  text-white text-[13px] font-semibold px-5 py-2.5 rounded-lg
                  transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-60 disabled:cursor-not-allowed">
          <span id="cf-btn-text">Send</span>
          <span id="cf-spinner" class="hidden w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
          <svg id="cf-btn-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
          </svg>
        </button>
      </div>

      <script>
      function submitContactForm() {
        const name  = document.getElementById('cf-name').value.trim();
        const email = document.getElementById('cf-email').value.trim();
        const msg   = document.getElementById('cf-msg').value.trim();

        const errEl = document.getElementById('cf-errors');
        const sucEl = document.getElementById('cf-success');
        errEl.classList.add('hidden');
        sucEl.classList.add('hidden');

        // basic client-side validation
        const errs = [];
        if (!name)                      errs.push('Full name is required.');
        if (!email || !/\S+@\S+\.\S+/.test(email)) errs.push('A valid email is required.');
        if (!msg)                       errs.push('Message cannot be empty.');
        if (errs.length) {
          errEl.innerHTML = errs.join('<br>');
          errEl.classList.remove('hidden');
          return;
        }

        // show spinner
        const btn = document.getElementById('cf-submit');
        btn.disabled = true;
        document.getElementById('cf-btn-text').textContent = 'Sending…';
        document.getElementById('cf-spinner').classList.remove('hidden');
        document.getElementById('cf-btn-icon').classList.add('hidden');

       fetch("{{ route('contact.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type':     'application/json',
                'X-CSRF-TOKEN':     document.querySelector('meta[name=csrf-token]')?.content ?? '',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept':           'application/json',
            },
            body: JSON.stringify({ full_name: name, email, message: msg })
        })
        .then(async r => {
            const data = await r.json();
            if (!r.ok) throw data;
            return data;
        })
        .then(() => {
            document.getElementById('cf-name').value  = '';
            document.getElementById('cf-email').value = '';
            document.getElementById('cf-msg').value   = '';
            document.getElementById('cf-success').classList.remove('hidden');
        })
        .catch(err => {
            console.error('Contact form error:', err);          // check console
            const msgs = err?.errors
                ? Object.values(err.errors).flat()
                : [err?.message ?? 'Something went wrong. Please try again.'];
            const errEl = document.getElementById('cf-errors');
            errEl.innerHTML = msgs.join('<br>');
            errEl.classList.remove('hidden');
        })
        .finally(() => {
            const btn = document.getElementById('cf-submit');
            btn.disabled = false;
            document.getElementById('cf-btn-text').textContent = 'Send';
            document.getElementById('cf-spinner').classList.add('hidden');
            document.getElementById('cf-btn-icon').classList.remove('hidden');
        });
      }
      </script>

      <!-- Divider -->
      <div class="w-px bg-[#e2eaed] flex-shrink-0"></div>

      <!-- About Suitable Sow -->
      <div class="w-[58%] ml-auto">
        <!-- Brand row -->
        <div class="flex items-center gap-3 mb-3">
          <img src="{{asset('assets/icons/main_logo.png')}}" alt="Suitable Sow"
               class="w-[40px] h-[40px] object-contain rounded-lg"/>
          <div>
            <p class="text-[15px] font-bold text-[#1a1a1a] leading-tight">Suitable Sow</p>
            <p class="text-[11px] text-[#9ca3af]">sttable Ic.</p>
          </div>
        </div>

        <p class="text-[13px] text-[#4b5563] leading-relaxed mb-3">
          We are a smart agriculture platform dedicated to helping people grow plants more efficiently using modern technology. By combining AI-powered tools with expert knowledge, we make gardening easier for everyone—from beginners to professionals.
        </p>
        <p class="text-[13px] text-[#4b5563] leading-relaxed mb-5">
          Our goal is to simplify plant care, improve productivity, and promote sustainable growing practices. We believe that with the right guidance and tools, anyone can grow healthier plants and achieve better results.
        </p>

        <!-- Social icons -->
        <div class="flex items-center gap-3">
          <!-- Facebook -->
          <a href="#" class="w-9 h-9 rounded-full border border-[#d1dae0] flex items-center justify-center hover:border-[#2e7d32] hover:bg-[#edf7ee] transition-colors">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="#1877f2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <!-- YouTube -->
          <a href="#" class="w-9 h-9 rounded-full border border-[#d1dae0] flex items-center justify-center hover:border-[#2e7d32] hover:bg-[#edf7ee] transition-colors">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="#ff0000"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon fill="#fff" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
          </a>
          <!-- X / Twitter -->
          <a href="#" class="w-9 h-9 rounded-full border border-[#d1dae0] flex items-center justify-center hover:border-[#2e7d32] hover:bg-[#edf7ee] transition-colors">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#000"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <!-- Instagram -->
          <a href="#" class="w-9 h-9 rounded-full border border-[#d1dae0] flex items-center justify-center hover:border-[#2e7d32] hover:bg-[#edf7ee] transition-colors">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#e1306c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
            </svg>
          </a>
        </div>
        {{-- Support Button --}}
        <div class="mt-4">
            <a href="{{ route('support') }}"
              class="support-footer-btn inline-flex items-center gap-2 px-[18px] py-[9px]
                      rounded-[9px] border border-[#2e7d32] bg-white text-[#1f5c24]
                      text-[13px] font-medium transition-all duration-200
                      hover:-translate-y-0.5 hover:shadow-[0_4px_14px_rgba(31,92,36,.13)]
                      hover:bg-[#edf7ee] active:scale-[.97]">

                {{-- Live / online pulse dot --}}
                <span class="relative flex h-[7px] w-[7px]">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-[7px] w-[7px] bg-green-500"></span>
                </span>

                {{-- Info circle icon (matches your sidebar icon) --}}
                <svg class="w-[14px] h-[14px]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/>
                </svg>

                <span>Support</span>

                {{-- Arrow --}}
                <svg class="w-[11px] h-[11px] opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
      </div>

    </div>
  </div>