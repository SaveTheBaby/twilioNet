<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
     <Say language='ja-jp'>
       お子さんの症状を確認します。
       あなたの赤ちゃんは今日で生後{{ $afterBirth }}ヶ月です。
       {{ $question }}
       入力が終わったらシャープを押して下さい。
     </Say>
  </Gather>
</Response>
