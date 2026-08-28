<!-- ______Live(Dynamic) Search Bar ____________-->

<div class="relative w-full max-w-md" id="plant-search-container">
        <form id="search-form" onsubmit="event.preventDefault();">
            <div class="flex items-center gap-2 bg-[rgb(230,246,255)] rounded-full px-4 py-2 border border-[rgb(190,202,185)]">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                </svg>
                <input 
                    type="text" 
                    id="search-input"
                    placeholder="Search plant database..." 
                    class="bg-transparent text-sm text-gray-600 placeholder-gray-400 outline-none w-full"
                    autocomplete="off"
                >
            </div>
        </form>

        <div id="suggestions-dropdown" class="hidden absolute z-10 w-full bg-white mt-1 rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-y-auto">
            <ul id="suggestions-list"></ul>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('search-input');
        const dropdown = document.getElementById('suggestions-dropdown');
        const list = document.getElementById('suggestions-list');
        const form = document.getElementById('search-form');
        
        let debounceTimer;
        let currentPlants = []; // Stores the current active suggestions fetching from the server

        // 1. Fetching Suggestions on Input
        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                dropdown.classList.add('hidden');
                currentPlants = [];
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/api/plants/search?query=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(plants => {
                        list.innerHTML = '';
                        currentPlants = plants; // Save to global array for the Enter key fallback

                        if (plants.length === 0) {
                            dropdown.classList.add('hidden');
                            return;
                        }

                        plants.forEach(plant => {
                            const li = document.createElement('li');
                            li.innerHTML = `
                                <button type="button" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 flex justify-between items-center">
                                    <div>
                                        <span class="font-medium text-gray-900">${plant.plant_name}</span>
                                        <span class="text-xs italic text-gray-400 ml-2">(${plant.scientific_name})</span>
                                    </div>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">${plant.category}</span>
                                </button>
                            `;
                            
                            // Scenario A: Handle clicking a specific plant suggestion
                            li.querySelector('button').addEventListener('click', () => {
                                redirectToDetail(plant.id);
                            });

                            list.appendChild(li);
                        });

                        dropdown.classList.remove('hidden');
                    });
            }, 300);
        });

        // Scenario B: Handle pressing the "Enter" key
        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const inputValue = input.value.trim().toLowerCase();

                // 1. Check if the exact typed text matches any of our loaded suggestions
                const exactMatch = currentPlants.find(plant => plant.plant_name.toLowerCase() === inputValue);
                
                if (exactMatch) {
                    redirectToDetail(exactMatch.id);
                } 
                // 2. If user types something and just hits Enter, fallback to the very first suggestion in the list
                else if (currentPlants.length > 0) {
                    redirectToDetail(currentPlants[0].id);
                }
            }
        });

        // Helper function to build the Laravel route dynamically and redirect
        function redirectToDetail(plantId) {
            // Generates the base URL pattern using Laravel's route named 'detail'
            let routeUrl = "{{ route('detail', ':id') }}";
            // Replaces the placeholder string ':id' with the actual database integer ID
            window.location.href = routeUrl.replace(':id', plantId);
        }

        // Close dropdown when clicking completely outside the element
        document.addEventListener('click', function(e) {
            if (!document.getElementById('plant-search-container').contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
    </script>