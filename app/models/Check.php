<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Check extends Eloquent {

  protected $table = 'checks';
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
    if ($this->date_of_visit)
      return date('F d Y', strtotime($this->date_of_visit));
    else
      return $this->defaultValue;
  }

  public function getWeightInKg()
  {
    return $this->weight_in_kg;
  }

  public function getBloodPressur()
  {
    return str_replace('.', '/', $this->blood_pressur);
  }

  public function getTemperature()
  {
    return $this->temperature;
  }

  public function getHeightOfAbdomen()
  {
    return $this->height_of_abdomen;
  }
}