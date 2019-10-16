<?php


namespace classes;


class UserIdentity
{
    private static $user;
    private static $cookieAutologin = false;
    private static $sessionAutologin = true;
    private static $authError;

    const ERROR_INVALID_EMAIL = 'Email not found';
    const ERROR_INVALID_PASSWORD = 'Invalid password';



    public static function authByEmail(string $email, string $password): bool
    {

        $userMapper = new UserMapper();
        $user = $userMapper->findUserByEmail($email);

        if ( !$user || ! $user instanceof User) {
            self::$authError = self::ERROR_INVALID_EMAIL;
            return false;
        }

        if ( $user->verifyPassword($_POST['password']) ) {
            self::saveAuthSuccess($user);
            return true;
        } else {
            self::$authError = self::ERROR_INVALID_PASSWORD;
            return false;
        }
    }

    public static function authByCookieUserSecret()
    {

    }
    public static function authBySessionUserId()
    {
        if ( isset($_SESSION['userId']) && !empty($_SESSION['userId']) ) {
            $userMapper = new UserMapper();
            $user = $userMapper->findUserById($_SESSION['userId']);

            if ( $user &&  $user instanceof User) {
                self::saveAuthSuccess($user);
                return true;
            } else {
                self::$authError = self::ERROR_INVALID_SESSION;
                return false;
            }
        }
    }

    public static function tryAutoAuth()
    {
        $authComplete = false;
        if ( ! $authComplete && self::$sessionAutologin &&
            isset($_SESSION['userId']) && !empty($_SESSION['userId']) ) {
            $authComplete = self::authBySessionUserId($_SESSION['userId']);
        }
        if ( ! $authComplete && self::$cookieAutologin &&
            isset($_COOKIE['userSecret']) && !empty($_COOKIE['userSecret']) ) {
            $authComplete = self::authByCookieUserSecret($_COOKIE['userSecret']);
        }
    }

    public static function saveAuthSuccess($user)
    {
        if ( true === self::$cookieAutologin) {
            $secretString = $user->getSecretString();
            setcookie('userSecret', $secretString, SECONDS_IN_WEEK);
        }
        if ( true === self::$sessionAutologin) {
            $_SESSION['userId'] = $user->getId();
        }
        self::$user = $user;
    }

    /**
     * @return mixed
     */
    public static function getUser()
    {
        return self::$user;
    }

    /**
     * @param mixed $user
     */
    public static function setUser($user)
    {
        self::$user = $user;
    }

    /**
     * @return bool
     */
    public static function isCookieAutologin(): bool
    {
        return self::$cookieAutologin;
    }

    /**
     * @param bool $cookieAutologin
     */
    public static function setCookieAutologin(bool $cookieAutologin)
    {
        self::$cookieAutologin = $cookieAutologin;
    }

    /**
     * @return bool
     */
    public static function isSessionAutologin(): bool
    {
        return self::$sessionAutologin;
    }

    /**
     * @param bool $sessionAutologin
     */
    public static function setSessionAutologin(bool $sessionAutologin)
    {
        self::$sessionAutologin = $sessionAutologin;
    }

    /**
     * @return mixed
     */
    public static function getAuthError()
    {
        return self::$authError;
    }

}