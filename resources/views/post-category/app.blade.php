<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto py-2">
                        <h2 class="text-2xl font-semibold">Post Categories</h2>
                        <hr class="my-4">

                        <h5 class="text-gray-600 font-semibold">Add New Category</h5>
                        <form action="{{ route('post-categories.store') }}" method="post" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-3">
                                    <input type="text" name="name"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Enter Category Name" required value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="md:col-span-1">
                                    <button type="submit"
                                        class="btn btn-outline-success px-4 py-2 w-full bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Add</button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">
                        <h5 class="text-gray-600 font-semibold">Category List</h5>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-100 border-b border-gray-200 text-left">
                                        <th class="py-2 px-4">#Id</th>
                                        <th class="py-2 px-4">Name</th>
                                        <th class="py-2 px-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="border-b border-gray-200">
                                            <form
                                                action="{{ route('post-categories.update', ['postCategory' => $category->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <td class="py-2 px-4 ">{{ $category->id }}</td>
                                                <td class="py-2 px-4">
                                                    <input type="text"
                                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                        name="name" placeholder="Category Name" required
                                                        value="{{ $category->name }}">
                                                </td>
                                                <td class="py-2 px-4  flex space-x-2">
                                                    <button type="submit"
                                                        class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Update</button>
                                                    <a href="{{ route('post-categories.destroy', ['postCategory' => $category->id]) }}"
                                                        class="btn btn-danger bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300">Delete</a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
