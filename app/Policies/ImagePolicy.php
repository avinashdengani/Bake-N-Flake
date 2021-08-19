<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Image $image)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Image $image)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Image $image)
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Image $image)
    {
        //
    }

    public function forceDelete(User $user, Image $image)
    {
        //
    }
}
