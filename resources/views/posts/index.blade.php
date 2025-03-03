<x-layouts.main>
    <x-slot name="title">Posts</x-slot>

    <div id="container">
        <div class="container">
            <form action="">
                <input type="text" name="q" class="form-control search-input" placeholder="Search..." required>
            </form>
            <div class="btn d-flex">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-dark">Chiqish</button>
                    </form>
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary mx-2">Create</a>
                        <a type="button" class="btn btn-success" href="{{ route('send-email') }}">Email xabar yuborish</a>
                        <a type="button" class="btn btn-success" href="{{ route('sms.form') }}">sms xabar yuborish</a>
                    @endif
                    <p>{{ auth()->user()->name }}</p>
                    @if (auth()->user()->hasRole('seller'))
                        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary mx-2">Create</a>
                        <a type="button" class="btn btn-success mx-2" href="/">Account</a>
                        <a type="button" class="btn btn-success" href="{{ route('send-email') }}">Email xabar yuborish</a>
                    @endif
                    {{-- <h4 class="mx-3">{{ auth()->user() }}</h4> --}}
                @else
                    <a type="button" href="{{ route('login') }}" class="btn btn-outline-warning mx-2">Kirish</a>
                    <a type="button" href="{{ route('register') }}" class="btn btn-outline-warning mx-2">Ro'yxatdan
                        o'tish</a>
                    <a type="button" href="{{ route('seller') }}" class="btn btn-outline-warning">Sotuvchi sifatida
                        ro'yxatdan o'tish</a>
                @endauth
            </div>
            @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
            @endif
            <table class="search-result table">
                <marquee behavior="scroll" direction="left" scrollamount="7">Bu sayt test holatida ishlamoqda</marquee>
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Id</th>
                        <th scope="col">Post title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Create</th>
                        @auth
                            @if (auth()->user()->hasRole(['admin', 'seller']))
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            @endif
                        @endauth
                        <th scope="col">Read</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td scope="row">{{ $post->user->name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <img style="width: 10%;" src="{{ asset('storage/' . $post->photo) }}"><br>
                                <a
                                href="{{ route('posts.show', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}">{{ $post->short_content }}</a>
                            </td>
                            <td>
                                {{ $post->created_at }}
                            </td>
                            @auth
                                @if (auth()->user()->hasRole(['admin', 'seller']))
                                    <th><a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">✍️</a>
                                    </th>
                                    <th><a href="{{ route('posts.edit', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}"
                                            type="button" class="btn btn-success">✏️</a></th>
                                    <th>
                                        <form
                                            action="{{ route('posts.destroy', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}"
                                            method="POST" onsubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">✖️</button>
                                        </form>
                                    </th>
                                @endif
                            @endauth
                            <th><a href="{{ route('posts.show', ['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}"
                                    type="button" class="btn btn-secondary">📖</a></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            @if (session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif
        </div>

        {{ $posts->links() }}

    </div>
</x-layouts.main>
