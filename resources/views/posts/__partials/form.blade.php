<div class="mt-3 flex flex-col justify-center items-center">
    <div class="p-5 card w-96 bg-base-100 shadow-xl">
        <div class="mb-3 text-center text-lg">
            <h1>{{ $title . ' ' . __('Post') }}</h1>
        </div>
        <form action="{{ $route }}" method="POST">
            @csrf
            <div class="mb-3">
                <select required id="type" name="type" class="select select-bordered w-full">
                    <option disabled selected>{{ __("Escolha um tipo") }}</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $post->type_id ?? old('type') == $type->id ? 'selected' : '' }}>{{ __($type->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <select required id="gender" name="gender" class="select select-bordered w-full">
                    <option disabled selected>{{ __("Escolha um gênero") }}</option>
                    @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" {{ $post->gender_id ?? old('gender') == $gender->id ? 'selected' : '' }}>{{ __($gender->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <input type="text" id="name" name="name" placeholder="{{ __("Título") }}" value="{{ $post->name ?? old('name') }}" class="input input-bordered w-full"/>
            </div>

            <div class="text-center">
                <button type="submit" class="btn w-full">{{ $title }}</button>
            </div>
        </form>
    </div>
</div>
