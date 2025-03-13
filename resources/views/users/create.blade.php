<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}/create
            </h2>
                <a href={{route('users.index')}} class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">back</a>
           </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">name </label>
                            <div class="my-3">
                                <input value="{{old('name')}}" type="text" placeholder="enter name"  name="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('name')
                                
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">email </label>
                            <div class="my-3">
                                <input value="{{old('email')}}" type="text" placeholder="enter email"  name="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('email')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">password </label>
                            <div class="my-3">
                                <input value="{{old('password')}}" type="password" placeholder="enter password"  name="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('password')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                           
                            <label for="" class="text-lg font-medium">confirm password </label>
                            <div class="my-3">
                                <input value="{{old('confirm_password')}}" type="password" placeholder="confirm password"  name="confirm_password" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                                @error('confirm_password')
                                    <p class="text-red-400 font-medium"> {{$message}} </p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 mb-3"> 

                                @if ($roles->isNotEmpty())
                                @foreach ($roles as $role )
                                <div class="mt3">
                                    <input type="checkbox" name="role[]" id="role-{{$role->id}}" class="rounded" value="{{$role->name}}">
                                    <label for="role-{{$role->id}}">{{$role->name}}</label>
                                </div>
                                @endforeach
                                    
                                @endif
    
                                </div>



                           <div class="grid grid-cols-4 mb-3"> 

                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white"> submit</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
