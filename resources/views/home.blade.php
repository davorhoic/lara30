<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    @if (auth()->check())
        <p>Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</p>
    @else
        <p>Please <a href="/login">login</a>.</p>
    @endif



</x-layout>