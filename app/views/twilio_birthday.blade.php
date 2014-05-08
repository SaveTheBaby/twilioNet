<?php
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
// old
//生年月日を西暦・月・年で入力しましょう。
//入力が終わったらシャープを押して下さい。

// new
//あなたの情報を入力しましょう。あなたの誕生日を月・日・西暦で入力してください。
?>
<Response>
  <Gather action="<?php echo $actionUrl ?>" method="GET" finishOnKey="#" timeout="60">
    <Say voice="woman">
      Please input your data. Please input your birthday month, day, and year, and then enter the pound key.
    </Say>
  </Gather>
</Response>