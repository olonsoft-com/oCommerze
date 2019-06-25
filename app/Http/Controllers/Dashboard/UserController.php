<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $users = User::whereHas('roles', function($q){
            $q->whereNotIn('name', ['customer']);
        })->paginate(15);

        return view('admin.user.index', compact('users'))->withTitle('Administrators');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:password_confirm|min:8|max:32',
            'password_confirm' => 'required',
            'counter' => 'required|unique:users,counter',
            'role' => 'required|integer'
        ]);

        //validation fails
        if ( $validator->fails() )
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(Input::all());

        // dd( $request );

        //Saving data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );
        $user->counter = $request->counter;
        $user->status = 1;
        $user->save();

        if( $user->id ) {

            $role = Role::where('id', $request->role)->first();
            $user->assignRole($role); //Assigning role to user

            $redirectRoute = ( $request->role == '3' ) ? 'dashboard.artist.index' : 'dashboard.user.index';

            return redirect()->route($redirectRoute)->with([
                'message' => [
                    'label' => 'success',
                    'content' => 'User has been successfully created'
                ]
            ]);
        } else {
            return redirect()->back()->with([
                'message' => [
                    'label' => 'error',
                    'content' => 'Cannot create user'
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user )
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user )
    {
        return view('admin.user.edit', compact('user'));
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
        //form validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|max:191|unique:users,email,' . $id,
            'counter' => 'required|unique:users,counter,' . $id,
            'role' => 'required|integer'
        ]);

        //validation fails
        if ( $validator->fails() )
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(Input::all());

        //Saving data
        $user = User::findOrFail( $id );
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        $user->save();

        if( $user->id ) {
            //remove previous role
            if( $user->hasanyrole(Role::all() ) ) {
                foreach( $user->roles as $role ) {
                    $user->removeRole( $role );
                }
            }
            //assign role
            $role = Role::where('id', $request->role)->first();
            $user->assignRole($role);

            $redirectRoute = ( $request->role == '3' ) ? 'dashboard.artist.index' : 'dashboard.user.index';

            return redirect()->route($redirectRoute)->with([
                'message' => [
                    'label' => 'success',
                    'content' => 'User has been successfully updated'
                ]
            ]);
        } else {
            return redirect()->back()->with([
                'message' => [
                    'label' => 'error',
                    'content' => 'User cannot be updated'
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user )
    {
        if( Auth::user()->can('user-delete') ) {
            $user->delete();

            return redirect()->back()->with([
                'message' => [
                    'label' => 'success',
                    'content' => 'User has been successfully deleted.'
                ]
            ]);
        } else {
            return redirect()->back()->with([
                'message' => [
                    'label' => 'danger',
                    'content' => 'You have no permission to delete user.'
                ]
            ]);
        }
    }

    /**
     * Logout the user from session.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'))->with([
                'message' => [
                    'label' => 'success',
                    'content' => 'You are successfully loggedout.'
                ]
            ]);;
    }
}
