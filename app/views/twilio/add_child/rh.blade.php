<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//ＲＨプラスの方は１番、ＲＨマイナスの方は２番を、わからない場合は０番を押して下さい。
//      入力が終わったらシャープを押して下さい。
//new
//⑥Rh ＋ の方は、 １番
//Rh ー の方は２番
//分からない方は０番を選択し、最後に♯（シャープ）を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say>
      Press 1 for Rh+
    </Say>
    <Say>
      Press 2 for Rh-
    </Say>
    <Say>
      Press 0, if not known, and then enter the pound key.
    </Say>
  </Gather>
</Response>
