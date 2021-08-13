@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="float-right mr-4 col-4">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-xs btn-info pull-right">Add Admin</a>

                {{-- <a href="{{ route('admin.admins.download') }}" class="btn btn-xs btn-info pull-right">Download User</a> --}}
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

                @foreach ($admins as $admin)


                    <tr class="thien1">
                        <td class="text-center">{{ $admin->id }}</td>
                        <td class="text-center">
                            {{ $admin->name }}
                        </td>
                        <td class="text-center d-flex">






                            <a href=" {{ route('admin.admins.edit', ['admin' => $admin->id]) }}"
                                class="btn btn-info">Edit</a>

                            <form action="{{ route('admin.admins.destroy', ['admin' => $admin->id]) }}" method="POST">
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
