<x-app-layout>

    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gráficos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="p-6 text-gray-900">

                        <h1 class="text-2xl font-bold mb-4"></h1>
                        {!! $chart->renderHtml() !!}

                        {!! $chart->renderChartJsLibrary() !!}
                        {!! $chart->renderJs() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>