<x-filament-widgets::widget class="flex flex-col gap-3">
    {{-- <x-filament::section> --}}
        
        @if ($this->klbStatus)
            
            @foreach ($klb as $case)
                
                {{-- <div class="flex h-12 w-full items-center animate-pulse rounded-md justify-between px-5 bg-[#B00020] text-slate-100"> 
                    
                    <x-heroicon-o-arrow-trending-up class="w-5 h-5" />
                    <span>Status KLB (≥5 kasus selama 4 minggu berturut-turut). {{ $case['total_cases'] }} pada minggu ke {{ $case['start_week'] }} sampai {{ $case['end_week'] }}.</span>
                
                </div> --}}

                <div class="flex relative w-full items-center gap-4 rounded-md bg-[#B00020] px-5 py-3 text-slate-100">
                    <div class="absolute inset-0 rounded-md ring-4 ring-[#b00020b8] animate-pulse"></div>
                    <x-heroicon-o-arrow-trending-up class="w-5 fill-[#b00020b8] h-5 animate-pulse" />
                    <div class="flex flex-col">
                        <span>Status KLB (≥5 kasus selama 4 minggu berturut-turut).</span>
                        <span class="text-xs">Terdapat {{ $case['total_cases'] }} kasus pada minggu ke {{ $case['start_week'] }} sampai {{ $case['end_week'] }}.</span>
                    </div>
                </div>
            
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
        
        
        {{-- <div class="flex h-12 w-full items-center justify-between px-5 bg-green-700 text-slate-100"> 
    
            <span>LOGO</span>
            <span>Tidak ada peningkatan signifikan</span>
        
        </div>
        <br>
        <div class="flex h-12 w-full items-center justify-between px-5 bg-amber-500 text-slate-100"> 
            
            <span>LOGO</span>
            <span>Ada peningkatan, tetapi belum mencapai batas KLB</span>
        
        </div>
        <br>
        <div class="flex h-12 w-full items-center justify-between px-5 bg-red-700 text-slate-100"> 
            
            <span>LOGO</span>
            <span>Status KLB (≥5 kasus selama 4 minggu berturut-turut).</span>
        
        </div> --}}
      


    {{-- </x-filament::section> --}}
</x-filament-widgets::widget>
