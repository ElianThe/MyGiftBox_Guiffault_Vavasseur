<?php

class CsrfService
{

    /**
     * @throws Exception
     */
    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    /**
     * @throws Exception
     */
    public static function checkToken($token)
    {
        if (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']) {
            unset($_SESSION['csrf_token']);
            return true;
        } else {
            unset($_SESSION['csrf_token']);
            throw new Exception('CSRF token mismatch');
        }
    }

}