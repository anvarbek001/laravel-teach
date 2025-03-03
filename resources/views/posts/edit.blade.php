<x-layouts.main>
    <x-slot name="title">Edit post</x-slot>
    <div id="box">
        <h5>Post-{{ $post->id }} ni o'zgartirish</h5>
        <form class="input-group" action="{{ route('posts.update',['date' => $post->created_at->format('Y-m-d'), 'slug' => $post->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label>
                <input class="form-control" type="text" name="title" placeholder="Post title" value="{{ $post->title }}">
                @error('title')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <label class="mx-2">
                <input class="form-control" type="text" name="short_content" placeholder="Short_content" value="{{ $post->short_content }}">
                @error('short_content')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <label>
                <input class="form-control" type="file" name="photo" placeholder="Photo" value="{{ $post->photo }}">
                @error('photo')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </label>
            <div id="post">
                <textarea name="content" id="post" cols="50" rows="5" placeholder="Content">{{ $post->content }}</textarea>
                @error('content')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-dark">submit</button>
            </div>
        </form>
    </div>
</x-layouts.main>
