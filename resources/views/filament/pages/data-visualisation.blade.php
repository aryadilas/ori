<x-filament-panels::page x-data="{tab: 1}">

    <div class="grid grid-cols-7 gap-2">

        @if (!auth()->user()->kode_fasyankes)

            <div class="grid max-w-[10rem] gap-y-2">
                <div class="flex items-center justify-between gap-x-3 ">
                    <label class="inline-flex items-center fi-fo-field-wrp-label gap-x-3" for="tableFilters.year.value">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Tahun</span>
                    </label>
                </div>
                <div class="grid auto-cols-fr gap-y-2">
                    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                        <div class="flex-1 min-w-0 fi-input-wrp-input">
                            <select wire:change="ChangeYear" wire:model="year" class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" id="tableFilters.year.value">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid col-span-2 gap-y-2">
                <div class="flex items-center justify-between gap-x-3 ">
                    <label class="inline-flex items-center fi-fo-field-wrp-label gap-x-3" for="tableFilters.year.value">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Puskesmas</span>
                    </label>
                </div>
                <div class="grid auto-cols-fr gap-y-2">
                    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                        <div class="flex-1 min-w-0 fi-input-wrp-input">
                            <select wire:change="ChangeKodeFasyankes" wire:model="kode_fasyankes" class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" id="tableFilters.year.value">
                                <option value="">SEMUA</option>
                                @foreach($this->reference_fasyankes as $kode => $name)
                                    <option value="{{ $kode }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="flex w-full bg-white flex-col gap-8 flex-grow shadow-[0px_4px_7px_2px_#00000040] rounded-[8px] p-5">
        
        <style>
            #maps { height: 600px; }
        </style>
        <div x-show="tab === 1" class="flex flex-col gap-2">
            <div wire:ignore wire:key="luas_wilayah" id="maps"></div>
        </div>

    </div>

    @script
    <script>
        let leafletMap = L.map('maps').setView([-6.4025, 106.7942], 12,5); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(leafletMap);

        let geojsonData = null; 
        let geojsonLayer = null; 

        // Fungsi render ulang GeoJSON
        function renderGeojson(dataWilayah) {
            // console.log(dataWilayah);
            if (geojsonLayer) {
                leafletMap.removeLayer(geojsonLayer);
            }

            geojsonLayer = L.geoJSON(geojsonData, {
                style: function (feature) {
                    const nama = feature.properties['NAMOBJ'];
                    const data = dataWilayah.find(item => item.village_name === nama);
                    const warna = data && data.summary === 'ORI' ? '#b51d1d' : '#3388ff';

                    return {
                        color: warna,
                        weight: 1,
                        fillOpacity: 0.5
                    };
                },
                onEachFeature: function (feature, layer) {
                    const center = layer.getBounds().getCenter();
                    const namaKelurahan = feature.properties['NAMOBJ'] || 'Tanpa Nama';

                    const label = L.marker(center, {
                        icon: L.divIcon({
                            className: 'label-kelurahan',
                            html: `${namaKelurahan}`,
                            iconSize: [100, 20]
                        })
                    }).addTo(leafletMap);

                    layer.on({
                        mouseover: function () {
                            layer.setStyle({
                                weight: 3,
                                color: '#666',
                                fillOpacity: 0.7
                            });
                            layer.bindTooltip(`<b>${namaKelurahan}</b>`).openTooltip();
                        },
                        mouseout: function () {
                            const data = dataWilayah.find(item => item.village_name === namaKelurahan);
                            const warna = data && data.summary === 'ORI' ? '#b51d1d' : '#3388ff';

                            layer.setStyle({
                                color: warna,
                                weight: 1,
                                fillOpacity: 0.5
                            });
                            layer.closeTooltip();
                        }
                    });
                }
            }).addTo(leafletMap);
        }

        // Fetch GeoJSON sekali saja
        fetch('/geojson/depok_ori.geojson')
            .then(response => response.json())
            .then(json => {
                geojsonData = json;
                renderGeojson($wire.luas_wilayah);
            });

        $wire.on('changeYear', () => {
            console.log($wire.luas_wilayah)
            renderGeojson($wire.luas_wilayah);
        });
        $wire.on('changeKodeFasyankes', () => {
            renderGeojson($wire.luas_wilayah);
        });
    </script>
    @endscript

</x-filament-panels::page>
