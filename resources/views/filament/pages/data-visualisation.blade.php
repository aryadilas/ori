<x-filament-panels::page x-data="{tab: 1}">
    <div class="flex flex-wrap items-center justify-start w-full max-w-4xl gap-5 text-sm font-medium">
        <div @click="tab = 1" :class="tab === 1 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 1</div>
        <div @click="tab = 2" :class="tab === 2 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 2</div>
        <div @click="tab = 3" :class="tab === 3 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 3</div>
        <div @click="tab = 4" :class="tab === 4 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 4</div>
        <div @click="tab = 5" :class="tab === 5 ? 'bg-[#10DBB9] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#10DBB9] flex-grow flex-shrink hover:text-white">Grafik 5</div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="flex w-full bg-white flex-col gap-8 flex-grow shadow-[0px_4px_7px_2px_#00000040] rounded-[8px] p-5">
        
            <div x-show="tab === 1" wire:key="childGender" class="md:w-full" id="childGender"></div>
            <div x-show="tab === 1" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela 1 Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div  wire:key="cr1ImunizationAge13_16" class="max-w-sm p-2 border" id="cr1ImunizationAge13_16"></div>
                    <div  wire:key="cr1ImunizationAge18_59" class="max-w-sm p-2 border" id="cr1ImunizationAge18_59"></div>
                    <div  wire:key="cr1ImunizationAge5_7" class="max-w-sm p-2 border" id="cr1ImunizationAge5_7"></div>
                    <div  wire:key="cr1ImunizationAge7_13" class="max-w-sm p-2 border" id="cr1ImunizationAge7_13"></div>
                    <div  wire:key="cr1ImunizationAge9_18" class="max-w-sm p-2 border" id="cr1ImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 1" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela 2 Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div  wire:key="cr2ImunizationAge13_16" class="max-w-sm p-2 border" id="cr2ImunizationAge13_16"></div>
                    <div  wire:key="cr2ImunizationAge18_59" class="max-w-sm p-2 border" id="cr2ImunizationAge18_59"></div>
                    <div  wire:key="cr2ImunizationAge5_7" class="max-w-sm p-2 border" id="cr2ImunizationAge5_7"></div>
                    <div  wire:key="cr2ImunizationAge7_13" class="max-w-sm p-2 border" id="cr2ImunizationAge7_13"></div>
                    <div  wire:key="cr2ImunizationAge9_18" class="max-w-sm p-2 border" id="cr2ImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 1" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela Bias Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div  wire:key="crBiasImunizationAge13_16" class="max-w-sm p-2 border" id="crBiasImunizationAge13_16"></div>
                    <div  wire:key="crBiasImunizationAge18_59" class="max-w-sm p-2 border" id="crBiasImunizationAge18_59"></div>
                    <div  wire:key="crBiasImunizationAge5_7" class="max-w-sm p-2 border" id="crBiasImunizationAge5_7"></div>
                    <div  wire:key="crBiasImunizationAge7_13" class="max-w-sm p-2 border" id="crBiasImunizationAge7_13"></div>
                    <div  wire:key="crBiasImunizationAge9_18" class="max-w-sm p-2 border" id="crBiasImunizationAge9_18"></div>
                </div>
            </div>
            <div x-show="tab === 1" class="flex flex-col gap-4">
                <h1 class="text-sm font-extrabold text-center">Status Imunisasi Campak Rubela Tambahan Berdasarkan Kategori Umur Anak</h1>
                <div class="flex flex-wrap gap-2">
                    <div  wire:key="crTambahanImunizationAge13_16" class="max-w-sm p-2 border" id="crTambahanImunizationAge13_16"></div>
                    <div  wire:key="crTambahanImunizationAge18_59" class="max-w-sm p-2 border" id="crTambahanImunizationAge18_59"></div>
                    <div  wire:key="crTambahanImunizationAge5_7" class="max-w-sm p-2 border" id="crTambahanImunizationAge5_7"></div>
                    <div  wire:key="crTambahanImunizationAge7_13" class="max-w-sm p-2 border" id="crTambahanImunizationAge7_13"></div>
                    <div  wire:key="crTambahanImunizationAge9_18" class="max-w-sm p-2 border" id="crTambahanImunizationAge9_18"></div>
                </div>
            </div>

            <div x-show="tab === 2" wire:key="immunizationInfo" class="md:w-full" id="immunizationInfo"></div>
            <div x-show="tab === 2" wire:key="notImmunizedReason" class="md:w-full" id="notImmunizedReason"></div>
            <div x-show="tab === 2"  class="flex gap-2">
                <div wire:key="fever14Days" class="w-full max-w-full md:w-1/2" id="fever14Days"></div>
                <div wire:key="immunizedParentPermission" class="w-full max-w-full md:w-1/2" id="immunizedParentPermission"></div>
            </div>

    </div>

    {{-- Grafik 1 --}}
    <script>

        var childGender = {
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
                text: 'Jumlah Anak Berdasarkan Jenis Kelamin',
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
        var cr1ImunizationAge13_16 = {
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

        var cr1ImunizationAge18_59 = {
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

        var cr1ImunizationAge5_7 = {
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

        var cr1ImunizationAge7_13 = {
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

        var cr1ImunizationAge9_18 = {
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
                text: '9-<18 Tahun',
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
        var cr2ImunizationAge13_16 = {
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

        var cr2ImunizationAge18_59 = {
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

        var cr2ImunizationAge5_7 = {
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

        var cr2ImunizationAge7_13 = {
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

        var cr2ImunizationAge9_18 = {
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
                text: '9-<18 Tahun',
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
        var crBiasImunizationAge13_16 = {
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

        var crBiasImunizationAge18_59 = {
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

        var crBiasImunizationAge5_7 = {
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

        var crBiasImunizationAge7_13 = {
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

        var crBiasImunizationAge9_18 = {
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
                text: '9-<18 Tahun',
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
        var crTambahanImunizationAge13_16 = {
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

        var crTambahanImunizationAge18_59 = {
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

        var crTambahanImunizationAge5_7 = {
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

        var crTambahanImunizationAge7_13 = {
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

        var crTambahanImunizationAge9_18 = {
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
                text: '9-<18 Tahun',
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

        new ApexCharts(document.querySelector("#childGender"), childGender).render();
        new ApexCharts(document.querySelector("#cr1ImunizationAge13_16"), cr1ImunizationAge13_16).render();
        new ApexCharts(document.querySelector("#cr1ImunizationAge18_59"), cr1ImunizationAge18_59).render();
        new ApexCharts(document.querySelector("#cr1ImunizationAge5_7"), cr1ImunizationAge5_7).render();
        new ApexCharts(document.querySelector("#cr1ImunizationAge7_13"), cr1ImunizationAge7_13).render();
        new ApexCharts(document.querySelector("#cr1ImunizationAge9_18"), cr1ImunizationAge9_18).render();

        new ApexCharts(document.querySelector("#cr2ImunizationAge13_16"), cr2ImunizationAge13_16).render();
        new ApexCharts(document.querySelector("#cr2ImunizationAge18_59"), cr2ImunizationAge18_59).render();
        new ApexCharts(document.querySelector("#cr2ImunizationAge5_7"), cr2ImunizationAge5_7).render();
        new ApexCharts(document.querySelector("#cr2ImunizationAge7_13"), cr2ImunizationAge7_13).render();
        new ApexCharts(document.querySelector("#cr2ImunizationAge9_18"), cr2ImunizationAge9_18).render();

        new ApexCharts(document.querySelector("#crBiasImunizationAge13_16"), crBiasImunizationAge13_16).render();
        new ApexCharts(document.querySelector("#crBiasImunizationAge18_59"), crBiasImunizationAge18_59).render();
        new ApexCharts(document.querySelector("#crBiasImunizationAge5_7"), crBiasImunizationAge5_7).render();
        new ApexCharts(document.querySelector("#crBiasImunizationAge7_13"), crBiasImunizationAge7_13).render();
        new ApexCharts(document.querySelector("#crBiasImunizationAge9_18"), crBiasImunizationAge9_18).render();

        new ApexCharts(document.querySelector("#crTambahanImunizationAge13_16"), crTambahanImunizationAge13_16).render();
        new ApexCharts(document.querySelector("#crTambahanImunizationAge18_59"), crTambahanImunizationAge18_59).render();
        new ApexCharts(document.querySelector("#crTambahanImunizationAge5_7"), crTambahanImunizationAge5_7).render();
        new ApexCharts(document.querySelector("#crTambahanImunizationAge7_13"), crTambahanImunizationAge7_13).render();
        new ApexCharts(document.querySelector("#crTambahanImunizationAge9_18"), crTambahanImunizationAge9_18).render();

    </script>

    {{-- Grafik 2 --}}
    <script>
        var immunizationInfo = {
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

        var notImmunizedReason = {
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

        var fever14Days = {
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

        var immunizedParentPermission = {
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
    

    
        new ApexCharts(document.querySelector("#immunizationInfo"), immunizationInfo).render();
        new ApexCharts(document.querySelector("#notImmunizedReason"), notImmunizedReason).render();
        new ApexCharts(document.querySelector("#fever14Days"), fever14Days).render();
        new ApexCharts(document.querySelector("#immunizedParentPermission"), immunizedParentPermission).render();

    </script>
    
</x-filament-panels::page>
