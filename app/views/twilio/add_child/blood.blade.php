<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//血液型を選んでください。
//      Ａ型は１、Ｂ型は２、Ｏ型は３、ＡＢ型は４、不明の場合は０を入力して下さい。
//      入力が終わったらシャープを押して下さい。

//new
//⑤赤ちゃんの血液型を選択し、最後に♯（シャープ）を押してください。
//A型のかたは、１番
//B型のかたは、２番
//O型のかたは、３番
//AB型のかたは、４番
//分からない方は、０番を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say>
      Please choose the baby's blood type,and then enter the pound key.
    </Say>
    <Say>
      Press 1 for type A
    </Say>
    <Say>
      Press 2 for type B
    </Say>
    <Say>
      Press 3 for type O
    </Say>
    <Say>
      Press 4 for type AB
    </Say>
    <Say>
      Press 0, if not known
    </Say>
  </Gather>
</Response>
