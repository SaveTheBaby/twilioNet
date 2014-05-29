<?php

class InformationController extends TwilioControllerBase {

  public function getIndex()
  {
    $isEmergency = (Input::get('emergency', false) === '');
    $query = Information::query();
    if ($isEmergency)
      $query->where('type', 2);
    else
      $query->where('type', 1);

    $information = $query->orderBy('id', 'desc')->get();
    return View::make('information/index', array(
      'isEmergency' => $isEmergency,
      'information' => $information,
    ));
  }

  public function postIndex()
  {
    $content = Input::get('content');
    $isEmergency = (Input::get('emergency', false) === '');

    $information = new Information(array(
      'type'    => $isEmergency ? 2 : 1,
      'content' => $content,
    ));
    $information->save();

    return Redirect::to('information'.($isEmergency ? '?emergency':''));
  }

  public function getCall()
  {
    if (Session::get('user.name') == 'guest')
    {
      Session::flash('error-message', 'You can not call. Because of "guest" user ID(=test user)');
      return Redirect::to('information');
    }

    $id = $_REQUEST['Id'];

    $tel_from = Config::get('twilio.callerId');
    $sid      = Config::get('twilio.accountSid');
    $token    = Config::get('twilio.authToken');

    $client = new Services_Twilio($sid, $token);

    $mothers = Mother::all();
    foreach ($mothers as $mother)
    {
      if (!$mother->active)
        continue;

      $call = $client->account->calls->create(
        $tel_from,
        $mother->phone_number,
        $this->getUrl('call', array(), 'twilio-information').'?Id='.$id.'&MotherId='.$mother->id
      );
    }

    $information = Information::find($id);
    $information->call_at = date('Y-m-d H:i:s');
    $information->save();

    Session::flash('success-message', 'Call #'.$id.'.');

    return Redirect::to('information');
  }


}