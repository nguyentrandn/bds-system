―――――――――――――――――――――――――――――――――――
このメッセージは「{{config('app.name')}}」運用局より自動送信されています。
お心当たりのない場合は、誠にお手数ですが本メールへの返信にてご連絡ください。
―――――――――――――――――――――――――――――――――――
{{$param['fullname']}} 様

「{{config('app.name')}}」運用局より管理画面への招待が届いています。

下記のリンクより新規登録をお願い致します。

下記のURLから管理画面のパスワードを新規登録してください。

{{config('app.admin_url').'/admin/active-account?token='.$param['invitation_token']}}

ご不明な点がありましたらお手数ですが、
本メールの返信にてご連絡ください。

----------
{!!EMAIL_SIGN!!}
----------