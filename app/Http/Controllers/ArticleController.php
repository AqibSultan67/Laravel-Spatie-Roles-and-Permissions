<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array{
        return [
            new Middleware('permission:View Articles Page', only: ['index']),
            new Middleware('permission:Edit Articles', only: ['edit']),
            new Middleware('permission:Create Articles', only: ['create']),
            new Middleware('permission:Delete Articles', only: ['destroy']),

        ];
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::all();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $btn = '';


                    if (request()->user()->can('Edit Articles')) {
                        $btn .= '<a href="" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm py-2">Edit</a>';
                    }


                    if (request()->user()->can('Delete Articles')) {
                        $btn .= ' <a href="" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm py-2">Delete</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('articles.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'text' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'author' => $request->author,
            'text' => $request->text,
        ]);

        return response()->json(['success' => 'Article created successfully']);
    }

    public function edit($id)
{
    $article = Article::findOrFail($id);
    return response()->json($article);
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'text' => 'required',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'title' => $request->title,
            'author' => $request->author,
            'text' => $request->text,
        ]);

        return response()->json(['success' => 'Article updated successfully']);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['success' => 'Article deleted successfully']);
    }
}
