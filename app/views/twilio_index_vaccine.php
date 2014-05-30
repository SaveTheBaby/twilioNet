<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//お子さんの予防接種の記録ですね。
//      BCCを打った方は１番、
//      三種混合ワクチンは２番、
//      ポリオは３番、
//      ＨＢＶ／Ｂ型肝炎は４番、
//      ＡＭＶ／アンカラ修復ウィルスは５番、
//      ＭＭＲ／麻疹、風疹おたふくは６番を押してください。
//      入力が終わったらシャープを押して下さい。

//new
//お子さんの予防接種の記録ですね。
//ワクチンをプッシュし最後に♯（シャープ）を押してください。
//BCGを打った方は、１番
//三種混合ワクチンは２番
//ポリオは3番
//HBV/B型肝炎は４番
//AMV/アンカラ修復ウィルスは５番
//MMR/麻疹・風疹・おたふくは６番
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Pause />
    <Say voice="woman">
      Baby's vaccination record
    </Say>
    <Pause />
    <Say voice="woman">
      Please input the monther's 4-digit ID number and then enter the pound key.
    </Say>
    <Pause />
    <Say voice="woman">
      Please choose Vaccine, and then enter the pound key.
    </Say>
    <Pause />
    <Say voice="woman">
      Press 1 for BCG
    </Say>
    <Pause />
    <Say voice="woman">
      Press 2 for DPT vaccine
    </Say>
    <Pause />
    <Say voice="woman">
      Press 3 for OPV/Oral Polio Vaccine
    </Say>
    <Pause />
    <Say voice="woman">
      Press 4 for HBV/Hepatitis B Virus
    </Say>
    <Pause />
    <Say voice="woman">
      Press 5 for AMV/Ankara Modified Virus
    </Say>
    <Pause />
    <Say voice="woman">
      Press 6 for MMR/Measles, Mumps, Rubella
    </Say>
  </Gather>
</Response>
