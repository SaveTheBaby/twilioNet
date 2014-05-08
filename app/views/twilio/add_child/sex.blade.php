<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//性別を入力してください。男の子の場合は１を女の子の場合は０を入力してください。
//      入力が終わったらシャープを押して下さい。

//new
//⑦続いて、性別を選択し、最後に♯（シャープ）を押してください。
//男の子は１番
//女の子は２番を押してください。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say>
      Gender selection,and then enter the pound key.
    </Say>
    <Say>
      Press 1 for male
    </Say>
    <Say>
      Press 2 for female
    </Say>
  </Gather>
</Response>
