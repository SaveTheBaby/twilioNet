<?php
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      出産予定日を西暦・月・日で入力しましょう。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
