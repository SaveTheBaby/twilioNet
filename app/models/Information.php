<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Information extends Eloquent {

  protected $table = 'information';
  protected static $informationColumns;
  protected $informationTableRow;
  public static $unguarded = true;
  protected $defaultValue = '-';

  public static function getInformationColumns()
  {
    if (!static::$informationColumns)
    {
      $healthCheckColumns = array(
        'id',
        'Content',
        'Call at',
        Session::get('user.name') == 'guest' ? '*1' : ' ',
      );
      static::$informationColumns = $healthCheckColumns;
    }

    return static::$informationColumns;
  }

  public function getContent()
  {
    if ($this->content)
      return nl2br($this->content);
    else
      return $this->defaultValue;
  }

  protected static $type = array(
    1 => 'Normal',
    2 => 'Disaster',
  );

  public function getType()
  {
    if ($this->type)
    {
      if (isset(static::$type[$this->type]))
        return static::$type[$this->type];
    }

    return $this->defaultValue;
  }

  public function getCallAt()
  {
    if ($this->call_at)
      return date('F d Y H:i:s', strtotime($this->call_at));
    else
      return $this->defaultValue;
  }

  public function getInformationTableRow()
  {
    if (!$this->informationTableRow)
    {
      $healthCheckTableRow = array(
        array(
          'type'  => 'text',
          'value' => $this->id,
        ),
        array(
          'type'  => 'text',
          'value' => $this->getContent(),
        ),
        array(
          'type'  => 'text',
          'value' => $this->getCallAt(),
        ),
        array(
          'type'  => 'link',
          'value' => 'Call',
          'attributes' => array(
            'url'   => URL::to('information/call?Id='.$this->id),
            'class' => 'btn btn-success'
          ),
        ),
      );
      $this->informationTableRow = $healthCheckTableRow;
    }

    return $this->informationTableRow;
  }
} 