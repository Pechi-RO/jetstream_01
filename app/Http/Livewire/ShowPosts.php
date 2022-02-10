<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search="";
    public $campo="id";
    public $orden="desc";
    public $isOpen=false;
    public $image;

    //listeners
    protected $listeners=['renderizarPosts'=>'render'];//['render] eso significa que el evento y funcion comparten el nombre y ahorramos lineas de codigo
    //validacion
    protected $rules=[
        'post.titulo'=>'',
        'post.contenido'=>['required','string','min:8'],
        'image'=>['null','required','max:1024']
    ];
    
    public function mount(){
        $this->post=new Post;

    }

    public function render()
    {
        $posts=Post::orderBy($this->campo,$this->orden)
        ->where('titulo','like',"%{$this->search}%")
        ->orWhere('contenido','like',"%{$this->search}%")
        ->paginate(3);
        return view('livewire.show-posts',compact('posts'));
    }
    public function ordenar(String $campo)
    {
        if ($campo == $this->campo) {
            $this->orden = ($this->orden == 'desc') ? 'asc' : 'desc';
        }
        $this->campo = $campo;
    }
    public function borrar(Post $post){
        //borro fisicamente la img asociada al post
        Storage::delete($post->image);
        //elimino el post
        $post->delete();
        //emitimos una alerta
        $this->emit("alerta",'Post borrado');
    }


    public function mostrarEdit(Post $post){
        $this->isOpen=true;
        $this->post=$post;

    }

    public function update(){
        //validamos
        //al entrar aqui $this->post tiene datos 
        //asi que ya podemos escribir la validacion que faltaba
        $this->validate([
            'post.titulo'=>['required', 'string', 'unique:posts,titulo,'.$this->post->id]
        ]);
        //comprobamos si he subido una imagen nueva
        //si es asi debemos borrar la antigua
        //si hay image en 4this es que ha subido nueva
        if($this->image){
            //hemos subido una imagen
            //borramos la antigua
            Storage::delete($this->post->image);
            //guardo la nueva
            $imagenNueva=$this->image->store('posts');
            $this->post->image=$imagenNueva;
        }
        $this->post->save();
        //reseteamos
        $this->reset(['isOpen','image']);       
        $this->emit('alerta','Post modificado con éxito');
    }
    
}