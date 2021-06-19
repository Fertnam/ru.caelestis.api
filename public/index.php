<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);

?>

    <script async type="text/javascript">
        document.write('<script type="text/javascript" src="https://intellectmoney.ru/payform.js?bankcard=on&user_email=on&open_in_new_window=on&writer=now&serviceName=%20%D0%9F%D0%BE%D0%BF%D0%BE%D0%BB%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5%20%D1%81%D1%87%D0%B5%D1%82%D0%B0&serviceName_tip=&UserFieldName_1=&UserFieldName_1_tip=&default_sum=100.00&comment_tip=&successUrl=http%3A%2F%2Fcaelestis.ru&inn=870901737607&btn_name=pay&eshopId=459474"><\/script>');
    </script>

<?php
