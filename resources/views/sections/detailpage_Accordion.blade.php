<style>
.accordion-content{
      max-height:0;
      overflow:hidden;
      transition:max-height .35s ease;
    }

    .accordion-open .accordion-content{
      max-height:400px;
    }

    .accordion-open .accordion-icon{
      transform:rotate(180deg);
    }
</style>

    {{-- ACCORDION  --}}
    <div class="mt-5 space-y-3">

    <div class="accordion bg-white rounded-xl border border-gray-200 overflow-hidden shadow-soft accordion-open">

        <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition">
        <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
            Flowering/Fruiting Seasonality
        </span>

        <svg class="accordion-icon transition-transform duration-300 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
        </button>

        <div class="accordion-content">
        <div class="p-5 text-sm leading-8 text-gray-700">
            ORGANIC CONTROL PROTOCOLS ORGANIC CONTROL PROTOCOLS
            ORGANIC CONTROL PROTOCOLS ORGANIC CONTROL PROTOCOLS
            ORGANIC CONTROL PROTOCOLS ORGANIC CONTROL PROTOCOLS
            ORGANIC CONTROL PROTOCOLS ORGANIC CONTROL PROTOCOLS
        </div>
        </div>
    </div>


    <div class="accordion bg-white rounded-xl border border-gray-200 overflow-hidden shadow-soft accordion-open">

        <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition">
        <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
            assistance
        </span>

        <svg class="accordion-icon transition-transform duration-300 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
        </button>

        <div class="accordion-content">
        <div class="p-5 text-sm leading-8 text-gray-700">
            this is assistance section
        </div>
        </div>
    </div>


    <div class="accordion bg-white rounded-xl border border-gray-200 overflow-hidden shadow-soft">
        <button class="accordion-toggle w-full flex items-center justify-between px-5 py-4 bg-[#f8fafc] hover:bg-[#f1f5f9] transition">
        <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
            Organic Control Protocols
        </span>

        <svg class="accordion-icon transition-transform duration-300 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
        </button>

        <div class="accordion-content">
        <div class="p-5 text-sm text-gray-700 leading-8">
            Organic biological controls and disease prevention details.
        </div>
        </div>
    </div>

    </div>

<script>

// ACCORDION FUNCTIONALITY

  const accordions = document.querySelectorAll('.accordion');

  accordions.forEach(accordion => {

    const button = accordion.querySelector('.accordion-toggle');

    button.addEventListener('click', () => {

      accordion.classList.toggle('accordion-open');

    });

  });

</script>