<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class HealthCheck extends Eloquent {

  protected $table = 'health_checks';
  protected static $healthCheckColumns;
  protected $healthCheckTableRow;
  public static $unguarded = true;
  protected $defaultValue = '-';

  public function healthCheckAnswer()
  {
    return $this->hasMany('HealthCheckAnswer');
  }

  public function getQuestion()
  {
    if ($this->question)
      return nl2br($this->question);
    else
      return $this->defaultValue;
  }

  public function getDeliveryAt()
  {
    if ($this->delivery_at)
      return date('F d Y H:i:s', strtotime($this->delivery_at));
    else
      return $this->defaultValue;
  }


  public static function getHealthCheckColumns()
  {
    if (!static::$healthCheckColumns)
    {
      $healthCheckColumns = array(
        'id',
        'Question',
        'Delivery at',
        Session::get('user.name') == 'guest' ? '*1' : ' ',
        '1',
        '2',
        '3',
        '4',
      );
      static::$healthCheckColumns = $healthCheckColumns;
    }

    return static::$healthCheckColumns;
  }

  public function getHealthCheckTableRow()
  {
    if (!$this->healthCheckTableRow)
    {
      $healthCheckTableRow = array(
        array(
          'type'  => 'text',
          'value' => $this->id,
        ),
        array(
          'type'  => 'text',
          'value' => $this->getQuestion(),
        ),
        array(
          'type'  => 'text',
          'value' => $this->getDeliveryAt(),
        ),
        array(
          'type'  => 'link',
          'value' => 'Sent',
          'attributes' => array(
            'url'   => URL::to('health-check/sent?Id='.$this->id),
            'class' => 'btn btn-success'
          ),
        ),
        array(
          'type' => 'text',
          'value' => $this->healthCheckAnswer()->where('answer', '=', '1')->count(),
        ),
        array(
          'type' => 'text',
          'value' => $this->healthCheckAnswer()->where('answer', '=', '2')->count(),
        ),
        array(
          'type' => 'text',
          'value' => $this->healthCheckAnswer()->where('answer', '=', '3')->count(),
        ),
        array(
          'type' => 'text',
          'value' => $this->healthCheckAnswer()->where('answer', '=', '4')->count(),
        ),
      );
      $this->healthCheckTableRow = $healthCheckTableRow;
    }

    return $this->healthCheckTableRow;
  }
} 