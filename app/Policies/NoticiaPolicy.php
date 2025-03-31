<?php

namespace App\Policies;

use App\Models\Noticia;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NoticiaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Noticia $noticia): Response
    {
        /* return ($user->can('ver noticia') && $user->can('crear noticias'))
            ? Response::allow()
            : Response::deny('No tienes permiso para ver esta noticia.'); */
            return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('crear noticias');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Noticia $noticia): Response
    {
        return ($user->hasRole('admin') || ($user->can('editar noticias') && $user->id === $noticia->user_id))
            ? Response::allow()
            : Response::deny('No tienes permiso para editar esta noticia.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Noticia $noticia): Response
    {
        return ($user->hasRole('admin') || ($user->can('eliminar noticias') && $user->id === $noticia->user_id))
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar esta noticia.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Noticia $noticia): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Noticia $noticia): bool
    {
        return false;
    }
}
