{{-- ═══════════════════════════════════════════════
     PARTIAL: detailpage_scripts.blade.php
     Handles: Tab switching, Accordion toggle,
              Progress bar animation on load
     ═══════════════════════════════════════════════ --}}

<script>
    // ── TAB SWITCHING ─────────────────────────────────
    const tabButtons  = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {

            // Reset all buttons
            tabButtons.forEach(b => {
                b.classList.remove('tab-active');
                b.classList.add('text-gray-500');
            });

            // Activate clicked button
            btn.classList.add('tab-active');
            btn.classList.remove('text-gray-500');

            // Hide all tab panels, show target
            tabContents.forEach(c => c.classList.add('content-hidden'));
            const target = document.getElementById(btn.dataset.tab);
            if (target) target.classList.remove('content-hidden');
        });
    });

    // ── ACCORDION ─────────────────────────────────────
    document.querySelectorAll('.accordion').forEach(acc => {
        acc.querySelector('.accordion-toggle')
           .addEventListener('click', () => acc.classList.toggle('accordion-open'));
    });

    // ── PROGRESS BAR ANIMATION ────────────────────────
    // Runs once on load — bars animate from 0 to their target width
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.progress-bar-inner').forEach(bar => {
            const targetWidth = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => { bar.style.width = targetWidth; }, 200);
        });
    });
</script>