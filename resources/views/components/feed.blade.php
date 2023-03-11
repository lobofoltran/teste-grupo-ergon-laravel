<div class="mt-3 p-10 bg-base-100 rounded-2xl shadow-2xl">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight mb-3">
                @if ($post->conclued)<span class="bg-green-300 opacity-90 rounded-lg p-1"><i class="fa-solid fa-check mr-1"></i> {{ __("Concluído") }}</span>@endif
                {{ $post->name }}</h2>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="fa-solid fa-tv mr-3"></i>
                    {{ $post->type->name }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="fa-solid fa-magnifying-glass mr-3"></i>
                    {{ $post->gender->name }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="fa-regular fa-calendar mr-3"></i>
                    {{ Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d/m/Y H:i') }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="fa-solid fa-user mr-3"></i>
                    {{ $post->user->name }}
                </div>
            </div>
        </div>
        <div class="sm:flex mt-5 lg:mt-0 lg:ml-4">
            {{-- BUTTONS FOR OWNER --}}
            @if (auth()->user()->id == $post->user_id && !$post->conclued)
                {{-- EDIT AND DESTROY --}}
                @if ($post->votes->count() == 0 && $post->follows->count() == 0)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __("Editar") }}
                    </a>
                    <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$post->id}}').submit();" class="btn btn-sm btn-error ml-1">
                        <i class="fa-solid fa-trash mr-1"></i> {{ __("Excluir") }}
                    </a>

                    <form id="delete-form-{{$post->id}}" action="{{ route('posts.delete', $post->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endif
                {{-- CONCLUED --}}
                <a onclick="event.preventDefault(); document.getElementById('conclued-form-{{$post->id}}').submit();" class="btn btn-sm btn-success ml-1 mt-2 sm:m-0 sm:ml-1">
                    <i class="fa-solid fa-check mr-1"></i> {{ __("Concluir") }}
                </a>

                <form id="conclued-form-{{$post->id}}" action="{{ route('posts.conclued', $post->id) }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
            {{-- END OF BUTTONS FOR OWNER --}}

            {{-- VOTES --}}
            <div class="mt-3 sm:m-0 sm:ml-2">
                @livewire('votes-post', ['post' => $post])
            </div>
            {{-- FOLLOWS --}}
            <div class="mt-3 sm:m-0 sm:ml-2">
                @livewire('follows-post', ['post' => $post])
            </div>
        </div>
    </div>
</div>
