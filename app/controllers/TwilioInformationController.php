<?php
/**
 * Twilio Call
 */

class TwilioInformationController extends TwilioControllerBase {

  protected $name = 'twilio-information';

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

    $information = Information::find($params['Id']);
    $content = $information->content;

    $mother = Mother::find($params['MotherId']);

    return Response::view('twilio/information/call', array(
      'content' => $content
    ))->header('Content-Type', 'text/xml');
  }
}