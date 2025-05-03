<x-filament-panels::page x-data="{tab: 1}">
    <div class="flex flex-wrap items-center justify-start w-full max-w-4xl gap-5 text-sm font-medium">
        <div @click="tab = 1" :class="tab === 1 ? 'bg-[#16a34a] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#16a34a] flex-grow flex-shrink hover:text-white">Grafik 1</div>
        <div @click="tab = 2" :class="tab === 2 ? 'bg-[#16a34a] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#16a34a] flex-grow flex-shrink hover:text-white">Grafik 2</div>
        <div @click="tab = 3" :class="tab === 3 ? 'bg-[#16a34a] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#16a34a] flex-grow flex-shrink hover:text-white">Grafik 3</div>
        <div @click="tab = 4" :class="tab === 4 ? 'bg-[#16a34a] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#16a34a] flex-grow flex-shrink hover:text-white">Grafik 4</div>
        <div @click="tab = 5" :class="tab === 5 ? 'bg-[#16a34a] text-white' : 'bg-white'" class="cursor-pointer rounded-[8px] px-5 py-2 shadow-[0px_4px_7px_2px_#00000040] hover:bg-[#16a34a] flex-grow flex-shrink hover:text-white">Grafik 5</div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="flex w-full bg-white flex-col gap-5 flex-grow shadow-[0px_4px_7px_2px_#00000040] rounded-[8px] p-5">
        
            <div x-show="tab === 1" wire:key="immunizationInfo" class="md:w-full" id="immunizationInfo"></div>
            <div x-show="tab === 1" wire:key="notImmunizedReason" class="md:w-full" id="notImmunizedReason"></div>
            <div x-show="tab === 1"  class="flex gap-2">
                <div wire:key="fever14Days" class="w-full max-w-full md:w-1/2" id="fever14Days"></div>
                <div wire:key="immunizedParentPermission" class="w-full max-w-full md:w-1/2" id="immunizedParentPermission"></div>
            </div>
    </div>
    <script>
        var immunizationInfo = {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: '',
                data: @json($this->immunizedInfoValues)
            }],
            colors: ['#75C4C9'],
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
                        return value.toFixed(2) + "%";  
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
            colors: ['#75C4C9'],
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
                        return value.toFixed(2) + "%";
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
            colors: ['#C8D561', '#75C4C9'],
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
                        return value.toFixed(2) + "%";
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
            colors: ['#C8D561', '#75C4C9'],
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
                        return value.toFixed(2) + "%";
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
