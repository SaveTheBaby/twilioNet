<?php

class HealthCheckController extends TwilioControllerBase {

  public function getIndex()
  {
    $isEmergency = (Input::get('emergency', false) === '');
    $query =  HealthCheck::query();
    if ($isEmergency)
      $query->where('type', 2);
    else
      $query->where('type', 1);

    $healthCheck = $query->orderBy('id', 'desc')->get();
    return View::make('health-check/index', array(
      'isEmergency' => $isEmergency,
      'healthCheck' => $healthCheck,
    ));
  }

  public function postIndex()
  {
    $question = Input::get('question');
    $isEmergency = (Input::get('emergency', false) === '');

    $healthCheck = new HealthCheck(array(
      'type'      => $isEmergency ? 2 : 1,
      'question' => $question,
    ));
    $healthCheck->save();

    return Redirect::to('health-check');
  }

  public function getSent()
  {
    if (Session::get('user.name') == 'guest')
    {
      Session::flash('error-message', 'You can not sent. Because of "guest" user ID(=test user)');
      return Redirect::to('health-check');
    }

    $id = $_REQUEST['Id'];

    $tel_from = Config::get('twilio.callerId');
    $sid      = Config::get('twilio.accountSid');
    $token    = Config::get('twilio.authToken');

    $client = new Services_Twilio($sid, $token);

    $babies = Baby::all();
    foreach ($babies as $baby)
    {
      if (!$baby->mother)
        continue;

      if (!$baby->mother->active)
        continue;

      $call = $client->account->calls->create(
        $tel_from,
        $baby->mother->phone_number,
        $this->getUrl('call', array(), 'twilio-health-check').'?Id='.$id.'&MotherId='.$baby->mother->id
      );
    }

    $healthCheck = HealthCheck::find($id);
    $healthCheck->delivery_at = date('Y-m-d H:i:s');
    $healthCheck->save();

    Session::flash('success-message', 'Send #'.$id.'.');

    return Redirect::to('health-check');
  }


}