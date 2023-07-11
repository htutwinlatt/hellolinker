<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $postId;

    protected $rules = [
        'post.title' => 'required|string|max:255',
        'post.style' => 'nullable',
        'post.body' => 'required',
    ];

    public function render()
    {
        $this->post = Post::find($this->postId);
        return view('livewire.admin.post.post-edit', [
            'post' => $this->post,
        ]);
    }

    public function update()
    {
        $this->post->update();
    }
}
