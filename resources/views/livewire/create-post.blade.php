<div>
    <button wire:click="$set('isOpen','true')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    <i class="fas fa-plus"></i>Nuevo Post
</button>
<x-jet-dialog-modal wire:model="isOpen">
<x-slot name="title">
Nuevo Post
</x-slot>
<x-slot name="content">
<x-jet-label value="Título del Post"/>
<x-jet-input type="text" placeholder="Título" wire:model.defer="titulo" class="my-2 mb-4 w-full" />
<x-jet-input-error for="titulo"/>
<x-jet-label value="Contenido del Post"/>
<textarea
                class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'
                placeholder='Contenido del Post' wire:model.defer="contenido"></textarea>
<x-jet-input-error for="contenido"/>

<!---Para la imagen-->
<div class="grid mt-2 grid-cols-2 gap-4">
<div>
<x-jet-label value="Imagen del Post"/>
<div class="flex justify-center">

<input class="form-control
    block
    w-full
    px-3
    py-1.5
    text-base
    font-normal
    text-gray-700
    bg-white bg-clip-padding
    border border-solid border-gray-300
    rounded
    transition
    ease-in-out
    m-0
    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    type="file" wire:model="image" accept="image/*">
    <x-jet-input-error for="image"/>


</div>
<!--Pintamos la img por defecto o la img seleccionada-->
@if($image)
<img src="{{$image->temporaryUrl()}}" class="object-cover object-center w-80">
@else
<img src="{{Storage::url('logos/no-img.png')}}" class="object-cover object-center w-80">
@endif
</div>

<div>
</div>


</div>



<!--Fin de lo de la img-->
</x-slot>
<x-slot name="footer">
<button wire:click="guardar" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
    <i class="fas fa-save"></i> Enviar
</x-slot>

</x-jet-dialog-modal>
</div>
