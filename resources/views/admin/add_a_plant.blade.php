@extends('layouts.dashboard_layout')

@section('content')



    <div class="w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-12 gap-0 border border-emerald-100">
        
        <div class="md:col-span-4 bg-emerald-900 p-8 flex flex-col justify-between text-emerald-100 min-h-[200px] md:min-h-full relative overflow-hidden">
            <div class="absolute -right-16 -bottom-16 w-48 h-48 bg-emerald-800/30 rounded-full blur-2xl"></div>
            <div>
                <span class="text-xs font-semibold tracking-widest uppercase text-emerald-300">Botanical Inventory</span>
                <h1 class="text-3xl font-bold text-white mt-2 leading-tight">Grow Your Garden</h1>
                <p class="text-sm text-emerald-200/80 mt-3 leading-relaxed">Document and curate your plant catalog with high accuracy to cultivate structural growth insights.</p>
            </div>
            <div class="mt-8 md:mt-0 text-xs text-emerald-300/60">
                &copy; {{ date('Y') }} Botanic Management Suite
            </div>
        </div>

        <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data" class="md:col-span-8 p-6 sm:p-10 space-y-6">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    Add New Plant
                </h2>

                <p class="text-slate-500 mt-2">
                    Enter botanical information and environmental metrics for your plant inventory.
                </p>
            </div>
            @csrf

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm flex items-center gap-3 animate-fade-in">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-sm space-y-1">
                    <p class="font-semibold">Please resolve the tracking flaws highlighted below:</p>
                </div>
            @endif

            <div>
                <h2 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-1">Core Classifications</h2>
                
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="plant_name" class="block text-xs font-semibold text-slate-600 mb-1">Plant Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="plant_name" name="plant_name" value="{{ old('plant_name') }}" placeholder="e.g. Fig" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                        @error('plant_name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="scientific_name" class="block text-xs font-semibold text-slate-600 mb-1">Scientific Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="scientific_name" name="scientific_name" value="{{ old('scientific_name') }}" placeholder="e.g. Ficus carica" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm italic bg-slate-50/50">
                        @error('scientific_name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-xs font-semibold text-slate-600 mb-1">Category <span class="text-rose-500">*</span></label>
                        <select id="category" name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select Category</option>
                            <option value="Fruit" {{ old('category') == 'Fruit' ? 'selected' : '' }}>Fruit</option>
                            <option value="Crops" {{ old('category') == 'Crops' ? 'selected' : '' }}>Crops</option>
                            <option value="Vegetables" {{ old('category') == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                            <option value="Evergreen" {{ old('category') == 'Evergreen' ? 'selected' : '' }}>Evergreen</option>
                        </select>
                        @error('category') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-1">Environmental Metrics <span class="text-[10px] lowercase text-slate-400 font-normal">(Optional)</span></h2>
                
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="suitability" class="block text-xs font-semibold text-slate-600 mb-1"> Suitability</label>
                        <select id="suitability" name="suitability" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                            <option value="" selected>Unspecified</option>
                            <option value="low" {{ old('suitability') == 'low' ? 'selected' : '' }}>Low </option>
                            <option value="medium" {{ old('suitability') == 'medium' ? 'selected' : '' }}>Medium </option>
                            <option value="high" {{ old('suitability') == 'high' ? 'selected' : '' }}>High </option>
                        </select>
                        @error('suitability') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="growth_period" class="block text-xs font-semibold text-slate-600 mb-1">Growth Period (Months/Specs)</label>
                        <input type="text" id="growth_period" name="growth_period" value="{{ old('growth_period') }}" placeholder="e.g. 8" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                        @error('growth_period') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="growing_season" class="block text-xs font-semibold text-slate-600 mb-1">Growing Season</label>
                        <select id="growing_season" name="growing_season" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                            <option value="" selected>Unspecified</option>
                            <option value="spring" {{ old('growing_season') == 'spring' ? 'selected' : '' }}>Spring</option>
                            <option value="summer" {{ old('growing_season') == 'summer' ? 'selected' : '' }}>Summer</option>
                            <option value="autumn" {{ old('growing_season') == 'autumn' ? 'selected' : '' }}>Autumn</option>
                            <option value="winter" {{ old('growing_season') == 'winter' ? 'selected' : '' }}>Winter</option>
                        </select>
                        @error('growing_season') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sunlight_requirement" class="block text-xs font-semibold text-slate-600 mb-1">Sunlight Requirement</label>
                        <select id="sunlight_requirement" name="sunlight_requirement" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm bg-slate-50/50">
                            <option value="" selected>Unspecified</option>
                            <option value="Full Sun" {{ old('sunlight_requirement') == 'Full Sun' ? 'selected' : '' }}>Full Sun</option>
                            <option value="Partial Shade" {{ old('sunlight_requirement') == 'Partial Shade' ? 'selected' : '' }}>Partial Shade</option>
                        </select>
                        @error('sunlight_requirement') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Plant Asset Image <span class="text-rose-500">*</span></label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-slate-200 hover:border-emerald-400 bg-slate-50/30 rounded-2xl transition relative group">
                    <div class="space-y-2 text-center">
                        <div id="preview-box" class="hidden mb-2">
                            <img id="image-preview" src="#" alt="Preview" class="mx-auto h-24 w-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                        </div>
                        
                        <svg id="upload-icon" class="mx-auto h-10 w-10 text-slate-400 group-hover:text-emerald-600 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="image" class="relative cursor-pointer font-semibold text-emerald-700 hover:text-emerald-600 transition focus-within:outline-none">
                                <span>Upload botanical image file</span>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewFile()">
                            </label>
                        </div>
                        <p class="text-[11px] text-slate-400">PNG, JPG, WEBP up to 2MB</p>
                    </div>
                </div>
                @error('image') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-emerald-800 text-white font-medium text-sm rounded-xl hover:bg-emerald-950 shadow-md shadow-emerald-950/10 hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-800 cursor-pointer">
                    Add Plant To Inventory
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewFile() {
            const preview = document.getElementById('image-preview');
            const previewBox = document.getElementById('preview-box');
            const icon = document.getElementById('upload-icon');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                previewBox.classList.remove('hidden');
                icon.classList.add('hidden');
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>


@endsection