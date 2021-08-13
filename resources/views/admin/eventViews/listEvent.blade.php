@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="float-right mr-4 col-4">
                <a href="{{ route('admin.events.create') }}" class="btn btn-xs btn-info pull-right">Add Event</a>

                <a href="{{ route('admin.events.showFormImport') }}" class="btn btn-xs btn-info pull-right"> Import
                    Event</a>
            </div>

        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        @foreach ($events as $event)
            <div class="card m-9" style="width: 18rem; ">
                <img class="card-img-top h-50" src="{{ asset($event->image) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->content }}</p>
                    {{-- <a href="{{ route('guests.edit', ['guest' => $event->id]) }}" class="btn btn-success">Register</a> --}}
                    <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.events.destroy', ['event' => $event->id]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" onclick="return  confirm('Are you sure?')"
                            class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>

        @endforeach






    </div>



@endsection
