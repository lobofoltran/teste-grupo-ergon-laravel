@extends('layouts.guest')

@section('content')
    <div class="hero min-h-screen" style="background-image: url({{ Vite::asset('resources/images/hero.png') }})">
        <div class="hero-overlay bg-opacity-20"></div>
            <div class="hero-content text-center text-neutral-content p-10 bg-gray-900 border-gray-300 border-2 rounded-2xl bg-opacity-90">
                <div class="max-w-xl">
                    <h1 class="mb-5 text-5xl font-bold">{{ __("Encontre o que assistir") }}</h1>
                    <p class="mb-5">{{ __("Está cansado de nunca achar o que assistir? Acesse e faça parte da maior comunidade de recomendação de de filmes e séries") }}</p>
                    @auth
                        <a class="btn glass btn-wide" href="{{ route('posts.index') }}">{{ __("Entre no Sistema") }}</a>
                        <a class="btn glass ml-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __("Log out") }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="btn glass" href="{{ route('login') }}">{{ __("Faça Login") }}</a>
                        <a class="btn glass ml-3" href="{{ route('register') }}">{{ __("Registre-se") }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
