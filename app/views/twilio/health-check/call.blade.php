<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//お子さんの症状を確認します。
//       あなたの赤ちゃんは今日で生後{ $afterBirth }ヶ月です。
//       { $question }
//       入力が終わったらシャープを押して下さい。
//new
//こんにちは！Save the Babyです
//お子さんの症状を確認します。 あなたの赤ちゃんは今日で生後○ヶ月です。
//[質問事項]
//入力が終わったらシャープを押して下さい。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
     <Say voice="woman">
       Hello,This is Save the Baby!
       Please tell us the condition of the children.Your baby is old {{ $afterBirth }} months today.
       {{ $question }}
       and then enter the pound key.
     </Say>
  </Gather>
</Response>
