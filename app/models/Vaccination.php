<?php

class Vaccination extends Eloquent {

  protected $table = 'vaccinations';
  public static $unguarded = true;
  protected $defaultValue = '-';

  public static function parseDate($date)
  {
    $parsed = date_parse_from_format('Ymd', $date);
    return date('Y-m-d', mktime(
      $parsed['hour'],
      $parsed['minute'],
      $parsed['second'],
      $parsed['month'],
      $parsed['day'],
      $parsed['year']));
  }

  public function getDate()
  {
    if ($this->date)
      return date('F d Y', strtotime($this->date));
    else
      return $this->defaultValue;


  }
} 