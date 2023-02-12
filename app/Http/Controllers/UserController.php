<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Hash as Hash;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:mostrar-usuarios|crear-usuarios|editar-usuarios|borrar-usuarios', ['only' => ['index','store']]);
        $this->middleware('permission:crear-usuarios', ['only' => ['create','store']]);
        $this->middleware('permission:editar-usuarios', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuarios', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $usuarios = User::orderBy('id','DESC')->paginate(25);
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.index',compact('usuarios', 'roles'));
    }
    
    public function subir(Request $request)
    {
        
            $name = $request->file("archivo")->getClientOriginalName();
            $request->file("archivo")->store('archivos');
            dd("subido y guardado");
        
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('usuarios.index')->with('success','User created successfully');
    }
    

    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show',compact('user'));
    }
    

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('usuarios.editar',compact('user','roles','userRole'));
    }
    

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('usuarios.index')->with('success','User updated successfully');
    }
    

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('success','User deleted successfully');
    }

    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'password'=> 'required|confirmed',
        ],[
            'password.required' => "El password no debe estar vacio",
            'password.confirmed' => "password no",
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }

        else
        {
            $password = Hash::make($request->password);
            $user = User::find(auth()->user()->id);
            $user->update(['password' => $password]);
            
        }
        
    }
}