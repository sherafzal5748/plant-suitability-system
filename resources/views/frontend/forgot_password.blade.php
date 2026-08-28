<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Suitable Sow</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col items-center justify-center p-6">

  <!-- Logo Header -->
  <div class="flex items-center gap-3 mb-6">
    <img src="assets/icons/main_logo.png" alt="Suitable Sow Logo" class="w-12 h-12 rounded-xl object-cover">
    <div>
      <p class="text-base font-bold text-gray-900 leading-tight">Suitable Sow</p>
      <p class="text-xs font-semibold tracking-widest text-gray-500 uppercase">Agricultural Admin Portal</p>
    </div>
  </div>

  <!-- Card -->
  <div class="bg-white rounded-2xl border border-slate-200 px-8 pt-8 pb-8 w-full max-w-sm text-center shadow-sm">

    <!-- Image -->
    <div class="flex justify-center mb-6">
      <img src="assets/icons/forgot_passwrd_img.png" alt="Forgot Password" class="w-44 h-36 object-cover rounded-lg">
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-3">Forgot Password?</h1>

    <!-- Description -->
    <p class="text-sm text-gray-500 leading-relaxed mb-6">
      No worries! Enter your email address below<br>
      and we'll send you a link to reset your<br>
      password.
    </p>

  <form action="{{ route('passwordForgot') }}" method="POST">
    @csrf 
    {{-- Session expired error (will come from EmailController via session)--}}
      @error('email')
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 text-sm rounded-xl text-center">
          {{ $message }}
        </div>
      @enderror 
    <!-- Email Input -->
    <div class="text-left mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
      <div class="flex items-center gap-2 border border-slate-300 rounded-lg px-3 py-2.5 bg-white focus-within:ring-2 focus-within:ring-blue-400 focus-within:border-blue-400 transition">
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <input
          type="email"
          name="email"
          placeholder="e.g. manager@northsector.com"
          class="flex-1 text-sm text-gray-700 placeholder-gray-400 outline-none bg-transparent"
          required
          >
      </div>
    </div>

    <!-- Send Reset Link Button -->
    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors duration-150 mb-5">
      Send Request
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
      </svg>
    </button>

  </form>

    <!-- Back to Login -->
    <a href="{{ route('login') }}" class="flex items-center justify-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
      </svg>
      Back to Login
    </a>

  </div>

  <!-- Footer -->
  <div class="mt-6 text-center">
    <p class="text-xs text-gray-400 mb-1">© 2024 AgriPulse Suitability. All rights reserved.</p>
    <div class="flex justify-center gap-4">
      <a href="#" class="text-xs text-gray-500 hover:text-gray-700 transition-colors">Privacy Policy</a>
      <a href="#" class="text-xs text-gray-500 hover:text-gray-700 transition-colors">Support</a>
    </div>
  </div>

</body>
</html>