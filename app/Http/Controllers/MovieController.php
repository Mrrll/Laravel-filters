<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Models\Gender;
use App\Models\Tag;
use App\Traits\Upload;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $movies = isset($request->search) && $request->search != "all" ? Movie::search($request->search)->paginate(3)->withQueryString() : Movie::paginate(3);
        $movies->withPath('/filters/ajax');

        $genders = Gender::all();
        $tags = Tag::all();

        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('welcome', compact('profile', 'movies', 'genders', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $genders = Gender::all();
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.movies.create', compact('profile', 'tags', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {

        try {

            $movie = Movie::create($request->safe()->except(['tags', 'image']));

            if ($request->validated()['image']) {

                $image = $this->upload($request, 'image', 'portadas', $request->validated()['title'], 'public');
                $movie->image()->create(['url' => $image]);
            }

            if ($request->validated()['tags']) {

                foreach ($request->validated()['tags'] as $id) {

                    $tag = Tag::find($id);
                    $movie->tags()->attach($tag);
                }
            }

            return redirect()->intended('/')->with('message', [
                'type' => 'success',
                'title' => Lang::get('Save success') . '!',
                'message' => Lang::get('Success in saving your :name.', ['name' => strtolower(Lang::get('Movie'))]),
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
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $tags = Tag::all();
        $genders = Gender::all();
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.movies.show', compact('profile', 'tags', 'genders', 'movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $tags = Tag::all();
        $genders = Gender::all();
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.movies.edit', compact('profile', 'tags', 'genders', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {

        $this->authorize('update', $movie);

        try {

            if (isset($request->validated()['image'])) {
                if ($movie->image->first()) {

                    $delete = ($this->Del($movie->image->first()->url, 'public') && $movie->image()->delete()) ? true : false;

                    if ($delete) {

                        $image = $this->upload($request, 'image', 'portadas', $request->validated()['title'], 'public');
                        $movie->image()->update(['url' => $image]);
                    } else {

                        throw new \RuntimeException('There was an error when deleting the image');
                    }
                } else {

                    $image = $this->upload($request, 'image', 'portadas', $request->validated()['title'], 'public');
                    $movie->image()->create(['url' => $image]);
                }
                $image = $this->upload($request, 'image', 'portadas', $request->validated()['title'], 'public');
                $movie->image()->create(['url' => $image]);
            }

            if ($request->validated()['tags']) {

                if ($movie->tags()->detach()) {

                    foreach ($request->validated()['tags'] as $id) {

                        $tag = Tag::find($id);
                        $movie->tags()->attach($tag);
                    }
                } else {

                    throw new \RuntimeException('An error occurred while changing tags');
                }
            }

            $movie->update($request->safe()->except(['tags', 'image', 'user_id']));

            return redirect()->intended('/')->with('message', [
                'type' => 'success',
                'title' => Lang::get('Update success') . '!',
                'message' => Lang::get('Success in updating your :name.', ['name' => strtolower(Lang::get('Movie'))]),
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
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);

        try {

            if ($movie->image->first()) {

                $delete = ($this->Del($movie->image->first()->url, 'public') && $movie->image()->delete()) ? true : false;

                $delete ? true :
                    throw new \RuntimeException('There was an error when deleting the image');
            }

            if ($movie->tags->first()) {

                $movie->tags()->detach() ? true :
                    throw new \RuntimeException('An error occurred while changing tags');
            }

            if ($movie->comments->first()) {

                foreach ($movie->comments as $comment) {

                    $comment->delete() ? true :
                        throw new \RuntimeException('An error occurred while deleting comments');
                }
            }

            $movie->delete();

            return redirect()->intended('/')->with('message', [
                'type' => 'success',
                'title' => Lang::get('Delete success') . '!',
                'message' => Lang::get('Success in deleting your :name.', ['name' => strtolower(Lang::get('Movie'))]),
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
