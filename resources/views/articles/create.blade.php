<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}/create
            </h2>
                <a href={{route('articles.index')}} class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">back</a>
           </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articles.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">titre </label>
                            <div class="my-3">
                                <input value="{{old('title')}}" type="text" placeholder="enter title"  name="title" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('title')
                                
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">author </label>
                            <div class="my-3">
                                <input value="{{old('author')}}" type="text" placeholder="enter author"  name="author" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('author')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Content</label>
                            <div class="my-3">

                                <textarea name="text" id="text" placeholder="content" class="border-gray-300 shadow-sm w-1/2 rounded-lg" cols="30" rows="10">{{old('text')}}</textarea>
                               
                                @error('content')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>



                           <div class="grid grid-cols-4 mb-3"> 
{{--
                            @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission )
                            <div class="mt3">
                                <input type="checkbox" name="permission[]" id="{{$permission->id}}" class="rounded" value="{{$permission->name}}">
                                <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                            </div>
                            @endforeach
                                
                            @endif
--}}
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white"> submit</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
