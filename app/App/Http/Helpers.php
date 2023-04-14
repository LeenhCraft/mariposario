<?php

use App\Models\Admin\LoginAdminModel;
use App\Models\MenuModel;
use App\Models\WebModel;

function base_url()
{
    // return BASE_URL;
    return $_ENV['APP_URL'] . '/';
}

function media()
{
    // return BASE_URL . "Assets/";
    return base_url() . "Assets/";
}

function headerWeb($view, $data = [])
{
    extract($data);
    $webModel = new WebModel();
    $menuModel = new MenuModel();
    $id = $_SESSION['lnh'] ?? 0;
    $nombre = $webModel->query("SELECT * FROM web_usuarios WHERE idwebusuario = {$id}")->first();
    $nombre = $nombre['usu_nombre'] ?? $_SESSION['visita'];
    $cant = 0;
    $dnon = 'style="display: none;"';
    $view = str_replace('.', '/', $view);
    $menus = $menuModel->menus();
    $view_header = "../app/resources/views/$view.php";
    require_once $view_header;
}

function footerWeb($view, $data = [])
{
    extract($data); //extrae los datos del array y los convierte en variables
    $view = str_replace('.', '/', $view);
    $view_footer =  "../app/resources/views/$view.php";
    require_once $view_footer;
}

function headerApp($view, $data = "")
{
    $nombre = getName($_SESSION['app_id'] ?? 0);
    $view_header = "../app/resources/views/App/{$view}.php";
    require_once $view_header;
}

function footerApp($view, $data = "")
{
    $view_footer = "../app/resources/views/App/$view.php";
    require_once $view_footer;
}

function getModal($ruta, $data = "")
{
    $view_modal = "../app/resources/views/App/Template/Modals/{$ruta}.php";
    require_once $view_modal;
}

function dep($data, $exit = 0)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    ($exit != 0) ? $format .= exit : '';
    return $format;
}

function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    $string = str_ireplace("//", "", $string);
    $string = str_ireplace("\\", "", $string);
    $string = str_ireplace("'", "", $string);
    return $string;
}

function can_carrito()
{
    // require_once 'Models/WebModel.php';
    $objWeb = new WebModel();
    $b = (isset($_SESSION['vi'])) ? $_SESSION['vi'] : 0;
    $a = $objWeb->car_art($b);
    return $a;
}

//Genera un token
function token($cant = 10)
{
    $r1 = bin2hex(random_bytes($cant));
    $r2 = bin2hex(random_bytes($cant));
    $r3 = bin2hex(random_bytes($cant));
    $r4 = bin2hex(random_bytes($cant));
    // $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $r1 . $r2 . $r3 . $r4;
}

//Generador de letras
function generar_letras($strength = 16)
{
    $input = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}


function generar_numeros($digitos = 8)
{
    $num = 0;
    $num = mt_rand(pow(10, $digitos - 1), pow(10, $digitos) - 1);
    return $num;
}

function codigo_visita()
{
    date_default_timezone_set('America/Lima');
    $objWeb = new WebModel();
    $ip = '';
    $metod = isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD']  : 'none';
    $ipHeaders = array(
        'REMOTE_ADDR' => 'IP',
        'HTTP_CLIENT_IP' => 'IP',
        'HTTP_X_FORWARDED_FOR' => 'IP',
        'HTTP_X_FORWARDED' => 'IP',
        'HTTP_CF_CONNECTING_IP' => 'ip'
    );

    $ip = '';
    foreach ($ipHeaders as $header => $label) {
        if (isset($_SERVER[$header]) && $_SERVER[$header] !== '') {
            $ip .= " $label: " . $_SERVER[$header];
        }
    }

    // $url = isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '' ? $_SERVER['REQUEST_URI'] : '$_SERVER[\'REQUEST_URI\'] no existe';
    $url = $_SERVER['REQUEST_URI'] ?? 'no existe';
    // $url = isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? ': ' . $_SERVER['REQUEST_URI'] : ' $_SERVER[´REQUEST_URI´] No existe';
    // $agente = isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT']) ? dispositivo($_SERVER['HTTP_USER_AGENT']) : 'No existe';
    $agente = $_SERVER['HTTP_USER_AGENT'] ?? 'No existe';
    if (!isset($_SESSION['vi'])) {
        $vi = generar_numeros(4);
        $_SESSION['vi'] = $vi;
        $_SESSION['visita'] = 'Visita_' . $_SESSION['vi'];
        $objWeb->rg_visita($_SESSION['vi'], $ip, $agente, $url, $metod);
    } else {
        $vi = $_SESSION['vi'];
        $response = $objWeb->chk_vi($vi);
        while (!empty($response)) {
            $vi = generar_numeros(4);
            $response = $objWeb->chk_vi($vi);
        }
        if (!empty($response)) {
            $_SESSION['vi'] = $vi;
            $_SESSION['visita'] = 'Visista_' . $_SESSION['vi'];
            $objWeb->rg_visita($_SESSION['vi'], $ip, $agente, $url, $metod);
        }
    }
    if (isset($_SESSION['login'])) {
        //Comprobamos si esta definida la sesión 'tiempo'.
        if (isset($_SESSION['tiempo'])) {

            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 1440; //5 min en este caso.

            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $_SESSION['tiempo'];

            //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
            if ($vida_session > $inactivo) {
                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();
                //Redirigimos pagina.
                header('location: ' . base_url());
                exit();
            }
        }
        $_SESSION['tiempo'] = time();
    }
    $objWeb->centinel($_SESSION['vi'], $ip, $agente, $url, $metod, $_SESSION['lnh'] ?? '0');
}

