@component('mail::message')
# Formulario de contacto

##Nombre


{{$datos['nombre']}}

##Email


{{$email}}


##Mensaje


{{$datos['mensaje']}}
@endcomponent