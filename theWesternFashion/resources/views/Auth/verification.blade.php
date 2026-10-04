{{-- resources/views/emails/verification-code.blade.php --}}
<div style="font-family: Arial, Helvetica, sans-serif; max-width: 480px; margin: 0 auto; padding: 24px; color: #000;">
    <h2 style="margin: 0 0 12px; font-weight: 600;">Verify your email</h2>

    <p style="margin: 0 0 12px;">Hi {{ $user->name }},</p>
    <p style="margin: 0 0 16px;">Use this code to finish setting up your thewesternfashion admin account:</p>

    <p style="margin: 0 0 16px; padding: 16px; background: #f5f5f5; border-radius: 8px;
              text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px;">
        {{ $code }}
    </p>

    <p style="margin: 0; color: #666; font-size: 14px;">
        This code expires in 10 minutes. If you didn't ask for it, you can safely ignore this email.
    </p>
</div>