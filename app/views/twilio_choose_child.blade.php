<?php
  //header("content-type: text/xml");
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
  <Gather action='http://savethebaby.heteml.jp/savethebaby1/public/twilio/choose-child?mother_id=<?php echo $mother_id; ?>' method='GET' finishOnKey='#'>
    <Say language='ja-jp'>
      はじめに使用するユーザーアイディーを入力しシャープを押してください。
    </Say>
  </Gather>
</Response>
