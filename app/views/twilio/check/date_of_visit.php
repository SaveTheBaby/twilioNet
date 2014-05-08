<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//今日の日付を入力して下さい。
//      入力が終わったらシャープを押して下さい。

//new
//定期検診の記録をします。
//診察した日を、月・日・西暦で入力し最後に♯を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Record periodic medical check-up
    </Say>
    <Say voice="woman">
      Please input medical check-up day, day,month, year, and then enter the pound key.
    </Say>
  </Gather>
</Response>
