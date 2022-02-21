<div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl">
    <div class="flex content-center m-4">
        <h1 class="text-2xl text-gray-900 ">
            {{$title}}
        </h1>
    </div>
    <a href="{{App\Models\Category::indexRoute()}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
        <em class="fas fa-arrow-circle-left flex self-center"></em> {{trans('dashboard.back')}}
    </a>
</div>
@if($isEdit)
<div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl mt-4">
    <div class="flex content-center gap-6">
        <div class="flex-shrink-0 w-24 h-24">
            <img class="w-full h-full rounded-full"
                 src="{{$category->image_route}}"
                 alt="{{ $category->name }}" />
        </div>
        <div class="flex flex-col justify-center">
            <h1 class="text-2xl text-gray-900 ">
                {{ $category->name }}
            </h1>
        </div>
    </div>
</div>
@endif
<form action="{{$route}}" method="POST" enctype="multipart/form-data" class="p-5 shadow-md  bg-white rounded-xl mt-4">
    @csrf
    @if($isEdit)
        @method('PATCH')
    @endif
    <div class="grid grid-cols-2 gap-6 gap-y-8 h-full">
        <div>
            <x-label for="name" :value="trans('register.name')" />

            <x-input id="name" class="block w-full" type="text" name="name" value="{{$category->name}}" required autofocus />
            @error('name')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror

        </div>
        <div class="w-full flex justify-center flex-col">
            <x-label for="image" :value="trans('register.image')" />
            <input type="file" name="image" id="">
            @error('name')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-button type="submit" class="ml-4">
            {{$title}}
        </x-button>
    </div>
</form>
