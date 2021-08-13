@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="float-right mr-4 col-4">
                <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-info pull-right">Add User</a>

                <a href="{{ route('admin.users.download') }}" class="btn btn-xs btn-info pull-right">Download User</a>
            </div>

        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope=" col" style="width:5%" class="text-center">ID</th>
                    <th scope="col" style="width:20%" class="text-center">Name</th>
                    <th scope="col" style="width:20%" class="text-center"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)


                    <tr class="thien1">
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">
                            {{ $user->name }}
                        </td>
                        <td class="text-center d-flex">






                            <a href=" {{ route('admin.users.edit', ['user' => $user->id]) }}"
                                class="btn btn-info">Edit</a>

                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return  confirm('Are you sure?')"
                                    class="btn btn-danger">Delete</button>
                            </form>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('sweetalert::alert')
    </div>

    <!--Model add type-->


    <!--Modal add product-->

    <!-- Button trigger modal -->


    <!-- Modal -->

@endsection
