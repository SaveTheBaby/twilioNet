<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//定期健診を開始します。４桁のＩＤを入力してください。
//      入力が終わったらシャープを押して下さい。

//new
//妊婦さんの定期健診の記録ですね。
//はじめに、あなたの４桁のID番号をプッシュし、最後に♯（シャープ）を押してください。?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Pregnant mother's periodic medical check-up record.
    </Say>
    <Say voice="woman">
      Please input the mother's 4-digit ID number and then enter the pound key.
    </Say>
  </Gather>
</Response>
