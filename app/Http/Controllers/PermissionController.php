<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission; 

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware; 

class PermissionController extends Controller implements HasMiddleware
{
    /**/


    public static function middleware()
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }





    public function index(){

        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);

        return view('permissions.list',['permissions' => $permissions]);
        
    }
    //
    public function create(){
        return view('permissions.create');
    }
    //
    public function store(Request $request){

        $validator = Validator::make($request->all(),[

            'name' => 'required|unique:permissions|min:3',
        ]);

        if($validator->passes()){
            Permission::create(['name' => $request->name]);

            return redirect()->route('permissions.index')->with('success','permission ajoute avec succes');
     
            
        }else {
            # code...
            return redirect()->route('permissions.create')->withInput()->withErrors($validator );
        }
      
 
        
    }
    //
    public function edit($id){
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',['permission' => $permission]);
       
    }
    //
    public function update($id,Request $request){

        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(),[

            'name' => 'required|unique:permissions,name,'.$id.',id|min:3',
        ]);

        if($validator->passes()){
           // Permission::create(['name' => $request->name]);
           $permission->name = $request->name;
           $permission->save();

            return redirect()->route('permissions.index')->with('success','mise a jour effectue avec succes');
     
            
        }else {
            # code...
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator );
        }
        
    }
    //
    public function destroy(Request $request){
       $id = $request->id;
        $permission = $request = Permission::find($id); 
        if($permission == null){
            session()->flash('error','permission not found');
            return response()->json([
                'status' => false
            ]);

        }
        $permission->delete();

     
            session()->flash('success','permission delete success');
            return response()->json([
                'status' => true
            ]);

        
    }
}
