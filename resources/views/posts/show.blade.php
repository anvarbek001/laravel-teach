<x-layouts.main>
    <x-slot name="title">Show post</x-slot>
    <div class="container">
        <div class="row">
            <div class="col text-center w-100 p-5">
                <p>Created: <span>{{ $post->created_at->format('Y-m-d') }}</span></p>
                <h1>{{ $post->title }}</h1>
                <p><strong>Published on:</strong> {{ $post->created_at->format('Y-m-d') }}</p>
                <img style="width: 20%;" src="{{ asset('storage/' . $post->photo) }}" alt="photo">
                <h3 class="mb-3">{{ $post->short_content }}</h3>
                <p class="mb-3">{{ $post->content }}</p>
                <div class="btn-box">
                    @auth
                        @if (auth()->user()->hasRole('seller'))
                            <a type="button" href="{{ route('posts.create') }}" class="btn btn-outline-success">Create</a>
                            <a href="{{ route('posts.edit', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}"
                                type="button" class="btn btn-success">Edit</a>
                            <form
                                action="{{ route('posts.destroy', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}"
                                method="POST" onsubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        @endif
                    @else
                        <a type="button" href="{{ route('login') }}" class="btn btn-outline-success">Kirish</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
