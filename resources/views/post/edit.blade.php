<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto py-2">
                        <h2 class="text-2xl font-semibold">Edit Blog Post</h2>
                        <hr class="my-4">

                        <form action="{{ route('posts.update', $post->id) }}" method="post" class="space-y-4"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="category"
                                        class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="post_category_id" id="category"
                                        class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                        <option value="">Select Category</option>
                                        @foreach ($postCategories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $post->post_category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Enter Blog Post Title" required
                                        value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @if ($post->image)
                                        <img src="{{ $post->imagePath }}" alt="{{ $post->title }}"
                                            class="mt-2" width="150px">
                                    @endif
                                    @error('image')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="content"
                                        class="block text-sm font-medium text-gray-700">Content</label>
                                    <textarea name="body" id="content" rows="10"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Enter Blog Post Content" required>{{ old('body', $post->body) }}</textarea>
                                    @error('body')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit"
                                        class="btn btn-outline-success px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
