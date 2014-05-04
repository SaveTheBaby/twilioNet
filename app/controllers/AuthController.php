<?php
/**
 * Created by PhpStorm.
 * User: hiroshi_kawai
 * Date: 14/04/29
 * Time: 1:39
 */

class AuthController extends BaseController {

  public function getLogin()
  {
    return View::make('auth/login', array(
      'message' => null,
    ));
  }

  public function postLogin()
  {
    $loginId  = $_REQUEST['LoginId'];
    $password = $_REQUEST['Password'];

    $users = array(
      'savethebaby' => 'eiXQE26V',
      'guest'       => 'guest',
    );

    if (isset($users[$loginId]) && $password == $users[$loginId])
    {
      Session::put('user.name', $loginId);
      return Redirect::to('.');
    }

    Session::flash('error-message', 'Login failed.');

    return View::make('auth/login');
  }

  public function getLogout()
  {
    Session::forget('user');
    return Redirect::to('login');
  }
} 