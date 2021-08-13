@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">


            <h5>Add User</h5>

        </nav>
    </div>
    <div class="info row " style="display: flex;justify-content: center;">

        <form class="w-50" action="{{ route('admin.events.update', ['event' => $event->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                    placeholder="Enter name" name="name" value="{{ $event->name }}">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
                <input type="text" class="form-control" id="exampleInputContent" aria-describedby="ContentHelp"
                    placeholder="Enter Content" name="content" value="{{ $event->content }}">

            </div>


            <div class="form-group col-md-6">
                <label for="inputPassword4">Image</label>
                <input type="file" class="form-control" placeholder="Image" name="file" id="file"
                    onchange="getImagePreview(event)" value="1">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
