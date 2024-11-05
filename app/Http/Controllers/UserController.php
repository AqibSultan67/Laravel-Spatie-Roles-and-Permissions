<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\DataTables;

class UserController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array{
    //     return [
    //         new Middleware('permission:View Users', only: ['index']),
    //         new Middleware('permission:Edit Users', only: ['edit']),
    //         new Middleware('permission:Create Users', only: ['create']),
    //         new Middleware('permission:Delete Users', only: ['destroy']),

    //     ];
    // }
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles')->get();
            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('name')->join(', ');
                })
                ->addColumn('permissions', function ($user) {
                    return $user->permissions->pluck('name')->join(', ');
                })
                ->addColumn('created_at', function ($user) {
                    return $user->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($user) {
                    $btn = '';


                    if (request()->user()->can('Edit Users')) {
                        $btn .= '<button class="btn btn-primary btn-sm editUserBtn py-2" data-id="'.$user->id.'">Edit</button>';
                    }


                    if (request()->user()->can('Delete Users')) {
                        $btn .= ' <button class="btn btn-danger btn-sm deleteUserBtn py-2" data-id="'.$user->id.'">Delete</button>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.index', compact('roles', 'permissions'));
    }




    public function store(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8',

    ]);

    DB::transaction(function () use ($request) {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        // dd('Aqib' . '23');
    });

    return response()->json(['success' => true]);
}


    public function show(User $user)
    {
        $user->load('roles' ,'permissions');
        return response()->json($user);

    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'roles' => 'array',
         'permissions' => 'array',
    ]);

    DB::transaction(function () use ($request, $user) {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);


        $user->roles()->sync($request->input('roles', []));
        $user->permissions()->sync($request->input('permissions', []));
    });

    return response()->json(['success' => true]);
}



    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
