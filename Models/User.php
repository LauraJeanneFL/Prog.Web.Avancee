<?php
namespace App\Models;

use App\Models\CRUD;
use App\Providers\View;

class User extends CRUD{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'username', 'password','email', 'role'];

    public function hashPassword ($password, $cost = 10){
        $options = [
            "cost"=> $cost
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkuser($username, $password) {
        $user = $this->unique('nom_utilisateur', $username); 
        if ($user) {
            // Compare le mot de passe brut avec le mot de passe haché
            if (password_verify($password, $user['mot_de_passe'])) {
                // Initialisez les variables de session après une connexion réussie
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom_utilisateur'];
                $_SESSION['role'] = $user['role'];
                return true;
            } else {
                error_log("Mot de passe incorrect pour l'utilisateur $username");
            }
        } else {
            error_log("Utilisateur $username non trouvé");
        }
        return false;
    }

    public function redirectIfNoAccess($requiredRole) {
        if (!$this->hasAccess($requiredRole)) {
            error_log("Accès refusé pour le rôle requis : $requiredRole");
            error_log("Rôle actuel de l'utilisateur : " . ($_SESSION['role'] ?? 'non défini'));
            View::render('error', ['msg' => "Accès refusé. Vous n'avez pas les privilèges requis."]);
            exit;
        }
    }

    // Modifier le rôle d'un utilisateur
    public function setRole($userId, $newRole) {
        $data = ['role' => $newRole];
        return $this->update($data, $userId);
    }

    // Différencier les privilèges des rôles (client et administrateur)
    public function hasAccess($requiredRole) {
        if (!$this->validateSession()) {
            return false;
        }

        // Vérifie si le rôle de l'utilisateur correspond au rôle requis
        return $_SESSION['role'] === $requiredRole;
    }

    // Vérifier l’intégrité de la session
    public function validateSession() {
        if (!isset($_SESSION['user_id'], $_SESSION['finger_print'])) {
            return false;
        }

        // Vérifie si la session correspond à l'utilisateur
        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
        if ($_SESSION['finger_print'] !== $fingerPrint) {
            return $_SESSION['finger_print'] === $fingerPrint;
        }
    }   

    // Sécuriser la déconnexion
    public function logout() {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header("Location: /ProgWebAvancee/Evaluations/TP3/login");
        exit;
    }

    public function getAll() {
        return $this->select(); 
    }
}