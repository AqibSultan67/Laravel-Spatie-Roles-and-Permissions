<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array{
        return [
            new Middleware('permission:View Roles', only: ['show']),
            new Middleware('permission:Edit Roles', only: ['edit']),
            new Middleware('permission:Create Roles', only: ['create']),
            new Middleware('permission:Delete Roles', only: ['destroy']),

        ];
    }
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::with('permissions')->get();

            return DataTables::of($data)
                ->addColumn('permissions', function ($row) {
                    return $row->permissions->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $btn='';
                    if(request()->user()->can('Edit Roles')){
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm py-2">Edit</a>';
                    }

                    if(request()->user()->can('Delete Roles')){
                    $btn .= ' <a href="" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm py-2">Delete</a>';
                }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $permissions = Permission::all();
        return view('roles.index', compact('permissions'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles|min:3',
            'permissions' => 'nullable|array',
        ]);


        $role = Role::create(['name' => $request->name]);


        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }


        return response()->json(['success' => 'Role created successfully']);
    }

    public function edit($id)
{
    $role = Role::with('permissions')->find($id);
    if (!$role) {
        return response()->json(['message' => 'Role not found'], 404);
    }
    return response()->json($role);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $id . '|min:3',

        'permissions' => 'nullable|array',
    ]);


    $role = Role::findOrFail($id);


    $role->update(['name' => $request->name]);

    $permissions = $request->has('permissions') ? Permission::whereIn('id', $request->permissions)->get() : [];

    $role->syncPermissions($permissions);

    return response()->json(['success' => 'Role updated successfully']);
}


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['success' => 'Role deleted successfully']);
    }
}
