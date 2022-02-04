<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withFileUploads;

class CreatePost extends Component
{
        use withFileUploads;
        public $image;
        public $isOpen=false;
        public function render(){
            return view('livewire.create-post');
        }
    
}
