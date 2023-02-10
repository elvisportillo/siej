<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB as DB;

class RoleController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:mostrar-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index','store']]);
        $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }
    
    
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    
    public function create()
    {
        $permisos = Permission::get();
        return view('roles.crear',compact('permisos'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'description' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name'), 'description' => $request->input('description')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.editar',compact('role','permission','rolePermissions'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}