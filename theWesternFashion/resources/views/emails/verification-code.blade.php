<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Your verification code</title>
</head>
<body style="margin:0;padding:0;background:#fafafa;font-family:Arial,Helvetica,sans-serif;color:#000;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:420px;background:#fff;border:1px solid #e5e5e5;border-radius:12px;padding:32px;">
          <tr>
            <td align="center" style="padding-bottom:16px;">
              <div style="display:inline-block;width:44px;height:44px;line-height:44px;border-radius:6px;background:#000;color:#fff;font-family:Georgia,serif;font-size:24px;">w</div>
            </td>
          </tr>
          <tr>
            <td style="font-size:16px;padding-bottom:8px;">
              Hi {{ $user->name }},
            </td>
          </tr>
          <tr>
            <td style="font-size:14px;color:#525252;padding-bottom:24px;line-height:1.5;">
              Use the code below to verify your email address. It expires in 10 minutes.
            </td>
          </tr>
          <tr>
            <td align="center" style="padding-bottom:24px;">
              <div style="display:inline-block;padding:14px 24px;background:#f5f5f5;border-radius:8px;font-size:32px;font-weight:700;letter-spacing:8px;">
                {{ $code }}
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-size:12px;color:#a3a3a3;line-height:1.5;">
              If you didn't create an account, you can safely ignore this email.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>