<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Standard\LoginHandler as StandardLoginHandler;
use MoOauthClient\GrantTypes\Implicit;
use MoOauthClient\GrantTypes\Password;
use MoOauthClient\GrantTypes\JWSVerify;
use MoOauthClient\GrantTypes\JWTUtils;
use MoOauthClient\Premium\MappingHandler;
use MoOauthClient\StorageManager;
use MoOauthClient\MO_Oauth_Debug;
class LoginHandler extends StandardLoginHandler
{
    private $implicit_handler;
    private $app_name = '';
    private $group_mapping_attr = false;
    private $resource_owner = false;
    public function __construct()
    {
        global $lT;
        parent::__construct();
        add_filter("\x6d\157\137\x61\x75\164\150\137\x75\x72\x6c\x5f\151\156\164\x65\162\x6e\141\x6c", array($this, "\x6d\157\137\x6f\x61\165\x74\x68\137\x63\154\x69\145\156\x74\137\x67\x65\x6e\x65\x72\x61\164\x65\x5f\x61\x75\164\150\157\162\151\x7a\x61\x74\x69\x6f\x6e\137\165\162\x6c"), 5, 2);
        add_action("\167\160\x5f\x66\157\157\x74\145\162", array($this, "\x6d\157\x5f\157\141\165\164\150\x5f\143\154\151\x65\156\164\137\x69\155\160\154\x69\x63\151\164\x5f\x66\x72\141\x67\155\x65\x6e\164\x5f\x68\141\156\144\154\145\162"));
        add_action("\155\x6f\137\157\141\165\164\x68\137\162\x65\163\x74\162\151\x63\164\137\x65\x6d\x61\151\x6c\163", array($this, "\x6d\157\x5f\157\x61\165\x74\150\137\x63\x6c\x69\145\156\x74\137\x72\x65\x73\164\162\151\x63\164\137\145\x6d\141\151\154\163"), 10, 2);
        add_action("\x6d\x6f\x5f\157\x61\165\164\150\x5f\143\x6c\151\x65\156\x74\137\155\x61\160\137\162\x6f\x6c\x65\x73", array($this, "\x6d\157\137\157\x61\x75\x74\150\x5f\x63\x6c\x69\145\x6e\x74\137\155\141\x70\x5f\162\x6f\154\145\163"), 10, 1);
        $Zx = $lT->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\x75\164\x68\137\145\x6e\x61\x62\154\145\x5f\x6f\x61\165\x74\x68\x5f\167\x70\x5f\x6c\157\147\151\156");
        if (!$Zx) {
            goto myc;
        }
        remove_filter("\x61\x75\164\x68\145\156\164\151\x63\x61\x74\145", "\167\160\x5f\x61\165\164\150\x65\156\164\151\x63\x61\164\145\x5f\165\163\x65\162\x6e\x61\x6d\x65\137\160\x61\x73\163\x77\x6f\162\144", 20, 3);
        $R0 = new Password(true);
        add_filter("\141\x75\164\x68\x65\156\164\151\143\x61\x74\145", array($R0, "\x6d\157\137\157\x61\x75\164\x68\137\167\160\x5f\x6c\x6f\147\x69\x6e"), 20, 3);
        myc:
    }
    public function mo_oauth_client_restrict_emails($q3, $zB)
    {
        global $lT;
        $aH = isset($zB["\162\145\163\x74\162\x69\x63\x74\145\x64\137\144\157\x6d\141\151\x6e\x73"]) ? $zB["\x72\145\163\164\x72\151\143\164\145\x64\x5f\x64\157\155\141\151\156\x73"] : '';
        if (!empty($aH)) {
            goto sN9;
        }
        return;
        sN9:
        $P6 = isset($zB["\141\154\154\157\x77\x5f\162\145\163\x74\x72\151\x63\164\145\x64\137\144\x6f\155\141\151\156\x73"]) ? $zB["\x61\154\x6c\157\x77\x5f\x72\x65\x73\164\x72\151\x63\164\x65\144\x5f\x64\157\x6d\141\x69\156\163"] : '';
        if (!empty($P6)) {
            goto yAY;
        }
        $P6 = false;
        yAY:
        $P6 = intval($P6);
        $aH = array_map("\164\162\151\x6d", explode("\54", strtolower($aH)));
        $eK = strtolower(substr($q3, strpos($q3, "\100") + 1));
        $pG = in_array($eK, $aH, false);
        $pG = $P6 ? !$pG : $pG;
        $rA = !empty($aH) && $pG;
        if (!$rA) {
            goto Mp7;
        }
        $TA = "\131\157\x75\40\x64\157\40\156\x6f\164\40\150\141\x76\145\40\x72\151\147\x68\x74\x73\x20\164\x6f\40\x61\143\x63\x65\163\x73\40\164\x68\x69\163\x20\160\x61\147\145\x2e\x20\120\154\145\141\163\145\x20\143\x6f\156\x74\141\143\164\x20\164\150\x65\40\141\144\x6d\x69\156\x69\x73\x74\162\141\x74\157\x72\56";
        $lT->handle_error($TA);
        wp_die($TA);
        Mp7:
    }
    public function mo_oauth_client_generate_authorization_url($A4, $Or)
    {
        global $lT;
        $KO = $lT->parse_url($A4);
        $zB = $lT->get_app_by_name($Or)->get_app_config();
        $p5 = md5(rand());
        setcookie("\x6d\x6f\137\157\x61\165\x74\150\x5f\156\157\x6e\x63\145", $p5, time() + 120, "\57", null, true, true);
        if (isset($zB["\x67\x72\141\156\164\137\x74\x79\x70\x65"]) && "\111\x6d\160\x6c\151\x63\x69\x74\x20\107\x72\x61\156\x74" === $zB["\x67\x72\141\156\x74\137\164\171\160\145"]) {
            goto NPV;
        }
        if (!(isset($zB["\x67\x72\x61\156\x74\137\164\171\160\x65"]) && "\x48\171\x62\162\151\x64\40\107\162\x61\x6e\x74" === $zB["\147\162\x61\x6e\x74\x5f\x74\171\x70\145"])) {
            goto B4y;
        }
        MO_Oauth_Debug::mo_oauth_log("\107\162\141\156\x74\72\40\x48\171\x62\162\x69\x64\40\107\x72\141\156\x74");
        $Ol = isset($zB["\155\157\x5f\x6f\141\x75\x74\x68\x5f\162\145\163\x70\157\x6e\x73\x65\137\164\171\160\x65"]) && !empty($zB["\155\157\x5f\157\x61\165\x74\150\x5f\162\x65\x73\160\x6f\156\163\x65\x5f\164\171\x70\145"]) ? $zB["\155\157\x5f\157\141\165\x74\x68\137\162\145\163\160\157\x6e\163\x65\x5f\x74\x79\160\145"] : "\164\x6f\153\x65\x6e\x25\62\x30\x69\x64\137\x74\x6f\x6b\x65\x6e\x25\x32\60\143\x6f\144\145";
        $KO["\x71\x75\x65\162\171"]["\x72\145\163\x70\x6f\156\x73\145\x5f\x74\x79\x70\x65"] = $Ol;
        return $lT->generate_url($KO);
        B4y:
        goto r1w;
        NPV:
        $KO["\x71\165\145\162\171"]["\156\157\x6e\143\145"] = $p5;
        $KO["\161\x75\x65\162\171"]["\x72\x65\163\x70\x6f\x6e\x73\x65\137\x74\x79\160\x65"] = "\x74\x6f\x6b\x65\156";
        $Ol = isset($zB["\155\157\x5f\x6f\141\165\x74\150\x5f\162\x65\x73\x70\157\156\x73\x65\137\x74\x79\160\x65"]) && !empty($zB["\x6d\x6f\137\x6f\x61\165\164\150\x5f\x72\145\x73\x70\157\x6e\163\145\137\x74\x79\x70\145"]) ? $zB["\155\157\137\157\x61\165\164\150\137\162\145\x73\160\157\156\x73\145\137\x74\x79\160\145"] : "\164\157\x6b\145\x6e";
        $KO["\x71\165\x65\162\171"]["\162\x65\x73\160\x6f\156\x73\x65\137\164\171\x70\x65"] = $Ol;
        return $lT->generate_url($KO);
        r1w:
        return $A4;
    }
    public function mo_oauth_client_map_roles($nt)
    {
        $FK = isset($nt["\x61\160\160\x5f\x63\157\156\146\151\147"]) && !empty($nt["\x61\160\x70\x5f\x63\x6f\x6e\146\151\x67"]) ? $nt["\x61\x70\160\x5f\143\157\156\x66\151\147"] : [];
        $zF = isset($FK["\147\162\157\165\160\156\141\155\x65\x5f\141\x74\x74\162\151\142\x75\164\145"]) && '' !== $FK["\147\x72\157\x75\x70\x6e\x61\x6d\x65\137\141\x74\164\x72\151\142\165\x74\145"] ? $FK["\147\x72\157\x75\160\x6e\x61\155\x65\x5f\x61\x74\164\x72\x69\142\165\x74\x65"] : false;
        $OR = isset($nt["\156\145\x77\x5f\165\x73\145\162"]) && !empty($nt["\x6e\145\x77\x5f\165\163\x65\x72"]) ? $nt["\x6e\x65\167\137\165\163\x65\162"] : 0;
        global $lT;
        $hE = false;
        if (isset($FK["\x65\x6e\x61\x62\x6c\x65\137\162\x6f\x6c\x65\137\155\141\160\160\x69\156\147"])) {
            goto ByO;
        }
        $FK["\x65\156\141\x62\154\145\137\x72\157\x6c\145\137\155\x61\x70\160\x69\x6e\x67"] = true;
        $hE = true;
        ByO:
        if (isset($FK["\137\x6d\x61\160\x70\151\x6e\x67\x5f\x76\x61\x6c\x75\145\x5f\144\145\x66\x61\165\x6c\x74"])) {
            goto kzu;
        }
        $FK["\137\x6d\x61\160\x70\151\x6e\147\x5f\166\141\x6c\x75\145\x5f\x64\145\x66\141\165\154\164"] = "\163\x75\142\163\x63\162\x69\x62\x65\x72";
        $hE = true;
        kzu:
        if (!boolval($hE)) {
            goto ASS;
        }
        if (!(isset($FK["\143\154\x69\x65\x6e\164\x5f\143\x72\x65\144\163\137\145\156\143\162\x70\171\164\145\x64"]) && boolval($FK["\143\154\x69\x65\x6e\x74\x5f\x63\x72\145\x64\163\x5f\x65\156\143\162\160\171\164\x65\x64"]))) {
            goto gxU;
        }
        $FK["\143\x6c\x69\x65\156\164\x5f\x69\144"] = $lT->mooauthencrypt($FK["\143\154\151\x65\156\164\x5f\151\x64"]);
        $FK["\x63\x6c\x69\145\x6e\164\137\163\x65\143\x72\x65\x74"] = $lT->mooauthencrypt($FK["\x63\154\x69\x65\x6e\164\137\163\145\143\162\145\164"]);
        gxU:
        $lT->set_app_by_name($nt["\x61\160\x70\x5f\156\141\155\x65"], $FK);
        ASS:
        $this->resource_owner = isset($nt["\x72\145\x73\x6f\x75\162\x63\x65\x5f\x6f\x77\x6e\145\162"]) && !empty($nt["\162\x65\163\x6f\165\162\143\145\137\x6f\x77\156\x65\162"]) ? $nt["\x72\x65\163\157\165\x72\x63\145\x5f\157\x77\156\145\162"] : [];
        $this->group_mapping_attr = $this->get_group_mapping_attribute($this->resource_owner, false, $zF);
        if (!(isset($FK["\145\170\x74\162\141\143\x74\x5f\145\155\x61\x69\154\137\x64\x6f\155\141\x69\x6e\x5f\146\x6f\162\137\x72\157\154\x65\x6d\x61\160\160\x69\x6e\147"]) && boolval($FK["\145\x78\x74\x72\141\143\164\137\x65\x6d\x61\151\154\x5f\144\x6f\155\x61\x69\156\137\146\x6f\x72\137\162\x6f\x6c\145\x6d\x61\x70\160\x69\156\x67"]))) {
            goto cZZ;
        }
        if (!is_array($this->group_mapping_attr) && is_email($this->group_mapping_attr)) {
            goto Cdp;
        }
        MO_Oauth_Debug::mo_oauth_log("\105\x6d\141\151\x6c\40\x61\144\144\162\145\x73\x73\x20\x6e\157\164\x20\162\x65\143\x65\x69\x76\145\144\x20\151\156\x20\x74\150\145\40\x63\x6f\x6e\x66\x69\x67\165\x72\145\144\x20\147\162\157\165\x70\x20\x61\164\164\x72\151\142\165\164\x65\40\x6e\x61\155\145\x20\141\163\40\x74\x68\x65\40\x6f\x70\164\x69\x6f\x6e\40\x69\x73\40\x65\x6e\141\x62\154\x65\x64\40\164\157\40\145\170\x74\x72\x61\x63\x74\x20\144\x6f\155\x61\151\156\40\167\x68\145\x6e\40\145\x6d\141\151\x6c\40\151\x73\x20\155\x61\x70\160\145\144\40\146\x6f\162\x20\x72\157\154\x65\40\155\x61\160\160\151\x6e\x67\x2e\40\103\150\145\x63\x6b\40\171\157\165\x72\x20\x52\157\154\x65\40\x4d\x61\x70\x70\x69\156\x67\40\143\157\x6e\x66\x69\147\165\162\141\x74\x69\x6f\x6e\56");
        $lT->handle_error("\105\155\141\151\154\x20\x64\157\155\x61\x69\156\x20\156\x6f\x74\40\162\145\143\145\151\166\145\x64\x2e\x20\103\150\x65\x63\x6b\40\x79\x6f\165\x72\x20\74\x73\164\x72\157\x6e\147\76\x52\157\154\145\40\115\x61\x70\160\x69\x6e\147\74\x2f\163\164\162\x6f\x6e\147\x3e\40\143\x6f\x6e\x66\151\x67\x75\x72\x61\x74\151\157\156\x2e");
        wp_die("\x45\155\x61\x69\x6c\x20\x64\x6f\x6d\141\x69\156\40\156\x6f\x74\x20\162\x65\143\x65\151\166\x65\144\56\40\x43\x68\x65\143\x6b\40\x79\x6f\x75\162\40\74\x73\164\x72\157\156\x67\x3e\122\x6f\154\x65\x20\115\141\x70\x70\x69\156\x67\74\x2f\x73\x74\162\157\x6e\147\76\x20\143\157\x6e\146\x69\x67\x75\x72\141\164\x69\x6f\156\56");
        goto FdE;
        Cdp:
        $this->group_mapping_attr = substr($this->group_mapping_attr, strpos($this->group_mapping_attr, "\100") + 1);
        FdE:
        cZZ:
        MO_Oauth_Debug::mo_oauth_log("\107\x72\x6f\165\x70\x20\x4d\141\x70\160\x69\x6e\147\40\x41\164\164\162\151\x62\165\164\x65\163\40\75\x3e\40" . $zF);
        $IE = new MappingHandler(isset($nt["\165\x73\145\162\x5f\151\144"]) && is_numeric($nt["\x75\x73\x65\x72\137\151\x64"]) ? intval($nt["\x75\x73\145\x72\137\151\x64"]) : 0, $FK, isset($this->group_mapping_attr) ? $this->group_mapping_attr : '', isset($nt["\156\145\x77\x5f\165\163\x65\x72"]) ? \boolval($nt["\156\145\167\137\x75\x73\x65\x72"]) : true);
        $zB = $nt["\143\x6f\156\146\151\x67"];
        if (!($OR || (!isset($zB["\x6b\x65\x65\x70\137\x65\170\151\x73\164\151\156\147\137\x75\x73\x65\x72\163"]) || 1 !== intval($zB["\x6b\x65\x65\160\x5f\x65\x78\151\163\164\x69\x6e\x67\137\x75\163\145\162\x73"])))) {
            goto Xqh;
        }
        $IE->apply_custom_attribute_mapping(is_array($this->resource_owner) ? $this->resource_owner : []);
        Xqh:
        $KV = false;
        $KV = apply_filters("\x6d\157\137\x6f\141\165\x74\150\137\x63\x6c\151\145\156\164\137\165\x70\x64\141\x74\x65\x5f\x61\144\155\x69\x6e\x5f\162\157\154\145", $KV);
        if (!$KV) {
            goto SkR;
        }
        MO_Oauth_Debug::mo_oauth_log("\101\144\x6d\151\x6e\x20\122\157\154\x65\x20\167\x69\154\154\40\x62\145\x20\165\160\x64\x61\x74\x65\144");
        SkR:
        if (!(user_can($nt["\x75\163\145\162\137\151\144"], "\141\144\x6d\x69\156\151\163\x74\x72\141\164\157\162") && !$KV)) {
            goto jHk;
        }
        return;
        jHk:
        $IE->apply_role_mapping(is_array($this->resource_owner) ? $this->resource_owner : []);
    }
    public function mo_oauth_client_implicit_fragment_handler()
    {
        echo "\x9\11\11\74\x73\143\162\x69\x70\164\76\xa\11\x9\11\x9\146\165\156\x63\x74\x69\157\156\x20\x63\x6f\x6e\x76\x65\x72\x74\x5f\x74\x6f\x5f\x75\162\154\x28\x6f\x62\x6a\51\x20\x7b\12\x9\x9\11\x9\x9\x72\145\164\165\x72\x6e\40\x4f\142\x6a\x65\x63\x74\12\11\x9\x9\11\11\56\x6b\145\171\x73\50\x6f\142\152\51\xa\11\11\x9\11\11\56\155\141\x70\x28\x6b\40\75\x3e\40\140\44\173\x65\156\143\157\x64\x65\125\122\x49\103\157\x6d\160\157\x6e\x65\156\164\x28\153\51\175\x3d\44\173\x65\156\143\x6f\144\145\x55\x52\111\x43\157\x6d\x70\x6f\x6e\145\x6e\164\x28\x6f\x62\152\x5b\153\x5d\x29\x7d\x60\x29\xa\x9\x9\x9\11\x9\x2e\152\x6f\151\x6e\50\47\x26\x27\51\73\xa\x9\x9\x9\11\175\xa\12\x9\11\x9\x9\x66\x75\156\x63\164\x69\x6f\156\x20\160\x61\x73\163\137\164\157\137\x62\141\143\x6b\x65\156\x64\x28\51\40\173\12\11\11\x9\x9\11\x69\x66\50\167\151\x6e\x64\x6f\167\x2e\154\157\x63\x61\164\x69\157\x6e\x2e\150\141\163\x68\x29\x20\x7b\12\11\x9\x9\x9\x9\11\166\x61\x72\40\x68\141\163\150\40\x3d\40\167\x69\156\x64\157\167\x2e\x6c\x6f\x63\141\164\x69\x6f\x6e\x2e\x68\x61\x73\x68\73\xa\11\x9\x9\x9\x9\11\x76\141\162\40\x65\x6c\x65\x6d\145\x6e\164\163\x20\75\x20\x7b\175\x3b\xa\11\11\11\11\11\11\x68\x61\163\150\x2e\x73\x70\x6c\151\164\50\42\x23\x22\51\133\x31\x5d\x2e\x73\160\x6c\x69\x74\x28\42\x26\x22\x29\56\146\x6f\x72\105\x61\x63\150\x28\x65\x6c\x65\x6d\145\x6e\x74\40\x3d\x3e\x20\173\12\x9\x9\x9\x9\x9\11\11\x76\141\162\x20\x76\141\x72\163\x20\75\x20\145\154\145\155\x65\x6e\x74\x2e\x73\160\154\x69\164\x28\42\x3d\x22\51\x3b\12\x9\x9\11\x9\x9\11\x9\145\x6c\145\x6d\x65\x6e\164\163\133\x76\141\162\163\x5b\60\x5d\x5d\x20\x3d\x20\166\x61\x72\163\133\x31\x5d\73\xa\11\x9\11\11\11\11\175\x29\x3b\12\x9\x9\11\11\11\x9\x69\x66\50\50\42\141\x63\x63\145\x73\x73\x5f\164\x6f\x6b\145\156\42\x20\x69\x6e\x20\145\x6c\145\x6d\x65\x6e\x74\x73\51\x20\174\174\40\50\42\151\x64\x5f\x74\x6f\x6b\145\x6e\x22\40\x69\156\40\x65\154\145\x6d\x65\156\164\x73\x29\40\x7c\174\x20\x28\x22\164\157\x6b\145\156\42\x20\151\x6e\40\145\154\145\155\145\x6e\164\163\51\51\x20\173\xa\x9\11\11\11\11\x9\11\x69\146\50\x77\x69\x6e\x64\157\x77\x2e\154\157\x63\141\x74\x69\x6f\x6e\x2e\150\162\x65\146\56\x69\x6e\144\145\x78\x4f\146\x28\42\x3f\42\51\x20\41\75\75\40\55\x31\x29\40\x7b\xa\11\11\x9\x9\11\x9\x9\x9\x77\151\x6e\144\x6f\167\x2e\x6c\157\143\141\164\151\x6f\156\40\75\x20\50\x77\x69\x6e\144\157\x77\x2e\x6c\x6f\143\141\x74\151\157\156\x2e\150\x72\145\x66\x2e\163\x70\x6c\151\164\50\x22\x3f\x22\x29\133\x30\135\x20\x2b\x20\167\x69\156\x64\x6f\x77\56\x6c\x6f\143\141\164\x69\x6f\x6e\x2e\x68\141\x73\150\x29\56\x73\160\154\151\x74\x28\47\43\x27\51\133\x30\135\40\53\40\42\x3f\x22\x20\x2b\40\143\157\x6e\166\145\x72\x74\x5f\164\157\137\x75\x72\x6c\50\x65\154\x65\155\x65\156\164\163\x29\x3b\xa\x9\11\11\x9\11\11\11\x7d\40\145\154\163\x65\x20\173\xa\x9\x9\11\x9\11\11\11\11\167\151\156\x64\x6f\167\56\x6c\157\143\x61\164\x69\157\x6e\x20\x3d\x20\167\151\156\144\x6f\167\x2e\154\157\143\141\x74\x69\157\156\x2e\150\x72\145\x66\x2e\x73\x70\154\x69\x74\x28\47\43\x27\x29\x5b\60\135\x20\53\x20\42\x3f\x22\40\53\40\143\x6f\x6e\x76\145\162\164\x5f\164\157\x5f\165\162\x6c\x28\145\154\x65\155\145\x6e\x74\x73\x29\73\xa\x9\11\x9\11\x9\x9\x9\175\xa\x9\x9\11\x9\11\x9\x7d\12\11\x9\x9\x9\11\x7d\xa\x9\x9\x9\x9\175\12\xa\11\11\x9\11\160\x61\x73\x73\137\164\157\137\x62\x61\143\x6b\x65\x6e\x64\50\x29\73\12\x9\x9\11\74\57\163\x63\162\x69\x70\x74\x3e\xa\12\x9\x9";
    }
    private function check_state($VP)
    {
        global $lT;
        $w6 = str_replace("\x25\x33\x64", "\75", urldecode($VP->get_query_param("\x73\x74\x61\164\145")));
        if (empty($w6) && isset($_COOKIE["\x73\164\x61\x74\x65\x5f\160\x61\162\141\155"])) {
            goto fLe;
        }
        if (isset($_GET["\x73\164\x61\164\145"]) && !empty($_GET["\163\164\141\x74\145"])) {
            goto fTr;
        }
        goto S6c;
        fLe:
        $w6 = $_COOKIE["\163\x74\141\164\145\137\160\141\x72\x61\x6d"];
        goto S6c;
        fTr:
        $w6 = wp_unslash($_GET["\x73\164\141\x74\x65"]);
        S6c:
        $Xc = new StorageManager($w6);
        $Wj = $Xc->get_value("\141\x70\x70\156\x61\x6d\145");
        $FK = $lT->get_app_by_name($Wj)->get_app_config();
        $Ig = $FK["\x61\160\160\x49\x64"];
        $kp = $lT->get_app_by_name($Ig);
        if (!is_wp_error($Xc)) {
            goto Fgo;
        }
        $lT->handle_error($Xc->get_error_message());
        wp_die(wp_kses($Xc->get_error_message(), \mo_oauth_get_valid_html()));
        Fgo:
        $PO = $Xc->get_value("\x75\x69\x64");
        if (!($PO && MO_UID === $PO)) {
            goto oOg;
        }
        $this->appname = $Xc->get_value("\x61\160\160\156\x61\x6d\145");
        return $Xc;
        oOg:
        return false;
    }
    public function mo_oauth_login_validate()
    {
        if (isset($_REQUEST["\x6d\x6f\x5f\154\157\147\x69\x6e\x5f\x70\157\x70\x75\x70"]) && 1 == sanitize_text_field($_REQUEST["\155\157\x5f\x6c\157\x67\151\156\137\160\x6f\x70\x75\x70"])) {
            goto gli;
        }
        parent::mo_oauth_login_validate();
        global $lT;
        if (!(isset($_REQUEST["\164\157\x6b\145\156"]) && !empty($_REQUEST["\x74\x6f\153\145\x6e"]) || isset($_REQUEST["\151\144\137\x74\x6f\x6b\145\x6e"]) && !empty($_REQUEST["\151\144\137\164\x6f\153\145\x6e"]))) {
            goto DwT;
        }
        if (!(isset($_REQUEST["\x74\x6f\x6b\x65\x6e"]) && !empty($_REQUEST["\164\x6f\153\145\x6e"]))) {
            goto kvJ;
        }
        $Y3 = $lT->is_valid_jwt(urldecode($_REQUEST["\x74\x6f\x6b\x65\156"]));
        if ($Y3) {
            goto Ztv;
        }
        return;
        Ztv:
        kvJ:
        if (!(isset($_REQUEST["\156\x6f\x6e\x63\145"]) && (isset($_COOKIE["\155\157\137\x6f\x61\165\164\x68\x5f\x6e\x6f\156\143\x65"]) && $_COOKIE["\155\x6f\x5f\x6f\x61\x75\x74\150\137\x6e\157\x6e\x63\145"] != $_REQUEST["\156\157\x6e\x63\145"]))) {
            goto wQU;
        }
        $lT->handle_error("\x4e\x6f\156\143\145\x20\166\x65\162\x69\146\x69\x63\141\164\x69\157\156\40\x69\x73\40\146\141\x69\x6c\145\x64\x2e\40\x50\x6c\x65\141\x73\x65\x20\x63\157\156\x74\x61\x63\164\40\x74\x6f\40\x79\x6f\165\x72\40\x61\144\155\x69\156\151\x73\164\x72\x61\164\157\x72\56");
        wp_die("\x4e\x6f\156\143\145\x20\x76\145\x72\151\146\151\143\x61\x74\151\x6f\x6e\x20\x69\x73\x20\x66\x61\151\154\145\144\56\40\120\154\145\x61\x73\145\40\x63\x6f\x6e\x74\x61\143\164\x20\164\157\40\171\x6f\165\162\40\x61\144\x6d\x69\x6e\151\163\164\162\x61\164\157\162\56");
        exit;
        wQU:
        $VP = new Implicit(isset($_SERVER["\x51\125\x45\122\131\137\x53\124\122\111\x4e\x47"]) ? $_SERVER["\121\125\105\122\131\137\123\124\122\x49\116\x47"] : '');
        if (!is_wp_error($VP)) {
            goto LXv;
        }
        $lT->handle_error($VP->get_error_message());
        wp_die(wp_kses($VP->get_error_message(), \mo_oauth_get_valid_html()));
        MO_Oauth_Debug::mo_oauth_log("\x50\x6c\x65\x61\163\145\40\164\x72\171\40\114\x6f\x67\147\151\x6e\x67\40\151\x6e\x20\x61\147\x61\x69\x6e\x2e");
        exit("\x50\154\145\x61\163\145\x20\x74\x72\x79\x20\114\157\x67\x67\x69\x6e\147\40\x69\156\40\141\x67\x61\x69\x6e\x2e");
        LXv:
        $dR = $VP->get_jwt_from_query_param();
        if (!is_wp_error($dR)) {
            goto hkN;
        }
        $lT->handle_error($dR->get_error_message());
        MO_Oauth_Debug::mo_oauth_log($dR->get_error_message());
        wp_die(wp_kses($dR->get_error_message(), \mo_oauth_get_valid_html()));
        hkN:
        MO_Oauth_Debug::mo_oauth_log("\x4a\x57\x54\x20\x54\157\153\145\x6e\x20\x75\x73\x65\x64\40\x66\x6f\x72\x20\x6f\x62\164\141\151\x6e\x69\156\x67\x20\162\145\x73\x6f\x75\x72\x63\x65\x20\x6f\167\156\x65\162\x20\x3d\x3e\x20");
        MO_Oauth_Debug::mo_oauth_log($dR);
        $Xc = $this->check_state($VP);
        if ($Xc) {
            goto NCF;
        }
        $Jw = "\123\x74\141\x74\x65\40\120\141\x72\x61\155\145\x74\145\162\40\144\151\144\40\156\x6f\x74\40\x76\x65\162\x69\146\x79\56\40\120\x6c\x65\141\163\x65\40\x54\x72\171\x20\x4c\157\x67\x67\x69\156\x67\40\151\156\x20\x61\147\x61\x69\156\56";
        $lT->handle_error($Jw);
        MO_Oauth_Debug::mo_oauth_log("\x53\164\141\x74\145\40\120\x61\x72\141\x6d\145\x74\x65\x72\x20\144\151\x64\40\x6e\x6f\164\x20\x76\x65\162\151\146\x79\x2e\x20\120\154\x65\x61\x73\x65\40\x54\162\171\40\x4c\157\x67\147\x69\156\147\x20\x69\x6e\40\141\147\141\151\x6e\61\56");
        wp_die($Jw);
        NCF:
        $FK = $lT->get_app_by_name($this->app_name);
        $FK = $FK ? $FK->get_app_config() : false;
        $tJ = $this->handle_jwt($dR);
        MO_Oauth_Debug::mo_oauth_log("\x52\145\x73\x6f\x75\x72\x63\x65\x20\117\167\x6e\145\x72\40\x3d\76\x20");
        MO_Oauth_Debug::mo_oauth_log($tJ);
        if (!is_wp_error($tJ)) {
            goto AMW;
        }
        $lT->handle_error($tJ->get_error_message());
        wp_die(wp_kses($tJ->get_error_message(), \mo_oauth_get_valid_html()));
        AMW:
        if ($FK) {
            goto GPU;
        }
        $au = "\x53\x74\141\164\x65\40\120\141\162\141\x6d\x65\x74\x65\162\40\144\151\x64\40\156\x6f\164\x20\166\145\162\151\x66\171\56\x20\x50\x6c\145\141\x73\x65\40\x54\x72\x79\40\114\157\x67\x67\151\x6e\147\x20\x69\156\40\x61\147\141\151\x6e\x32\x2e";
        $lT->handle_error($au);
        MO_Oauth_Debug::mo_oauth_log("\x53\x74\141\164\x65\40\x50\141\162\141\155\x65\x74\145\162\40\144\x69\144\x20\156\157\x74\x20\166\x65\162\151\x66\171\x2e\40\x50\x6c\x65\141\x73\145\40\x54\162\x79\40\x4c\x6f\147\147\151\156\x67\40\151\156\x20\x61\x67\141\151\x6e\56");
        wp_die($au);
        GPU:
        if ($tJ) {
            goto Hic;
        }
        $vp = "\x4a\127\x54\x20\123\151\147\156\141\x74\x75\x72\x65\40\144\x69\144\40\156\x6f\x74\40\x76\x65\x72\151\x66\x79\56\x20\120\x6c\x65\141\163\x65\x20\124\162\171\40\x4c\157\147\147\151\x6e\147\40\x69\156\40\141\x67\x61\151\x6e\56";
        $lT->handle_error($vp);
        MO_Oauth_Debug::mo_oauth_log("\112\x57\124\40\123\x69\x67\x6e\141\164\x75\162\x65\x20\x64\x69\x64\40\x6e\157\164\x20\x76\145\x72\151\146\171\56\x20\x50\x6c\x65\141\163\145\40\124\x72\x79\40\x4c\x6f\147\147\151\156\147\40\x69\156\x20\x61\147\141\151\x6e\x2e");
        wp_die($vp);
        Hic:
        $wK = $Xc->get_value("\164\145\163\164\137\x63\157\x6e\146\x69\x67");
        $this->resource_owner = $tJ;
        $this->handle_group_details($VP->get_query_param("\141\143\x63\145\x73\x73\137\164\157\153\145\x6e"), isset($FK["\x67\162\157\165\160\x64\x65\164\141\151\154\x73\165\162\x6c"]) ? $FK["\147\x72\x6f\165\x70\x64\145\164\141\x69\154\163\x75\x72\154"] : '', isset($FK["\x67\x72\x6f\x75\x70\156\x61\155\x65\x5f\141\x74\x74\x72\x69\x62\165\164\x65"]) ? $FK["\147\x72\x6f\x75\x70\x6e\x61\155\145\137\141\x74\164\162\x69\x62\165\x74\x65"] : '', $wK);
        $h0 = [];
        $Vk = $this->dropdownattrmapping('', $tJ, $h0);
        $lT->mo_oauth_client_update_option("\155\x6f\137\157\x61\x75\164\x68\137\x61\164\164\162\137\x6e\141\x6d\x65\137\x6c\x69\163\164" . $FK["\141\160\x70\111\144"], $Vk);
        if (!($wK && '' !== $wK)) {
            goto LVc;
        }
        $this->render_test_config_output($tJ);
        exit;
        LVc:
        MO_Oauth_Debug::mo_oauth_log("\102\145\146\157\162\145\40\x68\x61\x6e\x64\x6c\x65\x20\x73\x73\157\61");
        $this->handle_sso($this->app_name, $FK, $tJ, $Xc->get_state(), $VP->get_query_param());
        DwT:
        if (!(isset($_REQUEST["\x68\x75\x62\x6c\145\164"]) || isset($_REQUEST["\160\157\162\x74\x61\x6c\137\144\157\155\141\151\156"]))) {
            goto Z8M;
        }
        return;
        Z8M:
        if (!(isset($_REQUEST["\141\x63\143\145\163\163\137\x74\157\153\x65\156"]) && '' !== $_REQUEST["\x61\x63\x63\x65\x73\x73\137\x74\157\x6b\145\156"])) {
            goto plg;
        }
        do_action("\155\157\137\x6f\141\165\x74\150\x5f\143\x68\145\143\153\x5f\x63\x75\163\x74\x6f\155\x5f\141\143\x63\x65\163\x73\x5f\x74\x6f\153\145\156", $_REQUEST);
        $VP = new Implicit(isset($_SERVER["\121\125\x45\x52\131\x5f\123\124\x52\111\x4e\x47"]) ? $_SERVER["\x51\125\x45\x52\x59\x5f\123\124\122\x49\116\107"] : '');
        $Xc = $this->check_state($VP);
        if ($Xc) {
            goto rKM;
        }
        $Jw = "\x53\x74\x61\164\145\x20\120\x61\x72\141\x6d\145\x74\x65\162\40\144\x69\144\x20\156\x6f\x74\x20\x76\x65\162\151\146\x79\x2e\x20\120\x6c\145\141\163\x65\40\x54\162\x79\40\x4c\157\x67\147\x69\156\x67\x20\151\x6e\x20\141\147\141\x69\x6e\x2e";
        $lT->handle_error($Jw);
        MO_Oauth_Debug::mo_oauth_log("\x53\164\141\x74\145\x20\x50\x61\x72\141\x6d\145\x74\145\162\x20\x64\x69\144\40\156\x6f\164\x20\x76\x65\x72\151\x66\171\56\x20\120\x6c\145\141\x73\145\40\124\x72\171\40\x4c\x6f\x67\147\151\156\147\x20\x69\156\40\x61\147\141\151\156\62\x2e");
        wp_die($Jw);
        rKM:
        $FK = $lT->get_app_by_name($Xc->get_value("\x61\x70\x70\x6e\141\x6d\145"));
        $FK = $FK->get_app_config();
        $tJ = [];
        if (!(isset($FK["\x72\145\163\x6f\x75\162\143\x65\157\167\x6e\145\x72\x64\x65\x74\141\x69\154\163\165\x72\154"]) && !empty($FK["\162\x65\x73\157\x75\x72\143\145\157\167\x6e\x65\162\x64\x65\x74\x61\x69\x6c\x73\165\162\154"]))) {
            goto ssG;
        }
        $tJ = $this->oauth_handler->get_resource_owner($FK["\x72\x65\x73\157\x75\162\x63\x65\x6f\167\156\x65\x72\144\x65\x74\141\151\154\x73\165\162\x6c"], $VP->get_query_param("\141\x63\x63\145\163\x73\x5f\x74\157\153\145\x6e"));
        ssG:
        MO_Oauth_Debug::mo_oauth_log("\101\x63\x63\145\163\x73\40\x54\157\153\145\156\40\75\76\x20");
        MO_Oauth_Debug::mo_oauth_log($VP->get_query_param("\x61\143\143\145\163\163\137\x74\157\x6b\x65\156"));
        $yP = [];
        if (!$lT->is_valid_jwt($VP->get_query_param("\x61\143\143\145\163\x73\x5f\x74\x6f\x6b\145\x6e"))) {
            goto jgp;
        }
        $dR = $VP->get_jwt_from_query_param();
        $yP = $this->handle_jwt($dR);
        jgp:
        if (empty($yP)) {
            goto B2_;
        }
        $tJ = array_merge($tJ, $yP);
        B2_:
        if (!(empty($tJ) && !$lT->is_valid_jwt($VP->get_query_param("\141\143\143\x65\x73\163\x5f\164\x6f\x6b\x65\156")))) {
            goto h1W;
        }
        $lT->handle_error("\111\156\x76\141\x6c\x69\144\x20\122\145\x73\x70\157\156\163\145\x20\122\145\143\x65\x69\166\145\x64\x2e");
        MO_Oauth_Debug::mo_oauth_log("\x49\x6e\x76\141\154\151\x64\x20\x52\145\x73\160\157\x6e\x73\145\x20\x52\x65\x63\145\x69\166\x65\144");
        wp_die("\x49\156\166\141\x6c\151\x64\x20\122\145\x73\160\157\x6e\163\x65\x20\x52\x65\143\x65\x69\166\145\x64\56");
        exit;
        h1W:
        $this->resource_owner = $tJ;
        MO_Oauth_Debug::mo_oauth_log("\122\145\x73\x6f\165\x72\x63\145\40\117\x77\x6e\x65\162\x20\75\76\x20");
        MO_Oauth_Debug::mo_oauth_log($this->resource_owner);
        $wK = $Xc->get_value("\x74\x65\163\164\x5f\143\157\x6e\x66\151\x67");
        $this->handle_group_details($VP->get_query_param("\x61\x63\x63\145\163\x73\137\x74\157\x6b\x65\156"), isset($FK["\x67\x72\157\165\160\144\x65\164\x61\x69\154\x73\x75\x72\x6c"]) ? $FK["\x67\x72\x6f\165\160\144\145\164\141\151\154\163\165\162\x6c"] : '', isset($FK["\x67\162\x6f\x75\x70\156\x61\155\145\x5f\x61\x74\x74\162\x69\142\165\164\x65"]) ? $FK["\x67\162\157\165\x70\x6e\141\x6d\x65\137\x61\164\x74\162\x69\142\x75\164\x65"] : '', $wK);
        $h0 = [];
        $Vk = $this->dropdownattrmapping('', $tJ, $h0);
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\157\x61\165\x74\150\137\x61\x74\164\x72\x5f\156\x61\x6d\145\137\154\151\x73\x74" . $FK["\141\160\x70\111\144"], $Vk);
        if (!($wK && '' !== $wK)) {
            goto dhG;
        }
        $this->render_test_config_output($tJ);
        exit;
        dhG:
        $w6 = str_replace("\x25\x33\x44", "\75", rawurldecode($VP->get_query_param("\163\x74\141\x74\145")));
        $this->handle_sso($this->app_name, $FK, $tJ, $w6, $VP->get_query_param());
        plg:
        if (!(isset($_REQUEST["\x6c\x6f\147\151\156"]) && "\x70\167\144\147\162\x6e\164\146\x72\x6d" === $_REQUEST["\x6c\157\147\151\156"])) {
            goto nvb;
        }
        $R0 = new Password();
        $Od = isset($_REQUEST["\143\x61\x6c\154\x65\162"]) && !empty($_REQUEST["\x63\141\x6c\154\145\162"]) ? $_REQUEST["\x63\141\x6c\x6c\145\162"] : false;
        $Av = isset($_REQUEST["\x74\x6f\x6f\154"]) && !empty($_REQUEST["\164\157\157\154"]) ? $_REQUEST["\164\157\x6f\154"] : false;
        $Or = isset($_REQUEST["\141\x70\x70\x5f\156\141\x6d\x65"]) && !empty($_REQUEST["\141\160\x70\137\156\x61\155\145"]) ? $_REQUEST["\141\160\160\137\156\x61\155\x65"] : '';
        if (!($Or == '')) {
            goto ZLo;
        }
        $WG = "\x4e\157\x20\163\165\x63\150\40\141\160\160\40\x66\x6f\165\156\x64\40\143\x6f\156\x66\151\x67\165\162\x65\x64\x2e\40\120\154\x65\141\x73\145\40\143\x68\145\143\x6b\40\x69\146\40\171\x6f\x75\40\141\x72\x65\40\163\145\x6e\144\151\x6e\x67\40\164\x68\145\40\x63\x6f\x72\x72\145\x63\164\x20\x61\x70\x70\154\151\x63\141\164\x69\x6f\x6e\x20\x6e\x61\x6d\x65";
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        ZLo:
        $Tx = $lT->mo_oauth_client_get_option("\x6d\x6f\x5f\157\x61\165\164\150\x5f\x61\160\x70\163\x5f\154\x69\x73\164");
        if (is_array($Tx) && isset($Tx[$Or])) {
            goto HA2;
        }
        $WG = "\x4e\157\x20\163\x75\x63\x68\x20\141\x70\160\40\146\x6f\x75\156\144\40\x63\x6f\156\146\151\147\165\162\x65\144\56\x20\x50\154\x65\x61\163\145\40\x63\x68\x65\x63\153\40\151\146\40\x79\157\165\40\141\162\x65\x20\163\x65\x6e\x64\x69\156\x67\40\x74\x68\145\40\x63\157\x72\162\x65\x63\x74\40\x61\x70\160\x5f\x6e\x61\155\x65";
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        HA2:
        $yU = isset($_REQUEST["\154\157\143\141\164\x69\x6f\156"]) && !empty($_REQUEST["\154\x6f\143\x61\164\x69\x6f\156"]) ? $_REQUEST["\x6c\x6f\143\141\164\x69\157\156"] : site_url();
        $LI = isset($_REQUEST["\x74\145\x73\164"]) && !empty($_REQUEST["\x74\145\163\x74"]);
        if (!(!$Od || !$Av || !$Or)) {
            goto Q2F;
        }
        $lT->redirect_user(urldecode($yU));
        Q2F:
        do_action("\x6d\157\x5f\x6f\141\x75\x74\150\x5f\x63\x75\163\164\157\155\x5f\163\163\x6f", $Od, $Av, $Or, $yU, $LI);
        $R0->behave($Od, $Av, $Or, $yU, $LI);
        nvb:
        goto nNO;
        gli:
        echo "\11\11\x9\74\163\x63\x72\151\160\164\40\164\x79\160\145\x3d\42\x74\x65\170\x74\x2f\152\x61\x76\x61\x73\143\x72\151\160\x74\x22\x3e\12\x9\x9\11\x76\x61\162\40\x62\x61\x73\145\x5f\165\162\x6c\x20\75\40\42";
        echo site_url();
        echo "\x22\73\xa\11\11\x9\166\x61\x72\x20\x61\x70\160\x5f\x6e\x61\x6d\x65\x20\x3d\40\42";
        echo sanitize_text_field($_REQUEST["\141\x70\x70\x5f\x6e\141\155\x65"]);
        echo "\42\73\xa\x9\11\11\11\x76\141\x72\40\155\171\x57\x69\x6e\144\x6f\167\40\75\40\167\x69\156\x64\x6f\x77\56\x6f\160\145\x6e\x28\40\x62\141\x73\x65\137\165\x72\154\x20\53\40\x27\x2f\77\157\x70\164\151\x6f\156\x3d\x6f\x61\165\164\x68\162\x65\x64\151\x72\x65\x63\164\x26\x61\160\x70\x5f\x6e\141\155\x65\x3d\x27\40\x2b\40\141\x70\160\x5f\x6e\x61\x6d\x65\x2c\x20\47\47\54\x20\x27\167\x69\x64\164\x68\x3d\x35\x30\60\x2c\150\145\x69\x67\x68\x74\x3d\x35\x30\x30\47\x29\73\xa\x9\x9\11\x9\74\x2f\163\143\162\151\x70\x74\76\12\11\11\x9\x9";
        nNO:
    }
    public function handle_group_details($T2 = '', $K5 = '', $lm = '', $wK = false)
    {
        $tj = [];
        if (!('' === $T2 || '' === $lm)) {
            goto Zq8;
        }
        return;
        Zq8:
        if (!('' !== $K5)) {
            goto M7i;
        }
        $tj = $this->oauth_handler->get_resource_owner($K5, $T2);
        if (!(isset($_COOKIE["\155\x6f\x5f\157\x61\x75\164\150\137\x74\x65\x73\x74"]) && $_COOKIE["\x6d\157\x5f\x6f\x61\x75\x74\x68\137\164\x65\163\164"])) {
            goto z3t;
        }
        if (!(is_array($tj) && !empty($tj))) {
            goto i1V;
        }
        $this->render_test_config_output($tj, true);
        i1V:
        return;
        z3t:
        M7i:
        $zF = $this->get_group_mapping_attribute($this->resource_owner, $tj, $lm);
        $this->group_mapping_attr = '' !== $zF ? false : $zF;
    }
    public function get_group_mapping_attribute($tJ = array(), $tj = array(), $lm = '')
    {
        global $lT;
        $WQ = '';
        if (!('' === $lm)) {
            goto i8P;
        }
        return '';
        i8P:
        if (isset($tj) && !empty($tj)) {
            goto y0z;
        }
        if (isset($tJ) && !empty($tJ)) {
            goto A1A;
        }
        goto dq8;
        y0z:
        $WQ = $lT->getnestedattribute($tj, $lm);
        goto dq8;
        A1A:
        $WQ = $lT->getnestedattribute($tJ, $lm);
        dq8:
        if (!($WQ === 0 || $WQ === "\60")) {
            goto RQL;
        }
        return $WQ;
        RQL:
        return !empty($WQ) ? $WQ : '';
    }
    public function handle_jwt($dR)
    {
        global $lT;
        $kp = $lT->get_app_by_name($this->app_name);
        $Y6 = $kp->get_app_config("\x6a\167\164\137\x73\x75\x70\160\x6f\x72\x74");
        if ($Y6) {
            goto fbG;
        }
        return $dR->get_decoded_payload();
        fbG:
        $Nk = $kp->get_app_config("\152\x77\x74\x5f\x61\154\x67\x6f");
        if ($dR->check_algo($Nk)) {
            goto eeL;
        }
        return new \WP_Error("\151\x6e\x76\141\154\151\x64\137\163\151\147\156", __("\x4a\127\x54\40\123\x69\x67\x6e\x69\x6e\147\40\141\154\147\x6f\x72\x69\x74\x68\155\40\151\x73\40\x6e\157\164\x20\x61\x6c\x6c\157\167\145\144\x20\157\162\x20\165\x6e\x73\165\160\x70\157\x72\164\x65\144\x2e"));
        eeL:
        $Ld = "\122\x53\101" === $Nk ? $kp->get_app_config("\x78\65\x30\71\137\143\x65\162\x74") : $kp->get_app_config("\x63\x6c\x69\x65\x6e\164\x5f\x73\145\x63\162\x65\x74");
        $pr = $kp->get_app_config("\x6a\167\x6b\163\x75\x72\x6c");
        $kx = $pr ? $dR->verify_from_jwks($pr) : $dR->verify($Ld);
        return !$kx ? $kx : $dR->get_decoded_payload();
    }
    public function get_resource_owner_from_app($M3, $kp)
    {
        global $lT;
        $this->app_name = $kp;
        $dR = new JWTUtils($M3);
        if (!is_wp_error($dR)) {
            goto hQt;
        }
        $lT->handle_error($dR->get_error_message());
        wp_die($dR);
        hQt:
        $tJ = $this->handle_jwt($dR);
        if (!is_wp_error($tJ)) {
            goto lvE;
        }
        $lT->handle_error($tJ->get_error_message());
        wp_die($tJ);
        lvE:
        if (!(false === $tJ)) {
            goto VjS;
        }
        $TA = "\x46\141\151\154\x65\144\x20\x74\x6f\40\x76\x65\x72\x69\146\x79\x20\x4a\x57\124\40\x54\157\x6b\x65\156\x2e\40\x50\154\145\x61\x73\145\40\x63\150\145\143\x6b\x20\171\x6f\165\x72\x20\143\x6f\x6e\x66\151\147\x75\x72\x61\164\151\x6f\156\40\157\x72\x20\143\157\x6e\x74\141\143\164\40\x79\x6f\165\162\x20\x41\x64\155\x69\x6e\x69\163\164\162\x61\x74\157\x72\56";
        $lT->handle_error($TA);
        MO_Oauth_Debug::mo_oauth_log("\106\141\x69\x6c\x65\144\40\164\157\x20\166\145\162\151\x66\171\40\x4a\x57\124\x20\124\x6f\x6b\x65\156\x2e\x20\x50\x6c\145\141\163\145\x20\143\x68\145\143\153\40\x79\x6f\x75\x72\x20\143\157\x6e\x66\151\147\165\162\x61\x74\x69\157\156\x20\157\x72\x20\143\157\156\x74\141\143\x74\40\171\x6f\x75\x72\x20\x41\x64\x6d\151\x6e\151\x73\164\162\141\x74\x6f\162\56");
        wp_die($TA);
        VjS:
        return $tJ;
    }
}
