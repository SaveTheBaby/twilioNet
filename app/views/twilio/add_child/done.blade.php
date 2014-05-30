<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
//old
//これで登録手続きは完了しました。
//new
//⑧「これで、登録手続きは完了しました。
//これで、赤ちゃんが予防接種の記録ができます。
//次回の予防接種の予定は、SMSでご案内します。
//ありがとうございました。」
?>
<Response>
  <Pause /> 
  <Say voice="woman">
    This is the end of the registration.
  </Say>
  <Pause />
  <Say voice="woman">
    The baby's vaccination record was be registered.
  </Say>
  <Pause />
  <Say voice="woman">
    The next vaccination appointment will be sent by SMS.
  </Say>
  <Pause />
  <Say voice="woman">
    Thank you very much.
  </Say>
</Response>
