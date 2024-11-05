<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array{
        return [
            new Middleware('permission:View Permissions', only: ['show']),
            new Middleware('permission:Edit Permissions', only: ['edit']),
            new Middleware('permission:Create Permissions', only: ['create']),
            new Middleware('permission:Delete Permissions', only: ['destroy']),

        ];
    }
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
            ->addColumn('action', function($row){
                $btn='';
                if(request()->user()->can('Edit Permissions')){
                    $btn = '<a href="" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm py-2">Edit</a>';
                }
                if(request()->user()->can('Delete Permissions')){
                    $btn .= ' <a href="" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm py-2">Delete</a>';
                }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('permissions.list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|min:3',
        ]);

        Permission::create(['name' => $request->name]);

        return response()->json(['success' => 'Permission created successfully']);
    }
    public function edit($id)
{
    $permission = Permission::findOrFail($id);
    return response()->json($permission);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:permissions,name,' . $id . '|min:3',
    ]);

    $permission = Permission::findOrFail($id);
    $permission->update(['name' => $request->name]);

    return response()->json(['success' => 'Permission updated successfully']);
}
public function destroy($id)
{
    $permission = Permission::findOrFail($id);
    $permission->delete();

    return response()->json(['success' => 'Permission deleted successfully']);
}

}
