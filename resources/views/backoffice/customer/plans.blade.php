<x-app-layout>
    <x-slot name="title">
        Selección de Plan
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Selección de Plan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-3 gap-3">
                @foreach ($plans as $plan)
                    <x-plan-card>
                        <div class="grid justify-center">
                            <h3 class="font-semibold text-x2">{{ $plan->name }}</h3>
                        </div>

                        <div class="grid justify-center">
                            <div class="container overflow-x-hidden">
                                {!! $plan->description !!}
                            </div>
                        </div>

                        <div class="grid justify-center">
                            <div class="grid grid-rows align-baseline">
                                <form method="POST" action="{{ route('customer.plans.store', $plan) }}">
                                    @csrf
                                    <x-button>
                                        Seleccionar
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </x-plan-card>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
