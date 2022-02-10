<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-3/4 p-4 bg-teal-300 shadow rounded mx-auto">
                <x-form action="{{route('contacto.procesar')}}">
                <x-form-input name="nombre" label="Nombre" placeholder="Su nombre"/>
                <x-form-textarea name="mensaje" label="Mensaje" placeholder="Su mensaje"/>
            
                <x-form-submit><i class="fas fa-solid fa-paper-plane"></i> Enviar</x-form-submit>
            </x-form>
            </div>
        </div>
    </div>
</x-app-layout>