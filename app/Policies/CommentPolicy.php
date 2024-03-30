<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;

class CommentPolicy
{

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): Response
    {

        $response = false;

        if ($user->roles->contains('slug', 'admin')) {
            // Si el usuario tiene el role editor
            $response =  true;
        } elseif ($comment->user_id == $user->id) {
            // Si el usuario es el propietario del post
            $response =  true;
        }
        return $response
            ? Response::allow()
            : Response::deny(Lang::get('You do not have permissions to :action this :model.', ['action' => Lang::get('Delete'), 'model' => Lang::get('Comment')]));
    }

}
