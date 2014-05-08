<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class BabyCheck extends Eloquent {

  protected $table = 'baby_checks';
  public static $unguarded = true;
  protected $defaultValue = '-';

  public static function parseDateOfVisit($dateOfVisit)
  {
    $parsed = date_parse_from_format('mdY', $dateOfVisit);
    return date('Y-m-d', mktime(
      $parsed['hour'],
      $parsed['minute'],
      $parsed['second'],
      $parsed['month'],
      $parsed['day'],
      $parsed['year']));
  }

  public static function parseDecimal($str)
  {
    return (float)str_replace('*', '.', $str);
  }

  public function getDateOfVisit()
  {
    return date('F d Y', strtotime($this->date_of_visit));
  }

  public function getWeightInKg()
  {
    if ($this->weight_in_kg)
      return $this->weight_in_kg;
    else
      return $this->defaultValue;
  }

  public function getTemperature()
  {
    if ($this->temperature)
      return $this->temperature;
    else
      return $this->defaultValue;
  }

  public function getHeight()
  {
    if ($this->height)
      return $this->height;
    else
      return $this->defaultValue;
  }

}