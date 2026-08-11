{{-- resources/views/admin/message.blade.php --}}
@extends('layouts.dashboard_layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  * { font-family: 'DM Sans', sans-serif; }

  /* ── Sidebar list item ── */
  .msg-item {
    padding: 14px 16px; border-radius: 12px; cursor: pointer;
    border: 1.5px solid transparent;
    transition: background .15s, border-color .15s;
  }
  .msg-item:hover  { background: #f0fdf4; }
  .msg-item.active { background: #f0fdf4; border-color: #16a34a; }
  .msg-item.unread .msg-subject { font-weight: 700; color: #111827; }
  .msg-item.read   .msg-subject { font-weight: 500; color: #6b7280; }

  /* ── Unread dot ── */
  .unread-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #16a34a; flex-shrink: 0;
  }

  /* ── Badge ── */
  .badge-unread { background:#dcfce7; color:#15803d; font-size:11px; font-weight:700; padding:2px 8px; border-radius:999px; }
  .badge-read   { background:#f1f5f9; color:#94a3b8; font-size:11px; font-weight:600; padding:2px 8px; border-radius:999px; }

  /* ── Filter tab ── */
  .filter-tab { padding:6px 14px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; transition:background .15s,color .15s; }
  .filter-tab.active { background:#15803d; color:white; }
  .filter-tab:not(.active) { color:#6b7280; }
  .filter-tab:not(.active):hover { background:#f3f4f6; }

  /* ── Empty state ── */
  #empty-list, #empty-detail { display:none; }

  /* ── Detail panel ── */
  #detail-panel { display:none; }
  #detail-panel.show { display:flex; }

  /* ── Skeleton ── */
  .skeleton-bar {
    border-radius:5px;
    background:linear-gradient(90deg,#f0f0f0 25%,#e8e8e8 50%,#f0f0f0 75%);
    background-size:200% 100%; animation:shimmer 1.2s infinite;
  }
  @keyframes shimmer{from{background-position:200% 0}to{background-position:-200% 0}}

  /* ── Spinner ── */
  .spinner{width:15px;height:15px;border:2px solid rgba(255,255,255,.35);border-top-color:white;border-radius:50%;animation:spin .6s linear infinite;display:inline-block;}
  @keyframes spin{to{transform:rotate(360deg)}}

  /* ── Toast ── */
  #toast{
    position:fixed;bottom:28px;right:28px;z-index:999;
    display:flex;align-items:center;gap:10px;
    background:#15803d;color:white;font-size:13.5px;font-weight:600;
    padding:12px 20px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,0.18);
    transform:translateY(80px);opacity:0;
    transition:all .3s cubic-bezier(.34,1.56,.64,1);pointer-events:none;
  }
  #toast.show{transform:translateY(0);opacity:1;}
  #toast.error{background:#dc2626;}

  /* ── Bulk delete dropdown ── */
  #bulk-dropdown{
    display:none;position:absolute;top:calc(100% + 6px);right:0;z-index:50;
    min-width:220px;background:white;border:1px solid #e2e8f0;border-radius:12px;
    box-shadow:0 12px 32px rgba(0,0,0,0.12);animation:dropIn .15s ease;
  }
  #bulk-dropdown.open{display:block;}
  @keyframes dropIn{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}

  /* ── Message body pre-wrap ── */
  #detail-body { white-space: pre-wrap; line-height: 1.75; }

  /* ── Pagination ── */
  .page-btn-active { background:#15803d!important;color:white!important; }

  /* scrollbar thin */
  #msg-list::-webkit-scrollbar{width:4px;}
  #msg-list::-webkit-scrollbar-track{background:transparent;}
  #msg-list::-webkit-scrollbar-thumb{background:#d1d5db;border-radius:4px;}
</style>

<div class="flex-1 flex flex-col overflow-hidden">
<main class="flex-1 overflow-y-auto px-8 py-7 bg-[rgb(243,250,255)]">

  <!-- Page Header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
        Messages
        <span id="unread-badge-header" class="hidden text-sm font-bold bg-red-500 text-white px-2.5 py-0.5 rounded-full"></span>
      </h1>
      <p class="text-sm text-gray-500 mt-0.5">User enquiries submitted via the Contact Us form.</p>
    </div>

    <!-- Bulk delete -->
    <div class="relative" id="bulk-wrap">
      <button onclick="toggleBulkMenu()"
          class="flex items-center gap-2 border border-gray-300 text-gray-600 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        Delete All
        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </button>
      <div id="bulk-dropdown" >
        <div class="p-2 space-y-1">
          <button onclick="bulkDelete('read')"
              class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition text-left">
            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
            Delete all <strong>read</strong> messages
          </button>
          <button onclick="bulkDelete('unread')"
              class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition text-left">
            <span class="w-2 h-2 rounded-full bg-green-500"></span>
            Delete all <strong>unread</strong> messages
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter tabs -->
  <div class="flex items-center gap-1 mb-5 bg-white border border-gray-200 rounded-xl px-2 py-1.5 w-fit shadow-sm">
    <button class="filter-tab active" data-filter="all"    onclick="setFilter('all')">All</button>
    <button class="filter-tab"        data-filter="unread" onclick="setFilter('unread')">Unread</button>
    <button class="filter-tab"        data-filter="read"   onclick="setFilter('read')">Read</button>
  </div>

  <!-- Main two-panel layout -->
  <div class="flex gap-5" style="min-height: 560px;">

    <!-- LEFT: message list -->
    <div class="w-[360px] flex-shrink-0 flex flex-col bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

      <!-- list count -->
      <div class="px-4 pt-4 pb-2">
        <p id="list-count" class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Loading…</p>
      </div>

      <div id="msg-list" class="flex-1 overflow-y-auto px-3 pb-3 space-y-1.5"></div>

      <!-- empty state list -->
      <div id="empty-list" class="flex-1 flex flex-col items-center justify-center pb-10 text-center px-6">
        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-sm font-semibold text-gray-400">No messages here</p>
        <p class="text-xs text-gray-300 mt-1">Try switching the filter above</p>
      </div>

      <!-- list pagination -->
      <div id="list-pagination" class="hidden border-t border-gray-100 px-4 py-3 flex items-center justify-between">
        <span id="list-pag-info" class="text-xs text-gray-400"></span>
        <div class="flex gap-1.5">
          <button id="pag-prev" onclick="goPage('prev')"
              class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition disabled:opacity-30 disabled:cursor-not-allowed">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          </button>
          <button id="pag-next" onclick="goPage('next')"
              class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition disabled:opacity-30 disabled:cursor-not-allowed">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- RIGHT: detail panel -->
    <div class="flex-1 flex flex-col">

      <!-- placeholder when nothing selected -->
      <div id="empty-detail"
           class="flex-1 flex flex-col items-center justify-center bg-white rounded-2xl border border-gray-200 shadow-sm text-center px-8"
           style="display:flex;">
        <div class="w-20 h-20 rounded-3xl bg-green-50 flex items-center justify-center mb-5">
          <svg class="w-10 h-10 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-base font-bold text-gray-400">Select a message to read</p>
        <p class="text-sm text-gray-300 mt-1.5 max-w-xs">Click any message on the left to view its full content here.</p>
      </div>

      <!-- actual detail -->
      <div id="detail-panel" class="flex-col bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden" style="display:none;">

        <!-- header -->
        <div class="flex items-start justify-between px-6 pt-5 pb-4 border-b border-gray-100">
          <div class="flex items-center gap-3">
            <div id="detail-avatar"
                 class="w-11 h-11 rounded-full bg-gradient-to-br from-green-400 to-green-700 flex items-center justify-center text-white font-bold text-base flex-shrink-0">
              ?
            </div>
            <div>
              <p id="detail-name"  class="font-bold text-gray-900 text-base"></p>
              <p id="detail-email" class="text-xs text-gray-400"></p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <span id="detail-badge" class="badge-unread">Unread</span>
            <span id="detail-time"  class="text-xs text-gray-400"></span>
            <button id="detail-delete-btn" onclick="deleteMessage()"
                class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition ml-1">
              <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </div>

        <!-- body -->
        <div class="px-6 py-5 flex-1 overflow-y-auto">
          <p id="detail-body" class="text-sm text-gray-700 leading-relaxed"></p>
        </div>

        <!-- reply hint -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
          <a id="detail-reply-link" href="#"
             class="inline-flex items-center gap-2 text-sm font-semibold text-green-700 hover:text-green-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
            Reply via Email
          </a>
        </div>

      </div>
    </div>

  </div>

</main>
</div>

<!-- TOAST -->
<div id="toast">
  <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
  <span id="toast-msg"></span>
</div>

<script>
const ENDPOINT_LIST    = "{{ route('admin.messages') }}";
const CSRF             = document.querySelector('meta[name=csrf-token]').content;

let state       = { filter:'all', page:1 };
let pagination  = { prevPage:null, nextPage:null };
let activeId    = null;
let toastTimer  = null;

// ── INIT
document.addEventListener('DOMContentLoaded', () => {
  fetchMessages();
  // close bulk dropdown on outside click
  document.addEventListener('click', e => {
    if (!document.getElementById('bulk-wrap').contains(e.target))
      document.getElementById('bulk-dropdown').classList.remove('open');
  });
});

// ── FETCH LIST
function fetchMessages() {
  const list = document.getElementById('msg-list');
  list.innerHTML = skeletonItems();
  document.getElementById('empty-list').style.display = 'none';

  const p = new URLSearchParams({ page: state.page, filter: state.filter });

  fetch(`${ENDPOINT_LIST}?${p}`, { headers:{ 'X-Requested-With':'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
      pagination = { prevPage: data.prevPage, nextPage: data.nextPage };
      renderList(data.rows);
      renderListPagination(data.from, data.to, data.total);
      updateUnreadBadge(data.unreadCount);
    })
    .catch(() => { list.innerHTML=''; showToast('Failed to load messages.', true); });
}

// ── RENDER LIST ITEMS
function renderList(rows) {
  const list = document.getElementById('msg-list');
  document.getElementById('list-count').textContent =
    rows.length > 0 ? `${rows.length} message${rows.length !== 1 ? 's' : ''}` : '';

  if (!rows || rows.length === 0) {
    list.innerHTML = '';
    document.getElementById('empty-list').style.display = 'flex';
    return;
  }
  document.getElementById('empty-list').style.display = 'none';

  list.innerHTML = rows.map(m => {
    const initials = m.full_name.split(' ').map(w=>w[0]).join('').toUpperCase().slice(0,2);
    const preview  = m.message.length > 72 ? m.message.slice(0,72)+'…' : m.message;
    const readCls  = m.is_read ? 'read' : 'unread';
    const activeCls= activeId === m.id ? ' active' : '';
    return `
    <div class="msg-item ${readCls}${activeCls}" id="item-${m.id}" onclick="openMessage(${m.id})">
      <div class="flex items-start gap-3">
        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-green-400 to-green-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">
          ${initials}
        </div>
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between gap-2">
            <p class="msg-subject text-sm truncate">${esc(m.full_name)}</p>
            <div class="flex items-center gap-1.5 flex-shrink-0">
              ${!m.is_read ? '<span class="unread-dot"></span>' : ''}
              <span class="text-[11px] text-gray-400 whitespace-nowrap">${m.time_ago}</span>
            </div>
          </div>
          <p class="text-xs text-gray-400 mt-0.5 truncate">${esc(m.email)}</p>
          <p class="text-xs text-gray-500 mt-1 line-clamp-2" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${esc(preview)}</p>
        </div>
      </div>
    </div>`;
  }).join('');
}

// ── OPEN MESSAGE DETAIL
function openMessage(id) {
  // mark active visually
  document.querySelectorAll('.msg-item').forEach(el => el.classList.remove('active'));
  const item = document.getElementById(`item-${id}`);
  if (item) item.classList.add('active');
  activeId = id;

  // Show detail panel, hide placeholder
  document.getElementById('empty-detail').style.display = 'none';
  const panel = document.getElementById('detail-panel');
  panel.style.display = 'flex';

  // Show skeleton in detail
  document.getElementById('detail-body').innerHTML = '<div class="space-y-2"><div class="skeleton-bar h-3 w-full"></div><div class="skeleton-bar h-3 w-5/6"></div><div class="skeleton-bar h-3 w-4/6"></div></div>';
  document.getElementById('detail-name').textContent  = '…';
  document.getElementById('detail-email').textContent = '…';
  document.getElementById('detail-time').textContent  = '';

  fetch(`/admin/messages/${id}`, {
    headers:{ 'X-Requested-With':'XMLHttpRequest', 'X-CSRF-TOKEN': CSRF }
  })
  .then(r => r.json())
  .then(data => {
    // populate detail
    const initials = data.full_name.split(' ').map(w=>w[0]).join('').toUpperCase().slice(0,2);
    document.getElementById('detail-avatar').textContent    = initials;
    document.getElementById('detail-name').textContent      = data.full_name;
    document.getElementById('detail-email').textContent     = data.email;
    document.getElementById('detail-time').textContent      = data.created_at;
    document.getElementById('detail-body').textContent      = data.message;
    document.getElementById('detail-reply-link').href       = `mailto:${data.email}?subject=Re: Your message`;

    const badge = document.getElementById('detail-badge');
    badge.textContent = 'Read';
    badge.className   = 'badge-read';

    // mark item as read in list
    if (item) {
      item.classList.remove('unread');
      item.classList.add('read');
      item.querySelector('.msg-subject').style.fontWeight = '500';
      const dot = item.querySelector('.unread-dot');
      if (dot) dot.remove();
    }

    updateUnreadBadge(data.unreadCount);
  })
  .catch(() => showToast('Could not load message.', true));
}

// ── DELETE CURRENT MESSAGE
function deleteMessage() {
  if (!activeId) return;
  const btn = document.getElementById('detail-delete-btn');
  btn.disabled = true;

  fetch(`/admin/messages/${activeId}`, {
    method:'DELETE',
    headers:{ 'X-CSRF-TOKEN':CSRF, 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
  })
  .then(r => r.json())
  .then(data => {
    // remove from list
    const item = document.getElementById(`item-${activeId}`);
    if (item) { item.style.transition='opacity .2s'; item.style.opacity='0'; setTimeout(()=>item.remove(),220); }

    // hide detail
    activeId = null;
    document.getElementById('detail-panel').style.display = 'none';
    document.getElementById('empty-detail').style.display = 'flex';

    btn.disabled = false;
    updateUnreadBadge(data.unreadCount);
    showToast('Message deleted.');
    setTimeout(fetchMessages, 300);
  })
  .catch(() => { btn.disabled=false; showToast('Could not delete message.', true); });
}

// ── BULK DELETE
function toggleBulkMenu() {
  document.getElementById('bulk-dropdown').classList.toggle('open');
}
function bulkDelete(type) {
  document.getElementById('bulk-dropdown').classList.remove('open');
  if (!confirm(`Delete ALL ${type} messages? This cannot be undone.`)) return;

  fetch("{{ route('admin.messages.bulk-delete') }}", {
    method:'DELETE',
    headers:{ 'X-CSRF-TOKEN':CSRF, 'X-Requested-With':'XMLHttpRequest',
               'Accept':'application/json', 'Content-Type':'application/json' },
    body: JSON.stringify({ type })
  })
  .then(r => r.json())
  .then(data => {
    // if currently open message was deleted, close detail
    document.getElementById('detail-panel').style.display = 'none';
    document.getElementById('empty-detail').style.display = 'flex';
    activeId = null;
    updateUnreadBadge(data.unreadCount);
    showToast(`${data.deleted} ${type} message${data.deleted !== 1?'s':''} deleted.`);
    fetchMessages();
  })
  .catch(() => showToast('Bulk delete failed.', true));
}

// ── FILTER TABS
function setFilter(f) {
  state.filter = f; state.page = 1;
  document.querySelectorAll('.filter-tab').forEach(el => {
    el.classList.toggle('active', el.dataset.filter === f);
  });
  // close detail when switching filters
  document.getElementById('detail-panel').style.display = 'none';
  document.getElementById('empty-detail').style.display = 'flex';
  activeId = null;
  fetchMessages();
}

// ── PAGINATION
function renderListPagination(from, to, total) {
  const wrap = document.getElementById('list-pagination');
  if (total <= 15) { wrap.classList.add('hidden'); return; }
  wrap.classList.remove('hidden');
  document.getElementById('list-pag-info').textContent = `${from}–${to} of ${total}`;
  document.getElementById('pag-prev').disabled = !pagination.prevPage;
  document.getElementById('pag-next').disabled = !pagination.nextPage;
}
function goPage(dir) {
  if (dir==='prev' && pagination.prevPage) state.page = pagination.prevPage;
  if (dir==='next' && pagination.nextPage) state.page = pagination.nextPage;
  fetchMessages();
}

// ── UNREAD BADGE (header + page badge)
function updateUnreadBadge(count) {
  const hdrBadge = document.getElementById('unread-badge-header');
  if (count > 0) {
    hdrBadge.textContent = count;
    hdrBadge.classList.remove('hidden');
  } else {
    hdrBadge.classList.add('hidden');
  }
  // also update the header notification dot via custom event
  window.dispatchEvent(new CustomEvent('unread-count-changed', { detail: { count } }));
}

// ── SKELETON
function skeletonItems() {
  return Array(5).fill(0).map(() => `
    <div class="msg-item" style="cursor:default;">
      <div class="flex items-start gap-3">
        <div class="w-9 h-9 rounded-full skeleton-bar flex-shrink-0"></div>
        <div class="flex-1 space-y-2 pt-1">
          <div class="skeleton-bar h-3 w-24"></div>
          <div class="skeleton-bar h-2.5 w-32"></div>
          <div class="skeleton-bar h-2.5 w-full"></div>
        </div>
      </div>
    </div>`).join('');
}

// ── HELPERS
function esc(s){ return String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
function showToast(msg, isError=false) {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  t.classList.toggle('error', isError);
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 3200);
}
</script>

@endsection