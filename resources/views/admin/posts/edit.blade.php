<x-admin-master>

    @section('content')
        <h1>Edit a Post</h1>
        <div class="alert"></div>
        <div class="row">
            <div class="col-sm-8">
                <form method="post" id="post-form" enctype="multipart/form-data">
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="file">Featured Image</label>
                        <div><img src="{{$post->post_image}}" height="100" class="img-thumbnail" ></div>
                        <input type="file" name="post_image" class="form-control-file" id="post_image" value="{{$post->post_image}}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" cols="80" rows="10">{{$post->body}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                </form>
            </div>
        </div>
    @endsection

        @section('scripts')
            <script type="text/javascript">

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#post-form").submit(function(e){

                    e.preventDefault();

                    $.ajax({
                        type:'POST',
                        url:"{{route('post.update', $post->id)}}",
                        data        : new FormData(this),
                        contentType:false,
                        processData:false,

                        success:function(data){
                            $(".alert").html(data.success)
                            $(".alert").removeClass('alert-danger')
                            $(".alert").addClass('alert-success')
                        },
                        error:function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            console.log(errorMessage);
                            $(".alert").html(xhr.responseJSON.message)
                            $(".alert").removeClass('alert-success')
                            $(".alert").addClass('alert-danger')
                            $.each(xhr.responseJSON.errors, function (i, error) {
                                var el = $(document).find('[name="'+i+'"]');
                                el.after($('<span style="color: red;">'+error[0]+'</span>'));
                            });
                        }
                    });

                });
            </script>
        @endsection
</x-admin-master>
