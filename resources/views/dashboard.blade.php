<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Você está logado como " . Auth::user()->name . "!") }}


                    <div class="mt-8">
                        {!! $chart->renderHtml() !!}
                    </div>
                </div>

                <div style="margin: 20px 0;">
                    <a href="{{ route('historico.pdf') }}" style="background-color: #AE171C; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        Baixar Relatório em PDF
                    </a>
</div>
            </div>
        </div>
    </div>
    
{!! $chart->renderChartJsLibrary() !!}
{!! $chart->renderJs() !!}
</x-app-layout>
