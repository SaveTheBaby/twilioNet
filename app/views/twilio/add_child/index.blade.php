<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

//old
//ご出産おめでとうございます。まずは生年月日を入力してください。
//      入力が終わったらシャープを押して下さい。

//new
// ④ご出産、おめでとうございます！
//うまれた赤ちゃんの情報を入力しましょう。赤ちゃんの誕生日を月・日・西暦で入力し最後に♯（シャープ）を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Congratulations on the birth of your child!
    </Say>
    <Pause />
    <Say voice="woman">
      Please input baby's data. 
    </Say>
    <Pause />
    <Say voice="woman">
      Please input baby's birth month in two numbers, 
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
