<?php

/**
 * Class TwilioControllerBase
 */
abstract class TwilioControllerBase extends BaseController {

  protected $name = 'twilio';

  protected $twilioUrlBase = '';

  public function __construct()
  {
    $this->twilioUrlBase = Config::get('twilio.baseUrl');
  }

  public function getUrl($action = '', $params = array(), $name = '')
  {
    if (!$name)
      $name = $this->name;

    $encodedParams = array();
    foreach ($params as $key => $val)
    {
      $encodedParams[] = $key.'='.rawurlencode($val);
    }

    $url = $this->twilioUrlBase;
    if ($name == 'twilio')
    {
      $url = $this->twilioUrlBase.'/twilio';
    }
    elseif ($name == 'check')
    {
      $url = $this->twilioUrlBase.'/twilio_check';
    }
    elseif ($name == 'add-child')
    {
      $url = $this->twilioUrlBase.'/twilio_add_child';
    }
    elseif ($name == 'vaccine')
    {
      $url = $this->twilioUrlBase.'/twilio_vaccine';
    }
    elseif ($name == 'twilio-health-check')
    {
      $url = $this->twilioUrlBase.'/twilio_health_check';
    }
    elseif ($name == 'twilio-information')
    {
      $url = $this->twilioUrlBase.'/twilio_information';
    }

    if ($action)
      $url .= '/'.$action;

    if (count($encodedParams) > 0)
    {
      return $url.'?'.implode('&amp;', $encodedParams);
    }
    else
    {
      return $url;
    }
  }

}