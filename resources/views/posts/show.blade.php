<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 py-4 bg-white shadow-md rounded-md">
        <x-flash-message :message="session('notice')" />

        <article class="mb-2">
            <div class="flex">
                <img src="{{ $post->user->profile_photo_url }}" class="rounded-full mr-4 mt-2 mb-2">
                <div class="mt-6 mb-3 float-left">
                    <p class="text-xl">{{ $post->user->name }}</p>
                    <p class="text-sm">体重:{{ $post->user->weight }}kg</p>
                    <p class="text-sm">目標体重:{{ $post->user->terget_weight }}kg</p>
                    <p class="text-sm">生年月日:{{ $post->user->birth_year }}</p>
                </div>
            </div>
            <img src="{{ $post->image_url }}" class="container mx-auto mb-4 md:w-1/2 sm:auto">
            <p class="text-center mb-6">{{ $post->body }}</p>
            <hr class="my-4">
        </article>

        <div class="flex flex-row text-center my-4">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}"
                    class="bg-gradient-to-r from-blue-300 to-blue-400 hover:bg-gradient-to-l hover:from-blue-500 hover:to-blue-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-20 sm:mr-2 mb-2 sm:mb-0">編集</a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-gradient-to-r from-red-300 to-red-400 hover:bg-gradient-to-l hover:from-red-500 hover:to-red-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-20">
                </form>
            @endcan
        </div>
        <section class="font-sans break-normal text-gray-900">
            @foreach ($comments as $comment)
                @if ($comment->post_id == $post->id)
                    <div class="my-2 ml-14">
                        <span class="font-bold mr-3">{{ $comment->user->name }}</span>
                        <span class="text-sm">{{ $comment->created_at }}</span>
                        <p>{!! nl2br(e($comment->comment)) !!}</p>
                        <div class="flex justify-end text-center my-4 mr-10">
                            @can('update', $comment)
                                <a href="{{ route('posts.comments.edit', [$post, $comment]) }}"
                                    class="bg-gradient-to-r from-blue-300 to-blue-400 hover:bg-gradient-to-l hover:from-blue-500 hover:to-blue-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-20 sm:mr-2 mb-2 sm:mb-0">編集</a>
                            @endcan
                            @can('delete', $comment)
                                <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                                        class="bg-gradient-to-r from-red-300 to-red-400 hover:bg-gradient-to-l hover:from-red-500 hover:to-red-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-20">
                                </form>
                            @endcan
                        </div>
                    </div>
                    <hr class="my-4">
                @endif
            @endforeach
        </section>

        <form action="{{ route('posts.comments.store', $post, $comment) }}" method="post" class="flex">
            @csrf
            <input type="hidden" name="post" value="{{ $post->id }}">
            <input type="text" placeholder="コメントを入力する" name="comment" value="{{ old('comment') }}"
                class="container mx-auto md:w-4/5 rounded-full mr-3">
            <input type="submit" value="送信"
                class=" justify-center bg-gradient-to-r from-green-300 to-green-400 hover:bg-gradient-to-l hover:from-green-600 hover:to-green-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 sm:w-20">
        </form>
    </div>
</x-app-layout>
