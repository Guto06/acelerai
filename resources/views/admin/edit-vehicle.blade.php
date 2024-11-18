<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #FF9800;">
            {{ __('Editar Veículo') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('admin.vehicles.update', $vehicle->id) }}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="model" :value="__('Modelo')" />
                            <x-text-input id="model" class="block mt-1 w-full" type="text" name="model"
                                value="{{ $vehicle->model }}" required autofocus />
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="brand" :value="__('Marca')" />
                            <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                                value="{{ $vehicle->brand }}" required />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="year" :value="__('Ano')" />
                            <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                                value="{{ $vehicle->year }}" required />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="power" :value="__('Potência')" />
                            <x-text-input id="power" class="block mt-1 w-full" type="number" name="power"
                                value="{{ $vehicle->power }}" required />
                            <x-input-error :messages="$errors->get('power')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Atualizar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