function consultaDNI($dni)
{
    $curl = curl_init();
    $token = "?api_token=aa507814b8736127ebc77f0199a32bf3397762b9b7e854ce758c3982";
    $urlApi = "https://leenhcraft.com/apiv2/dni/{$dni}{$token}";
    // return $urlApi;
    curl_setopt_array($curl, [
        CURLOPT_URL => $urlApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        // CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer e"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    return $response;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Models\serverEmail;

function enviarEmail($data, $template)
{
    // require __DIR__ . '/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $objEmail = new serverEmail();


    $dataEmail = $objEmail->leerConfig();
    if (empty($dataEmail)) {
        return false;
    }

    $emailDestino = $data['email'];
    $asunto = $data['asunto'];
    $nombreDestino = $data['nombre'];
    ob_start();
    require_once("../app/resources/email/" . $template . ".php");
    $mensaje = ob_get_clean();
    $msg = [];


    try {
        //Server settings
        // $mail->SMTPDebug = local: 0, produccion: 1;
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $dataEmail['em_host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $dataEmail['em_usermail'];                 //SMTP username
        $mail->Password   = $dataEmail['em_pass'];                          //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption
        $mail->Port       = $dataEmail['em_port'];                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('servicios@leenhcraft.com', $_ENV['APP_NAME']);
        $mail->addAddress($emailDestino, $nombreDestino);     //Add a recipient
        // $mail->addAddress("2018100486@ucss.pe", "ucss");     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        // $mail->addCC("2018100486@ucss.pe", "ucss");
        // $mail->addBCC("2018100486@ucss.pe", "ucss");

        //Attachments - archivos adjuntos
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content - mensaje
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;
        $mail->AltBody = 'leenhcraft.com';
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        //To load the French version
        $mail->setLanguage('es', 'libraries/phpmailer/languaje');

        $mail->send();
        return true;
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // $msg['status'] = true;
        // $msg['text'] = "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        return false;
    }
    return $msg;
}

function generateSignature($token, $timestamp)
{
    $secret = "my_secret_key"; // Aquí deberías usar tu propia clave secreta
    $data = $timestamp . '.' . $token; // Concatenamos el timestamp y el token
    $signature = hash_hmac('sha256', $data, $secret); // Generamos la firma con HMAC-SHA256
    return $signature;
}

function verifySignature($token, $timestamp, $signature)
{
    // Obtener la clave secreta
    $secret_key = "mi_clave_secreta";

    // Verificar si la firma es válida
    $expected_signature = hash_hmac('sha256', $token . $timestamp, $secret_key);
    return hash_equals($signature, $expected_signature);
}

function menus()
{
    $mn = new MenuModel();
    $data = $mn->app_menus($_SESSION['app_r']);
    return $data;
}

function submenus(int $idmenu)
{
    $mn = new MenuModel();
    $data = $mn->app_submenus($idmenu);
    return $data;
}

function pertenece($submen, $menu)
{
    $mn = new MenuModel();
    $request = $mn->app_pertenece($submen, $menu);
    return (!empty($request)) ? true : false;
}

function getName(int $id)
{
    $mn = new LoginAdminModel();
    $arrPermisos = $mn->bscUsu($id);
    if (!empty($arrPermisos)) {
        if (ucfirst($arrPermisos['rol']) == 'Root') {
            $arrPermisos['rol'] = '<span class="badge bg-danger">' . $arrPermisos['rol'] . '</span>';
        } else if (ucfirst($arrPermisos['rol']) == 'Administrador') {
            $arrPermisos['rol'] = '<span class="badge bg-success">' . $arrPermisos['rol'] . '</span>';
        } else {
            $arrPermisos['rol'] = '<span class="badge bg-info">' . $arrPermisos['rol'] . '</span>';
        }
    }
    return $arrPermisos;
}

function getPermisos($idmod)
{
    $obj = new MenuModel;
    return $obj->app_menu_permisos($idmod);
}

// url pero amigable
function urls_amigables($url)
{
    // Tranformamos todo a minusculas
    $url = strtolower($url);
    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace($find, $repl, $url);
    // Añadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace($find, '-', $url);
    // Eliminamos y Reemplazamos demás caracteres especiales
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace($find, $repl, $url);
    return $url;
}

//Formato para valores monetarios
function formatMoney($cantidad)
{
    $cantidad = $_ENV['SMONEY'] . number_format($cantidad, 2, $_ENV['SPD'], $_ENV['SPM']);
    return $cantidad;
}
