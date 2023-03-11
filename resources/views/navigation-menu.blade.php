<div class="navbar bg-base-200">
  <div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost lg:hidden">
        <i class="fas fa-bars"></i>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="{{ route('posts.index') }}">{{ __('Feed') }}</a></li>
        <li><a href="{{ route('posts.history') }}">{{ __('Seus posts') }}</a></li>
        <li><a href="{{ route('posts.followed') }}">{{ __('Seguindo') }}</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost normal-case text-xl" href="{{ route('index') }}">{{ __('Recomende Séries e Filmes') }}</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a href="{{ route('posts.index') }}">{{ __('Feed') }}</a></li>
      <li><a href="{{ route('posts.history') }}">{{ __('Seus posts') }}</a></li>
      <li><a href="{{ route('posts.followed') }}">{{ __('Seguindo') }}</a></li>
</ul>
  </div>
  <div class="navbar-end">
    <a class="btn btn-success" href="{{ route('posts.create') }}"><i class="fas fa-plus mr-1"></i> Novo Post</a>
  </div>
</div>