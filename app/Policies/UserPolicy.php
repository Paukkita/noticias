<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('ver perfil') || $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->can('crear usuarios');
    }

    public function update(User $user, User $model): bool
    {   

        return $user->id === $model->id /* && $user->can('editar usuarios') */;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->id === $model->id && $user->can('eliminar usuarios');
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
