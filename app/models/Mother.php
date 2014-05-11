<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Mother extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mothers';
  protected static $motherColumns;
  protected $motherTable;
  protected static $checkColumns;
  protected $checkTable;
  protected $defaultValue = '-';
  protected static $countPerMonth;
  public static $unguarded = true;


  //①（折れ線グラフ１）：何ヶ月（max９ヶ月）の妊婦が、「何人」
  //X軸:出産予定日が現在日から過去9ヶ月以内(ひと月=30日)に該当する件数を1ヶ月毎に表示
  //Y軸:妊婦の人数
  //最大値は過去9ヶ月以内のmax月間妊婦数
  //最小値は過去9ヶ月以内のmin月間妊婦数
  public static function getCountPerMonth()
  {
    if (!static::$countPerMonth)
    {
      $mothers   = Mother::all();
      $data      = array_fill(1, 9, 0);
      $schedules = array();
      foreach ($mothers as $mother)
      {
        if (strtotime($mother->schedule) < time())
          continue;

        foreach (array_reverse(range(0, 8)) as $month)
        {
          if (strtotime($mother->schedule) > strtotime('+'.$month.' month'))
          {
            $data[9-$month]++;
            break;
          }
        }
      }

      foreach (range(1, 9) as $i)
      {
        if ($i <= 1)
          $schedules[]    = "'".$i." month'";
        else
          $schedules[]    = "'".$i." months'";
      }
      static::$countPerMonth = (object)array(
        'schedules'    => $schedules,
        'motherCounts' => $data,
      );
    }
    return static::$countPerMonth;
  }

  public function getMaskedPhoneNumber()
  {
    if ($this->phone_number)
      return $this->mask($this->phone_number, 1, strlen($this->phone_number)-5);
    else
      return $this->defaultValue;
  }

  function mask ( $str, $start = 0, $length = null ) {
    $mask = preg_replace ( "/\S/", "*", $str );
    if( is_null ( $length )) {
      $mask = substr ( $mask, $start );
      $str = substr_replace ( $str, $mask, $start );
    }else{
      $mask = substr ( $mask, $start, $length );
      $str = substr_replace ( $str, $mask, $start, $length );
    }
    return $str;
  }

  public function getPhoneNumber()
  {
    if ($this->phone_number)
      return $this->phone_number;
    else
      return $this->defaultValue;
  }

  public function getCountry()
  {
    if ($this->country)
      return $this->country;
    else
      return $this->defaultValue;
  }

  public function getSex()
  {
    $sex = array(0 => 'woman', 1 => 'man');
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

  public function getSchedule()
  {
    if ($this->schedule)
      return Date('F d Y', strtotime($this->schedule));
    else
      return $this->defaultValue;
  }

  public function getActive()
  {
    return $this->active ? 'Active' : '-';
  }

  public static function parseBirthday($birthday)
  {
    $parsed = date_parse_from_format('mdY', $birthday);
    return date('Y-m-d', mktime(
      $parsed['hour'],
      $parsed['minute'],
      $parsed['second'],
      $parsed['month'],
      $parsed['day'],
      $parsed['year']));
  }

  public static function parseSchedule($schedule)
  {
    $parsed = date_parse_from_format('mdY', $schedule);
    return date('Y-m-d', mktime(
      $parsed['hour'],
      $parsed['minute'],
      $parsed['second'],
      $parsed['month'],
      $parsed['day'],
      $parsed['year']));
  }

  public static function findByPhoneNumber($phoneNumber)
  {
    return Mother::where('phone_number', '=', $phoneNumber)->first();
  }

  public function checkPassword($password)
  {
    return ($this->password == $password);
  }

  public function baby()
  {
    return $this->hasOne('Baby');
  }

  public function checks()
  {
    return $this->hasMany('Check');
  }

  public static function getMotherColumns()
  {
    if (!static::$motherColumns)
    {
      $motherColumns = array(
        'Phone number',
        'Country',
    //    'Sex',
        'Birthday',
        'Blood Type',
        'Rh',
        'Expected Delivery Date',
        'Active',
      );
      static::$motherColumns = $motherColumns;
    }

    return static::$motherColumns;
  }

  public static function getCheckColumns()
  {
    if (!static::$checkColumns)
    {
      $checkColumns = range(1, 9);
      static::$checkColumns = $checkColumns;
    }

    return static::$checkColumns;
  }

  public function getMotherTable()
  {
    if (!$this->motherTable)
    {
      $phoneNumber = Session::get('user.name') == 'guest' ? $this->getMaskedPhoneNumber() : $this->getPhoneNumber();
      $motherTable = array(
        array(
          'name'  => '',
          'values' => array(
            $phoneNumber,
            $this->getCountry(),
    //        $this->getSex(),
            $this->getBirthday(),
            $this->getBlood(),
            $this->getRh(),
            $this->getSchedule(),
            $this->getActive(),
          ),
        ),
      );
      $this->motherTable = $motherTable;
    }

    return $this->motherTable;
  }

  public function getCheckTable()
  {
    if (!$this->checkTable)
    {
      $checkColumns = $this->getCheckColumns();

      $length = count($checkColumns);

      $checks = $this->checks()->orderBy('date_of_visit', 'asc')->limit($length)->get();

      $checkTable = array(
        array(
          'name'   => 'Date Of Visit',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Weight in kg',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Blood pressur',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Temperature',
          'values' => array_fill(0, $length, '-'),
        ),
        array(
          'name'   => 'Height of abdomen(in cm)',
          'values' => array_fill(0, $length, '-'),
        ),
      );
      foreach ($checks as $i => $check)
      {
        $checkTable[0]['values'][$i] = $check->getDateOfVisit();
        $checkTable[1]['values'][$i] = $check->getWeightInKg();
        $checkTable[2]['values'][$i] = $check->getBloodPressur();
        $checkTable[3]['values'][$i] = $check->getTemperature();
        $checkTable[4]['values'][$i] = $check->getHeightOfAbdomen();
      }

      $this->checkTable = $checkTable;
    }

    return $this->checkTable;
  }

  public function checkDateOfVisits()
  {
    return $this->getCheckData(0);
  }

  public function checkTemperatures()
  {
    return $this->getCheckData(3);
  }

  public function checkHeightOfAbdomens()
  {
    return $this->getCheckData(4);
  }

  public function checkWeightInKg()
  {
    return $this->getCheckData(1);
  }

  public function getCheckData($i)
  {
    $checkTable = $this->getCheckTable();
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