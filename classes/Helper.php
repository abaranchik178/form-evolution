<?php


namespace classes;


class Helper
{
    public static function generateRandomString(int $length = 20): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function getCsrfSecretFormInput()
    {
        if ( isset($_SESSION['csrfSecret']) && !empty($_SESSION['csrfSecret'])  ) {
            return  <<<INPUT
<input type="hidden" name="csrfSecret" value="{$_SESSION['csrfSecret']}">
INPUT;
        }
        return '';
    }
}