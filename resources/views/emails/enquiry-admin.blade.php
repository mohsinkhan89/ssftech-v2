<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New website enquiry</title>
    <style>
        @media only screen and (max-width:620px){.email-shell{width:100%!important}.email-pad{padding:26px 18px!important}.email-title{font-size:25px!important}.detail-label,.detail-value{display:block!important;width:100%!important}.detail-label{padding:12px 16px 3px!important}.detail-value{padding:0 16px 12px!important}}
    </style>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#252932;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:24px 12px;"><tr><td align="center">
    <table role="presentation" class="email-shell" width="640" cellspacing="0" cellpadding="0" style="width:640px;max-width:100%;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 12px 36px rgba(15,23,42,.09);">
        <tr><td style="padding:24px 30px;background:linear-gradient(135deg,#050508,#1b0308);border-bottom:4px solid #e40914;"><img src="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" width="170" alt="SSF Tech" style="display:block;max-width:170px;height:auto;"></td></tr>
        <tr><td class="email-pad" style="padding:38px 38px 34px;">
            <div style="color:#e40914;font-size:12px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;">New website enquiry</div>
            <h1 class="email-title" style="margin:10px 0 22px;color:#15171c;font-size:30px;line-height:1.2;">{{ $enquiry->name }} contacted SSF Tech</h1>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">
                @foreach([['Name',$enquiry->name],['Email',$enquiry->email],['Phone',$enquiry->phone],['Service / Subject',$enquiry->service ?: 'Not specified'],['Submitted',$enquiry->created_at?->format('d M Y, h:i A')]] as [$label,$value])
                    <tr><td class="detail-label" width="34%" style="padding:12px 16px;border-bottom:1px solid #eceef1;background:#f8f9fa;color:#6b7280;font-size:12px;font-weight:700;text-transform:uppercase;">{{ $label }}</td><td class="detail-value" style="padding:12px 16px;border-bottom:1px solid #eceef1;color:#252932;font-size:14px;">{{ $value }}</td></tr>
                @endforeach
            </table>
            <div style="margin-top:22px;padding:20px;border-left:4px solid #e40914;border-radius:8px;background:#fafafa;"><strong style="display:block;margin-bottom:8px;color:#17191e;font-size:14px;">Customer message</strong><p style="margin:0;color:#515863;font-size:14px;line-height:1.75;white-space:pre-line;">{{ $enquiry->message }}</p></div>
            <p style="margin:22px 0 0;color:#6b7280;font-size:13px;line-height:1.65;">Reply directly to this email to respond to {{ $enquiry->name }}.</p>
        </td></tr>
        <tr><td style="padding:20px 30px;background:#0a0b0f;color:#aeb3bc;text-align:center;font-size:12px;">SSF Tech enquiry notification · Message #{{ $enquiry->id }}</td></tr>
    </table>
</td></tr></table>
</body>
</html>
