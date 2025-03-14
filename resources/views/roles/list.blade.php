<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
       @can('create roles')
            <a href={{route('roles.create')}} class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">create</a>
     
       @endcan    
             </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-message></x-message>
        
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b"> 
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">name</th>
                        <th class="px-6 py-3 text-left">permission</th>
                        <th class="px-6 py-3 text-left" width="150">created</th>
                        <th class="px-6 py-3 text-left" width="180">action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($roles->isNotEmpty())
                    @foreach ($roles as $role  )
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left"> {{$role->id}}</td>
                        <td class="px-6 py-3 text-left"> {{$role->name}}</td>
                        <td class="px-6 py-3 text-left"> {{ $role->permissions->pluck('name')->implode(',')}}</td>
                        <td class="px-6 py-3 text-left"> {{\Carbon\Carbon::parse($role->created_at)->format('d,M,Y h:m:s')}}</td>
                        <td class="px-6 py-3 text-center"> 
                            @can('edit roles')
                     <a href="{{route("roles.edit",$role->id)}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600"> Edit</a>
                           
                            @endcan

                            @can('delete roles')
                     <a href="javascript:void(0);" onclick="deletePermission({{$role->id}})" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600"> delete</a>
                           
                            @endcan
                          {{--$permission->id--}}</td>
                      </tr>
                    @endforeach
                        
                    @endif
                 
                </tbody>
               

            </table>
                <div class="my-3">
                    {{$roles->links()}}
                </div>
              
               
         
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
        function deletePermission(id){
            if(confirm("are you sure you want to delete")){

                $.ajax({
                    url: '{{route("roles.destroy")}}',
                    type: 'delete',
                    data: {id: id},
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{csrf_token() }}',
                    },
                    success: function(response){
                        window.location.href = '{{route("roles.index")}}'

                    }

                })

            }
        }

        </script>
    </x-slot>
</x-app-layout>
