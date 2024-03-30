<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Http\Requests\Gender\StoreGenderRequest;
use Illuminate\Support\Facades\Lang;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genders = Gender::orderBy('id', 'desc')->paginate(5);
        $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
        return view('app.genders.index', compact('profile', 'genders'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenderRequest $request)
    {
        try {

            Gender::create($request->validated());

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Save success') . '!',
                'message' => Lang::get('Success in saving your :name.', ['name' => strtolower(Lang::get('Gender'))]),
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
    public function destroy(Gender $gender)
    {
        try {

            $gender->delete();

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Delete success') . '!',
                'message' => Lang::get('Success in deleting your :name.', ['name' => strtolower(Lang::get('Gender'))]),
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
