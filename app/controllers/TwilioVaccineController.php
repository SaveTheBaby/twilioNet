<?php

/**
 * Class TwilioVaccineController
 *
 * Twilio予防接種コントローラ
 */
class TwilioVaccineController extends TwilioControllerBase {

  protected $name = 'vaccine';

  /**
   * @return mixed
   */
  public function getIndex()
  {
    $digit = $_REQUEST['Digits'];

    if ($digit == '111') // デモ用１
    {
      return Response::view('twilio_demo1')
        ->header('Content-Type', 'text/xml');
    }
    elseif ($digit == '222') // デモ用２
    {
      return Response::view('twilio_demo2')
        ->header('Content-Type', 'text/xml');
    }

    $params = array(
      'Type'     => $digit,
      'MotherId' => $_REQUEST['MotherId'],
      'BabyId'   => $_REQUEST['BabyId'],
    );

    return Response::view('twilio/vaccine/index', array(
      'actionUrl' => $this->getUrl('date', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getDate()
  {
    $params = array(
      'Date'     => $_REQUEST['Digits'],
      'Type'     => $_REQUEST['Type'],
      'MotherId' => $_REQUEST['MotherId'],
      'BabyId'   => $_REQUEST['BabyId'],
    );

    $vaccination = new Vaccination;
    $vaccination->date = Vaccination::parseDate($params['Date']);

    return Response::view('twilio/vaccine/date', array(
      'actionUrl' => $this->getUrl('done', $params),
      'date'      => $vaccination->getDate(),
      'name'      => $vaccination->getVaccinationTypeName($params['Type']),
    ))->header('Content-Type', 'text/xml');
  }

  public function getDone()
  {
    $done = $_REQUEST['Digits'];
    if ($done == '1')
    {
      $data = array(
        'date'     => Vaccination::parseDate($_REQUEST['Date']),
        'type'     => $_REQUEST['Type'],
        'baby_id' => $_REQUEST['BabyId'],
      );
      $check = new Vaccination($data);
      $check->save();

      return Response::view('twilio/vaccine/done')
        ->header('Content-Type', 'text/xml');
    }
    elseif ($done == '2')
    {
      // やり直し
      $params = array(
        'MotherId' => $_REQUEST['MotherId'],
        'BabyId'  => $_REQUEST['BabyId'],
      );

      return Response::view('twilio_index_vaccine', array(
        'actionUrl' => $this->getUrl('', $params),
      ))->header('Content-Type', 'text/xml');
    }

  }
}