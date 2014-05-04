<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      <?php echo $name ?>の予防接種ですね。ワクチンを打った日にちを年月日の順に数字をプッシュしてください。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
