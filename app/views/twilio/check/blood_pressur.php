<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      血圧を入力して下さい。
      小数点はアスタリスクを使用して下さい。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
