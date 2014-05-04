<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      定期健診を開始します。４桁のＩＤを入力してください。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
