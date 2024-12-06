@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
   
    <div class="flex justify-center pt-20">
        <h1 style="z-index: -10;" class="relative text-4xl font-extrabold text-gray-800 bg-white px-4 py-2 shadow-lg rounded-md inline-block mb-4">
            Administrative Dashboard
            <span class="absolute inset-0 -z-10 bg-gradient-to-r  rounded-md blur-lg z-0"></span>
        </h1>
    </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold mb-6 ">Administrative Dashboard</h2>
            @csrf
            <div class="mb-3">
                        <label for="postId" class="block text-gray-700 font-bold mb-2">Post ID/URL</label>
                        <input type="text" id="postId" name="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="URL encoded title" required readonly disabled>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
                <textarea id="body" name="body" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                @error('body')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image (optional)</label>
                <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('image')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit Post
                </button>
            </div>
        </form>
        {{-- Section for displaying contact form messages    --}}
        <div class="bg-white darkmode shadow rounded-lg p-6 mb-2">
        <div class="border-b pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Contact Form Messages</h2>
        </div>
        <div>
            @if ($contacts->isEmpty())
                <p class="text-gray-500">No messages found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->phone }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->message }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('title');
            const postIdInput = document.getElementById('postId');

            titleInput.addEventListener('input', function () {
                let titleValue = titleInput.value.trim();

                // Convert to lowercase
                let postIdValue = titleValue.toLowerCase();

                // Replace spaces with dashes
                postIdValue = postIdValue.replace(/\s+/g, '-');

                // Encode special characters for URLs
                postIdValue = encodeURIComponent(postIdValue);

                // Set the postId input value
                postIdInput.value = postIdValue;
            });
        });
</script>


@endsection
