<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//Vaccination of polio has been recorded.　Next vaccination will be four weeks later.
//よろしければ１を訂正する場合は２を押してください。
//      入力が終わったらシャープを押して下さい。
//new
//"お子さんの○○の接種日を月・日・年で登録します。
//宜しければ1を、訂正する場合は0を押し、最後に♯（シャープ）を押してください。"
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Pause />
    <Say voice="woman">
      We will register as {{ $date }} the date of vaccination of {{ $name }}.
    </Say>
    <Pause />
    <Say voice="woman">
      Please press 1 if there is no problem,
    </Say>
    <Pause />
    <Say voice="woman">
      press 0 if you want to correct,
    </Say>
    <Pause />
    <Say voice="woman">
      and then enter the pound key.
    </Say>
  </Gather>
</Response>
