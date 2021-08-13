<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Sidebar</h2>
            <ul>
                <li><a href="{{ route('users.details') }}"><i class="fas fa-home"></i>Detail User</a></li>
                <li><a href="{{ route('events.index') }}"><i class="fas fa-user"></i>List Event</a></li>


            </ul>
            <div class="social_media">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        @include('sweetalert::alert')

        <div class="main_content">
            @yield('main_content')
        </div>

    </div>
</x-app-layout>
