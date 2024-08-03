<x-frontend-layout>
    <div class="bg-white py-2">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex justify-between items-center mx-auto max-w-2xl lg:mx-0">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Latest Posts</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Stay updated with the latest insights and trends.</p>
                </div>
                <div>
                    <form action="{{ route('post.list') }}" method="GET" class="flex items-center">
                        <select name="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md">Filter</button>
                        <a href="{{ route('post.list') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md">Clear</a>
                    </form>
                </div>
            </div>
            <div class="mx-auto mt-10 max-w-2xl border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none">
                @foreach ($posts as $post)
                    <article class="flex flex-col items-start justify-between mb-16">
                        <div class="flex flex-col sm:flex-row gap-4 w-full">
                            <div class="flex-1 flex-shrink-0">
                                <img src="{{ $post->imagePath }}" alt="Post Image"
                                    class="w-full h-full max-h-64 object-cover rounded-lg">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div class="group relative">
                                    <h3
                                        class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                        <a href="{{ route('post.view', ['id' => $post->id]) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($post->body), 150, '...') }}</p>
                                </div>
                                <div class="relative mt-8 flex items-center gap-x-4">
                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="" class="h-10 w-10 rounded-full bg-gray-50">
                                    <div class="text-sm leading-6">
                                        <p class="font-semibold text-gray-900">
                                            <a href="#">
                                                <span class="absolute inset-0"></span>
                                                {{ $post->user->name }}
                                            </a>
                                        </p>
                                        <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>