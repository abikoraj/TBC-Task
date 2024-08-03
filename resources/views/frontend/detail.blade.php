<x-frontend-layout>
    <div class="bg-white">
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative">
            <div class="bg-cover bg-center text-center overflow-hidden"
                style="min-height: 500px; background-image: url('{{ $post->imagePath }}');"
                title="Woman holding a mug">
            </div>
            <div class="max-w-3xl mx-auto">
                <div
                    class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                        <h1 href="#" class="text-gray-900 font-bold text-3xl mb-2">
                            {{ $post->title }}
                        </h1>
                        <p class="text-gray-700 text-xs mt-2">Written By:
                            <a href="#"
                                class="text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                                {{ $post->user->name }}
                            </a> In
                            <a href="#"
                                class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                                {{ $post->postCategory->name }}
                            </a>,
                            <a href="#"
                                class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                                {{ $post->created_at->format('M d, Y') }}
                            </a>

                        </p>

                        <div class="text-base leading-8 my-5">
                            {!! $post->body !!}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
