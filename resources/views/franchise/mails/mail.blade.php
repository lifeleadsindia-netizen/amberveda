<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Franchise Created - {{ config('detailsApp.name') }}</title>
    <style>
        body{margin:0;padding:0;background:#f3f4f6;font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;}
        .container{width:100%;padding:24px 12px;}
        .wrap{max-width:640px;margin:0 auto;background:#ffffff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;}
        .header{background:#1f2937;color:#fff;padding:22px 20px;text-align:center;}
        .header img{width:70px;height:auto;border-radius:10px;display:block;margin:0 auto 10px auto;}
        .header h1{margin:0;font-size:20px;letter-spacing:0.2px;}
        .header p{margin:6px 0 0 0;font-size:13px;opacity:0.9;}
        .body{padding:20px;}
        .card{border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;margin-top:14px;}
        .card-header{background:#f9fafb;padding:12px 14px;border-bottom:1px solid #e5e7eb;}
        .card-header h2{margin:0;font-size:16px;color:#111827;}
        .card-body{padding:14px;}
        .muted{color:#6b7280;font-size:13px;line-height:1.6;margin:0;}
        .table{width:100%;border-collapse:collapse;margin-top:8px;}
        .table td{padding:10px 8px;border-top:1px solid #e5e7eb;vertical-align:top;font-size:13px;}
        .table td.label{width:42%;color:#374151;font-weight:600;background:#fcfcfd;}
        .table td.value{color:#111827;}
        .btn{display:inline-block;margin-top:14px;background:#2563eb;color:#ffffff;text-decoration:none;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:600;}
        .notice{margin-top:14px;padding:12px 12px;border-radius:10px;background:#fff7ed;border:1px solid #fed7aa;color:#7c2d12;font-size:12.5px;line-height:1.6;}
        .footer{padding:16px 20px;background:#f9fafb;border-top:1px solid #e5e7eb;text-align:center;}
        .footer p{margin:0;color:#6b7280;font-size:12px;line-height:1.6;}
        @media (max-width:520px){
            .container{padding:14px 8px;}
            .body{padding:16px;}
            .table td.label{width:50%;}
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrap">
            <div class="header">
                <img src="{{ $message->embed(public_path().'/logo/logo.png') }}" alt="{{ config('detailsApp.name') }}">
                <h1>{{ config('detailsApp.name') }}</h1>
                <p>Franchise account created successfully</p>
            </div>

            <div class="body">
                <p class="muted">Hi <strong>{{ $name }}</strong>,</p>
                <p class="muted" style="margin-top:6px;">Your franchise account has been created. Below are the details as per the Create Franchise form.</p>

                <div class="card">
                    <div class="card-header">
                        <h2>Create Franchise Details</h2>
                    </div>
                    <div class="card-body">
                        <table class="table" role="presentation">
                            <tr>
                                <td class="label">Franchise ID</td>
                                <td class="value">{{ $franchise_id }}</td>
                            </tr>
                            <tr>
                                <td class="label">Name</td>
                                <td class="value">{{ $name }}</td>
                            </tr>
                            <tr>
                                <td class="label">Mobile</td>
                                <td class="value">{{ $mobile }}</td>
                            </tr>
                            <tr>
                                <td class="label">Email</td>
                                <td class="value">{{ $email }}</td>
                            </tr>
                            <tr>
                                <td class="label">State</td>
                                <td class="value">{{ $state }}</td>
                            </tr>
                            <tr>
                                <td class="label">City</td>
                                <td class="value">{{ $city }}</td>
                            </tr>
                            <tr>
                                <td class="label">Country</td>
                                <td class="value">{{ $country }}</td>
                            </tr>
                            <tr>
                                <td class="label">Commission (%)</td>
                                <td class="value">{{ $commission }}</td>
                            </tr>
                            <tr>
                                <td class="label">Login Password</td>
                                <td class="value">{{ $password }}</td>
                            </tr>
                        </table>

                        <a class="btn" href="{{ url('/franchise_panel') }}">Login to Franchise Panel</a>

                        <div class="notice">
                            <strong>Security note:</strong> Please change your password after first login and do not share it with anyone.
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p>If you need help, contact support.</p>
                <p>With regards, Team {{ config('detailsApp.name') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
