<?php
//header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say language="ja-jp">
      ようこそ Save the babyへ！
      あなたの国は <?php echo $country ?> です。
      はじめに使用する４桁のユーザーアイディーを入力しシャープを押してください。
    </Say>
  </Gather>
</Response>