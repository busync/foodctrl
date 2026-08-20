<?php

namespace App\Controllers;

use PDO;
use PDOException;

class UserController
{
    private string|null $userSession;
    private PDO $pdo;

    public function __construct(PDO $pdo, string|null $userSession)
    {
        $this->pdo = $pdo;
        $this->userSession = $userSession;
    }

    public function isAuth(): bool
    {
        if (!$this->userSession) return false;

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `sessionToken` = ?");
            $stmt->execute([$this->userSession]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}