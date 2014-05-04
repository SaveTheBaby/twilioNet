<?php
  //header("content-type: text/xml");
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      ＲＨプラスの方は１番、ＲＨマイナスの方は２番を、わからない場合は０番を押して下さい。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
