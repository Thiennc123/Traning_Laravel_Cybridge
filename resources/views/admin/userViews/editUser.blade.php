@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">


            <h5>edit User</h5>

        </nav>
    </div>
    <div class="info row " style="display: flex;justify-content: center;">

        <form class="w-50" action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                    placeholder="Enter name" name="name" value="{{ $user->name }}">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                    placeholder="Enter email" name="email" value="{{ $user->email }}">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password"
                    name="password">
            </div>

            {{-- <div class="form-group">
                <label for="exampleInputPassword1">Roles</label>
                <select name="role_id[]" class="form-control select_2" multiple>
                    @foreach ($listRoles as $role)
                        <option value="{{ $role->id }}" {{ $roleUsers->contains('id', $role->id) ? 'selected' : '' }}>

                            {{ $role->name }}

                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
