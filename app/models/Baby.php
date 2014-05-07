<?php

class Baby extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'babies';
  protected static $babyColumns;
  protected $babyTable;
  protected static $vaccinationColumns;
  protected $vaccinationTable;
  protected static $babyCheckColumns;
  protected $babyCheckTable;
  protected $defaultValue = '-';

  public static $unguarded = true;

  public static function parseBirthday($birthday)
  {
    $parsed = date_parse_from_format('Ymd', $birthday);
    return date('Y-m-d', mktime(
      $parsed['hour'],
      $parsed['minute'],
      $parsed['second'],
      $parsed['month'],
      $parsed['day'],
      $parsed['year']));
  }

  public function babyChecks()
  {
    return $this->hasMany('BabyCheck');
  }

  public function mother()
  {
    return $this->belongsTo('Mother');
  }

  public function getSex()
  {
    $sex = array(0 => 'female', 1 => 'male');
    if (isset($sex[$this->sex]))
      return $sex[$this->sex];
    else
      return $this->defaultValue;
  }

  public function getBirthday()
  {
    if ($this->birthday)
      return Date('F d Y', strtotime($this->birthday));
    else
      return $this->defaultValue;
  }

  public function getVaccinationDate($append = '')
  {
    if ($this->birthday)
      return Date('F d Y', strtotime($this->birthday.' '.$append));
    else
      return $this->defaultValue;
  }

  public function getBlood()
  {
    $blood = array(
      0 => 'unknown',
      1 => 'A',
      2 => 'B',
      3 => 'O',
      4 => 'AB',
    );
    if (isset($blood[$this->blood]))
      return $blood[$this->blood];
    else
      return $this->defaultValue;
  }

  public function getRh()
  {
    $rh = array(1 => 'Rh+', 0 => 'Rh-');
    if (isset($rh[$this->rh]))
      return $rh[$this->rh];
    else
      return $this->defaultValue;

  }

  public function getAfterBirth()
  {
    $birthday = strtotime($this->birthday);
    $now      = time();

    $diff = abs($now - $birthday) / (60 * 60 * 24 * 30);

    return (integer)$diff;
  }

  public function vaccinations()
  {
    return $this->hasMany('Vaccination');
  }


  public static function getBabyColumns()
  {
    if (!static::$babyColumns)
    {
      $babyColumns = array(
        'Sex',
        'Birthday',
        'Blood',
        'RH',
      );
      static::$babyColumns = $babyColumns;
    }

    return static::$babyColumns;
  }

  public static function getVaccinationColumns()
  {
    if (!static::$vaccinationColumns)
    {
      $vaccinationColumns = array(
        'at Birth',
        '6weeks',
        '10weeks',
        '14weeks',
        '9months',
        '12-15months',
      );
      static::$vaccinationColumns = $vaccinationColumns;
    }

    return static::$vaccinationColumns;
  }

  public function getBabyTable()
  {
    if (!$this->babyTable)
    {
      $babyTable = array(
        array(
          'name'  => '',
          'values' => array(
            $this->getSex(),
            $this->getBirthday(),
            $this->getBlood(),
            $this->getRh(),
          ),
        ),
      );
      $this->babyTable = $babyTable;
    }

    return $this->babyTable;
  }

  public function getVaccinationTable()
  {
    $vaccinationColumns = $this->getVaccinationColumns();

    $length = count($vaccinationColumns);

    $vaccinationTable = array(
      array(
        'name'   => ' ',
        'values' => array(
          $this->getBirthday(),
          $this->getVaccinationDate('+6 week'),
          $this->getVaccinationDate('+10 week'),
          $this->getVaccinationDate('+14 weeks'),
          $this->getVaccinationDate('+9 month'),
          $this->getVaccinationDate('+12 month').
            ' - '.$this->getVaccinationDate('+15 month'),
        ),
      ),
      array(
        'name'   => 'BCG',
        'values' => array_fill(0, $length, '-'),
      ),
      array(
        'name'   => 'DPT vaccine',
        'values' => array_fill(0, $length, '-'),
      ),
      array(
        'name'   => 'OPV/Oral Polio Vaccine',
        'values' => array_fill(0, $length, '-'),
      ),
      array(
        'name'   => 'HBV/Hepatitis B Virus',
        'values' => array_fill(0, $length, '-'),
      ),
      array(
        'name'   => 'AMV/Ankara Modified Virus',
        'values' => array_fill(0, $length, '-'),
      ),
      array(
        'name'   => 'MMR/Measles, Mumps, Rubella',
        'values' => array_fill(0, $length, '-'),
      ),
    );

    $vaccinationFillRule = array(
      array(
        'type' => 1,
        'rule' => array(0),
      ),
      array(
        'type' => 2,
        'rule' => array(1,2,3),
      ),
      array(
        'type' => 3,
        'rule' => array(1,2,3),
      ),
      array(
        'type' => 4,
        'rule' => array(0,1,3),
      ),
      array(
        'type' => 5,
        'rule' => array(4),
      ),
      array(
        'type' => 6,
        'rule' => array(5),
      ),
    );
    foreach ($vaccinationFillRule as $i => $spec)
    {
      /** @var Illuminate\Database\Eloquent\Collection $vaccinationsByType */
      $vaccinationsByType = $this->vaccinations()
        ->where('type', '=', $spec['type'])
        ->orderBy('date', 'asc')
        ->take(count($spec['rule']))->get();
      foreach ($spec['rule'] as $c)
      {
        if ($v = $vaccinationsByType->pop())
          $vaccinationTable[$i+1]['values'][$c] = $v->getDate();
      }
    }

    return $vaccinationTable;
  }

  public static function getBabyCheckColumns()
  {
    if (!static::$babyCheckColumns)
    {
      $babyCheckColumns = range(1, 9);
      static::$babyCheckColumns = $babyCheckColumns;
    }

    return static::$babyCheckColumns;
  }

  public function getBabyCheckTable()
  {
    if (!$this->babyCheckTable)
    {
      $checkColumns = static::getBabyCheckColumns();

      $length = count($checkColumns);

      $checks = $this->babyChecks()->orderBy('date_of_visit', 'asc')->limit($length)->get();
      $babyCheckTable = array(
        array(
          'name'   => 'Date Of Visit',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Weight in kg',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Temperature',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Height(in cm)',
          'values' => array_fill(0, $length, '-'),
        ),
      );
      foreach ($checks as $i => $check)
      {
        $babyCheckTable[0]['values'][$i] = $check->getDateOfVisit();
        $babyCheckTable[1]['values'][$i] = $check->getWeightInKg();
        $babyCheckTable[2]['values'][$i] = $check->getTemperature();
        $babyCheckTable[3]['values'][$i] = $check->getHeight();
      }

      $this->babyCheckTable = $babyCheckTable;
    }

    return $this->babyCheckTable;
  }

  public function checkDateOfVisits()
  {
    return $this->getCheckData(0);
  }

  public function checkTemperatures()
  {
    return $this->getCheckData(2);
  }

  public function checkHeight()
  {
    return $this->getCheckData(3);
  }

  public function checkWeightInKg()
  {
    return $this->getCheckData(1);
  }

  public function getCheckData($i)
  {
    $checkTable = $this->getBabyCheckTable();
    $dataList = array();
    foreach ($checkTable[$i]['values'] as $data)
    {
      if ($data != '-')
      {
        if (is_numeric($data))
          $dataList[] = $data;
        else
          $dataList[] = "'".$data."'";
      }
    }
    return implode(', ', $dataList);
  }

}