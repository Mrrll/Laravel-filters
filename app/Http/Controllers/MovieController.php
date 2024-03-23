<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('welcome', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.movies.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        dd("edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
