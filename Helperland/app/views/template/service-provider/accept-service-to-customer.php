<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div style="padding:10px 15px;border-radius:4px;border:0.5px solid lightgray;">
        <p style="padding:8px 0; text-align:center; font-size:14px;font-weight:bold;color:#4f4f4f">Service has been accepted by a Service Provider</p>
        <p style="padding:8px 0; text-align:center; font-size:14px;font-weight:bold;color:#4f4f4f">Details has been mentioned below</p>
        <!-- SERVICE PROVIDER -->
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Service Provider Name : </span>
            <span>$ServiceProviderName</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Service Provider Email Address : </span>
            <span>$ServiceProviderEmail</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Serivce Provider Mobile Number : </span>
            <span>$ServiceProviderMobile</span>
        </p>
        <!-- TITLE SERVICE DETAILS -->
        <p style="padding:6px; text-align:center; border-radius:4px; margin:6px 0; font-size:12px;font-weight:bold; background-color:#ff6b6b; color:white">SERVICE DETAILS</p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Service Id : </span>
            <span>$ServiceRequestId</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Service Date : </span>
            <span>$ServiceDate</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Start Time : </span>
            <span>$StartTime</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">End Time : </span>
            <span>$EndTime</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Extra : </span>
            <span>$ExtraService</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Comments : </span>
            <span>$Comments</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Have a Pets : </span>
            <span>$HasPets</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Total Working Time : </span>
            <span>$Duration Hours</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Service Address : </span>
            <span>$AddressLine1 $AddressLine2, $PostalCode, $City</span>
        </p>
        <p style="padding:4px 0; font-size:12px">
            <span style="font-weight:bold;color:#4f4f4f">Payment : </span>
            <span style="font-wieght:bold;color:#1D7A8C">€$TotalCost</span>
        </p>
        <!-- FOOTER -->
        <p style="padding:10px 0 0;font-size:12px;color:gray;">Thanks,</p>
        <p style="padding:5px 0;font-size:12px;color:gray;">Helperland Team</p>
    </div>
</body>
</html>
