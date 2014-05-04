<?php

class InformationController extends TwilioControllerBase {

  public function getIndex()
  {
    $information = Information::query()->orderBy('id', 'desc')->get();
    return View::make('information/index', array(
      'information' => $information,
    ));
  }

  public function postIndex()
  {
    $content = $_REQUEST['content'];

    $information = new Information(array(
      'content' => $content,
    ));
    $information->save();

    return Redirect::to('information');
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