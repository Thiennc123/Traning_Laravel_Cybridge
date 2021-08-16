@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">


            <h5>Confirm Event</h5>

        </nav>
    </div>
    <div class="info row " style="display: flex;justify-content: center;">

        <form class="w-50" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                    placeholder="Enter name" name="name" value="{{ $_COOKIE['name'] }}" disabled>

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
                <input type="text" class="form-control" id="exampleInputContent" aria-describedby="ContentHelp"
                    placeholder="Enter Content" name="content" value="{{ $_COOKIE['content'] }}" disabled>

            </div>

            <input type="hidden" name="file" value="{{ $_COOKIE['image'] }}">
            <div class="form-group col-md-6">
                <img class="card-img-top h-50" src="{{ asset('storage/tmp/' . $_COOKIE['image']) }}" alt="Card image cap">
            </div>







            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
