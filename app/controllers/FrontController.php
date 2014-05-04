<?php

class FrontController extends BaseController {

	public function getIndex() {

    $user = Session::get('user.name');
    if (!$user)
    {
      return Redirect::to('login');
    }

    return View::make('index')
    ->with('mothers', Mother::get());
	}

  public function getInfo($motherId)
  {
    $mother       = Mother::find($motherId);

    return View::make('front/info', array(
      'mother'             => $mother,
    ));
  }

  public function getMother($user_id) {

    return View::make('mother')
    ->with('mother', Mother::where('user_id', '=', $user_id)->first())
    ->with('children', Child::where('mother_id', '=', $user_id)->get())
    ->with('records', $this->observe_records)
    ->with('id', $user_id);
  }

  public function getChild($id) {
    $child = Child::find($id);
    $mother = Mother::where('user_id', '=', $child->mother_id)->first();
    return View::make('child')
    ->with('me', $child)
    ->with('mother', $mother)
    ->with('children', Child::where('mother_id', '=', $mother->user_id)->get())
    ->with('records', $this->observe_records)
    ->with('id', $id);
  }

  public function getVaccine($id) {
    return View::make('vaccine');
  }

  protected $observe_records = array(
    array(
      'id' => 1,
      'who_id' => 1,
      'type' => 1,
      'height' => 50,
      'body_weight' => 3,
      'body_temperature' => 36,
      'time' => '2013/7/8'
    ),
    array(
      'id' => 2,
      'who_id' => 1,
      'type' => 1,
      'height' => 55,
      'body_weight' => 4,
      'body_temperature' => 36,
      'time' => '2013/8/3'
    ),
    array(
      'id' => 3,
      'who_id' => 1,
      'type' => 1,
      'height' => 60,
      'body_weight' => 6,
      'body_temperature' => 36,
      'time' => '2013/8/26'
    ),
    array(
      'id' => 4,
      'who_id' => 1,
      'type' => 1,
      'height' => 65,
      'body_weight' => 7,
      'body_temperature' => 36,
      'time' => '2013/9/3'
    ),
    array(
      'id' => 5,
      'who_id' => 1,
      'type' => 1,
      'height' => 68,
      'body_weight' => 8,
      'body_temperature' => 37,
      'time' => '2013/11/20'
    ),
    array(
      'id' => 6,
      'who_id' => 1,
      'type' => 1,
      'height' => 73,
      'body_weight' => 9,
      'body_temperature' => 36,
      'time' => '2014/1/2'
    ),
    array(
      'id' => 7,
      'who_id' => 1,
      'type' => 1,
      'height' => 75,
      'body_weight' => 9,
      'body_temperature' => 36,
      'time' => '2014/1/20'
    ),
    array(
      'id' => 8,
      'who_id' => 1,
      'type' => 1,
      'height' => 78,
      'body_weight' => 10,
      'body_temperature' => 38,
      'time' => '2014/2/2'
    ),
    array(
      'id' => 9,
      'who_id' => 1,
      'type' => 1,
      'height' => 79,
      'body_weight' => 10,
      'body_temperature' => 36,
      'time' => '2014/2/12'
    )
  );
}