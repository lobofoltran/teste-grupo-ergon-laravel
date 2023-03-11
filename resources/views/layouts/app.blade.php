@extends('layouts.base')

@section('body')
    @extends('navigation-menu')

    @yield('content')
    
    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
