<?php

namespace Modules\Projects\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Projects\Entities\Project;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
       return true ; // $user->id === $project->user_id ;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function update(User $user, Project $project): bool
    {
        return  $user->id === $project->user_id ;
    }

}
