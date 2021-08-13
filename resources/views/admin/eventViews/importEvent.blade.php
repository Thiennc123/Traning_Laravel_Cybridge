@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">


            <h5>Import Event</h5>

        </nav>
    </div>
    <div class="info row " style="display: flex;justify-content: center;">

        <form class="w-50" action="{{ route('admin.events.ImportEvent') }}" method="post" enctype="multipart/form-data">
            @csrf




            <div class="form-group col-md-6">
                <label for="inputPassword4">Image</label>
                <input type="file" class="form-control" placeholder="Image" name="file" id="file"
                    onchange="getImagePreview(event)" value="1">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
