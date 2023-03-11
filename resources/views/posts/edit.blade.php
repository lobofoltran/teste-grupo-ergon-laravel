@extends('layouts.app')

@section('content')
    @include('posts.__partials.form', ['title' => __('Editar'), 'route' => route('posts.update', $post->id), 'post' => $post])
@endsection