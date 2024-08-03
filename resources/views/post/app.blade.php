<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto py-2">
                        {{-- <h2 class="text-2xl font-semibold">Blog Posts</h2> --}}
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-semibold">Blog Posts</h2>
                            <a href="{{ route('posts.create') }}"
                                class="btn btn-outline-success px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">
                                Add New
                            </a>
                        </div>
                        <hr class="my-4">
                        <h5 class="text-gray-600 font-semibold">Blog Post List</h5>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-100 border-b border-gray-200 text-left">
                                        <th class="py-2 px-4">#Id</th>
                                        <th class="py-2 px-4">Image</th>
                                        <th class="py-2 px-4">Title</th>
                                        <th class="py-2 px-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr class="border-b border-gray-200">
                                            <td class="py-2 px-4 ">{{ $post->id }}</td>
                                            <td class="py-2 px-4 "><img src="{{ $post->imagePath }}" alt=""
                                                    width="100px"></td>
                                            <td class="py-2 px-4">
                                                {{ $post->title }}
                                            </td>
                                            <td class="py-2 px-4  flex space-x-2">
                                                <a href="{{ route('posts.show', $post->id) }}"
                                                    class="btn btn-outline-primary px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">
                                                    View
                                                </a>
                                                <a href="{{ route('posts.edit', $post->id) }}"
                                                    class="btn btn-outline-warning px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-300">
                                                    Edit
                                                </a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300"
                                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="mt-6">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
