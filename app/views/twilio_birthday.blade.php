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
    <Pause />
    <Say voice="woman">
      Please input your data. 
    </Say>
    <Pause />
    <Say voice="woman">
      Please input your birth month in two numbers, 
    </Say>
    <Pause />
    <Say voice="woman">
      birth day in two numbers,  
    </Say>
    <Pause />
    <Say voice="woman">
      birth year in four numbers,  
    </Say>
    <Pause />
    <Say voice="woman">
      and then enter the pound key.  
    </Say>
  </Gather>
</Response>