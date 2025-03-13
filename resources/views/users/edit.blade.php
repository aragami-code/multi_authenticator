<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}/edit
            </h2>
                <a href={{route('users.index')}} class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">back</a>
           </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update',$user->id)}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">nom </label>
                            <div class="my-3">
                                <input value="{{old('name',$user->name)}}" type="text" placeholder="enter le nom"  name="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('name')
                                
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">email </label>
                            <div class="my-3">
                                <input value="{{old('author',$user->email)}}" type="text" placeholder="enter mail"  name="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('email')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                           



                           <div class="grid grid-cols-4 mb-3"> 

                            @if ($roles->isNotEmpty())
                            @foreach ($roles as $role )
                            <div class="mt3">
                                <input {{($hasRoles->contains($role->id))? 'checked' : '' }} type="checkbox" name="role[]" id="role-{{$role->id}}" class="rounded" value="{{$role->name}}">
                                <label for="role-{{$role->id}}">{{$role->name}}</label>
                            </div>
                            @endforeach
                                
                            @endif

                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white"> submit</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
