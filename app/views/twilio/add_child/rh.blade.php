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
    <Pause /> 
    <Say voice="woman">
      Press 1 for Rh plus,
    </Say>
    <Pause />
    <Say voice="woman">
      Press 2 for Rh minus,
    </Say>
    <Pause />
    <Say voice="woman">
      Press 0, if not known,
    </Say>
    <Pause />
    <Say voice="woman">
      and then enter the pound key.  
    </Say>
  </Gather>
</Response>
