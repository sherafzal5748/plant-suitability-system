<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">{{-- added for contact us form in footer --}}
  <title>Suitable Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { primary: '#2d7a3a' }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
  <style>
    * { font-family: 'DM Sans', sans-serif; }
    .mono { font-family: 'DM Mono', monospace; }
    .stat-card { transition: box-shadow 0.2s, transform 0.2s; }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .row-hover:hover { background: #f0fdf4; transition: background 0.15s; }
    .btn-export { background: linear-gradient(135deg, #16a34a, #15803d); }
    .btn-export:hover { background: linear-gradient(135deg, #15803d, #166534); }
    .page-active { background: #16a34a; color: white; }
    .page-btn { width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; }
    .page-btn:hover:not(.page-active) { background: #f0fdf4; }
    .new-bar { background: #16a34a; border-radius: 4px; }

    /* Filter dropdown */
    #filter-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      z-index: 50;
      min-width: 280px;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
      overflow: hidden;
      animation: dropIn 0.18s ease;
    }
    #filter-dropdown.open { display: block; }
    @keyframes dropIn {
      from { opacity: 0; transform: translateY(-6px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .filter-select {
      width: 100%;
      appearance: none;
      -webkit-appearance: none;
      background: #f0f9ff;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 10px 36px 10px 14px;
      font-size: 14px;
      color: #374151;
      cursor: pointer;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .filter-select:focus { border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
    .select-wrap { position: relative; }
    .select-wrap svg { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; }
    #filter-btn.active { background: #f0fdf4; border-color: #16a34a; color: #16a34a; }
  </style>
</head>
<body class="bg-gray-50 h-screen overflow-hidden font-sans">

    <!-- MAIN CONTAINER -->
    <div class="w-full h-full flex flex-col overflow-hidden">

        <!-- Header -->
        @include('partials.header')

        <!-- CONTENT -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
        <!-- END CONTENT -->

    </div>
    
</body>
</html>