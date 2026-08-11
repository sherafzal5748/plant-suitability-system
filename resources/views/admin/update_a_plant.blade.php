@extends('layouts.dashboard_layout')

@section('content')
<div class="py-6 px-4 sm:px-8 max-w-6xl mx-auto" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-200 pb-5 mb-8 gap-4">
        <div>
            <nav class="text-xs text-slate-400 font-medium flex gap-2 items-center mb-1">
                <span>Dashboard</span> <span>/</span> <span>Greenhouse Vault</span> <span>/</span> <span class="text-slate-600 font-semibold">Asset Optimization</span>
            </nav>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Modify Plant Matrix</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-6 bg-rose-50 border border-rose-200 text-rose-800 text-sm rounded-xl">
            <p class="font-semibold">Execution halted due to validation tracking errors. Please check form values.</p>
        </div>
    @endif

    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 mb-8 {{ request()->has('id') ? 'hidden' : 'block' }}">
        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-indigo-500"></span> Step 1: Query Active Index Vault
        </h2>
        <div class="grid sm:grid-cols-12 gap-4 items-end">
            <div class="sm:col-span-5">
                <label for="lookup_category" class="block text-xs font-semibold text-slate-500 mb-1.5">Target Plant Category</label>
                <select id="lookup_category" onchange="filterPlantDropdown()" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 text-slate-800 font-medium">
                    <option value="" selected disabled>Select Plant Category</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Crops">Crops</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Evergreen">Evergreen</option>
                </select>
            </div>

            <div class="sm:col-span-5">
                <label for="lookup_id" class="block text-xs font-semibold text-slate-500 mb-1.5">Select Targeted Plant Specimen</label>
                <select id="lookup_id" disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/20 text-slate-400 font-medium disabled:cursor-not-allowed">
                    <option value="" selected disabled>Choose category first...</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <button type="button" onclick="loadSpecimenDataToForm()" class="w-full px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs rounded-xl tracking-wide shadow transition cursor-pointer h-[42px] flex items-center justify-center">
                    Fetch Asset Metrics
                </button>
            </div>
        </div>
    </div>

    <div id="form-container" class="{{ request()->has('id') ? 'block opacity-100 transform translate-y-0' : 'hidden opacity-0 transform translate-y-4' }} transition-all duration-500">
        <form id="plant-update-form" action="#" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-12 gap-8">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden border border-slate-800">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Active Asset Media</h3>
                    
                    <div class="bg-slate-950 aspect-square w-full rounded-xl overflow-hidden border border-slate-800 flex items-center justify-center relative group">
                        <img id="image-display" 
                             src="" 
                             alt="Plant Asset Graphic" 
                             class="w-full h-full object-cover transition-all duration-500">
                        <div class="absolute inset-0 bg-slate-950/70 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="text-xs font-medium text-slate-200 border border-slate-700 rounded-lg px-3 py-1.5 pointer-events-none">Click Upload to Swap</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-800 flex justify-between items-center text-xs text-slate-400">
                        <div>
                            <p id="image-filename-string" class="font-semibold text-slate-200 truncate max-w-[180px]"></p>
                            <p class="text-[10px]">Active Saved Image Database Identifier</p>
                        </div>
                        <span class="px-2 py-0.5 bg-emerald-500/20 text-emerald-400 font-semibold rounded text-[10px] uppercase tracking-wider">Live</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Replace File Asset</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-slate-200 hover:border-indigo-400 hover:bg-indigo-50/10 rounded-xl transition cursor-pointer justify-center items-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="pt-1 text-xs text-slate-500 font-medium tracking-tight">Choose fresh image file...</p>
                            <input type="file" id="image-file" name="image" accept="image/*" class="hidden" onchange="runLocalPreview()">
                        </label>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 bg-white border border-slate-200/80 shadow-sm rounded-2xl p-6 sm:p-8 space-y-8">
                
                <div>
                    <h2 class="text-sm font-bold text-indigo-900 uppercase tracking-wider mb-5 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-indigo-600 rounded-sm inline-block"></span> Taxonomy Profile
                    </h2>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="plant_name" class="block text-xs font-semibold text-slate-500 mb-1.5">Common Plant Name <span class="text-rose-500">*</span></label>
                            <input type="text" id="plant_name" name="plant_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                        </div>

                        <div>
                            <label for="scientific_name" class="block text-xs font-semibold text-slate-500 mb-1.5">Binomial Nomenclature / Scientific <span class="text-rose-500">*</span></label>
                            <input type="text" id="scientific_name" name="scientific_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 italic font-medium text-slate-800">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="category" class="block text-xs font-semibold text-slate-500 mb-1.5">Category Designation <span class="text-rose-500">*</span></label>
                            <select id="category" name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                                <option value="Fruit">Fruit</option>
                                <option value="Crops">Crops</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Evergreen">Evergreen</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-indigo-900 uppercase tracking-wider mb-5 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-indigo-600 rounded-sm inline-block"></span> Environment Matrix
                    </h2>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="suitability" class="block text-xs font-semibold text-slate-500 mb-1.5">Care Management Suitability</label>
                            <select id="suitability" name="suitability" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                                <option value="">Unspecified</option>
                                <option value="low">Low Maintenance</option>
                                <option value="medium">Medium Maintenance</option>
                                <option value="high">High Maintenance</option>
                            </select>
                        </div>

                        <div>
                            <label for="growth_period" class="block text-xs font-semibold text-slate-500 mb-1.5">Estimated Growth Timeline (Months)</label>
                            <input type="text" id="growth_period" name="growth_period" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                        </div>

                        <div>
                            <label for="growing_season" class="block text-xs font-semibold text-slate-500 mb-1.5">Optimal Production Season</label>
                            <select id="growing_season" name="growing_season" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                                <option value="">Unspecified</option>
                                <option value="spring">Spring</option>
                                <option value="summer">Summer</option>
                                <option value="autumn">Autumn</option>
                                <option value="winter">Winter</option>
                            </select>
                        </div>

                        <div>
                            <label for="sunlight_requirement" class="block text-xs font-semibold text-slate-500 mb-1.5">Sunlight Energy Exposure</label>
                            <select id="sunlight_requirement" name="sunlight_requirement" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 font-medium text-slate-800">
                                <option value="">Unspecified</option>
                                <option value="Full Sun">Full Sun</option>
                                <option value="Partial Shade">Partial Shade</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('plant_catalog') }}" class="px-5 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-800 rounded-lg transition text-center">
                        Back to Catalog
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-slate-900 hover:bg-indigo-950 text-white font-semibold text-xs rounded-xl shadow-md tracking-wide hover:shadow-lg transition cursor-pointer">
                        Commit Plant Modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const activeBotanicalCollection = @json($plants);

    function filterPlantDropdown(callback = null) {
        const selectedCat = document.getElementById('lookup_category').value;
        const nameSelect = document.getElementById('lookup_id');
        
        nameSelect.innerHTML = '<option value="" selected disabled>Select Plant Name</option>';
        const relevantSpecs = activeBotanicalCollection.filter(p => p.category === selectedCat);

        if(relevantSpecs.length > 0) {
            relevantSpecs.forEach(plant => {
                const opt = document.createElement('option');
                opt.value = plant.id;
                opt.textContent = plant.plant_name + ' (' + (plant.scientific_name || 'N/A') + ')';
                nameSelect.appendChild(opt);
            });
            nameSelect.disabled = false;
            nameSelect.className = "w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/40 text-slate-800 font-medium";
        } else {
            nameSelect.innerHTML = '<option value="" selected disabled>No specimens in this group</option>';
            nameSelect.disabled = true;
            nameSelect.className = "w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-slate-50/20 text-slate-400 font-medium disabled:cursor-not-allowed";
        }

        if(typeof callback === 'function') callback();
    }

    // Modified: Removed alert popups on automatic lookup initialization checks
    function loadSpecimenDataToForm(forcedId = null) {
        const selectedId = forcedId || document.getElementById('lookup_id').value;
        if(!selectedId) return;

        const plant = activeBotanicalCollection.find(p => p.id == selectedId);
        if(!plant) return;

        const targetForm = document.getElementById('plant-update-form');
        targetForm.action = `/plants/${plant.id}`;

        document.getElementById('plant_name').value = plant.plant_name || '';
        document.getElementById('scientific_name').value = plant.scientific_name || '';
        document.getElementById('category').value = plant.category || 'Fruit';
        document.getElementById('suitability').value = plant.suitability || '';
        document.getElementById('growth_period').value = plant.growth_period || '';
        document.getElementById('growing_season').value = plant.growing_season || '';
        document.getElementById('sunlight_requirement').value = plant.sunlight_requirement || '';
        
        document.getElementById('image-filename-string').textContent = plant.image || 'no-image.jpg';
        document.getElementById('image-display').src = plant.image ? `/assets/images/home_plants/${plant.image}` : '/assets/images/default-plant.jpg';

        const formContainer = document.getElementById('form-container');
        formContainer.classList.remove('hidden');
        formContainer.classList.remove('opacity-0', 'translate-y-4');
        formContainer.classList.add('opacity-100', 'translate-y-0');
    }

    function runLocalPreview() {
        const input = document.getElementById('image-file');
        const visualDisplay = document.getElementById('image-display');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                visualDisplay.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Fires instantly on load stage to unpack dynamic profile properties directly
    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const idParam = urlParams.get('id');

        if (idParam) {
            // Skips dropdown filtering layout steps entirely and binds the data values
            loadSpecimenDataToForm(idParam);
        }
    });
</script>
@endsection