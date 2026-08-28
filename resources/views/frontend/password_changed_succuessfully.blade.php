<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Changed</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-100 min-h-screen flex flex-col items-center justify-center p-6">

  <!-- Card -->
  <div class="bg-white rounded-2xl border border-slate-200 px-12 pt-10 pb-10 max-w-lg w-full text-center">
      
    <!-- Icon -->
    <div class="flex items-center justify-center mb-6 relative">
      <!-- Outer light blue ring -->
      <div class="w-32 h-32 rounded-full bg-blue-50 flex items-center justify-center">
        <!-- Inner green circle -->
        <div class="w-20 h-20 rounded-full bg-green-500 flex items-center justify-center shadow-md">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
        </div>
      </div>
      <!-- Small green tick badge top-right -->
      <div class="absolute top-4 right-16 w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-3 leading-snug">
      Your password has been changed<br>successfully!
    </h1>

    <!-- Description -->
    <p class="text-sm text-gray-500 leading-relaxed mb-8">
      Your account is now secure. You can use your new password<br>
      to sign in across all your devices.
    </p>

    <!-- Buttons -->
    <div class="flex justify-center gap-4">
      <a href="{{ route('home') }}" class="bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-8 py-3 rounded-lg transition-colors duration-150">
        Go to Home
      </a>
      <a href="{{ route('profile') }}" class="bg-white hover:bg-gray-50 text-green-700 text-sm font-semibold px-8 py-3 rounded-lg border border-green-700 transition-colors duration-150">
        Dismiss
      </a>
    </div>

  </div>

  <!-- Footer Note (outside card) -->
  <p class="flex items-center gap-2 text-sm text-gray-500 mt-5">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
    </svg>
    Advanced encryption active for your Suitable Saw account
  </p>
  

</body>
</html>