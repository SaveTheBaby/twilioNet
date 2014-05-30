<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
// $name の予防接種ですね。ワクチンを打った日にちを年月日の順に数字をプッシュしてください。
//入力が終わったらシャープを押して下さい。
//new
//ワクチンを打った日を月・日・西暦で入力し最後に♯（シャープ）を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Please input date of vaccination, month, day, year, 
    </Say>
    <Pause />
    <Say voice="woman">
      and then enter the pound key.  
    </Say>
  </Gather>
</Response>
