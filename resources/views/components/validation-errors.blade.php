@if ($errors->any())
    <div class="g:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-gray-100 border-l-4 border-red-500 text-red-700 p-4 my-2" role="alert">
        <p>
            <b>{{ count($errors) }}件のエラーがあります。</b>
        </p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
