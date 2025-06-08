<x-filament-panels::page>

    <div class="w-full overflow-x-auto">
        <div class="w-full min-w-[48rem] max-w-6xl text-sm">
            <table class="w-full text-sm">
                <tr class="border">
                    <th class="p-3">No</th>
                    @if (!auth()->user()->hasRole('Puskesmas'))
                        <th class="p-3 text-center">Fasyankes</th>
                    @endif
                    <th class="p-3">Tanggal Status KLB</th>
                    <th class="p-3">Tanggal Pelaksanaan</th>
                    <th class="p-3">Durasi Respon KLB</th>
                </tr>
                @foreach($this->notifications as $notif)
                @php
                    \Carbon\Carbon::setLocale('id');
                    $date_klb = \Carbon\Carbon::parse($notif->created_at)->startOfDay();

                    if (isset($this->implementation_date[$notif->id])) {
                        $date_implementation = \Carbon\Carbon::parse($this->implementation_date[$notif->id]); 
                        $respond_duration = $date_klb->diffInDays($date_implementation);
                    } else {
                        $date_implementation = null;
                        $respond_duration = null;
                    }
                @endphp
                <tr class="border">
                    <td class="p-3 text-center">{{ $loop->iteration }}</td>
                    @if (!auth()->user()->hasRole('Puskesmas'))
                    <td class="p-3 text-center">
                        {{ $notif->fasyankes->name }}
                    </td>
                    @endif
                    <td class="p-3 text-center">
                        <span>{{ $date_klb->translatedFormat('l, d F Y') }}</span>
                    </td>
                    <td class="p-3 text-center">
                        @if (auth()->user()->hasRole('Puskesmas'))
                            <input 
                                wire:model="implementation_date.{{ $notif->id }}"
                                wire:change="updateImplementationDate('{{ $notif->id }}', $event.target.value)" 
                                class="rounded-lg bg-none" 
                                type="date" 
                                name="" 
                                id=""> 
                        @else                       
                            {{ $date_implementation?->translatedFormat('l, d F Y') ?? '-' }}                           
                        @endif
                    </td>
                    <td class="p-3 text-center">
                        <span>{{ $respond_duration ? round($respond_duration) . ' Hari' : '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>


</x-filament-panels::page>
