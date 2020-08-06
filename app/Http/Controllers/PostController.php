<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function show(Post $post){

        return view('blog-post', ['post'=>$post]);
    }

    public function index(){

      // $posts = Post::all(); //shows all the posts
        //$posts = auth()->user()->posts; //shows all the posts of logged in user
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(){
        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image'=>'file',
            'body' => 'required'
       ]);

     /* if($file = request('post_image')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $inputs['post_image'] = "images/".$name;
        }*/
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
      auth()->user()->posts()->create($inputs);
      session()->flash('post-created-message', 'Post with title was created '. $inputs['title']); //using flash to display messages in a session using helper function
      return redirect()->route('post.index');
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image'=>'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->post_image = $inputs['post_image'];
        /* save post with it belonging to logged in user
        auth()->user()->posts()->save($post); //the save function needs a class instance and not an array which is why we cant used $index here
        */
        $this->authorize('update', $post);//using policy PostPolicy
        $post->update(); //can also use $post->save();
        session()->flash('post-updated-message', 'Post with title was updated '. $inputs['title']); //using flash to display messages in a session using helper function
        return redirect()->route('post.index');

     }

    public function edit(Post $post){
        $this->authorize('view', $post); //restricting view through policy
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');//using flash to display messages in a session using session class
        return back();
    }
}
