<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware; 
use  Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    

/**/

    public static function middleware()
    {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:delete users', only: ['destroy']),

            // new Middleware('permission:view profile', only: ['index']),

           // new Middleware('permission:delete users', only: ['destroy']),
        ];
    }



    public function index()
    {
        //
        $users = User::latest()->paginate(10);
        return view('users.list',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::orderBy('name','ASC')->get();
        return view('users.create',[
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validator = Validator::make($request->all(),[
             'name' => 'required|min:3',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:8|same:confirm_password',
             'confirm_password' => 'required',
         ]);
 
         if($validator->fails()){
 
             return redirect()->route('users.create')->withInput()->withErrors($validator);
 
         }
         $user = new User();

         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $user->save();
 
         $user->syncRoles($request->role);
         return redirect()->route('users.index')->with('success','utilisateur ajouter avec success');
 
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = User::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();
        $hasRoles = $users->roles->pluck('id');
        return view('users.edit',[
            'user' => $users,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ]);

        if($validator->fails()){

            return redirect()->route('users.edit',$id)->withInput()->withErrors($validator);

        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success','utilisateur actualise avec success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //

        $id = $request->id;

        $users = User::find($id);
        
        if($users == null){
            session()->flash('error', 'utilisateur pas trouve ');
       
            return response()->json([
                'status' => false
            ]);
        }

        $users->delete();
        session()->flash('success', 'utilisateur supprime avec succes ');
        return response()->json([
            'status' => true
        ]);
            
    }
}




