<x-filament-panels::page>

    <div class="w-full overflow-x-auto">
        <div class="w-full min-w-[48rem] max-w-6xl text-sm" style="font-family:Poppins, sans-serif; color:#6b7280; background:#fff; border-radius:0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding:1rem;">
            <table class="w-full text-sm border-collapse" style="border-spacing:0;">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="p-3 font-semibold text-left text-gray-700">No</th>
                        @if (!auth()->user()->hasRole('Puskesmas'))
                            <th class="p-3 font-semibold text-center text-gray-700">Fasyankes</th>
                        @endif
                        <th class="p-3 font-semibold text-center text-gray-700">Kelurahan</th>
                        <th class="p-3 font-semibold text-center text-gray-700">Kelompok Usia</th>
                        <th class="p-3 font-semibold text-center text-gray-700">Jumlah Sasaran</th>
                        <th class="p-3 font-semibold text-center text-gray-700">Target Cakupan</th>
                        <th class="p-3 font-semibold text-center text-gray-700">Kebutuhan Vaksin (Dosis)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDosis = 0;
                    @endphp

                    @foreach($this->form3Answers as $form3Answer)
                        @php
                            $villageTarget = floatval($form3Answer->village_target);
                            $coverage = isset($this->coverage_target[$form3Answer->id])
                                        ? floatval($this->coverage_target[$form3Answer->id])
                                        : null;

                            $dosis = ($coverage !== null && $villageTarget)
                                        ? $villageTarget * $coverage / 100
                                        : null;

                            if ($dosis !== null) {
                                $totalDosis += $dosis;
                            }
                        @endphp
                        <tr class="transition-colors duration-200 border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-3 text-center">{{ $loop->iteration }}</td>
                            @if (!auth()->user()->hasRole('Puskesmas'))
                                <td class="p-3 text-center">{{ $form3Answer->fasyankes->name }}</td>
                            @endif
                            <td class="p-3 text-center">{{ $form3Answer->village_name }}</td>
                            <td class="p-3 text-center">{{ $form3Answer->age_group }}</td>
                            <td class="p-3 text-center">
                                {{ $form3Answer->village_target ?? '-' }}
                            </td>
                            <td class="p-3 text-center">
                                @if (auth()->user()->hasRole('Puskesmas'))
                                    <select 
                                        wire:model.defer="coverage_target.{{ $form3Answer->id }}"
                                        wire:change="updateCoverageTarget('{{ $form3Answer->id }}', $event.target.value)" 
                                        class="px-2 py-1 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    >
                                        <option value="">Pilih</option>
                                        <option value="95">95 %</option>
                                        <option value="100">100 %</option>
                                    </select>
                                @else
                                    {{ $this->coverage_target[$form3Answer->id] ?? '-' }}
                                @endif
                            </td>
                            <td class="p-3 font-semibold text-center text-gray-800">
                                {{ $dosis !== null ? number_format($dosis, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @endforeach

                    {{-- Baris Total --}}
                    <tr class="font-bold bg-gray-100 border-t border-gray-300">
                        @php
                            // Hitung jumlah kolom sebelum kolom dosis
                            $emptyCells = auth()->user()->hasRole('Puskesmas') ? 6 : 7;
                        @endphp

                        @for ($i = 1; $i < $emptyCells; $i++)
                            <td></td>
                        @endfor

                        <td class="p-3 text-center text-indigo-700">
                            <div class="text-sm font-semibold text-gray-600">Total</div>
                            {{ number_format($totalDosis, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-filament-panels::page>
