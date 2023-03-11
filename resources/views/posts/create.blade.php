@extends('layouts.app')

@section('content')
    @include('posts.__partials.form', ['title' => __('Incluir'), 'route' => route('posts.store')])
@endsection