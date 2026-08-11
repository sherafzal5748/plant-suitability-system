<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Identity</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-100 min-h-screen flex items-center justify-center p-6">

  <div class="relative w-full max-w-sm">
    {{-- Resend status message --}}
    @if (session('status'))
      <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 text-sm rounded-xl text-center">
        {{ session('status') }}
      </div>
    @endif
    {{-- code mismatch message --}}
     @error('status')
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 text-sm rounded-xl text-center">
          {{ $message }}
        </div>
      @enderror
    <!-- Card -->
    <div class="bg-white rounded-2xl border border-slate-200 px-8 pt-8 pb-6 text-center">
      
      <!-- Shield Icon -->
      <div class="flex justify-center mb-4">
        <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
        </div>
      </div>

      <!-- Title -->
      <h1 class="text-lg font-bold text-gray-900 mb-2">Verify Your Identity</h1>

      <!-- Description -->
      <p class="text-sm text-gray-500 leading-relaxed mb-6">
        Please enter the 4-digit verification code sent to your<br>
        registered email address (<span class="text-gray-700">a***@example.com</span>)
      </p>
      <form action="{{ route('fourdigitcode') }}" method="POST">
        @csrf
        <!-- OTP Inputs -->
        <div class="flex justify-center gap-3 mb-4" id="otp-inputs">
          <input name="digit1" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
            class="w-14 h-14 text-center text-xl font-semibold text-gray-800 bg-blue-50 border border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400"
            onkeydown="blockNonDigit(event)" oninput="moveNext(this, 0)" autofocus>
          <input name="digit2" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
            class="w-14 h-14 text-center text-xl font-semibold text-gray-800 bg-blue-50 border border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400"
            onkeydown="blockNonDigit(event)" oninput="moveNext(this, 1)">
          <input name="digit3" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
            class="w-14 h-14 text-center text-xl font-semibold text-gray-800 bg-blue-50 border border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400"
            onkeydown="blockNonDigit(event)" oninput="moveNext(this, 2)">
          <input name="digit4" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
            class="w-14 h-14 text-center text-xl font-semibold text-gray-800 bg-blue-50 border border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400"
            onkeydown="blockNonDigit(event)" oninput="moveNext(this, 3)">
        </div>

        <!-- Resend Code -->
        <a href="{{ route('resendCode') }}">
        <p class="text-sm text-green-600 font-medium mb-5 cursor-pointer hover:text-green-700">Resend Code</p>
        </a>
      
        <!-- Verify Button -->
        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold text-sm py-3.5 rounded-xl transition-colors duration-150 mb-4">
          Verify & Continue
        </button>
    
      </form>

      <!-- Back to Login -->
      <a href="{{ route('login') }}">
      <p class="text-sm text-gray-600 font-medium cursor-pointer hover:text-gray-800 mb-5">Back to Login</p>
      </a>

      <!-- Divider -->
      <hr class="border-slate-200 mb-4">

      <!-- Footer -->
      <p class="text-xs text-gray-400">
        🔒 secure 256-bit encrypted authentication
      </p>

    </div>

    <!-- Decorative plant icon bottom-right -->
    <div class="absolute -bottom-10 -right-10 opacity-20">
      <svg class="w-24 h-24 text-green-400" fill="currentColor" viewBox="0 0 64 64">
        <rect x="24" y="44" width="16" height="14" rx="2"/>
        <rect x="20" y="38" width="24" height="10" rx="3"/>
        <path d="M32 38 C32 28 20 22 20 22 C20 22 20 34 32 38Z"/>
        <path d="M32 38 C32 28 44 22 44 22 C44 22 44 34 32 38Z"/>
        <path d="M32 30 C32 20 26 14 26 14 C26 14 24 26 32 30Z"/>
      </svg>
    </div>

  </div>

  <script>
     const inputs = document.querySelectorAll('#otp-inputs input');

  function blockNonDigit(e) { //blockNonDigit runs on keydown — blocks the keystroke before it reaches the input, so letters never appear
    // Allow: backspace, delete, tab, arrows
    const allowed = ['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'];
    if (allowed.includes(e.key)) return;

    // Block anything that isn't a digit
    if (!/^[0-9]$/.test(e.key)) {
      e.preventDefault();
    }
  }

  function moveNext(el, index) { //oninput still strips non-digits as a second defense (covers mobile paste), Backspace, Delete, Tab, and arrow keys are whitelisted so navigation still works
    // Strip non-digits just in case (e.g. mobile paste)
    el.value = el.value.replace(/[^0-9]/g, '');

    // Move to next input if digit entered
    if (el.value && index < inputs.length - 1) {
      inputs[index + 1].focus();
    }
  }
  

  </script>

</body>
</html>