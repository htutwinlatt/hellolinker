<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class PostTable extends Component
{
    public function render()
    {
        $posts = Post::select('id', 'title', 'created_at', 'updated_at')
            ->when(request('searchKey'), function ($q) {
                $q->where('title', 'like', '%' . request('searchKey') . '%')
                    ->orWhere('body', 'like', '%' . request('searchKey') . '%');
            })
            ->paginate(20);
        return view('livewire.admin.post.post-table', [
            'posts' => $posts,
        ]);
    }

    public function delete($id){
        Post::find($id)->delete();
    }
}
