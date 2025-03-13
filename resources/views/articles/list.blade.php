<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
            <a href={{route('articles.create')}} class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">create</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-message></x-message>
        
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b"> 
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">titre</th>
                        <th class="px-6 py-3 text-left">author</th>
                        <th class="px-6 py-3 text-left" width="150">created</th>
                        <th class="px-6 py-3 text-left" width="180">action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($articles->isNotEmpty())
                    @foreach ($articles as $article  )
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left"> {{$article->id}}</td>
                        <td class="px-6 py-3 text-left"> {{$article->title}}</td>
                        <td class="px-6 py-3 text-left"> {{ $article->author}}</td>
                        <td class="px-6 py-3 text-left"> {{\Carbon\Carbon::parse($article->created_at)->format('d,M,Y h:m:s')}}</td>
                        <td class="px-6 py-3 text-center"> 
                            @can('edit articles')
                     <a href="{{route("articles.edit",$article->id)}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600"> Edit</a>
                         
                            @endcan
                            @can('delete articles')
                     <a href="javascript:void(0);" onclick="deletePermission({{$article->id}})" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600"> delete</a>
                           
                            @endcan
                            {{--$permission->id--}}</td>
                      </tr>
                    @endforeach
                        
                    @endif
                 
                </tbody>
               

            </table>
                <div class="my-3">
                    {{$articles->links()}}
                </div>
              
               
         
        </div>
    </div>
   
    @can('delete articles')
          <x-slot name="script">
        <script type="text/javascript">
        function deletePermission(id){
            if(confirm("are you sure you want to delete")){

                $.ajax({
                    url: '{{route("articles.destroy")}}',
                    type: 'delete',
                    data: {id: id},
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{csrf_token() }}',
                    },
                    success: function(response){
                        window.location.href = '{{route("articles.index")}}'

                    }

                })

            }
        }

        </script>
    </x-slot>           
    @endcan
</x-app-layout>
