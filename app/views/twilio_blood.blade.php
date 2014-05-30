<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//血液型を選んでください。
//      Ａ型は１、Ｂ型は２、Ｏ型は３、ＡＢ型は４、不明の場合は０を入力して下さい。
//      入力が終わったらシャープを押して下さい。
//new
//あなたの血液型を選んでください。
//A型のかたは、１番
//B型のかたは、２番
//O型のかたは、３番
//AB型のかたは、４番
//分からない方は、０番を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Pause />
    <Say voice="woman">
      Please choose the your blood type.
    </Say>
    <Pause />
    <Say voice="woman">
      Press 1 for type A
    </Say>
    <Pause />
    <Say voice="woman">
      Press 2 for type B
    </Say>
    <Pause />
    <Say voice="woman">
      Press 3 for type O
    </Say>
    <Pause />
    <Say voice="woman">
      Press 4 for type AB
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

