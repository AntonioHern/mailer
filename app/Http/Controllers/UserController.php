<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function show($id)
    {

        return view('users.edit', ['user' => User::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->get('name');
        if ($request->get('email') != $usuario->email){
            $usuario->email=$request->get('email');
        }
        $usuario->save();

        return back()->withStatus(__('Usuario actualizado correctamente!'));

    }

    public function store(UserRequest $request)
    {

        $usuario= new User();
        $usuario->name = $request->get('name');
        $usuario->email= $request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->save();
        return back()->withStatus(__('Usuario añadido correctamente!'));
    }


    public function destroy($id){

        User::find($id)->delete($id);

        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);

    }
}
