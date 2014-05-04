<?php

/**
 * Class TwilioCheckController
 *
 * Twilio妊婦定期健診コントローラ
 */
class TwilioCheckController extends TwilioControllerBase {

  protected $name = 'check';

  public function getDateOfVisit()
  {
    $params = array(
      'MotherId' => $_REQUEST['MotherId'],
    );

    $mother = Mother::find($params['MotherId']);

    if ($mother->checkPassword($_REQUEST['Digits']))
    {
      return Response::view('twilio/check/date_of_visit', array(
        'actionUrl' => $this->getUrl('weight-in-kg', $params),
      ))->header('Content-Type', 'text/xml');
    }
    else
    {
      throw new Exception('Failed check password.');
    }
  }

  /**
   * Weight In Kg.
   *
   * @return mixed
   */
  public function getWeightInKg()
  {
    $params = array(
      'DateOfVisit' => $_REQUEST['Digits'],
      'MotherId'    => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/check/weight_in_kg', array(
      'actionUrl' => $this->getUrl('blood-pressur', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getBloodPressur()
  {
    $params = array(
      'WeightInKg'  => $_REQUEST['Digits'],
      'DateOfVisit' => $_REQUEST['DateOfVisit'],
      'MotherId'    => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/check/blood_pressur', array(
      'actionUrl' => $this->getUrl('temperature', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getTemperature()
  {
    $params = array(
      'BloodPressur' => $_REQUEST['Digits'],
      'WeightInKg'   => $_REQUEST['WeightInKg'],
      'DateOfVisit'  => $_REQUEST['DateOfVisit'],
      'MotherId'     => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/check/temperature', array(
      'actionUrl' => $this->getUrl('height-of-abdomen', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getHeightOfAbdomen()
  {
    $params = array(
      'Temperature'  => $_REQUEST['Digits'],
      'BloodPressur' => $_REQUEST['BloodPressur'],
      'WeightInKg'   => $_REQUEST['WeightInKg'],
      'DateOfVisit'  => $_REQUEST['DateOfVisit'],
      'MotherId'     => $_REQUEST['MotherId'],
    );

    return Response::view('twilio/check/height_of_abdomen', array(
      'actionUrl' => $this->getUrl('done', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getDone()
  {
    $data = array(
      'height_of_abdomen' => Check::parseDecimal($_REQUEST['Digits']),
      'temperature'       => Check::parseDecimal($_REQUEST['Temperature']),
      'blood_pressur'     => Check::parseDecimal($_REQUEST['BloodPressur']),
      'weight_in_kg'      => Check::parseDecimal($_REQUEST['WeightInKg']),
      'date_of_visit'     => Check::parseDateOfVisit($_REQUEST['DateOfVisit']),
      'mother_id'         => $_REQUEST['MotherId'],
    );

    $check = new Check($data);
    $check->save();

    return Response::view('twilio/check/done')->header('Content-Type', 'text/xml');
  }
}