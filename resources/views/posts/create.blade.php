<x-layouts.main>
    <x-slot name="title">Create post</x-slot>
    <div id="box">
        <form class="input-group" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>
                <input class="form-control" type="text" name="title" placeholder="name" required>
                @error('title')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <label class="mx-2">
                <input class="form-control" type="text" name="short_content" placeholder="short_content" required>
                @error('short_content')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input class="form-control" type="file" name="photo" placeholder="file">
                @error('photo')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <div id="post">
                <textarea name="content" id="post" cols="50" rows="5" placeholder="Enter content..." required></textarea>
                @error('content')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-dark">submit</button>
            </div>
        </form>
    </div>
</x-layouts.main>
