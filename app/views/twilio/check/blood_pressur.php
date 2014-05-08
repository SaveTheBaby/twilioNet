<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//血圧を入力して下さい。
//      小数点はアスタリスクを使用して下さい。
//      入力が終わったらシャープを押して下さい。
//new
//血圧を記録します。数字をプッシュし最後に♯を押してください。小数点はアスタリスクで入力してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Input the number for the blood pressuer and then enter the pound key. Please enter a decimal point with an asterisk
    </Say>
  </Gather>
</Response>
