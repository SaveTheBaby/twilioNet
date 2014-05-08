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
    <Say>
      Congratulations on the birth of your child!
    </Say>
    <Say>
      Please input baby's data. Please input baby's birthday month, day, year, and then enter the pound key.
    </Say>
  </Gather>
</Response>
