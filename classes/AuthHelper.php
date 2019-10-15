<?php


namespace classes;


class AuthHelper
{
    public function login()
    {
        //validate
        if ( !isset($_POST['email'], $_POST['password']) ) {
            return 'email and password is required';
        }

        $userMapper = new UserMapper();
        $user = $userMapper->findUserByEmail( $_POST['email'] );

        if ( !$user ) {
            return 'Email not found';
        }

        if ( $user->verifyPassword($_POST['password']) ) {
            $_SESSION['userId'] = $user->getId();
            return true;
        } else {
            return 'Invalid password';
        }
    }
}