<?php
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TwimlGenerator extends Command {

  protected $name = 'twiml:generate';
  protected $description = "TwiML Generator.";

  public function __construct()
  {
    parent::__construct();
  }

  public function fire()
  {
    echo 'Generated!';
  }

  protected function getArguments()
  {
    return array();
  }

  protected function getOptions()
  {
    return array();
  }
}