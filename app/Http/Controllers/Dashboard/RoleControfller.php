<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

class RoleController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {
        // $this->middleware('permission:role-list');
        // $this->middleware('permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $roles = Role::whereNotIn('id', [1])->get();

        return view('admin.role.index',compact('roles'))

            ->with('i', ($request->input('page', 1) - 1) * 5)->withTitle('Roles');

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $query = Permission::get();

        $permissions = array();
        foreach( $query as $q ) {
            $param = explode('-', $q->name );
            $permissions[$param[0]][] = $q;
        }

        return view('admin.role.create',compact('permissions'));

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $this->validate($request, [

            'name' => 'required|unique:roles,name',

            'permission' => 'required',

        ]);


        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')->with([
            'message' => [
                'lable' => 'success',
                'content' => 'Role created successfully'
            ]
        ]);

    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $role = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")

            ->where("role_has_permissions.role_id",$id)

            ->get();


        return view('admin.role.show',compact('role','rolePermissions'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $role = Role::find($id);

        $query = Permission::get();

        $permissions = array();
        foreach( $query as $q ) {
            $param = explode('-', $q->name );
            $permissions[$param[0]][] = $q;
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)

            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')

            ->all();


        return view('admin.role.edit',compact('role','permissions','rolePermissions'))->withTitle('Edit Role: ' . $role->name);

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required|array'

        ]);

        //validation fails
        if ( $validator->fails() )
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(Input::all());


        $role = Role::find($id);

        $role->name = $request->input('name');

        $role->save();

        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')->with([
            'message' => [
                'label' => 'success',
                'content' => 'Role updated successfully'
            ]
        ]);

    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('roles.index')->with([
            'message' => [
                'label' => 'success',
                'content' => 'Role deleted successfully'
            ]
        ]);

    }

}