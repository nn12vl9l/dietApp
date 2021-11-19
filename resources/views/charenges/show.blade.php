<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 py-4 bg-white shadow-md rounded-md">

        <x-flash-message :message="session('notice')" />

        <article class="mb-2">
            <div class="flex justify-between text-sm">
                <div class="flex item-center">
                    <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                        {{-- <a href="{{ route('profile.show', $charenge->user) }}"> --}}
                        {{ $charenge->user->name }}さんのチャレンジ企画</div>
                    {{-- </a> --}}
                </div>
            </div>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600 text-right">
                <span
                    class="text-purple-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $charenge->created_at ? 'NEW' : '' }}</span>
                {{ $charenge->date_diff }} に投稿
            </p>
            <p class="text-sm mb-6 md:text-base font-normal text-gray-600 text-right">
                <span class="text-red-400 font-bold">残り期間 :{{ $charenge->limit_data_diff }} 日</span>
            </p>
            <div class="mb-4">
                @if (empty($entry))
                    <form action="{{ route('charenges.entries.store', $charenge) }}" method="post">
                        @csrf
                        <input type="submit" value="このチャレンジに参加する"
                            onclick="if(!confirm('このチャレンジに参加しますか？')){return false};"
                            class="w-full flex justify-center bg-gradient-to-r from-pink-400 to-red-500 hover:bg-gradient-to-l hover:from-pink-600 hover:to-red-400 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                    </form>
                @else
                    <form action="{{ route('charenges.entries.destroy', [$charenge, $entry]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="参加中" onclick="if(!confirm('参加を取り消しますか？')){return false};"
                            class="w-full flex justify-center bg-gradient-to-r from-pink-400 to-red-500 hover:bg-gradient-to-l hover:from-pink-600 hover:to-red-400 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                    </form>
                @endif
            </div>
            <h2 class="text-gray-600 pt-3 pb-1 text-3xl md:text-4xl">
                {{ $charenge->title }}</h2>
            <img src="{{ $charenge->image_url }}" alt="" class="container mx-auto mb-4 md:w-4/5 sm:auto">
            <p class="text-gray-700 text-base">{!! nl2br(e($charenge->body)) !!}</p>
        </article>

        <div class="flex flex-row text-center my-4">
            @can('update', $charenge)
                <a href="{{ route('charenges.edit', $charenge) }}"
                    class="bg-gradient-to-r from-blue-300 to-blue-400 hover:bg-gradient-to-l hover:from-blue-500 hover:to-blue-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32 sm:mr-2 mb-2 sm:mb-0">編集</a>
            @endcan
            @can('delete', $charenge)
                <form action="{{ route('charenges.destroy', $charenge) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-gradient-to-r from-red-300 to-red-400 hover:bg-gradient-to-l hover:from-red-500 hover:to-red-500 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                </form>
            @endcan
        </div>
        <div>
            @foreach ($posts as $post)
            @if ($post->charenge_id == $charenge->id)
                <hr class="my-4">
                <a href="{{ route('posts.show', $post) }}">
                <div class="flex">
                    <img src="{{ $post->user->profile_photo_url }}" class="rounded-full mr-4 mt-2 mb-2">
                    <div>
                        <p class="text-xl">{{ $post->user->name }}</p>
                        <p class="text-sm">体重:{{ $post->user->weight }}kg</p>
                        <p class="text-sm">目標体重:{{ $post->user->terget_weight }}kg</p>
                    </div>
                </div>
                <p>{{ $post->post_day }}</p>
                <img src="{{ $post->image_url }}" class="container mx-auto mb-4 md:w-1/2 sm:auto">
                <p class="text-center mb-6">{{ $post->body }}</p>
                </a>
                {{-- <form action="{{ route('charenges.comments.store', $charenge) }}" method="post"
                    class="flex">
                    @csrf
                    <input type="hidden" name="post" value="{{ $post->id }}">
                    <input type="text" placeholder="コメントを入力する" name="comment" value="{{ old('comment') }}"
                        class="container mx-auto md:w-1/2 rounded-full mr-3">
                    <input type="submit" value="送信"
                        class=" justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 sm:w-20">
                </form> --}}
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
