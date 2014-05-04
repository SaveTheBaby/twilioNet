<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      お子さんの予防接種の記録ですね。
      BCCを打った方は１番、
      三種混合ワクチンは２番、
      ポリオは３番、
      ＨＢＶ／Ｂ型肝炎は４番、
      ＡＭＶ／アンカラ修復ウィルスは５番、
      ＭＭＲ／麻疹、風疹おたふくは６番を押してください。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
