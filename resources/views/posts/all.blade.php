@extends('layouts.app')

@section('content')
<div class="p-5">
    @foreach ($posts as $post)
        <x-feed :$post></x-feed>
    @endforeach
</div>
@endsection
