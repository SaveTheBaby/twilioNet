<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      性別を入力してください。男の子の場合は１を女の子の場合は０を入力してください。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
