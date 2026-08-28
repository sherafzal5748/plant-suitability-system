{{-- ═══════════════════════════════════════════════
     SECTION: detailpage_scientific_parameter_table.blade.php
     Fields used:
       $plant->detail->annual_rainfall_min_mm, annual_rainfall_max_mm
       $plant->detail->soil_ph_range
       $plant->detail->ideal_temp_min_c, ideal_temp_max_c
       $plant->detail->soil_type, $plant->detail->drainage
       $plant->detail->humidity
       $plant->detail->growth_rate, $plant->detail->lifecycle
     ═══════════════════════════════════════════════ --}}

<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-[#f8fafc]">
        <h2 class="font-semibold text-gray-700 text-sm">Scientific Parameters</h2>
        <button class="text-xs text-green-600 font-semibold hover:underline tracking-wide uppercase">
            Export PDF
        </button>
    </div>

    @if($plant->detail)
        {{-- Table --}}
        <table class="w-full text-sm">

            <thead class="bg-[#f8fafc] text-gray-400 uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="text-left px-5 py-3">Parameter</th>
                    <th class="text-left px-5 py-3">Value</th>
                    <th class="text-left px-5 py-3">Condition</th>
                </tr>
            </thead>

            <tbody>

                {{-- Annual Rainfall --}}
                @if($plant->detail->annual_rainfall_min_mm || $plant->detail->annual_rainfall_max_mm)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Annual Rainfall</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">
                        {{ $plant->detail->annual_rainfall_min_mm ?? '?' }} – {{ $plant->detail->annual_rainfall_max_mm ?? '?' }} mm
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full font-semibold">
                            Moderate Moisture
                        </span>
                    </td>
                </tr>
                @endif

                {{-- Soil pH --}}
                @if($plant->detail->soil_ph_range)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Soil pH Range</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $plant->detail->soil_ph_range }}</td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-semibold">
                            Neutral to Mildly Acidic
                        </span>
                    </td>
                </tr>
                @endif

                {{-- Ideal Temperature --}}
                @if($plant->detail->ideal_temp_min_c !== null || $plant->detail->ideal_temp_max_c !== null)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Ideal Temperature</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">
                        {{ $plant->detail->ideal_temp_min_c ?? '?' }}°C – {{ $plant->detail->ideal_temp_max_c ?? '?' }}°C
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full font-semibold">
                            Optimal Range
                        </span>
                    </td>
                </tr>
                @endif

                {{-- Soil Type --}}
                @if($plant->detail->soil_type)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Soil Type</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $plant->detail->soil_type }}</td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full font-semibold">
                            {{ $plant->detail->drainage ?? 'Well Drained' }}
                        </span>
                    </td>
                </tr>
                @endif

                {{-- Humidity --}}
                @if($plant->detail->humidity)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Humidity</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $plant->detail->humidity }}</td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-purple-100 text-purple-700 px-2.5 py-1 rounded-full font-semibold">
                            Preferred Level
                        </span>
                    </td>
                </tr>
                @endif

                {{-- Growth Rate --}}
                @if($plant->detail->growth_rate)
                <tr class="border-t border-gray-100 hover:bg-green-50 transition">
                    <td class="px-5 py-3.5 text-gray-500">Growth Rate</td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $plant->detail->growth_rate }}</td>
                    <td class="px-5 py-3.5">
                        <span class="text-[11px] bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-semibold">
                            {{ $plant->detail->lifecycle ?? 'Plant Lifecycle' }}
                        </span>
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    @else
        <div class="p-5 text-center text-xs text-gray-400 italic">
            No technical profiles generated for this record.
        </div>
    @endif

</div>