<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Profile Details</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<style>
  body { font-family: 'DM Sans', sans-serif; background: linear-gradient(135deg, #e8f0fe 0%, #f0f4f0 60%, #e8f5e9 100%); }
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

<!-- Outer Page Card -->
<div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

  <!-- ── HEADER ── -->
  <header class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-white">
    <!-- Logo -->
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 rounded-xl bg-green-600 flex items-center justify-center shadow">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12c0-2.76 1.12-5.26 2.93-7.07"/>
          <path d="M12 6v6l4 2"/>
        </svg>
      </div>
      <span class="font-bold text-gray-800 text-base tracking-tight">GreenFarm <span class="text-green-600">Pro</span></span>
    </div>
    <!-- Nav links -->
    <nav class="flex items-center gap-5 text-xs font-medium text-gray-400">
      <p> smart crops and plants suitability analysis </p>
    </nav>
  </header>

  <!-- ── MAIN CONTENT ── -->
  <div class="p-5 space-y-4 bg-[#f5f7fb]">

    <!-- Card 1: Cover + Avatar + Name -->
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

      <!-- Cover Image -->
      <div class="relative h-36 w-full overflow-hidden">
        <img
          src="assets/images/other_images/profile_header.png"
          alt="Cover"
          class="w-full h-full object-cover"
          onerror="this.src='https://placehold.co/800x144/a8d5a2/2e7d32?text=🌿'"
        />
      </div>

      <!-- Avatar + Info + Buttons -->
      <div class="px-5 pb-5 flex items-end justify-between -mt-10 relative">

        <!-- Avatar -->
        <div class="flex items-end gap-4">
          <div class="relative flex-shrink-0">
            <!-- Form for CSRF Protection wrapper -->
            <form id="avatarForm" enctype="multipart/form-data" class="hidden">
                @csrf
            </form>
            <!-- Hidden file input -->
            <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="changeAvatar(event)" />
            <img
              id="avatarImg"
              src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
              alt="{{ auth()->user()->first_name }}"
              class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow"
              onerror="this.src='https://placehold.co/80x80/c8d8c8/2e7d32?text=SA'"
            />
            <!-- Camera icon button -->
            <div
              onclick="document.getElementById('avatarInput').click()"
              class="absolute bottom-1 right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow cursor-pointer hover:bg-blue-50 transition"
              title="Change profile picture"
            >
              <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
              </svg>
            </div>
          </div>

          <!-- Toast notification -->
          <div id="toast" class="hidden fixed bottom-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-4 py-2 rounded-full shadow-lg z-50 transition-all">
            ✅ Profile picture updated!
          </div>
 
          <script>
            function changeAvatar(event) {
                const file = event.target.files[0];
                if (!file) return;

                // 1. Instantly update UI with Client-Side Preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarImg').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // 2. Build Form Data payload
                const formData = new FormData();
                formData.append('avatar', file);
                
                // Securely fetch token directly from the hidden form element
                const csrfToken = document.querySelector('#avatarForm input[name="_token"]').value;

                // 3. Send AJAX process to Laravel Controller
                fetch("{{ route('profile.avatar.update') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Upload failed');
                    return response.json();
                })
                .then(data => {
                    const toast = document.getElementById('toast');
                    toast.textContent = "✅ " + (data.message || "Profile picture updated!");
                    toast.classList.remove('hidden');
                    setTimeout(() => toast.classList.add('hidden'), 2500);
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                    alert('Could not save your profile picture. Please try again.');
                });
            }
          </script>

          <!-- Name + Member since -->
          <div class="mb-1">
            <h1 class="text-xl font-bold text-gray-900">
                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            </h1>
            <div class="flex items-center gap-1 text-gray-400 text-xs mt-0.5">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Member since {{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'Jan 2026' }}</span>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2 mb-1">
          <a href="{{ route('edit_profile') }}" class="flex items-center gap-1.5 border border-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit Profile
          </a>
          <a href="{{ route('change_password') }}" class="flex items-center gap-1.5 border border-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Change Password
          </a>
        </div>

      </div>
    </div>

    <!-- Card 2: Profile Details -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

      <!-- Section Title -->
      <div class="flex items-center gap-2 mb-5">
        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <h2 class="font-bold text-gray-800 text-base">Profile Details</h2>
      </div>

      <hr class="border-gray-200 mb-5"/>

      <div class="grid grid-cols-3 gap-y-6">

        <!-- Full Name -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Full Name</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm font-medium">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
          </div>
        </div>

        <!-- City -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">City</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            {{ auth()->user()->city ?? 'Not Provided' }}
          </div>
        </div>

        <!-- Phone -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Phone</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.81a16 16 0 0 0 6 6l.85-.85a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            {{ auth()->user()->phone ?? 'Not Provided' }}
          </div>
        </div>

        <!-- Email -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">E-Mail</p>
          <div class="flex items-center gap-1.5 text-blue-500 text-sm font-medium">
            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            {{ auth()->user()->email }}
          </div>
        </div>

        <!-- State -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">State</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
            {{ auth()->user()->state ?? 'Not Provided' }}
          </div>
        </div>

        <!-- Date Joined -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Date Joined</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '15 Jun 2026' }}
          </div>
        </div>

        <!-- Address -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Address</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ auth()->user()->street_address ?? 'Not Provided' }}
          </div>
        </div>

        <!-- Country -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Country</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            {{ auth()->user()->country ?? 'Not Provided' }}
          </div>
        </div>

        <!-- Role -->
        <div>
          <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Role</p>
          <div class="flex items-center gap-1.5 text-gray-700 text-sm capitalize">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 2a5 5 0 1 1 0 10A5 5 0 0 1 12 2zM2 20c0-4 4-7 10-7s10 3 10 7"/></svg>
            {{ auth()->user()->role ?? 'Farmer/Gardener' }}
          </div>
        </div>

      </div>
    </div>

  </div><!-- end main content -->

  <!-- ── BACK BUTTON ROW ── -->
  <div class="flex justify-end px-6 py-3 bg-[#f5f7fb] border-t border-gray-100 gap-4">
      <!-- Upgraded Logout Form & Component Buttons -->
      <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="flex items-center gap-2 bg-white border border-red-100 text-red-600 text-xs font-medium px-4 py-2 rounded-xl shadow-sm hover:bg-red-50 hover:text-red-700 hover:border-red-200 transition">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
              </svg>
              Logout
          </button>
      </form>

      <a href="{{ route('home') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 text-xs font-medium px-4 py-2 rounded-xl shadow-sm hover:bg-gray-50 hover:text-green-700 hover:border-green-300 transition">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M19 12H5M12 5l-7 7 7 7"/>
          </svg>
          Back
        </a>
  </div>

  <!-- ── FOOTER ── -->
  <footer class="px-6 py-4 border-t border-gray-100 bg-white flex items-center justify-between">
    <div class="flex items-center gap-1.5 text-gray-400 text-xs">
      <div class="w-5 h-5 rounded-md bg-green-600 flex items-center justify-center">
        <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12"/></svg>
      </div>
      <span>© 2026 <span class="font-semibold text-gray-500">GreenFarm Pro</span>. All rights reserved.</span>
    </div>
    <div class="flex items-center gap-4 text-xs text-gray-400">
      <a href="#" class="hover:text-green-600 transition">Privacy Policy</a>
      <a href="#" class="hover:text-green-600 transition">Terms of Use</a>
      <a href="#" class="hover:text-green-600 transition">Support</a>
    </div>
  </footer>

</div><!-- end outer card -->

</body>
</html>