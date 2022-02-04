<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    public $search="";
    public $campo="id";
    public $orden="desc";

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
    
}
