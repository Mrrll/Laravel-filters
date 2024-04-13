<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filter\AjaxFilterRequest;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Tag;

class FilterController extends Controller
{
    public function filter(AjaxFilterRequest $request)
    {
        if ($request->ajax()) {

            $movies = Movie::query();

            if ($request->validated('search')) {

                $search = $request->validated('search');
                $movies = $movies->search($search);
            }

            if ($request->validated('gender') && $request->validated('gender') != 'all') {

                $gender = $request->validated('gender');
                $movies = $movies->whereRelation('gender', 'name', 'LIKE', "%$gender%");
            }
            if ($request->validated('tags')) {

                $tags = $request->validated('tags');
                $movies = $movies->whereHas('tags', fn ($q) => $q->whereIn('name', $tags));
            }

            if ($request->validated('stars') != null) {

                $rating = floatval($request->validated('stars'));
                $movies = $movies->whereRelation('ratings', 'rating', '=', $rating);
            }

            $movies = $movies->paginate(3);

            $genders = Gender::all();
            $tags = Tag::all();

            $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;

            $view = view('components.app.movies.movies', compact('movies'))->render();

            return response()->json($view);
        }
    }
}
