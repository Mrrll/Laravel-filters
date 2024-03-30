<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\AjaxProfileRequest;
use App\Models\User;
use App\Traits\Upload;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
    use Upload;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {

        try {

            $user = User::find($request->validated()['user_id']);

            $profile = Profile::create($request->safe()->except('avatar', 'user_id'));

            if (isset($request->validated()['avatar'])) {

                $avatar = $this->upload($request, 'avatar', null, 'avatar' . '-' . $request->validated()['user_id'], 'private');
                $profile->image()->create(['url' => $avatar]);
            }

            $user->profile()->attach($profile);

            return redirect()->intended('/')->with('message', [
                'type' => 'success',
                'title' => Lang::get('Save success') . '!',
                'message' => Lang::get('Success in saving your :name.', ['name' => strtolower(Lang::get('Profile'))]),
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
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {

        try {

            $profile->update($request->safe()->except(['avatar', 'user_id', 'profile_id']));

            if (isset($request->validated()['avatar'])) {

                if ($profile->image->first()) {

                    $delete = ($this->Del($profile->image->first()->url, 'private') && $profile->image()->delete()) ? true : false;

                    if ($delete) {

                        $avatar = $this->upload($request, 'avatar', null, 'avatar' . '-' . $request->validated()['user_id'], 'private');
                        $profile->image()->update(['url' => $avatar]);
                    } else {

                        throw new \RuntimeException('There was an error when deleting the image');
                    }
                } else {

                    $avatar = $this->upload($request, 'avatar', null, 'avatar' . '-' . $request->validated()['user_id'], 'private');
                    $profile->image()->create(['url' => $avatar]);
                }
            }

            return redirect()->back()->with('message', [
                'type' => 'success',
                'title' => Lang::get('Update success') . '!',
                'message' => Lang::get('Success in updating your :name.', ['name' => strtolower(Lang::get('Profile'))]),
            ]);
        } catch (\Throwable $th) {

            return back()->with('message', [
                'type' => 'danger',
                'autohide' => 'false',
                'title' => Lang::get('An unexpected error has occurred') . '!',
                'message' => Lang::get($th->getMessage()) . ', ' . Lang::get('Check your settings and if the problem persists, contact your administrator.'),
            ]);
        }
    }

    public function ajax(AjaxProfileRequest $request)
    {
        if ($request->ajax()) {
            if (isset($request->deleteavatar)) {
                $profile = Profile::find($request->deleteavatar);
                $info = ($this->Del($profile->image->first()->url, 'private') && $profile->image()->delete()) ? true : false;
            }
            return response()->json($info);
        }
    }
}
