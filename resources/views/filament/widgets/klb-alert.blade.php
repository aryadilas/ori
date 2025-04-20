<x-filament-widgets::widget class="flex flex-col gap-3">
    {{-- <x-filament::section> --}}
        
        <h1 class="text-lg font-medium">
            Peringatan KLB
        </h1>

        @if ($this->klbStatus)
            
            @foreach ($klb as $case)
                
                @if ($case['status'] === 'unconfirmed')

                    <div class="flex relative w-fit items-center gap-4 rounded-md bg-[#B00020] px-4 py-2 text-slate-100">
                        <div class="absolute inset-0 rounded-md ring-4 ring-[#b00020b8] animate-pulse"></div>
                        <x-heroicon-o-arrow-trending-up class="w-5 fill-[#b00020b8] h-5 animate-pulse" />
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold">Puskesmas {{ $case['fasyankes_name'] }}</span>
                            <div class="flex flex-col">
                                {{-- <span>Status KLB (≥5 kasus selama 4 minggu berturut-turut).</span> --}}
                                <span class="text-xs">Terdapat {{ $case['total_cases'] }} kasus pada minggu ke {{ $case['start_week'] }} sampai {{ $case['end_week'] }}.</span>
                            </div>
                            @if ($case['status'] === 'unconfirmed' && auth()->user()->hasRole('Puskesmas'))
                                <div class="z-10 flex gap-2 mt-2">
                                    <button wire:click="notification_confirm('{{ $case['kode_fasyankes'] }}', '{{ $case['total_cases'] }}', '{{ $case['start_week'] }}', '{{ $case['end_week'] }}', 'confirmed')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm('{{ $case['kode_fasyankes'] }}', '{{ $case['total_cases'] }}', '{{ $case['start_week'] }}', '{{ $case['end_week'] }}', 'confirmed')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Konfirmasi KLB</span>
                                    </button>
                                    <button wire:click="notification_confirm('{{ $case['kode_fasyankes'] }}', '{{ $case['total_cases'] }}', '{{ $case['start_week'] }}', '{{ $case['end_week'] }}', 'false')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm('{{ $case['kode_fasyankes'] }}', '{{ $case['total_cases'] }}', '{{ $case['start_week'] }}', '{{ $case['end_week'] }}', 'false')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Bukan KLB</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                @else
                    @if ($case['status'] === 'confirmed')
                        
                        <div class="flex relative w-fit items-center gap-4 rounded-md bg-[#B00020] px-4 py-2 text-slate-100">
                            <div class="absolute inset-0 rounded-md ring-4 ring-[#b00020b8] animate-pulse"></div>
                            <x-heroicon-o-arrow-trending-up class="w-5 fill-[#b00020b8] h-5 animate-pulse" />
                            <div 
                                x-data="{ showConfirmButton: false }" 
                                x-init="window.addEventListener('hide-confirm-button', () => showConfirmButton = false)"
                                class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold">Puskesmas {{ $case['fasyankes_name'] }}</span>
                                    <x-heroicon-o-pencil-square @click="showConfirmButton = ! showConfirmButton" class="z-10 w-4 h-4 cursor-pointer " />
                                </div>
                                <div class="flex flex-col">
                                    <span>Status KLB.</span>
                                    <span class="text-xs">Terdapat {{ $case['total_cases'] }} kasus pada minggu ke {{ $case['start_week'] }} sampai {{ $case['end_week'] }}.</span>
                                </div>
                                <div x-show="showConfirmButton" class="z-10 flex gap-2 mt-2">
                                    <button wire:click="notification_confirm_edit('{{ $case['notification_id'] }}', 'confirmed')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm_edit('{{ $case['notification_id'] }}', 'confirmed')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Konfirmasi KLB</span>
                                    </button>
                                    <button wire:click="notification_confirm_edit('{{ $case['notification_id'] }}', 'false')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm_edit('{{ $case['notification_id'] }}', 'false')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Bukan KLB</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    
                    @else

                        <div class="flex relative w-fit items-center gap-4 rounded-md bg-[#4CAF50] px-4 py-2 text-slate-100">
                            <div class="absolute inset-0 rounded-md ring-4 ring-[#4caf4f9d] animate-pulse"></div>
                            <x-heroicon-o-arrow-trending-up class="w-5 fill-[#4caf4f9d] h-5 animate-pulse" />
                            <div 
                                x-data="{ showConfirmButton: false }"  
                                x-init="window.addEventListener('hide-confirm-button', () => showConfirmButton = false)"
                                class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold">Puskesmas {{ $case['fasyankes_name'] }}</span>
                                    <x-heroicon-o-pencil-square @click="showConfirmButton = ! showConfirmButton" class="z-10 w-4 h-4 cursor-pointer " />
                                </div>
                                <div class="flex flex-col">
                                    <span>Bukan KLB.</span>
                                    <span class="text-xs">Terdapat {{ $case['total_cases'] }} kasus pada minggu ke {{ $case['start_week'] }} sampai {{ $case['end_week'] }}.</span>
                                </div>
                                <div x-show="showConfirmButton" class="z-10 flex gap-2 mt-2">
                                    <button wire:click="notification_confirm_edit('{{ $case['notification_id'] }}', 'confirmed')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm_edit('{{ $case['notification_id'] }}', 'confirmed')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Konfirmasi KLB</span>
                                    </button>
                                    <button wire:click="notification_confirm_edit('{{ $case['notification_id'] }}', 'false')" class="flex items-center gap-1 px-2 py-1 text-black bg-white rounded-md cursor-pointer w-fit focus:outline-none focus:ring-2 focus:ring-gray-300" tabindex="0">
                                        <div class="hidden" wire:loading.class="inline" wire:loading.class.remove="hidden" wire:target="notification_confirm_edit('{{ $case['notification_id'] }}', 'false')">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#FF156D"></stop><stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="30" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="30" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                        </div>
                                        <span class="text-xs font-semibold">Bukan KLB</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endif
                @endif
            @endforeach

        @else

            <div class="flex w-full relative items-center gap-4 rounded-md bg-[#4CAF50] px-5 py-3 text-slate-100">
                <div class="absolute inset-0 rounded-md ring-4  ring-[#4caf4f9d] animate-pulse"></div>
                <x-heroicon-o-check class="w-5 h-5 fill-[#4caf4f9d] animate-pulse" />
                <div class="flex flex-col">
                    <span>Tidak ada peningkatan signifikan.</span>
                </div>
            </div>
        
            {{-- <div class="flex h-12 w-full items-center animate-pulse justify-between px-5 rounded-md bg-[#4CAF50] text-slate-100"> 
        
                <x-heroicon-o-check class="w-5 h-5" />
                <span>Tidak ada peningkatan signifikan</span>
            
            </div> --}}
        
        @endif

        {{-- <div class="flex h-12 w-full items-center animate-pulse rounded-md justify-between px-5 bg-[#FFEA00] text-black"> 
            
            <x-heroicon-o-arrow-trending-up class="w-5 h-5" />
            <span>Ada peningkatan, tetapi belum mencapai batas KLB</span>
        
        </div> --}}
        
        
        {{-- <div class="flex items-center justify-between w-full h-12 px-5 bg-green-700 text-slate-100"> 
    
            <span>LOGO</span>
            <span>Tidak ada peningkatan signifikan</span>
        
        </div>
        <br>
        <div class="flex items-center justify-between w-full h-12 px-5 bg-amber-500 text-slate-100"> 
            
            <span>LOGO</span>
            <span>Ada peningkatan, tetapi belum mencapai batas KLB</span>
        
        </div>
        <br>
        <div class="flex items-center justify-between w-full h-12 px-5 bg-red-700 text-slate-100"> 
            
            <span>LOGO</span>
            <span>Status KLB (≥5 kasus selama 4 minggu berturut-turut).</span>
        
        </div> --}}
      


    {{-- </x-filament::section> --}}
</x-filament-widgets::widget>
