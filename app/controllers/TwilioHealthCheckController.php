<?php
/**
 * Twilio Call
 */

class TwilioHealthCheckController extends TwilioControllerBase {

  protected $name = 'twilio-health-check';

  public function postCall()
  {
    return $this->getCall();
  }

  public function getCall()
  {
    $params = array(
      'Id'       => $_REQUEST['Id'],
      'MotherId' => $_REQUEST['MotherId'],
    );

    $healthCheck = HealthCheck::find($params['Id']);
    $question = $healthCheck->question;

    $mother = Mother::find($params['MotherId']);
    $afterBirth = $mother->baby->getAfterBirth();

    return Response::view('twilio/health-check/call', array(
      'afterBirth' => $afterBirth,
      'question' => $question,
      'actionUrl' => $this->getUrl('answer', $params),
    ))->header('Content-Type', 'text/xml');
  }

  public function getAnswer()
  {
    $data = array(
      'health_check_id' => $_REQUEST['Id'],
      'mother_id'       => $_REQUEST['MotherId'],
      'answer'          => $_REQUEST['Digits'],
    );

    $healthCheckAnswer = new HealthCheckAnswer($data);
    $healthCheckAnswer->save();

    return Response::view('twilio/health-check/done', array())
      ->header('Content-Type', 'text/xml');
  }
} 