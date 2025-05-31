<x-filament-panels::page>

    <div class="w-full overflow-x-auto">
        <div class="w-full min-w-[48rem] max-w-6xl text-sm">
            <table class="w-full text-sm">
                <tr class="border">
                    <th class="p-3">No</th>
                    @if (!auth()->user()->hasRole('Puskesmas'))
                        <th class="p-3 text-center">Fasyankes</th>
                    @endif
                    <th class="p-3">Kelompok Usia</th>
                    <th class="p-3">Jumlah Sasaran</th>
                    <th class="p-3">Target Cakupan</th>
                    <th class="p-3">Kebutuhan Vaksin (Dosis)</th>
                </tr>
                @foreach($this->form3Answers as $form3Answer)
                    <tr class="border">
                        <td class="p-3 text-center">{{ $loop->iteration }}</td>
                        @if (!auth()->user()->hasRole('Puskesmas'))
                            <td class="p-3 text-center">{{ $form3Answer->fasyankes->name }}</td>
                        @endif
                        <td class="p-3 text-center">{{ $form3Answer->age_group }}</td>
                        <td class="p-3 text-center">

                            @if (auth()->user()->hasRole('Puskesmas'))
                                <input 
                                    wire:model.defer="vaccine_target.{{ $form3Answer->id }}"
                                    wire:change="updateVaccineTarget('{{ $form3Answer->id }}', $event.target.value)" 
                                    class="rounded-lg bg-none" 
                                    type="number" 
                                    name="" 
                                    id=""> 
                            @else                       
                                {{ $this->vaccine_target[$form3Answer->id]?->vaccine_target ?? '-' }}                           
                            @endif

                        </td>
                        <td class="p-3 text-center">

                            @if (auth()->user()->hasRole('Puskesmas'))
                                <select 
                                    wire:model.defer="coverage_target.{{ $form3Answer->id }}"
                                    wire:change="updateCoverageTarget('{{ $form3Answer->id }}', $event.target.value)" 
                                    class="rounded-lg bg-none" 
                                    type="number" 
                                    name="" 
                                    id="">
                                    <option value="">Pilih</option>
                                    <option value="95">95 %</option>
                                    <option value="100">100 %</option>
                                </select>

                            @else                       
                                {{ $this->coverage_target[$form3Answer->id]?->coverage_target ?? '-' }}                           
                            @endif

                        </td>
                        <td class="p-3 text-center">
                            {{ 
                                isset($this->coverage_target[$form3Answer->id]) && isset($this->vaccine_target[$form3Answer->id])
                                ? (int) $this->vaccine_target[$form3Answer->id] * (int) $this->coverage_target[$form3Answer->id] / 100
                                : '-'
                            }}
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>


</x-filament-panels::page>
