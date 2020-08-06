<x-admin-master>

    @section('content')
    {{-- @include('includes.tinyeditor') --}}
     <h1>Create a Post</h1>
        @if(Session::has('message'))
            <div class="alert alert-danger">{{Session ::get('message')}}</div>
        @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
        @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
        @endif

     <div class="row">
         <div class="col-sm-8">
             <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                 @csrf
                 <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="" placeholder="Enter Title">
                 </div>
                 <div>
                     @error('title')
                     <div class="alert alert-danger">{{$message}}</div>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label for="file">Featured Image</label>
                     <input type="file" name="post_image" class="form-control-file" id="post_image">
                 </div>
                 <div class="form-group">
                     <label for="body">Body</label>
                     <textarea name="body" id="body" cols="80" rows="10" class="form-control @error('body') is-invalid @enderror"></textarea>
                 </div>
                 <div>
                     @error('body')
                     <div class="alert alert-danger">{{$message}}</div>
                     @enderror
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
             </form>
         </div>
     </div>

 @endsection
</x-admin-master>
