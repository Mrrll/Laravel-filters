<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\Rating\AjaxRatingRequest;
use App\Models\Movie;
use App\Models\User;

class RatingController extends Controller
{

    public function ajax(AjaxRatingRequest $request)
    {

        if ($request->ajax()) {

            if (isset($request->id)) {

                $user = User::find($request->safe()->only('user_id'))->first();

                $movie = Movie::find($request->validated()['movie_id']);

                $rating = Rating::where('movie_id', $request->validated()['movie_id'])->first();


                if ($rating != null) {

                    $movie->ratings()->update($request->safe()->except('user_id'));
                    $rating = Rating::where('movie_id', $request->validated()['movie_id'])->first();
                } else {

                    $rating = $movie->ratings()->create($request->safe()->except('user_id'));
                }

                $user->rating()->attach($rating);

                $info = [
                    "movie" => $request->validated()['movie_id'],
                    "rating" => [
                        "yes" => $rating->yes,
                        "no" => $rating->no,
                        "rating" => $rating->rating,
                    ]
                ];
            }
            return response()->json($info);
        }
    }
}
