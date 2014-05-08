<?php

class Vaccination extends Eloquent {

  protected $table = 'vaccinations';
  public static $unguarded = true;
  protected $defaultValue = '-';
  protected $vaccinationTypeTable;

  public static function parseDate($date)
  {
    $parsed = date_parse_from_format('mdY', $date);
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

  public function getVaccinationTypeTable()
  {
    if (!$this->vaccinationTypeTable)
    {
      $vaccinationTypeTable = array(
        array(
          'digit' => '1',
          'name'  => 'BCG',
        ),
        array(
          'digit' => '2',
          'name'  => 'DPT vaccine',
        ),
        array(
          'digit' => '3',
          'name'  => 'OPV/Oral Polio Vaccine',
        ),
        array(
          'digit' => '4',
          'name'  => 'HBV/Hepatitis B Virus',
        ),
        array(
          'digit' => '5',
          'name'  => 'AMV/Ankara Modified Virus',
        ),
        array(
          'digit' => '6',
          'name'  => 'MMR/Measles, Mumps, Rubella',
        ),
      );

      $this->vaccinationTypeTable = $vaccinationTypeTable;
    }

    return $this->vaccinationTypeTable;
  }

  public function getVaccinationTypeName($digit)
  {
    foreach ($this->getVaccinationTypeTable() as $type)
    {
      if ($type['digit'] == $digit)
        return $type['name'];
    }

    return $this->defaultValue;
  }
}