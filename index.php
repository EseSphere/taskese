<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>TaskEse | Task Board - Collaborative Task and Workflow Management</title>
    <meta name="title" content="Task Board Collaborative Task and Workflow Management">
    <meta name="description" content="Task Board helps teams organize, prioritize, and complete work with real-time updates, detailed reporting, and seamless communication across devices.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://yourdomain.com/">
    <meta property="og:title" content="Task Board Collaborative Task and Workflow Management">
    <meta property="og:description" content="Task Board helps teams organize, prioritize, and complete work with real-time updates, detailed reporting, and seamless communication across devices.">
    <meta property="og:image" content="https://yourdomain.com/images/og-image.jpg">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://yourdomain.com/">
    <meta property="twitter:title" content="Task Board Collaborative Task and Workflow Management">
    <meta property="twitter:description" content="Task Board helps teams organize, prioritize, and complete work with real-time updates, detailed reporting, and seamless communication across devices.">
    <meta property="twitter:image" content="https://yourdomain.com/images/twitter-image.jpg">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="author" content="Task Board Team">
    <link rel="icon" href="img/gsLogo.png" />
    <link rel="icon" href="img/gsLogo.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700|Roboto:300,400,700&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="vendor/aos/aos.css" rel="stylesheet">
    <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script>
        window.location = 'app/';
    </script>
</head>

<body>
    <?php
    // DB Connection
    require_once __DIR__ . '/db_connect.php';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Get IP address
    function getUserIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    $ip = getUserIP();

    // Get location info using free API (e.g. ip-api.com)
    $locationData = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}?fields=status,country,city"));

    $country = ($locationData && $locationData->status == "success") ? $locationData->country : "Unknown";
    $city = ($locationData && $locationData->status == "success") ? $locationData->city : "Unknown";

    // Get User Agent Info
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    function getOS($userAgent)
    {
        $osArray = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/linux/i' => 'Linux',
            '/iphone/i' => 'iPhone',
            '/android/i' => 'Android',
        ];
        foreach ($osArray as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                return $value;
            }
        }
        return "Unknown OS";
    }

    function getBrowser($userAgent)
    {
        $browserArray = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/chrome/i' => 'Chrome',
            '/safari/i' => 'Safari',
            '/opera/i' => 'Opera',
            '/edge/i' => 'Edge',
        ];
        foreach ($browserArray as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                return $value;
            }
        }
        return "Unknown Browser";
    }

    $os = getOS($userAgent);
    $browser = getBrowser($userAgent);

    // Store data
    $stmt = $conn->prepare("INSERT INTO user_tracking (ip_address, country, city, device, browser, os) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $ip, $country, $city, $userAgent, $browser, $os);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    ?>
</body>

</html>