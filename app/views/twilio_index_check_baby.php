<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
// old
//出産しましたか？
//出産した場合は１、そうでない場合は２を入力して下さい。
//入力が終わったらシャープを押して下さい。

// new
//① こんにちは！Save the Babyです
//あなたの記録は１番
//赤ちゃんが記録は２番をプッシュし最後に♯（シャープ）を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Hello,This is Save the Baby!
    </Say>
    <Say voice="woman">
      Press 1, if this is the mother's number.
    </Say>
    <Say voice="woman">
      Press 2, if this is the Baby's record, and then enter the pound key.
    </Say>
  </Gather>
</Response>
