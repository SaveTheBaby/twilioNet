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
    $type = $_REQUEST['Digits'];

    if ($type == '111') // デモ用１
    {
      return Response::view('twilio_demo1')
        ->header('Content-Type', 'text/xml');
    }
    elseif ($type == '222') // デモ用２
    {
      return Response::view('twilio_demo2')
        ->header('Content-Type', 'text/xml');
    }

    $types = array(
      '1' => 'BCG',
      '2' => '三種混合ワクチン',
      '3' => 'ポリオ',
      '4' => 'HBV/B型肝炎',
      '5' => 'AMV/アンカラ修復ウィルス',
      '6' => 'MMR/麻疹・風疹・おたふく',
    );

    $name = $types[$type];

    $params = array(
      'Type'     => $type,
      'MotherId' => $_REQUEST['MotherId'],
      'BabyId'  => $_REQUEST['BabyId'],
    );

    return Response::view('twilio/vaccine/index', array(
      'actionUrl' => $this->getUrl('date', $params),
      'name'      => $name,
    ))->header('Content-Type', 'text/xml');
  }

  public function getDate()
  {
    $params = array(
      'Date'     => $_REQUEST['Digits'],
      'Type'     => $_REQUEST['Type'],
      'MotherId' => $_REQUEST['MotherId'],
      'BabyId'  => $_REQUEST['BabyId'],
    );

    return Response::view('twilio/vaccine/date', array(
      'actionUrl' => $this->getUrl('done', $params),
      'date'      => $params['Date'],
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