<?php

namespace App\Policies;

use App\Models\Avaluo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AvaluoPolicy
{

    public function view(User $user, Avaluo $avaluo): bool
    {

        if($user->hasRole('Administrador'))
            return true;

        return $user->id === $avaluo->creado_por;

    }

    public function update(User $user, Avaluo $avaluo): Response
    {

        return $user->id === $avaluo->creado_por
                ? Response::allow()
                : Response::deny('El avalúo pertenece a otro valuador no tienes permisos para editarlo.');

    }

}
