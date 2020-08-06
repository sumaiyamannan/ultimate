<x-admin-master>

    @section('content')
        <h1>Edit a Post</h1>
        <div class="row">
            <div class="col-sm-8">
                <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="file">Featured Image</label>
                        <div><img src="{{$post->post_image}}" height="100" class="img-thumbnail" ></div>
                        <input type="file" name="post_image" class="form-control-file" id="post_image">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" cols="80" rows="10">{{$post->body}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    @endsection
</x-admin-master>
