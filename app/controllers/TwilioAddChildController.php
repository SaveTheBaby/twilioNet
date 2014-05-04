<?php

class TwilioAddChildController extends TwilioControllerBase {

  protected $name = 'add-child';

  /**
   * 性別
   *
   * @return mixed
   */
  public function getSex()
  {
    $params = array(
      'Birthday' => $_REQUEST['Digits'],
      'MotherId' => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/add_child/sex', array(
      'actionUrl' => $this->getUrl('blood', $params),
    ))->header('Content-Type', 'text/xml');
  }

  /**
   * 血液型
   *
   * @return mixed
   */

  public function getBlood()
  {
    $params = array(
      'Sex'      => $_REQUEST['Digits'],
      'Birthday' => $_REQUEST['Birthday'],
      'MotherId' => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/add_child/blood', array(
      'actionUrl' => $this->getUrl('rh', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getRh()
  {
    $params = array(
      'Blood'    => $_REQUEST['Digits'],
      'Sex'      => $_REQUEST['Sex'],
      'Birthday' => $_REQUEST['Birthday'],
      'MotherId' => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/add_child/rh', array(
      'actionUrl' => $this->getUrl('done', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getDone()
  {
    $data = array(
      'rh'        => $_REQUEST['Digits'],
      'blood'     => $_REQUEST['Blood'],
      'sex'       => $_REQUEST['Sex'],
      'birthday'  => Baby::parseBirthday($_REQUEST['Birthday']),
      'mother_id' => $_REQUEST['MotherId'],
    );

    $child = new Baby($data);
    $child->save();

    return Response::view('twilio/add_child/done')->header('Content-Type', 'text/xml');

  }
}