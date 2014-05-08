<?php

class TwilioController extends TwilioControllerBase {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

  /**
   * 電話に対する応答 POST
   *
   * @return mixed
   */
  public function postIndex()
  {
    return $this->getIndex();
  }

  public function getIndex()
	{
    $phoneNumber = $_REQUEST['From'];
    $country     = $_REQUEST['FromCountry'];

    $mother = Mother::findByPhoneNumber($phoneNumber);

    if ($mother)
    {
      // 子供が登録されているかいないか
      $baby = $mother->baby;
      if ($baby) // 子供が登録されている -> 予防接種へ
      {
        $params = array(
          'MotherId' => $mother->id,
          'BabyId'   => $baby->id,
        );

        return Response::view('twilio_index_vaccine', array(
          'actionUrl' => $this->getUrl('', $params, 'vaccine'),
        ))->header('Content-Type', 'text/xml');
      }
      else // 子供が登録されていない -> 出産したかを確認
      {
        $params = array(
          'MotherId' => $mother->id,
        );

        return Response::view('twilio_index_check_baby', array(
          'actionUrl' => $this->getUrl('check-baby', $params),
        ))->header('Content-Type', 'text/xml');
      }
    }
    else
    {
      $params = array(
        'PhoneNumber' => $phoneNumber,
        'Country'     => $country,
      );
      // 未登録(4桁のパスワードを入力)
      return Response::view('twilio_create_password', array(
        'country'   => $country,
        'actionUrl' => $this->getUrl('create-birthday', $params),
      ))->header('Content-Type', 'text/xml');
    }
  }

  /**
   * 定期検診か、赤ちゃんの新規登録か
   *
   * @return mixed
   */
  public function getCheckBaby()
  {
    $params = array(
      'MotherId' => $_REQUEST['MotherId'],
    );

    $answer = $_REQUEST['Digits']; // 1 = 定期検診 / 2 = 赤ちゃん登録

    if ($answer == '1') // 定期検診へ
    {
      return Response::view('twilio/check/index', array(
        'actionUrl' => $this->getUrl('date-of-visit', $params, 'check'),
      ))->header('Content-Type', 'text/xml');
    }
    elseif ($answer == '2') // 赤ちゃん新規登録へ
    {
      return Response::view('twilio/add_child/index', array(
        'actionUrl' => $this->getUrl('sex', $params, 'add-child'),
      ))->header('Content-Type', 'text/xml');
    }
    elseif ($answer == '111') // 隠しコマンド1
    {
      return Response::view('twilio_demo1')->header('Content-Type', 'text/xml');

    }
    elseif ($answer == '222') // 隠しコマンド2
    {
      return Response::view('twilio_demo2')->header('Content-Type', 'text/xml');
    }
  }

  public function getCreateBirthday()
  {
    $params = array(
      'Password'    => $_REQUEST['Digits'],
      'PhoneNumber' => $_REQUEST['PhoneNumber'],
      'Country'     => $_REQUEST['Country'],
    );

    return Response::view('twilio_birthday', array(
      'actionUrl' => $this->getUrl('create-blood', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getCreateBlood()
  {
    $params = array(
      'Birthday'    => $_REQUEST['Digits'],
      'Password'    => $_REQUEST['Password'],
      'PhoneNumber' => $_REQUEST['PhoneNumber'],
      'Country'     => $_REQUEST['Country'],
    );

    return Response::view('twilio_blood', array(
      'actionUrl' => $this->getUrl('create-rh', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getCreateRh()
  {
    $params = array(
      'Blood'       => $_REQUEST['Digits'],
      'Birthday'    => $_REQUEST['Birthday'],
      'Password'    => $_REQUEST['Password'],
      'PhoneNumber' => $_REQUEST['PhoneNumber'],
      'Country'     => $_REQUEST['Country'],
    );

    return Response::view('twilio_rh', array(
      'actionUrl' => $this->getUrl('create-schedule', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getCreateSchedule()
  {
    $params = array(
      'Rh'          => $_REQUEST['Digits'],
      'Blood'       => $_REQUEST['Blood'],
      'Birthday'    => $_REQUEST['Birthday'],
      'Password'    => $_REQUEST['Password'],
      'PhoneNumber' => $_REQUEST['PhoneNumber'],
      'Country'     => $_REQUEST['Country'],
    );

    return Response::view('twilio_schedule', array(
      'actionUrl' => $this->getUrl('create-done', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getCreateDone()
  {
    $data = array(
      'schedule'     => Mother::parseSchedule($_REQUEST['Digits']),
      'rh'           => $_REQUEST['Rh'],
      'blood'        => $_REQUEST['Blood'],
      'birthday'     => Mother::parseBirthday($_REQUEST['Birthday']),
      'password'     => $_REQUEST['Password'],
      'phone_number' => $_REQUEST['PhoneNumber'],
      'country'      => $_REQUEST['Country'],
    );

    $mother = new Mother($data);
    $mother->save();

    return Response::view('twilio_done')->header('Content-Type', 'text/xml');
  }
}
