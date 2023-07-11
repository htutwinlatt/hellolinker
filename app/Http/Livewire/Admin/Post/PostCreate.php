<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class PostCreate extends Component
{
    public $post;

    protected $rules = [
        'post.title' => 'required|string|max:255',
        'post.style' => 'nullable',
        'post.body' => 'required'
    ];

    public function __construct() {
        $this->post = new Post();
    }

    public function render()
    {
        return view('livewire.admin.post.post-create',['post'=>$this->post]);
    }

    public function save(){
        $validateData = $this->validate();
        $this->post->save();
        $this->post = new Post();
    }
}
