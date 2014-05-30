<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//体温を入力して下さい。
//      小数点はアスタリスクを使用して下さい。
//      入力が終わったらシャープを押して下さい。

//new
//体温を記録します。数字をプッシュし最後に♯を押してください。小数点はアスタリスクで入力してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Pause />
    <Say voice="woman">
      Input the number for the temperature, and then enter the pound key. 
    </Say>
    <Pause />
    <Say voice="woman">
      Please enter a decimal point with an asterisk
    </Say>
  </Gather>
</Response>
