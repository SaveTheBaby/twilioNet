<?php
class VaccinationSeeder extends Seeder {

  public function run()
  {
    DB::table('vaccinations')->delete();

    $params = array(
      array(1, '2014-01-01', 1),
      array(1, '2014-02-02', 2),
      array(1, '2014-02-11', 2),
      array(1, '2014-02-20', 3),
      array(1, '2014-02-03', 4),
      array(1, '2014-02-05', 5),
      array(2, '2014-01-05', 1),
      array(2, '2014-02-10', 2),
      array(2, '2014-03-08', 3),
      array(2, '2014-04-02', 3),
      array(2, '2014-05-09', 4),
      array(2, '2014-02-28', 5),
    );

    foreach ($params as $param)
    {
      Vaccination::create(array(
        'baby_id' => $param[0],
        'date'    => $param[1],
        'type'    => $param[2],
      ));
    }

  }

} 