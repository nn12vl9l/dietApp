<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 py-4 bg-white shadow-md rounded-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">Comment Edit</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('posts.comments.update', [$post, $comment]) }}" method="POST"
            enctype="multipart/form-data" class="rounded px-8 pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="comment">
                    コメント
                </label>
                <textarea name="comment" rows="3"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3">{{ old('comment', $comment->comment) }}</textarea>
            </div>
            <input type="submit" value="更新"
                class="w-full bg-gradient-to-r from-green-300 to-green-400 hover:bg-gradient-to-l hover:from-green-600 hover:to-green-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
