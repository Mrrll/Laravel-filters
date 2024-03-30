<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\AjaxTagRequest;
use App\Models\Tag;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Lang;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(5);
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.tags.index', compact('profile', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        try {

            Tag::create($request->validated());

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Save success') . '!',
                'message' => Lang::get('Success in saving your :name.', ['name' => strtolower(Lang::get('Tag'))]),
            ]);
        } catch (\Throwable $th) {

            return back()->with('message', [
                'type' => 'danger',
                'autohide' => 'false',
                'title' => Lang::get('An unexpected error has occurred') . '!',
                'message' => Lang::get($th->getMessage()) . ' ' . Lang::get('Check your settings and if the problem persists, contact your administrator.'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {

            $tag->delete();

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Delete success') . '!',
                'message' => Lang::get('Success in deleting your :name.', ['name' => strtolower(Lang::get('Tag'))]),
            ]);
        } catch (\Throwable $th) {

            return back()->with('message', [
                'type' => 'danger',
                'autohide' => 'false',
                'title' => Lang::get('An unexpected error has occurred') . '!',
                'message' => Lang::get($th->getMessage()) . ' ' . Lang::get('Check your settings and if the problem persists, contact your administrator.'),
            ]);
        }
    }

    public function ajax(AjaxTagRequest $request)
    {
        if ($request->ajax()) {
            if (isset($request->id)) {
                if (isset($request->select) && $request->select) {

                    $movie = Movie::find($request->id);
                    $info = $movie->tags->toArray();
                } else {

                    $tag = Tag::find($request->id);
                    $info = [
                        "id" => $tag->id,
                        "name" => $tag->name,
                    ];
                }
            }
            return response()->json($info);
        }
    }
}
