<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\withFileUploads;

class CreatePost extends Component
{
        use withFileUploads;
        public $image;
        public $titulo, $contenido;
        public $isOpen=false;
        protected $rules=[
            'titulo'=>['required', 'string', 'min:3','unique:posts,titulo'],
            'contenido'=>['required','string','min:8'],
            'image'=>['required','image','max:1024']
        ];
        public function render(){
            return view('livewire.create-post');
        }
    
        public function guardar(){
            $this->validate();
            //hemos pasado las validaciones
            //1.-Guardamos la imagen en el disco
            //como estamos usando el driver public lo guardará
            //en public, en una carpeta posts que creará
            $imagen=$this->image->store('posts');

            //2.-Guardamos el registro en la BBDD.
            Post::create([
                'titulo'=>ucfirst($this->titulo),
                'contenido'=>ucfirst($this->contenido),
                //en la variable $imagen esta la ruta de la propia imagen, que es lo que queremos guardar
                //es un archivo, asi que no usamos el this, usamos la url 
                'image'=>$imagen
            ]);
             //resetea las variables con sus valores iniciales
        $this->reset(['isOpen', 'titulo', 'contenido','image']);
            //necesito que el showpost se renderice
            //para ello creamos un listener que solo lo escuche show.posts
            //y para las alertas un listener para todos los sitios
            $this->emitTo('show-posts','renderizarPosts');

            //evento para las alertas de crear post
            $this->emit('alerta','Post creado con éxito');

        }
}
