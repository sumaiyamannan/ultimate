<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Registered date</th>
                    <th>Updated profile date</th>
                    <th>Delete</th>

                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Registered date</th>
                    <th>Updated profile date</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user.profile.show', $user->id)}}"> {{$user->username}}</a></td>
                    <td><img src="{{asset($user->avatar)}}" class="img-thumbnail" ></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>
                        <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>