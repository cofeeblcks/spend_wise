@props(['ths' => [], 'trs' => null])

<div class="flex-auto px-0 p-0">
    <div class="p-0 overflow-x-auto">
        @if( $trs == null || ($trs == '' || $trs == '<!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->' || empty($trs)))
            <div class="flex items-center m-4 text-center border rounded-lg h-96 dark:border-gray-700">
                <div class="flex flex-col w-full max-w-sm p-4 mx-auto">
                    <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h1 class="mt-3 text-lg text-gray-800 dark:text-white">{{ __('Empty registers') }}</h1>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">{{ __('Please try again or create add a new register.') }}</p>
                </div>
            </div>
        @else
            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        @foreach ($ths as $th)
                            <th class="px-6 py-3 font-bold text-sm text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-accent">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $trs }}
                </tbody>
            </table>
        @endif
    </div>
</div>
