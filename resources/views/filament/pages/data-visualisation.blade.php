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
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Kode Fasyankes</span>
                    </label>
                </div>
                <div class="grid auto-cols-fr gap-y-2">
                    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                        <div class="flex-1 min-w-0 fi-input-wrp-input">
                            <select wire:change="ChangeKodeFasyankes" wire:model="kode_fasyankes" class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" id="tableFilters.year.value">
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


    <div class="flex flex-wrap items-center justify-start w-full gap-5 text-sm font-medium">
        <div @click="tab = 1" :class="tab === 1 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] hover:text-white">LUAS WILAYAH ORI CAMPAK RUBELA</div>
        <div @click="tab = 2" :class="tab === 2 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] hover:text-white">HASIL SCK I</div>
        <div @click="tab = 3" :class="tab === 3 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] hover:text-white">HASIL SCK II</div>
        {{-- <div @click="tab = 3" :class="tab === 3 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] hover:text-white">KELOMPOK SASARAN</div> --}}
        {{-- <div @click="tab = 5" :class="tab === 5 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 5</div> --}}
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="flex w-full bg-white flex-col gap-8 flex-grow shadow-[0px_4px_7px_2px_#00000040] rounded-[8px] p-5">
        
            <div wire:ignore x-show="tab === 2" wire:key="childGender" class="md:w-full" id="childGender"></div>
            <div x-show="tab === 2" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela 1 Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div wire:ignore wire:key="cr1ImunizationAge13_16" class="max-w-sm p-2 border" id="cr1ImunizationAge13_16"></div>
                    <div wire:ignore wire:key="cr1ImunizationAge18_59" class="max-w-sm p-2 border" id="cr1ImunizationAge18_59"></div>
                    <div wire:ignore wire:key="cr1ImunizationAge5_7" class="max-w-sm p-2 border" id="cr1ImunizationAge5_7"></div>
                    <div wire:ignore wire:key="cr1ImunizationAge7_13" class="max-w-sm p-2 border" id="cr1ImunizationAge7_13"></div>
                    <div wire:ignore wire:key="cr1ImunizationAge9_18" class="max-w-sm p-2 border" id="cr1ImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 2" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela 2 Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div wire:ignore wire:key="cr2ImunizationAge13_16" class="max-w-sm p-2 border" id="cr2ImunizationAge13_16"></div>
                    <div wire:ignore wire:key="cr2ImunizationAge18_59" class="max-w-sm p-2 border" id="cr2ImunizationAge18_59"></div>
                    <div wire:ignore wire:key="cr2ImunizationAge5_7" class="max-w-sm p-2 border" id="cr2ImunizationAge5_7"></div>
                    <div wire:ignore wire:key="cr2ImunizationAge7_13" class="max-w-sm p-2 border" id="cr2ImunizationAge7_13"></div>
                    <div wire:ignore wire:key="cr2ImunizationAge9_18" class="max-w-sm p-2 border" id="cr2ImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 2" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela Bias Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div wire:ignore wire:key="crBiasImunizationAge13_16" class="max-w-sm p-2 border" id="crBiasImunizationAge13_16"></div>
                    <div wire:ignore wire:key="crBiasImunizationAge18_59" class="max-w-sm p-2 border" id="crBiasImunizationAge18_59"></div>
                    <div wire:ignore wire:key="crBiasImunizationAge5_7" class="max-w-sm p-2 border" id="crBiasImunizationAge5_7"></div>
                    <div wire:ignore wire:key="crBiasImunizationAge7_13" class="max-w-sm p-2 border" id="crBiasImunizationAge7_13"></div>
                    <div wire:ignore wire:key="crBiasImunizationAge9_18" class="max-w-sm p-2 border" id="crBiasImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 2" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela Tambahan Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div wire:ignore wire:key="crTambahanImunizationAge13_16" class="max-w-sm p-2 border" id="crTambahanImunizationAge13_16"></div>
                    <div wire:ignore wire:key="crTambahanImunizationAge18_59" class="max-w-sm p-2 border" id="crTambahanImunizationAge18_59"></div>
                    <div wire:ignore wire:key="crTambahanImunizationAge5_7" class="max-w-sm p-2 border" id="crTambahanImunizationAge5_7"></div>
                    <div wire:ignore wire:key="crTambahanImunizationAge7_13" class="max-w-sm p-2 border" id="crTambahanImunizationAge7_13"></div>
                    <div wire:ignore wire:key="crTambahanImunizationAge9_18" class="max-w-sm p-2 border" id="crTambahanImunizationAge9_18"></div>
                </div>
            </div>

            <div wire:ignore x-show="tab === 3" wire:key="immunizationInfo" class="md:w-full" id="immunizationInfo"></div>
            <div wire:ignore x-show="tab === 3" wire:key="notImmunizedReason" class="md:w-full" id="notImmunizedReason"></div>
            <div wire:ignore x-show="tab === 3"  class="flex flex-col gap-2 sm:flex-row">
                <div wire:key="fever14Days" class="w-full max-w-full md:w-1/2" id="fever14Days"></div>
                <div wire:key="immunizedParentPermission" class="w-full max-w-full md:w-1/2" id="immunizedParentPermission"></div>
            </div>

            {{-- <div x-show="tab === 3" class="flex flex-col gap-2">
                <h1 class="text-sm font-extrabold text-center">Jumlah Sasaran</h1>
                <table class="text-sm border border-black">
                    <tr>
                        <td class="p-2 border border-black">Kateogri Umur Anak</td>
                        <td class="p-2 border border-black">Usia Anak</td>
                    </tr>
                    @foreach ($this->graphic_4 as $item)
                        <tr>
                            <td class="p-2 border border-black">{{ $item->usia }}</td>
                            <td class="p-2 border border-black">{{ $item->target }}</td>
                        </tr>
                    @endforeach
                </table>
            </div> --}}

            <style>
                #maps { height: 600px; }
            </style>
            <div x-show="tab === 1" class="flex flex-col gap-2">
                
                <div wire:ignore wire:key="luas_wilayah" id="maps"></div>

            </div>

    </div>

    {{-- Grafik 1 --}}
    @script
    <script>

        let childGender = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->childGenderValues)
            }],
            plotOptions: {
                bar: {
                    distributed: true
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: 'Persentase Anak Berdasarkan Jenis Kelamin',
                align: 'center'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->childGenderTotal);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->childGenderCategories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        /* CR1 */
        let cr1ImunizationAge13_16 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr1ImunizationAge13_16Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '13-<16 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr1ImunizationAge13_16Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr1ImunizationAge13_16Categories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    },
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                },
            }
        };

        let cr1ImunizationAge18_59 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr1ImunizationAge18_59Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '18-59 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr1ImunizationAge18_59Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr1ImunizationAge18_59Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr1ImunizationAge5_7 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr1ImunizationAge5_7Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '5-<7 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr1ImunizationAge5_7Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr1ImunizationAge5_7Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr1ImunizationAge7_13 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr1ImunizationAge7_13Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '7-<13 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr1ImunizationAge7_13Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr1ImunizationAge7_13Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr1ImunizationAge9_18 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr1ImunizationAge9_18Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '9-<18 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr1ImunizationAge9_18Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr1ImunizationAge9_18Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };


        /* CR2 */
        let cr2ImunizationAge13_16 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr2ImunizationAge13_16Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '13-<16 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr2ImunizationAge13_16Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr2ImunizationAge13_16Categories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    },
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                },
            }
        };

        let cr2ImunizationAge18_59 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr2ImunizationAge18_59Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '18-59 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr2ImunizationAge18_59Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr2ImunizationAge18_59Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr2ImunizationAge5_7 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr2ImunizationAge5_7Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '5-<7 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr2ImunizationAge5_7Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr2ImunizationAge5_7Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr2ImunizationAge7_13 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr2ImunizationAge7_13Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '7-<13 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr2ImunizationAge7_13Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr2ImunizationAge7_13Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let cr2ImunizationAge9_18 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->cr2ImunizationAge9_18Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '9-<18 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->cr2ImunizationAge9_18Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->cr2ImunizationAge9_18Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };


        /* CR BIAS */
        let crBiasImunizationAge13_16 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crBiasImunizationAge13_16Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '13-<16 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crBiasImunizationAge13_16Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crBiasImunizationAge13_16Categories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    },
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                },
            }
        };

        let crBiasImunizationAge18_59 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crBiasImunizationAge18_59Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '18-59 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crBiasImunizationAge18_59Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crBiasImunizationAge18_59Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crBiasImunizationAge5_7 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crBiasImunizationAge5_7Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '5-<7 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crBiasImunizationAge5_7Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crBiasImunizationAge5_7Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crBiasImunizationAge7_13 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crBiasImunizationAge7_13Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '7-<13 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crBiasImunizationAge7_13Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crBiasImunizationAge7_13Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crBiasImunizationAge9_18 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crBiasImunizationAge9_18Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '9-<18 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crBiasImunizationAge9_18Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crBiasImunizationAge9_18Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };


        /* CR TAMBAHAN */
        let crTambahanImunizationAge13_16 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crTambahanImunizationAge13_16Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '13-<16 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crTambahanImunizationAge13_16Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crTambahanImunizationAge13_16Categories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    },
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                },
            }
        };

        let crTambahanImunizationAge18_59 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crTambahanImunizationAge18_59Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '18-59 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crTambahanImunizationAge18_59Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crTambahanImunizationAge18_59Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crTambahanImunizationAge5_7 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crTambahanImunizationAge5_7Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '5-<7 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crTambahanImunizationAge5_7Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crTambahanImunizationAge5_7Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crTambahanImunizationAge7_13 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crTambahanImunizationAge7_13Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '7-<13 Tahun',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crTambahanImunizationAge7_13Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crTambahanImunizationAge7_13Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let crTambahanImunizationAge9_18 = {
            chart: { type: 'bar', height: 200 },
            series: [{
                name: '',
                data: @json($this->crTambahanImunizationAge9_18Values)
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                }
            },
            legend: {
                show: false,
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: '9-<18 Bulan',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->crTambahanImunizationAge9_18Total);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->crTambahanImunizationAge9_18Categories),
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    },
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };



        /* Grafik 2 */
        let immunizationInfo = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->immunizedInfoValues)
            }],
            colors: ['#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: 'Info Tentang Imunisasi',
                align: 'center'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";  
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->immunizedInfoTotal);
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);
                    }
                }
            },
            xaxis: { 
                categories: @json($this->immunizedInfoCategories) ,
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let notImmunizedReason = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->notImmunizedReasonValues)
            }],
            colors: ['#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: 'Alasan Tidak Imunisasi',
                align: 'center'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->notImmunizedReasonTotal);
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);
                    }
                }
            },
            xaxis: { 
                categories: @json($this->notImmunizedReasonCategories) ,
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let fever14Days = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->fever14DaysValues)
            }],
            plotOptions: {
                bar: {
                    distributed: true
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: 'Demam Ruam dalam 14 Hari',
                align: 'center'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->fever14DaysTotal);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->fever14DaysCategories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };

        let immunizedParentPermission = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->immunizedParentPermissionValues)
            }],
            plotOptions: {
                bar: {
                    distributed: true
                }
            },
            colors: ['#C8D561', '#3FD6C8'],
            dataLabels: {
                formatter: function (val) {
                    return val.toFixed(0) + '%';
                },
            },
            title: {
                text: 'Imunisasi dengan Izin Orangtua',
                align: 'center'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0) + "%";
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let total = @json($this->immunizedParentPermissionTotal);  
                        let actualValue = (val / 100) * total;
                        return 'Jumlah: ' + actualValue.toFixed(0);  
                    }
                }
            },
            xaxis: { 
                categories: @json($this->immunizedParentPermissionCategories),
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        whiteSpace: 'pre-wrap'
                    }
                },
            }
        };







        let childGenderChart = new ApexCharts(document.querySelector("#childGender"), childGender);
        childGenderChart.render();
        let cr1ImunizationAge13_16Chart = new ApexCharts(document.querySelector("#cr1ImunizationAge13_16"), cr1ImunizationAge13_16);
        cr1ImunizationAge13_16Chart.render();
        let cr1ImunizationAge18_59Chart = new ApexCharts(document.querySelector("#cr1ImunizationAge18_59"), cr1ImunizationAge18_59);
        cr1ImunizationAge18_59Chart.render();
        let cr1ImunizationAge5_7Chart = new ApexCharts(document.querySelector("#cr1ImunizationAge5_7"), cr1ImunizationAge5_7);
        cr1ImunizationAge5_7Chart.render();
        let cr1ImunizationAge7_13Chart = new ApexCharts(document.querySelector("#cr1ImunizationAge7_13"), cr1ImunizationAge7_13);
        cr1ImunizationAge7_13Chart.render();
        let cr1ImunizationAge9_18Chart = new ApexCharts(document.querySelector("#cr1ImunizationAge9_18"), cr1ImunizationAge9_18);
        cr1ImunizationAge9_18Chart.render();

        let cr2ImunizationAge13_16Chart = new ApexCharts(document.querySelector("#cr2ImunizationAge13_16"), cr2ImunizationAge13_16);
        cr2ImunizationAge13_16Chart.render();
        let cr2ImunizationAge18_59Chart = new ApexCharts(document.querySelector("#cr2ImunizationAge18_59"), cr2ImunizationAge18_59);
        cr2ImunizationAge18_59Chart.render();
        let cr2ImunizationAge5_7Chart = new ApexCharts(document.querySelector("#cr2ImunizationAge5_7"), cr2ImunizationAge5_7);
        cr2ImunizationAge5_7Chart.render();
        let cr2ImunizationAge7_13Chart = new ApexCharts(document.querySelector("#cr2ImunizationAge7_13"), cr2ImunizationAge7_13);
        cr2ImunizationAge7_13Chart.render();
        let cr2ImunizationAge9_18Chart = new ApexCharts(document.querySelector("#cr2ImunizationAge9_18"), cr2ImunizationAge9_18);
        cr2ImunizationAge9_18Chart.render();

        let crBiasImunizationAge13_16Chart = new ApexCharts(document.querySelector("#crBiasImunizationAge13_16"), crBiasImunizationAge13_16);
        crBiasImunizationAge13_16Chart.render();
        let crBiasImunizationAge18_59Chart = new ApexCharts(document.querySelector("#crBiasImunizationAge18_59"), crBiasImunizationAge18_59);
        crBiasImunizationAge18_59Chart.render();
        let crBiasImunizationAge5_7Chart = new ApexCharts(document.querySelector("#crBiasImunizationAge5_7"), crBiasImunizationAge5_7);
        crBiasImunizationAge5_7Chart.render();
        let crBiasImunizationAge7_13Chart = new ApexCharts(document.querySelector("#crBiasImunizationAge7_13"), crBiasImunizationAge7_13);
        crBiasImunizationAge7_13Chart.render();
        let crBiasImunizationAge9_18Chart = new ApexCharts(document.querySelector("#crBiasImunizationAge9_18"), crBiasImunizationAge9_18);
        crBiasImunizationAge9_18Chart.render();

        let crTambahanImunizationAge13_16Chart = new ApexCharts(document.querySelector("#crTambahanImunizationAge13_16"), crTambahanImunizationAge13_16);
        crTambahanImunizationAge13_16Chart.render();
        let crTambahanImunizationAge18_59Chart = new ApexCharts(document.querySelector("#crTambahanImunizationAge18_59"), crTambahanImunizationAge18_59);
        crTambahanImunizationAge18_59Chart.render();
        let crTambahanImunizationAge5_7Chart = new ApexCharts(document.querySelector("#crTambahanImunizationAge5_7"), crTambahanImunizationAge5_7);
        crTambahanImunizationAge5_7Chart.render();
        let crTambahanImunizationAge7_13Chart = new ApexCharts(document.querySelector("#crTambahanImunizationAge7_13"), crTambahanImunizationAge7_13);
        crTambahanImunizationAge7_13Chart.render();
        let crTambahanImunizationAge9_18Chart = new ApexCharts(document.querySelector("#crTambahanImunizationAge9_18"), crTambahanImunizationAge9_18);
        crTambahanImunizationAge9_18Chart.render();


        let immunizationInfoChart = new ApexCharts(document.querySelector("#immunizationInfo"), immunizationInfo);
        immunizationInfoChart.render();
        let notImmunizedReasonChart = new ApexCharts(document.querySelector("#notImmunizedReason"), notImmunizedReason);
        notImmunizedReasonChart.render();
        let fever14DaysChart = new ApexCharts(document.querySelector("#fever14Days"), fever14Days);
        fever14DaysChart.render();
        let immunizedParentPermissionChart = new ApexCharts(document.querySelector("#immunizedParentPermission"), immunizedParentPermission);
        immunizedParentPermissionChart.render();

        


        let UpdateChart = () => {
            
            childGenderChart.updateOptions({
                    series: [{
                        data: $wire.childGenderValues
                    }],
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                let total = $wire.childGenderTotal;  
                                let actualValue = (val / 100) * total;
                                return 'Jumlah: ' + actualValue.toFixed(0);  
                            }
                        }
                    },
                    xaxis: { 
                        categories: $wire.childGenderCategories,
                    },
            });

            

            cr1ImunizationAge13_16Chart.updateOptions({
                series: [{
                    data: $wire.cr1ImunizationAge13_16Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr1ImunizationAge13_16Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr1ImunizationAge13_16Categories,
                },
            })

            cr1ImunizationAge18_59Chart.updateOptions({
                series: [{
                    data: $wire.cr1ImunizationAge18_59Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr1ImunizationAge18_59Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr1ImunizationAge18_59Categories,
                },
            })
            cr1ImunizationAge5_7Chart.updateOptions({
                series: [{
                    data: $wire.cr1ImunizationAge5_7Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr1ImunizationAge5_7Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr1ImunizationAge5_7Categories,
                },
            })
            cr1ImunizationAge7_13Chart.updateOptions({
                series: [{
                    data: $wire.cr1ImunizationAge7_13Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr1ImunizationAge7_13Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr1ImunizationAge7_13Categories,
                },
            })
            cr1ImunizationAge9_18Chart.updateOptions({
                series: [{
                    data: $wire.cr1ImunizationAge9_18Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr1ImunizationAge9_18Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr1ImunizationAge9_18Categories,
                },
            })




            cr2ImunizationAge13_16Chart.updateOptions({
                series: [{
                    data: $wire.cr2ImunizationAge13_16Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr2ImunizationAge13_16Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr2ImunizationAge13_16Categories,
                },
            })
            cr2ImunizationAge18_59Chart.updateOptions({
                series: [{
                    data: $wire.cr2ImunizationAge18_59Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr2ImunizationAge18_59Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr2ImunizationAge18_59Categories,
                },
            })
            cr2ImunizationAge5_7Chart.updateOptions({
                series: [{
                    data: $wire.cr2ImunizationAge5_7Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr2ImunizationAge5_7Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr2ImunizationAge5_7Categories,
                },
            })
            cr2ImunizationAge7_13Chart.updateOptions({
                series: [{
                    data: $wire.cr2ImunizationAge7_13Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr2ImunizationAge7_13Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr2ImunizationAge7_13Categories,
                },
            })
            cr2ImunizationAge9_18Chart.updateOptions({
                series: [{
                    data: $wire.cr2ImunizationAge9_18Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.cr2ImunizationAge9_18Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.cr2ImunizationAge9_18Categories,
                },
            })



            crBiasImunizationAge13_16Chart.updateOptions({
                series: [{
                    data: $wire.crBiasImunizationAge13_16Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crBiasImunizationAge13_16Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crBiasImunizationAge13_16Categories,
                },
            })
            crBiasImunizationAge18_59Chart.updateOptions({
                series: [{
                    data: $wire.crBiasImunizationAge18_59Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crBiasImunizationAge18_59Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crBiasImunizationAge18_59Categories,
                },
            })
            crBiasImunizationAge5_7Chart.updateOptions({
                series: [{
                    data: $wire.crBiasImunizationAge5_7Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crBiasImunizationAge5_7Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crBiasImunizationAge5_7Categories,
                },
            })
            crBiasImunizationAge7_13Chart.updateOptions({
                series: [{
                    data: $wire.crBiasImunizationAge7_13Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crBiasImunizationAge7_13Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crBiasImunizationAge7_13Categories,
                },
            })
            crBiasImunizationAge9_18Chart.updateOptions({
                series: [{
                    data: $wire.crBiasImunizationAge9_18Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crBiasImunizationAge9_18Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crBiasImunizationAge9_18Categories,
                },
            })
            


            crTambahanImunizationAge13_16Chart.updateOptions({
                series: [{
                    data: $wire.crTambahanImunizationAge13_16Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crTambahanImunizationAge13_16Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crTambahanImunizationAge13_16Categories,
                },
            })
            crTambahanImunizationAge18_59Chart.updateOptions({
                series: [{
                    data: $wire.crTambahanImunizationAge18_59Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crTambahanImunizationAge18_59Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crTambahanImunizationAge18_59Categories,
                },
            })
            crTambahanImunizationAge5_7Chart.updateOptions({
                series: [{
                    data: $wire.crTambahanImunizationAge5_7Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crTambahanImunizationAge5_7Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crTambahanImunizationAge5_7Categories,
                },
            })
            crTambahanImunizationAge7_13Chart.updateOptions({
                series: [{
                    data: $wire.crTambahanImunizationAge7_13Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crTambahanImunizationAge7_13Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crTambahanImunizationAge7_13Categories,
                },
            })
            crTambahanImunizationAge9_18Chart.updateOptions({
                series: [{
                    data: $wire.crTambahanImunizationAge9_18Values
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.crTambahanImunizationAge9_18Total;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);  
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.crTambahanImunizationAge9_18Categories,
                },
            })




            immunizationInfoChart.updateOptions({
                series: [{
                    data: $wire.immunizedInfoValues
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.immunizedInfoTotal;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.immunizedInfoCategories,
                }
            })
            notImmunizedReasonChart.updateOptions({
                series: [{
                    data: $wire.notImmunizedReasonValues
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.notImmunizedReasonTotal;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.notImmunizedReasonCategories,
                }
            })
            fever14DaysChart.updateOptions({
                series: [{
                    data: $wire.fever14DaysValues
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.fever14DaysTotal;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.fever14DaysCategories,
                }
            })
            immunizedParentPermissionChart.updateOptions({
                series: [{
                    data: $wire.immunizedParentPermissionValues
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            let total = $wire.immunizedParentPermissionTotal;
                            let actualValue = (val / 100) * total;
                            return 'Jumlah: ' + actualValue.toFixed(0);
                        }
                    }
                },
                xaxis: { 
                    categories: $wire.immunizedParentPermissionCategories,
                }
            })

        };


        $wire.on('changeKodeFasyankes', UpdateChart)
        $wire.on('changeYear', UpdateChart)

    </script>
    @endscript

    @script
    <script>
        let leafletMap = L.map('maps').setView([-6.4025, 106.7942], 13); 

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
