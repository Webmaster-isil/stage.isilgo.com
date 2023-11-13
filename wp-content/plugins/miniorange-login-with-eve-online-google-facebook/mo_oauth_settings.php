<?php
/**
 * Plugin Name: OAuth Single Sign On - SSO (OAuth client)
 * Plugin URI: http://miniorange.com
 * Description: This plugin enables login to your WordPress site using OAuth apps like Google, Facebook, EVE Online and other.
 * Version: 28.5.0
 * Author: miniOrange
 * Author URI: https://www.miniorange.com
 * License: miniOrange
 */


require "\x5f\141\165\164\157\154\157\141\144\x2e\x70\150\160";
require_once "\x6d\157\x2d\157\x61\165\x74\150\x2d\143\154\x69\145\x6e\164\x2d\160\x6c\165\147\151\156\55\x76\x65\x72\x73\151\157\156\55\x75\x70\x64\x61\164\145\56\160\x68\x70";
define("\115\117\x5f\x4f\x41\125\x54\110\137\x50\x52\105\115\111\x55\x4d\137\x43\x53\x53\137\x4a\123\137\126\x45\x52\x53\x49\117\x4e", mo_oauth_client_options_plugin_constants::Version);
use MoOauthClient\Base\BaseStructure;
use MoOauthClient\MOUtils;
use MoOauthClient\GrantTypes\JWTUtils;
use MoOauthClient\Base\InstanceHelper;
use MoOauthClient\MoOauthClientWidget;
use MoOauthClient\Free\MOCVisualTour;
use MoOauthClient\Free\CustomizationSettings;
global $lT;
$io = new InstanceHelper();
$lT = $io->get_utils_instance();
$zB = $lT->get_plugin_config()->get_current_config();
$ss = $io->get_settings_instance();
$gq = new BaseStructure();
$vt = $io->get_login_handler_instance();
$nB = new CustomizationSettings();
$nB = $nB->mo_oauth_custom_icons_intiater();
function register_mo_oauth_widget()
{
    register_widget("\134\115\157\117\x61\x75\x74\150\x43\x6c\151\x65\156\164\x5c\115\x6f\117\x61\x75\x74\150\x43\154\151\145\156\x74\127\151\x64\x67\145\x74");
}
function mo_oauth_shortcode_login($lu)
{
    global $lT;
    $Gz = new MoOauthClientWidget();
    if ($lT->check_versi(4) && $lT->mo_oauth_client_get_option("\155\157\x5f\x6f\x61\165\164\150\137\x61\x63\164\151\166\141\164\x65\137\163\x69\x6e\x67\x6c\145\137\154\157\147\151\x6e\x5f\x66\x6c\157\x77")) {
        goto WIF;
    }
    if (!(!empty($lu["\162\145\x64\x69\162\x65\x63\x74\137\x75\162\154"]) || !empty($lu["\142\165\164\x74\157\156\x5f\164\x65\170\164"]))) {
        goto IKP;
    }
    $Dl = isset($lu["\162\x65\x64\x69\162\x65\x63\164\x5f\165\162\154"]) ? $lu["\162\x65\x64\x69\162\x65\143\164\137\x75\x72\x6c"] : '';
    $Pa = isset($lu["\x62\165\164\x74\157\x6e\137\x74\x65\x78\164"]) ? $lu["\142\x75\x74\x74\157\x6e\x5f\x74\145\x78\x74"] : '';
    return $lu && isset($lu["\x61\160\160\x6e\x61\155\x65"]) && !empty($lu["\x61\x70\x70\156\x61\x6d\x65"]) ? $Gz->mo_oauth_login_form($CN = true, $FE = $lu["\141\160\160\156\x61\x6d\x65"], $Dl, $Pa) : $Gz->mo_oauth_login_form($CN = false, $FE = '', $Dl, $Pa);
    IKP:
    return $lu && isset($lu["\x61\160\x70\156\x61\x6d\x65"]) && !empty($lu["\141\160\160\x6e\141\155\x65"]) ? $Gz->mo_oauth_login_form($CN = true, $FE = $lu["\141\160\160\156\141\x6d\x65"]) : $Gz->mo_oauth_login_form(false);
    goto yNy;
    WIF:
    return $Gz->mo_activate_single_login_flow_form();
    yNy:
}
add_action("\167\x69\x64\x67\145\x74\163\x5f\151\156\151\x74", "\x72\x65\147\x69\x73\x74\x65\x72\x5f\155\157\137\x6f\141\x75\x74\150\x5f\x77\151\x64\x67\145\164");
add_shortcode("\155\x6f\137\157\x61\x75\x74\x68\137\x6c\157\147\151\x6e", "\155\157\137\157\141\165\x74\x68\x5f\x73\x68\157\162\164\x63\x6f\144\x65\x5f\154\x6f\147\x69\x6e");
add_action("\151\x6e\151\x74", "\x6d\x6f\137\147\145\x74\137\166\x65\x72\163\x69\157\x6e\137\x6e\165\155\x62\x65\x72");
add_action("\151\156\x69\164", "\x6d\x6f\137\157\x61\165\164\x68\137\146\162\x6f\156\x74\x73\154\x6f");
add_action("\x69\156\151\164", "\155\x6f\x5f\x6f\141\x75\x74\150\x5f\x62\x61\143\x6b\x73\154\x6f");
function mo_get_version_number()
{
    if (!(isset($_GET["\141\x63\x74\151\157\x6e"]) && $_GET["\141\x63\164\151\x6f\x6e"] === "\x6d\x6f\137\166\145\162\x73\151\x6f\x6e\x5f\x6e\165\155\142\x65\x72" && isset($_GET["\x61\160\x69\x4b\x65\171"]) && $_GET["\x61\160\x69\113\145\171"] === "\x63\x32\x30\141\67\x64\x66\70\x36\142\63\144\x34\x64\x31\x61\142\145\x32\144\x34\x37\144\x30\x65\x31\142\x31\146\70\64\67")) {
        goto XIL;
    }
    echo mo_oauth_client_options_plugin_constants::Version;
    exit;
    XIL:
}
function mo_oauth_frontslo()
{
    $lT = new MOUtils();
    if (!($lT->check_versi(4) && isset($_SERVER["\x52\105\x51\x55\105\123\x54\137\x55\122\x49"]) && sanitize_url($_SERVER["\x52\x45\x51\125\105\123\x54\137\125\x52\x49"]) != NULL && strpos(sanitize_url($_SERVER["\x52\105\121\125\105\x53\x54\137\125\122\111"]), "\x66\x72\157\156\x74\143\x68\x61\x6e\x6e\x65\154\x5f\154\157\x67\157\x75\x74") != false)) {
        goto dvE;
    }
    $kM = get_current_user_id();
    $M3 = get_user_meta($kM, "\x6d\x6f\x5f\157\141\x75\164\150\x5f\x63\x6c\151\145\156\x74\x5f\154\x61\x73\164\x5f\x69\144\137\x74\157\153\x65\x6e", true);
    $dR = new JWTUtils($M3);
    $Ce = $dR->get_decoded_payload();
    $cX = sanitize_url($_SERVER["\x52\x45\x51\125\x45\x53\x54\x5f\x55\x52\x49"]);
    $uc = parse_url($cX);
    parse_str($uc["\x71\x75\x65\x72\171"], $RT);
    $ms = $Ce["\163\151\144"];
    $IZ = $RT["\x73\x69\144"];
    if ($ms === $IZ) {
        goto DMM;
    }
    $Qv = array("\143\x6f\144\x65" => 400, "\x64\145\163\143\x72\x69\160\x74\x69\x6f\x6e" => "\125\x73\145\162\40\111\144\x20\156\157\x74\x20\x66\157\x75\x6e\144");
    wp_send_json($Qv, 400);
    goto nJS;
    DMM:
    $t0 = '';
    if (!isset($Ce["\151\141\164"])) {
        goto bN9;
    }
    $t0 = $Ce["\151\141\x74"];
    bN9:
    if (!is_user_logged_in()) {
        goto HmH;
    }
    mo_slo_logout_user($kM);
    HmH:
    nJS:
    dvE:
}
function mo_oauth_backslo()
{
    $lT = new MOUtils();
    if (!($lT->check_versi(4) && isset($_SERVER["\122\x45\x51\125\x45\x53\x54\x5f\x55\x52\111"]) && sanitize_url($_SERVER["\122\105\121\x55\105\123\124\x5f\x55\122\111"]) != NULL && strpos(sanitize_url($_SERVER["\122\105\x51\125\x45\123\x54\x5f\x55\122\111"]), "\142\x61\x63\x6b\x63\x68\x61\x6e\x6e\145\154\x5f\154\x6f\x67\x6f\x75\164") != false)) {
        goto ecR;
    }
    $dU = file_get_contents("php://input");
    $HP = explode("\x3d", $dU);
    if (!(json_last_error() !== JSON_ERROR_NONE)) {
        goto pI1;
    }
    $dU = array_map("\x65\163\x63\137\x61\164\164\x72", sanitize_post($_POST));
    pI1:
    if ($HP[0] == "\x6c\x6f\147\157\x75\164\x5f\x74\x6f\153\145\x6e") {
        goto g4j;
    }
    $Qv = array("\143\157\144\x65" => 400, "\144\145\x73\143\x72\x69\160\x74\151\x6f\156" => "\124\150\145\40\114\157\147\157\165\164\x20\164\157\153\145\x6e\x20\151\163\x20\145\x69\x74\150\145\162\40\x6e\157\x74\x20\163\x65\156\x74\40\x6f\162\40\163\x65\156\x74\x20\151\x6e\143\157\x72\162\x65\143\x74\x6c\171\x2e");
    wp_send_json($Qv, 400);
    goto wsj;
    g4j:
    $qj = $HP[1];
    $dR = new JWTUtils($qj);
    $Ig = isset($_REQUEST["\x61\x70\160\156\x61\x6d\x65"]) && sanitize_text_field($_REQUEST["\x61\160\x70\156\141\x6d\x65"]) != NULL ? sanitize_text_field($_REQUEST["\141\160\160\x6e\141\x6d\145"]) : '';
    $mn = false;
    $kp = $lT->get_app_by_name($Ig);
    $mn = $kp->get_app_config("\152\167\153\163\165\x72\x6c");
    $jd = $kp->get_app_config("\165\x73\145\162\156\141\x6d\x65\x5f\x61\x74\164\x72");
    $Ce = $dR->get_decoded_payload();
    $DH = '';
    $ms = '';
    if (!isset($Ce["\x73\165\142"])) {
        goto lAw;
    }
    $DH = $Ce["\163\165\142"];
    lAw:
    if (!isset($Ce["\163\151\144"])) {
        goto dWV;
    }
    $ms = $Ce["\x73\151\x64"];
    dWV:
    $t0 = '';
    if (!isset($Ce["\x69\141\x74"])) {
        goto ul4;
    }
    $t0 = $Ce["\151\141\x74"];
    ul4:
    global $wpdb;
    if (isset($Ce[$jd])) {
        goto cE8;
    }
    if ($DH) {
        goto nPr;
    }
    if ($ms) {
        goto NuL;
    }
    $Qv = array("\x63\x6f\144\145" => 400, "\144\x65\x73\143\162\x69\160\164\x69\157\x6e" => "\124\150\145\40\154\x6f\147\x6f\165\x74\40\x74\157\x6b\145\x6e\x20\x69\163\x20\x76\141\x6c\151\144\40\142\165\164\x20\165\163\x65\x72\x20\x6e\157\x74\40\x69\x64\x65\x6e\164\151\146\151\x65\144\x2e");
    wp_send_json($Qv, 400);
    goto Yd3;
    NuL:
    $Vz = "\123\x45\114\105\103\124\x20\165\x73\145\162\x5f\151\144\x20\106\x52\117\x4d\x20\x60\x77\x70\137\165\x73\145\x72\155\x65\x74\x61\x60\40\x57\110\x45\122\105\40\155\x65\164\141\x5f\166\x61\154\165\145\x3d\47{$ms}\x27\x20\x61\x6e\144\40\x6d\145\x74\x61\137\153\145\171\75\x27\x6d\157\137\142\x61\143\x6b\143\x68\x61\156\x6e\x65\154\x5f\x61\164\x74\x72\137\x73\x69\x64\47\73";
    $dP = $wpdb->get_results($Vz);
    $kM = $dP[0]->{"\x75\x73\145\x72\137\151\x64"};
    Yd3:
    goto EAC;
    nPr:
    $Vz = "\123\x45\114\105\x43\x54\x20\165\x73\x65\162\137\x69\144\40\106\122\x4f\115\40\x60\x77\x70\x5f\165\x73\x65\x72\x6d\145\x74\141\x60\40\x57\x48\x45\x52\105\40\x6d\x65\164\141\137\x76\141\x6c\x75\145\x3d\x27{$DH}\x27\40\x61\x6e\x64\x20\155\145\164\141\x5f\153\145\x79\75\47\155\x6f\137\x62\141\143\x6b\x63\x68\x61\156\x6e\x65\x6c\x5f\141\164\x74\x72\137\x73\165\x62\x27\x3b";
    $dP = $wpdb->get_results($Vz);
    $kM = $dP[0]->{"\x75\x73\145\x72\x5f\x69\x64"};
    EAC:
    goto Se8;
    cE8:
    $kM = get_user_by("\x6c\x6f\147\x69\156", $vP)->ID;
    Se8:
    if ($kM) {
        goto pDR;
    }
    $Qv = array("\143\x6f\144\x65" => 400, "\x64\145\x73\143\162\x69\x70\164\151\157\x6e" => "\124\150\145\40\x6c\x6f\147\x6f\x75\x74\40\164\x6f\x6b\145\156\40\151\163\40\x76\141\x6c\x69\144\x20\x62\165\164\40\165\x73\x65\x72\40\156\157\164\x20\x69\144\145\156\x74\151\146\151\x65\144\x2e");
    wp_send_json($Qv, 400);
    goto hqi;
    pDR:
    mo_slo_logout_user($kM);
    hqi:
    wsj:
    ecR:
}
function mo_slo_logout_user($kM)
{
    $SI = WP_Session_Tokens::get_instance($kM);
    $SI->destroy_all();
    $Qv = array("\143\x6f\144\x65" => 200, "\x64\145\163\x63\162\151\x70\x74\151\x6f\x6e" => "\x54\x68\145\x20\125\x73\x65\x72\x20\x68\141\163\x20\x62\145\x65\156\40\x6c\x6f\x67\x67\145\x64\40\157\x75\x74\x20\x73\x75\143\x63\145\x73\x73\146\165\x6c\171\x2e");
    wp_send_json($Qv, 200);
}
function miniorange_oauth_visual_tour()
{
    $J5 = new MOCVisualTour();
}
if (!($lT->get_versi() === 0)) {
    goto EDX;
}
add_action("\x61\144\x6d\x69\x6e\137\x69\x6e\x69\x74", "\155\151\156\151\157\162\141\x6e\147\145\137\x6f\141\165\164\150\137\166\151\x73\x75\141\154\137\164\157\165\x72");
EDX:
function mo_oauth_deactivate()
{
    global $lT;
    do_action("\x6d\157\x5f\x63\x6c\x65\x61\x72\137\160\x6c\x75\x67\137\x63\x61\143\x68\x65");
    $lT->deactivate_plugin();
}
register_deactivation_hook(__FILE__, "\155\x6f\x5f\x6f\141\165\164\x68\x5f\144\x65\x61\143\164\151\166\141\x74\145");
