<?php
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//出産予定日を西暦・月・日で入力しましょう。
//      入力が終わったらシャープを押して下さい。

//new
//出産予定日を月・日・西暦で入力し、最後に♯（シャープ）を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Please input expected delivery date month, day, year, and then enter the pound key.
    </Say>
  </Gather>
</Response>
