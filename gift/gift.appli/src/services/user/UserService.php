<?php

namespace gift\app\services\user;

use gift\app\models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function disconnect()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        } else {
            throw new UserNotFoundException('Utilisateur non connecté', 404);
        }
    }

    public function addUser(array $attributs)
    {
        try {
            $user = new User();
            $user->nom = $attributs['nom'];
            $user->prenom = $attributs['prenom'];
            $user->email = $attributs['email'];
            $user->password = password_hash($attributs['password'], PASSWORD_DEFAULT);
            $user->save();
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }
    }

    public function getUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return $user;
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }
    }

    public function getUserFromEmail(string $email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            return $user;
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }
    }

    public function getUserFromSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        throw new UserNotFoundException("Vous n'êtes pas connecté", 404);
    }

    public function save(User $user)
    {
        $user->save();
    }

    public function updateUser(array $attributs)
    {
        try {
            $user = User::findOrFail($attributs['id']);
            $user->nom = $attributs['nom'];
            $user->prenom = $attributs['prenom'];
            $user->email = $attributs['email'];
            $user->save();
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }
    }

    public function updatePassword(array $attributs)
    {
        try {
            $user = User::findOrFail($attributs['id']);
            $user->password = password_hash($attributs['pass'], PASSWORD_DEFAULT);
            $user->save();
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }
    }


}