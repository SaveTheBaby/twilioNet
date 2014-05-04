<?php
//header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language='ja-jp'>
      血液型を選んでください。
      Ａ型は１、Ｂ型は２、Ｏ型は３、ＡＢ型は４、不明の場合は０を入力して下さい。
      入力が終わったらシャープを押して下さい。
    </Say>
  </Gather>
</Response>
