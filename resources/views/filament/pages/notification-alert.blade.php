<x-filament-panels::page>


    <x-filament-widgets::widgets
        {{-- :columns="$this->getColumns()" --}}
        :columns="1"
        :data="
            [
                ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
                ...$this->getWidgetData(),
            ]
        "
        :widgets="$this->getVisibleWidgets()"
    />
</x-filament-panels::page>
