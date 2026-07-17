<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>We received your message</title>
    <style>
        @media only screen and (max-width:620px){.email-shell{width:100%!important}.email-pad{padding:28px 20px!important}.email-title{font-size:26px!important}.email-button{display:block!important;text-align:center!important}.detail-label,.detail-value{display:block!important;width:100%!important}.detail-label{padding-bottom:4px!important}.detail-value{padding-top:0!important}}
    </style>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#252932;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:24px 12px;"><tr><td align="center">
    <table role="presentation" class="email-shell" width="600" cellspacing="0" cellpadding="0" style="width:600px;max-width:100%;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 12px 36px rgba(15,23,42,.09);">
        <tr><td style="padding:24px 30px;background:linear-gradient(135deg,#050508,#1b0308);border-bottom:4px solid #e40914;"><img src="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" width="170" alt="SSF Tech" style="display:block;max-width:170px;height:auto;"></td></tr>
        <tr><td class="email-pad" style="padding:42px 42px 36px;">
            <div style="color:#e40914;font-size:12px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;">Message received</div>
            <h1 class="email-title" style="margin:10px 0 18px;color:#15171c;font-size:32px;line-height:1.2;">Thank you, {{ $enquiry->name }}.</h1>
            <p style="margin:0 0 16px;color:#5f6670;font-size:15px;line-height:1.75;">We’ve received your enquiry and a member of the SSF Tech team will review it shortly. We’ll get back to you as soon as possible.</p>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:24px 0;border:1px solid #e7e9ed;border-radius:10px;background:#fafafa;overflow:hidden;">
                <tr><td style="padding:18px 20px;"><strong style="display:block;margin-bottom:8px;color:#e40914;font-size:13px;">Your message</strong><p style="margin:0;color:#4f5661;font-size:14px;line-height:1.7;white-space:pre-line;">{{ $enquiry->message }}</p></td></tr>
            </table>
            <p style="margin:0 0 24px;color:#5f6670;font-size:14px;line-height:1.7;">If you need to add anything, simply reply to this email or contact us through our website.</p>
            <a class="email-button" href="{{ route('index') }}" style="display:inline-block;padding:13px 22px;border-radius:8px;background:#e40914;color:#fff;text-decoration:none;font-size:14px;font-weight:700;">Visit SSF Tech</a>
        </td></tr>
        <tr><td style="padding:22px 30px;background:#0a0b0f;color:#aeb3bc;text-align:center;font-size:12px;line-height:1.6;">© {{ date('Y') }} SSF Tech. This is an automatic confirmation of your website enquiry.</td></tr>
    </table>
</td></tr></table>
</body>
</html>
