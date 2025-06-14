<x-filament-widgets::widget class="flex flex-col gap-3">

    {{-- filter --}}
    <div class="flex gap-2">

        <div class="flex flex-col">
            <label class="font-medium" for="year">Tahun</label>
            <select class="rounded-lg" wire:model.live="year_value" name="year" id="">
                @foreach ($this->years as $key => $year)
                    <option value="{{ $key }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->hasRole('Kemkes'))
            <div class="flex flex-col">
                <label class="font-medium" for="province">Provinsi</label>
                <select class="rounded-lg" wire:model.live="province_value" name="province" id="">
                    @foreach ($this->provinces as $key => $province)
                        <option value="{{ $key }}">{{ $province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="font-medium" for="regency">Kabupaten</label>
                <select class="rounded-lg" wire:model.live="regency_value" name="regency" id="">
                    @foreach ($this->regencies as $key => $regency)
                        <option value="{{ $key }}">{{ $regency }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="flex flex-col">
            <label class="font-medium" for="subdistrict">Kecamatan</label>
            <select wire:change="subdistrict_change" class="rounded-lg" wire:model.live="subdistrict_value" name="subdistrict" id="">
                <option value="all">Semua</option>
                @foreach ($this->subdistricts as $key => $subdistrict)
                    <option value="{{ $key }}">{{ $subdistrict }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col">
            <label class="font-medium" for="puskesmas">Puskesmas</label>
            <select wire:model.live="puskes_value" class="rounded-lg" name="puskesmas" id="">
                <option value="all">Semua</option>
                @foreach ($this->puskesmas as $key => $puskes)
                    <option value="{{ $key }}">{{ $puskes }}</option>
                @endforeach
            </select>
            <div class="flex flex-col mt-4">
                @foreach ($alerts as $alert)
                    <span>{{ $alert->fasyankes->name }}</span>
                @endforeach
            </div>
        </div>

        <span class="my-auto text-xs animate-pulse" wire:loading>Loading..</span>
    </div>

</x-filament-widgets::widget>
