<x-filament-panels::page>

    <div class="grid grid-cols-7 gap-2">

        <div class="grid col-span-2 gap-y-2">
            <div class="flex items-center justify-between gap-x-3 ">
                <label class="inline-flex items-center fi-fo-field-wrp-label gap-x-3" for="tableFilters.year.value">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Puskesmas</span>
                </label>
            </div>
            <div class="grid auto-cols-fr gap-y-2">
                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                    <div class="flex-1 min-w-0 fi-input-wrp-input">
                        <select wire:change="ChangeKodeFasyankes" wire:model="fasyankes" class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" >
                            <option value="all">SEMUA</option>
                            @foreach($this->reference_fasyankes as $kode => $name)
                                <option value="{{ $kode }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="grid col-span-2 gap-y-2">
            <div class="flex items-center justify-between gap-x-3 ">
                <label class="inline-flex items-center fi-fo-field-wrp-label gap-x-3" for="tableFilters.year.value">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Desa/Kelurahan ORI</span>
                </label>
            </div>
            <div class="grid auto-cols-fr gap-y-2">
                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                    <div class="flex-1 min-w-0 fi-input-wrp-input">
                        <select wire:change="ChangeVillage" wire:model="village" class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" >
                            <option value="all">SEMUA</option>
                            @foreach($this->reference_village as $kode => $name)
                                <option value="{{ $kode }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>
        

    </div>
    <div class="flex flex-col gap-6 sm:flex-row">

        <div class="flex bg-white flex-col border w-full sm:w-[30%] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Sasaran Imunisasi ORI Campak Rubela</h1>
            <span class="text-4xl font-semibold">{{ $this->sasaran_imunisasi }}</span>
        </div>

        <div class="flex bg-white flex-col border w-full sm:w-[30%] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Jumlah Anak Diimunisasi ORI Campak Rubela</h1>
            <span class="text-4xl font-semibold">{{ $this->anak_imunisasi }}</span>
        </div>

        <div class="flex bg-white flex-col border w-full sm:w-[30%] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">% Persentase Cakupan ORI Campak Rubela</h1>
            <span class="text-4xl font-semibold">{{ $this->persen_cakupan_ori }}</span>
        </div>

        {{-- 
        <div class="flex bg-white flex-col border w-full sm:max-w-[15rem] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Sasaran Imunisasi ORI Campak Rubela Laki-Laki</h1>
            <span class="text-4xl font-semibold">{{ $this->target_male }}</span>
        </div>
        <div class="flex bg-white flex-col border w-full sm:max-w-[15rem] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Sasaran Imunisasi ORI Campak Rubela Perempuan</h1>
            <span class="text-4xl font-semibold">{{ $this->target_female }}</span>
        </div>
        <div class="flex bg-white flex-col border w-full sm:max-w-[15rem] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Anak diimunisasi ORI Campak Rubela</h1>
            <span class="text-4xl font-semibold">{{ $this->immunized_child }}</span>
            <div class="w-full ">
                <span class="block text-lg font-semibold text-right">{{ $this->target_all ? number_format( ($this->immunized_child / $this->target_all) * 100, 1 ) : '-' }}%</span>
            </div>
        </div>
        <div class="flex bg-white flex-col border w-full sm:max-w-[15rem] justify-center items-center gap-2 shadow-lg rounded-lg p-3">
            <h1 class="text-lg font-semibold text-[#05C7C7] text-center leading-5">Anak Tidak diimunisasi ORI Campak Rubela</h1>
            <span class="text-4xl font-semibold">{{ $this->unimmunized_child }}</span>
            <div class="w-full ">
                <span class="block text-lg font-semibold text-right">{{ $this->target_all ? number_format( ($this->unimmunized_child / $this->target_all) * 100, 1 ) : '-' }}%</span>
            </div>
        </div> --}}


    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="flex flex-col flex-wrap gap-6 sm:flex-row">
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanSasaran" class="w-full" id="cakupanSasaran"></div>
        </div>
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanUsia_9_18" class="w-full" id="cakupanUsia_9_18"></div>
        </div>
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanUsia_18_59" class="w-full" id="cakupanUsia_18_59"></div>
        </div>
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanUsia_5_7" class="w-full" id="cakupanUsia_5_7"></div>
        </div>
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanUsia_7_13" class="w-full" id="cakupanUsia_7_13"></div>
        </div>
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-[30%]">
            <div wire:ignore wire:key="cakupanUsia_13_16" class="w-full" id="cakupanUsia_13_16"></div>
        </div>
        {{-- 
        <div class="p-3 bg-white border rounded-lg shadow-lg md:w-1/2">
            <div wire:ignore wire:key="genderBasedCoverage" class="w-full" id="genderBasedCoverage"></div>
        </div> --}}
    </div>


    @script
    <script>
        let cakupanSasaran = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_sasaran),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Berdasarkan Sasaran',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanSasaranChart = new ApexCharts(document.querySelector("#cakupanSasaran"), cakupanSasaran);
        cakupanSasaranChart.render();

        let cakupanUsia_9_18 = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_usia_9_18),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Usia 9 - <18 bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanUsia_9_18Chart = new ApexCharts(document.querySelector("#cakupanUsia_9_18"), cakupanUsia_9_18);
        cakupanUsia_9_18Chart.render();

        let cakupanUsia_18_59 = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_usia_18_59),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Usia 18 - 59 bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanUsia_18_59Chart = new ApexCharts(document.querySelector("#cakupanUsia_18_59"), cakupanUsia_18_59);
        cakupanUsia_18_59Chart.render();

        let cakupanUsia_5_7 = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_usia_5_7),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Usia 5 - <7 tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanUsia_5_7Chart = new ApexCharts(document.querySelector("#cakupanUsia_5_7"), cakupanUsia_5_7);
        cakupanUsia_5_7Chart.render();

        let cakupanUsia_7_13 = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_usia_7_13),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Usia 7 - <13 tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanUsia_7_13Chart = new ApexCharts(document.querySelector("#cakupanUsia_7_13"), cakupanUsia_7_13);
        cakupanUsia_7_13Chart.render();

        let cakupanUsia_13_16 = {
            chart: { 
                type: 'bar', 
                height: 300,
                stacked: true,
                stackType: '100%',
            },
            series: @json($this->cakupan_usia_13_16),
            xaxis: {
                categories: ['']
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '100px',
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            title: {
                text: '% Cakupan Usia 13 - <16 tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val}%`;  
                    }
                }
            },
        };
        let cakupanUsia_13_16Chart = new ApexCharts(document.querySelector("#cakupanUsia_13_16"), cakupanUsia_13_16);
        cakupanUsia_13_16Chart.render();



        let UpdateChart = () => {
            
            cakupanSasaranChart.updateOptions({
                series: $wire.cakupan_sasaran
            });
            cakupanUsia_9_18Chart.updateOptions({
                series: $wire.cakupan_usia_9_18
            });
            cakupanUsia_18_59Chart.updateOptions({
                series: $wire.cakupan_usia_18_59
            });
            cakupanUsia_5_7Chart.updateOptions({
                series: $wire.cakupan_usia_5_7
            });
            cakupanUsia_7_13Chart.updateOptions({
                series: $wire.cakupan_usia_7_13
            });
            cakupanUsia_13_16Chart.updateOptions({
                series: $wire.cakupan_usia_13_16
            });

        }

        $wire.on('changeKodeFasyankes', UpdateChart)
        $wire.on('changeYear', UpdateChart)
    </script>
    @endscript

</x-filament-panels::page>
