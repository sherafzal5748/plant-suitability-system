<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Edit Profile</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<style>
  body { font-family: 'DM Sans', sans-serif; background: #f0f2f8; }
  input, select {
    background: #f4f6fb;
    border: 1px solid #e5e8f0;
    border-radius: 9px;
    padding-top: 14px;
    padding-bottom: 14px;
    padding-right: 16px;
    padding-left: 22px !important;
    font-size: 13px;
    color: #222;
    width: 100%;
    outline: none;
    transition: border 0.2s;
    height: 48px;
    box-sizing: border-box;
  }
  input:focus, select:focus { border-color: #22c55e; background: #fff; }
  label { font-size: 11px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 5px; display: block; }
  .section-card { background: white; border-radius: 16px; padding: 24px; border: 1px solid #e8eaf2; }
  .section-title { font-size: 15px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 8px; margin-bottom: 18px; }
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-3xl bg-[#f4f6fb] rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

  <!-- Unified Form Wrapper -->
  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Top Bar -->
    <div class="bg-white px-7 py-5 border-b border-gray-100 flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
        <p class="text-xs text-gray-400 mt-0.5">Manage your professional profile and digital identity.</p>
      </div>
      <div class="flex gap-2 mt-1">
        <a href="{{ route('profile') }}" class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">Cancel</a>
        <button type="submit" class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition shadow">Save Changes</button>
      </div>
    </div>

    <!-- Error Alert Banner -->
    @if ($errors->any())
      <div class="mx-5 mt-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
        <p class="text-xs font-bold text-red-700 uppercase tracking-wider mb-1">Please fix the following items:</p>
        <ul class="list-disc list-inside text-xs text-red-600 space-y-0.5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Body Layout -->
    <div class="p-5 grid grid-cols-3 gap-4">

      <!-- LEFT COLUMN: Avatar Card -->
      <div class="col-span-1 flex flex-col gap-4">

        <!-- Profile Card -->
        <div class="section-card flex flex-col items-center text-center">
          <div class="relative mb-3">
            <input type="file" id="avatarInput" name="image" accept="image/*" class="hidden" onchange="changeAvatar(event)" />
            <img
              id="avatarImg"
              src="{{ !empty(auth()->user()->image) && auth()->user()->image !== 'null' ? asset('storage/' . auth()->user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name ?? 'U') . '&background=16a34a&color=ffffff&bold=true' }}"
              alt="Profile Picture"
              class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md"
            />
            <button
              type="button"
              onclick="document.getElementById('avatarInput').click()"
              class="absolute bottom-0 right-0 w-7 h-7 bg-green-600 rounded-full flex items-center justify-center shadow-md hover:bg-green-700 transition"
              title="Change profile picture"
            >
              <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
              </svg>
            </button>
          </div>

          <h2 class="font-bold text-gray-900 text-base leading-tight">
            {{ auth()->user()->first_name }}<br/>{{ auth()->user()->last_name }}
          </h2>
          <p class="text-[11px] font-bold text-green-600 uppercase tracking-wider mt-1">
            {{ ucfirst(auth()->user()->role) }}
          </p>
          <div class="flex items-center gap-1 text-gray-400 text-xs mt-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ auth()->user()->city ?? 'Location not set' }}
          </div>

          <!-- Platform Stats -->
          <div class="w-full mt-4 border-t border-gray-100 pt-4 space-y-2">
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest text-left">Platform Status</p>
            <div class="flex justify-between text-xs">
              <span class="text-gray-500">Account Type</span>
              <span class="font-bold text-green-600 uppercase text-[10px] tracking-wide">{{ auth()->user()->role }}</span>
            </div>
            <div class="flex justify-between text-xs">
              <span class="text-gray-500">Joined</span>
              <span class="font-medium text-gray-700">{{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'Recent' }}</span>
            </div>
          </div>
        </div>

        <!-- Verified Badge Info Box -->
        <div class="bg-green-600 rounded-2xl p-4 text-white">
          <div class="flex items-center gap-2 mb-1.5">
            <svg class="w-4 h-4 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              <polyline points="9 12 11 14 15 10"/>
            </svg>
            <span class="font-bold text-sm">Verified Profile</span>
          </div>
          <p class="text-green-100 text-[11px] leading-relaxed">Your data forms your verified identity across the Suitable SOW platform maps.</p>
        </div>

      </div>

      <!-- RIGHT COLUMN: Input Forms Data Fields -->
      <div class="col-span-2 flex flex-col gap-4">

        <!-- Basic Details Block -->
        <div class="section-card">
          <div class="section-title">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Basic Details
          </div>
          <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
              <label>First Name</label>
              <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required />
            </div>
            <div>
              <label>Last Name</label>
              <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required />
            </div>
          </div>
          <div>
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required />
          </div>
        </div>

        <!-- Role & Regionality Block -->
        <div class="section-card">
          <div class="section-title">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            Role & Regionality
          </div>
          <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
              <label>Role</label>
              <select name="role">
                @if(auth()->user()->role === 'admin')
                  <option value="admin" selected>Admin</option>
                @else
                  <option value="farmer"      {{ old('role', auth()->user()->role) === 'farmer'      ? 'selected' : '' }}>Farmer</option>
                  <option value="enthusiast"  {{ old('role', auth()->user()->role) === 'enthusiast'  ? 'selected' : '' }}>Enthusiast</option>
                @endif
              </select>
            </div>
            <div>
              <label>Country</label>
              <select name="country">
                <option value="" {{ old('country', auth()->user()->country) == '' ? 'selected' : '' }}>Select your country</option>
                <option value="Pakistan" {{ old('country', auth()->user()->country) === 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                <option value="India" {{ old('country', auth()->user()->country) === 'India' ? 'selected' : '' }}>India</option>
                <option value="United States" {{ old('country', auth()->user()->country) === 'United States' ? 'selected' : '' }}>United States</option>
                <option value="Canada" {{ old('country', auth()->user()->country) === 'Canada' ? 'selected' : '' }}>Canada</option>
                <option value="United Kingdom" {{ old('country', auth()->user()->country) === 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                <option value="Australia" {{ old('country', auth()->user()->country) === 'Australia' ? 'selected' : '' }}>Australia</option>
                <option value="Germany" {{ old('country', auth()->user()->country) === 'Germany' ? 'selected' : '' }}>Germany</option>
                <option value="France" {{ old('country', auth()->user()->country) === 'France' ? 'selected' : '' }}>France</option>
                <option value="India" {{ old('country', auth()->user()->country) === 'India' ? 'selected' : '' }}>India</option>
              </select>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label>State / Province</label>
              <input type="text" name="state" value="{{ old('state', auth()->user()->state) }}" />
            </div>
            <div>
              <label>City</label>
              <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" />
            </div>
          </div>
        </div>

        <!-- Contact & Address Block -->
        <div class="section-card">
          <div class="section-title">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Contact & Address
          </div>
          <div class="mb-3">
            <label>Physical Address</label>
            <!-- Adjusted field attribute name below to street_address -->
            <input type="text" name="street_address" value="{{ old('street_address', auth()->user()->street_address) }}" />
          </div>
          <div>
            <label>Mobile Number</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" />
          </div>
        </div>

      </div>
    </div>
  </form>
</div>

<!-- Preview Notification -->
<div id="toast" class="hidden fixed bottom-6 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-5 py-2.5 rounded-full shadow-lg z-50">
  📸 Selected new avatar! Click Save Changes to upload.
</div>

<script>
  function changeAvatar(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('avatarImg').src = e.target.result;
      const toast = document.getElementById('toast');
      toast.classList.remove('hidden');
      setTimeout(() => toast.classList.add('hidden'), 3500);
    };
    reader.readAsDataURL(file);
  }
</script>

</body>
</html>