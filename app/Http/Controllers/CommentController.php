<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {

        try {

            $movie = Movie::find($request->safe()->only('movie_id'))->first();

            $movie->comments()->create($request->safe()->only(['message', 'user_id']));

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Save success') . '!',
                'message' => Lang::get('Success in saving your :name.', ['name' => strtolower(Lang::get('Comment'))]),
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
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        try {

            $comment->delete();

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Delete success') . '!',
                'message' => Lang::get('Success in deleting your :name.', ['name' => strtolower(Lang::get('Comment'))]),
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
}
