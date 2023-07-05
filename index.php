<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
// die($_SERVER['REQUEST_URI']);
// print_r($_SERVER);
//require_once('src/Bramus/Router/Router.php');
require_once "config.php";
require_once "vendor/autoload.php";
require_once "lib/rigctl/rigctl.php";
require_once "data/errors_hamlib.php";


$router = new \Bramus\Router\Router();
$router->set404(function() { 
    header('HTTP/1.1 404 Not Found'); 
    echo "Error 404!"; 
});

$router->get('/', function () { echo file_get_contents('usage.html');});
$router->get('/trx/(\d+)/frequency', function($trx_id) { echo get_trx_frequency($trx_id);});
$router->post('/trx/(\d+)/frequency', function($trx_id) { echo set_trx_frequency(json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/mode', function($trx_id) { echo get_trx_mode($trx_id);});
$router->post('/trx/(\d+)/mode', function($trx_id) { echo set_trx_mode(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/split_frequency', function($trx_id) { echo get_trx_split_frequency($trx_id);});
$router->post('/trx/(\d+)/split_frequency', function($trx_id) { echo set_trx_split_frequency(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/split_mode', function($trx_id) { echo get_trx_split_mode($trx_id);});
$router->post('/trx/(\d+)/split_mode', function($trx_id) { echo set_trx_split_mode(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/split_frequency_mode', function($trx_id) { echo get_trx_split_frequency_mode($trx_id);});
$router->post('/trx/(\d+)/split_frequency_mode', function($trx_id) { echo set_trx_split_frequency_mode(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/split_vfo', function($trx_id) { echo get_trx_split_vfo($trx_id);});
$router->post('/trx/(\d+)/split_vfo', function($trx_id) { echo set_trx_split_vfo(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/tuning_step', function($trx_id) { echo get_trx_tuningstep($trx_id);});
$router->post('/trx/(\d+)/tuning_step', function($trx_id) { echo set_trx_tuningstep(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/level/(\w+)', function($trx_id, $level_param) { echo get_trx_level($level_param, $trx_id);});
$router->post('/trx/(\d+)/level/(\w+)', function($trx_id, $level_param) { echo set_trx_level($level_param, json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/level', function($trx_id) { echo get_trx_level_list($trx_id);});

$router->get('/trx/(\d+)/function/(\w+)', function($trx_id, $function_param) { echo get_trx_function($function_param, $trx_id);});
$router->post('/trx/(\d+)/function/(\w+)', function($trx_id, $function_param) { echo set_trx_function($function_param, json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/function', function($trx_id) { echo get_trx_function_list($trx_id);});

$router->get('/trx/(\d+)/parameter/(\w+)', function($trx_id, $parameter) { echo get_trx_parameter($parameter, $trx_id);});
$router->post('/trx/(\d+)/parameter/(\w+)', function($trx_id, $parameter) { echo set_trx_parameter($parameter, json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/parameter', function($trx_id) { echo get_trx_parameter_list($trx_id);});

$router->post('/trx/(\d+)/scan/(\w+)', function($trx_id, $parameter) { echo set_trx_scan($parameter, $trx_id);});
// $router->post('/trx/(\d+)/scan/(\w+)', function($trx_id, $parameter) { echo set_trx_scan($parameter, json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/scan', function($trx_id) { echo get_trx_scan_list($trx_id);});

$router->get('/trx/(\d+)/transceive/(\w+)', function($trx_id, $parameter) { echo get_trx_transceive($transceive_parameter, $trx_id);});
$router->post('/trx/(\d+)/transceive', function($trx_id) { echo set_trx_transceive(json_decode(getRequestBody(), true), $trx_id);});
$router->get('/trx/(\d+)/transceive', function($trx_id) { echo get_trx_transceive_list($trx_id);});

$router->get('/trx/(\d+)/repeater_shift', function($trx_id) { echo get_trx_repeater_shift($trx_id);});
$router->post('/trx/(\d+)/repeater_shift', function($trx_id) { echo set_trx_repeater_shift(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/ctcss_tone', function($trx_id) { echo get_trx_ctcss_tone($trx_id);});
$router->post('/trx/(\d+)/ctcss_tone', function($trx_id) { echo set_trx_ctcss_tone(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/dcs_tone', function($trx_id) { echo get_trx_dcs_tone($trx_id);});
$router->post('/trx/(\d+)/dcs_tone', function($trx_id) { echo set_trx_dcs_tone(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/vfo', function($trx_id) { echo get_trx_vfo($trx_id);});
$router->post('/trx/(\d+)/vfo', function($trx_id) { echo set_trx_vfo(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/ptt', function($trx_id) { echo get_trx_ptt($trx_id);});
$router->post('/trx/(\d+)/ptt', function($trx_id) { echo set_trx_ptt(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/memory', function($trx_id) { echo get_trx_memory($trx_id);});
$router->post('/trx/(\d+)/memory', function($trx_id) { echo set_trx_memory(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/channel', function($trx_id) { echo get_trx_channel($trx_id);});
$router->post('/trx/(\d+)/channel', function($trx_id) { echo set_trx_channel(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/info', function($trx_id) { echo get_trx_info($trx_id);});

$router->get('/trx/(\d+)/rit', function($trx_id) { echo get_trx_rit($trx_id);});
$router->post('/trx/(\d+)/rit', function($trx_id) { echo set_trx_rit(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/xit', function($trx_id) { echo get_trx_xit($trx_id);});
$router->post('/trx/(\d+)/xit', function($trx_id) { echo set_trx_xit(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/antenna', function($trx_id) { echo get_trx_antenna($trx_id);});
$router->post('/trx/(\d+)/antenna', function($trx_id) { echo set_trx_antenna(json_decode(getRequestBody(), true), $trx_id);});

$router->post('/trx/(\d+)/raw_command', function($trx_id) { echo set_trx_raw_command($trx_id);});
$router->post('/trx/(\d+)/raw_command_rx', function($trx_id) { echo set_trx_raw_command_rx(json_decode(getRequestBody(), true), $trx_id);});

$router->post('/trx/(\d+)/convert_mw_power', function($trx_id) { echo get_trx_mw_power(json_decode(getRequestBody(), true), $trx_id);});

$router->post('/trx/(\d+)/convert_power_mw', function($trx_id) { echo get_trx_power_mw(json_decode(getRequestBody(), true), $trx_id);});

$router->post('/trx/(\d+)/dump_capabilities', function($trx_id) { echo set_trx_dump_capabilities($trx_id);});

$router->post('/trx/(\d+)/dump_configuration', function($trx_id) { echo set_trx_dump_configuration($trx_id);});

$router->post('/trx/(\d+)/morse', function($trx_id) { echo set_trx_morse(json_decode(getRequestBody(), true), $trx_id);});
$router->post('/trx/(\d+)/morse_stop', function($trx_id) { echo set_trx_morse_stop(json_decode(getRequestBody(), true), $trx_id);});

$router->get('/trx/(\d+)/ctcss_sql', function($trx_id) { echo get_trx_ctcss_sql($trx_id);});

$router->get('/trx/(\d+)/dcs_sql', function($trx_id) { echo get_trx_dcs_sql($trx_id);});

$router->get('/trx/(\d+)/dtmf', function($trx_id) { echo get_trx_dtmf($trx_id);});

$router->get('/trx/(\d+)/morse', function($trx_id) { echo get_trx_morse($trx_id);});

$router->get('/trx/(\d+)/dcd', function($trx_id) { echo get_trx_dcd($trx_id);});

$router->get('/trx/(\d+)/twiddle', function($trx_id) { echo get_trx_twiddle($trx_id);});

$router->get('/trx/(\d+)/cache', function($trx_id) { echo get_trx_cache($trx_id);});
$router->post('/trx/(\d+)/cache', function($trx_id) { echo set_trx_cache(json_decode(getRequestBody(), true), $trx_id);});


$router->run();

function getRequestBody(){
    $entityBody = file_get_contents('php://input');
    return($entityBody);
}

function build_response($response){
    http_response_code(200);
    echo json_encode(array(
        "REQUEST_URI" => $_SERVER['REQUEST_URI'],
        "REQUEST_BODY" => getRequestBody(),
        "response" => $response
    ));
}

function build_error_response($response, $error_code){
    global $errors_hamlib;
    http_response_code(400);
    echo json_encode(array(
        "REQUEST_URI" => $_SERVER['REQUEST_URI'],
        "REQUEST_BODY" => getRequestBody(),
        "response" => $response,
        "error_code" => $error_code,
        "error_message" => $errors_hamlib[intval($error_code)]
    ));
    die();
}


?>