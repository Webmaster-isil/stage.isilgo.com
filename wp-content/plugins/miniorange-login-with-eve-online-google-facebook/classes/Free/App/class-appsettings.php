<?php


namespace MoOauthClient\Free;

use MoOauthClient\App;
class AppSettings
{
    private $app_config;
    public function __construct()
    {
        $this->app_config = array("\x63\x6c\x69\145\156\164\137\x69\144", "\143\x6c\x69\x65\156\164\x5f\x73\145\143\162\145\164", "\163\143\x6f\x70\x65", "\162\x65\x64\x69\x72\145\x63\x74\x5f\x75\x72\x69", "\141\x70\x70\137\164\x79\x70\x65", "\x61\165\x74\x68\157\162\x69\x7a\145\x75\x72\x6c", "\x61\143\143\145\163\163\x74\x6f\x6b\145\156\165\162\x6c", "\162\x65\x73\157\165\x72\143\x65\x6f\x77\x6e\145\162\x64\x65\x74\x61\151\154\x73\x75\162\x6c", "\x67\162\x6f\x75\160\144\x65\x74\141\151\154\x73\165\x72\x6c", "\x6a\167\153\163\x5f\165\x72\x69", "\144\151\163\x70\x6c\x61\171\141\160\x70\156\141\155\x65", "\141\x70\160\111\x64", "\155\x6f\137\x6f\141\165\x74\150\137\x72\145\163\160\x6f\156\163\x65\x5f\164\x79\x70\x65");
    }
    public function save_app_settings()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\x64\151\x73\141\x62\x6c\x65\144";
        if (empty($zB["\155\x6f\x5f\x64\x74\145\x5f\x73\x74\141\164\x65"])) {
            goto AY;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\x6f\x5f\x64\x74\x65\137\163\164\141\x74\145"]);
        AY:
        if (!($M9 == "\144\151\x73\141\142\154\x65\144")) {
            goto rY;
        }
        if (!(isset($_POST["\155\157\x5f\157\x61\165\x74\150\137\141\144\x64\x5f\x61\x70\x70\x5f\x6e\x6f\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x6f\x61\165\x74\150\x5f\x61\x64\x64\x5f\x61\x70\160\x5f\x6e\x6f\x6e\143\x65"])), "\x6d\157\137\157\x61\x75\164\x68\x5f\x61\x64\144\137\x61\x70\160") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\157\x5f\157\141\x75\164\150\x5f\x61\x64\144\x5f\x61\x70\160" === $_POST[\MoOAuthConstants::OPTION])) {
            goto Wb;
        }
        if (!($lT->mo_oauth_check_empty_or_null($_POST["\155\x6f\x5f\157\x61\x75\164\150\x5f\143\154\x69\145\156\164\x5f\x69\x64"]) || $lT->mo_oauth_check_empty_or_null($_POST["\x6d\157\137\157\141\x75\x74\x68\137\143\x6c\x69\x65\156\x74\137\x73\x65\143\x72\145\164"]))) {
            goto fI;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x6c\145\x61\x73\145\40\x65\x6e\x74\145\162\x20\x76\141\x6c\151\x64\40\103\154\x69\145\x6e\x74\40\x49\x44\x20\x61\156\144\40\103\154\x69\x65\x6e\x74\40\x53\x65\x63\x72\x65\x74\x2e");
        $lT->mo_oauth_show_error_message();
        return;
        fI:
        $Ig = isset($_POST["\155\x6f\137\157\x61\x75\x74\150\x5f\x63\x75\x73\x74\157\x6d\x5f\x61\160\x70\137\156\141\x6d\145"]) ? sanitize_text_field(wp_unslash($_POST["\155\157\x5f\x6f\x61\x75\164\x68\x5f\x63\x75\x73\164\x6f\155\x5f\141\x70\x70\137\156\x61\155\145"])) : false;
        $Bs = $lT->get_app_by_name($Ig);
        $Bs = false !== $Bs ? $Bs->get_app_config() : [];
        $kc = false !== $Bs;
        $Tx = $lT->get_app_list();
        if (!(!$kc && is_array($Tx) && count($Tx) > 0 && !$lT->check_versi(4))) {
            goto lW;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\x6f\x75\x20\143\x61\156\40\157\156\154\171\40\x61\x64\x64\x20\61\40\141\x70\160\x6c\x69\143\141\164\x69\x6f\156\40\167\x69\x74\150\40\x66\x72\x65\145\40\166\145\x72\163\151\157\x6e\56\40\x55\x70\147\x72\x61\x64\145\x20\164\x6f\40\x65\x6e\164\145\162\x70\x72\151\x73\x65\40\x76\x65\162\x73\x69\x6f\156\x20\151\x66\x20\171\x6f\165\40\x77\x61\156\164\x20\164\157\40\141\x64\x64\x20\x6d\x6f\162\x65\40\141\x70\160\x6c\151\143\141\x74\x69\157\156\x73\56");
        $lT->mo_oauth_show_error_message();
        return;
        lW:
        $Bs = !is_array($Bs) || empty($Bs) ? array() : $Bs;
        $Bs = $this->change_app_settings($_POST, $Bs);
        $iv = isset($_POST["\x6d\x6f\137\x6f\x61\x75\164\x68\137\144\x69\x73\x63\x6f\x76\x65\162\x79"]) && isset($Bs["\x69\x73\x5f\x64\151\163\143\157\166\145\162\171\137\x76\x61\154\x69\x64"]) && $Bs["\151\163\137\144\x69\x73\143\x6f\x76\x65\162\171\137\x76\x61\x6c\x69\x64"] == "\164\x72\x75\x65";
        if (!$iv) {
            goto KO;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\165\162\x20\x73\145\164\x74\x69\156\x67\163\x20\141\162\145\40\163\x61\x76\145\144\40\x73\x75\x63\143\x65\x73\163\146\x75\154\154\x79\x2e");
        $Bs["\x6d\157\x5f\144\151\x73\143\157\166\145\162\x79\137\x76\x61\154\x69\144\x61\x74\x69\x6f\156"] = "\x76\141\x6c\151\x64";
        $lT->mo_oauth_show_success_message();
        goto i4;
        KO:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\74\x73\x74\x72\157\156\x67\76\x45\162\x72\157\162\72\40\74\x2f\163\164\x72\157\x6e\147\76\40\x49\156\143\157\x72\162\x65\x63\x74\40\x44\157\155\x61\x69\x6e\x2f\x54\145\156\141\x6e\164\x2f\120\x6f\x6c\151\x63\x79\57\122\145\x61\x6c\155\56\x20\120\x6c\145\141\163\145\x20\143\157\x6e\x66\151\x67\165\x72\145\x20\167\151\164\150\40\143\x6f\162\x72\145\x63\x74\x20\x76\x61\x6c\x75\x65\163\x20\x61\x6e\144\x20\x74\x72\171\40\141\147\x61\x69\x6e\56");
        $Bs["\155\157\x5f\x64\151\163\143\157\x76\145\162\171\x5f\166\x61\x6c\x69\x64\141\x74\151\157\x6e"] = "\151\x6e\166\141\x6c\151\x64";
        $lT->mo_oauth_show_error_message();
        i4:
        $Tx[$Ig] = new App($Bs);
        $Tx[$Ig]->set_app_name($Ig);
        $Tx = apply_filters("\x6d\x6f\137\157\141\165\164\x68\137\143\x6c\151\x65\156\164\137\x73\x61\166\145\137\141\x64\x64\151\164\151\157\x6e\x61\154\x5f\x66\x69\x65\154\144\x5f\x73\145\x74\x74\x69\x6e\x67\163\x5f\151\156\x74\145\x72\156\141\154", $Tx);
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\x6f\x61\165\x74\150\137\x61\x70\x70\x73\137\x6c\151\x73\164", $Tx);
        wp_redirect("\x61\144\x6d\151\156\56\160\150\160\x3f\x70\141\x67\145\x3d\155\x6f\x5f\x6f\141\165\164\x68\x5f\163\145\x74\164\x69\x6e\147\163\x26\164\x61\142\75\x63\x6f\156\x66\151\x67\x26\x61\x63\x74\x69\157\156\75\165\160\144\x61\x74\145\x26\141\160\x70\x3d" . urlencode($Ig));
        Wb:
        if (!(isset($_POST["\155\x6f\x5f\x6f\x61\165\x74\150\137\x61\164\164\162\151\x62\x75\164\145\137\155\141\x70\x70\x69\x6e\147\x5f\x6e\157\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\157\141\165\164\150\137\x61\x74\164\162\151\142\x75\164\145\137\155\x61\160\x70\151\156\147\x5f\156\157\x6e\x63\145"])), "\x6d\157\137\157\x61\x75\164\x68\x5f\141\x74\164\162\151\142\x75\x74\145\x5f\x6d\141\160\160\x69\x6e\147") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\x5f\x6f\141\x75\164\150\x5f\141\x74\164\x72\x69\142\165\x74\145\137\155\141\160\x70\x69\x6e\x67" === $_POST[\MoOAuthConstants::OPTION])) {
            goto QK;
        }
        $Ig = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::POST_APP_NAME]) ? $_POST[\MoOAuthConstants::POST_APP_NAME] : ''));
        $kp = $lT->get_app_by_name($Ig);
        $FK = $kp->get_app_config('', false);
        $post = array_map("\x65\163\143\x5f\x61\164\164\162", $_POST);
        $FK = $this->change_attribute_mapping($post, $FK);
        $FK = apply_filters("\155\x6f\x5f\157\141\x75\x74\150\x5f\x63\154\151\x65\x6e\x74\x5f\x73\141\x76\145\137\x61\x64\x64\x69\x74\x69\x6f\x6e\141\x6c\137\x61\x74\164\162\137\155\141\160\160\x69\x6e\x67\x5f\163\145\164\x74\151\x6e\147\163\137\x69\156\164\145\162\x6e\141\154", $FK);
        $oR = $lT->set_app_by_name($Ig, $FK);
        if (!$oR) {
            goto Y3;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\165\162\x20\163\145\164\164\151\156\147\163\x20\x61\x72\145\x20\x73\141\x76\x65\144\x20\x73\165\143\x63\145\x73\x73\x66\165\154\154\x79\x2e");
        $lT->mo_oauth_show_success_message();
        goto Po;
        Y3:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\124\x68\145\x72\145\x20\x77\141\163\x20\141\x6e\40\145\162\x72\157\162\40\x73\x61\x76\151\x6e\x67\40\x73\145\x74\164\151\156\x67\x73\x2e");
        $lT->mo_oauth_show_error_message();
        Po:
        wp_safe_redirect("\141\144\155\x69\156\x2e\x70\x68\160\77\160\x61\147\145\75\155\x6f\x5f\x6f\x61\165\164\x68\x5f\163\145\x74\x74\151\x6e\x67\163\x26\164\x61\x62\x3d\x63\157\156\146\151\x67\x26\x61\x63\164\151\x6f\x6e\75\165\x70\144\141\164\145\46\x61\160\160\x3d" . rawurlencode($Ig));
        QK:
        rY:
        do_action("\155\157\137\157\141\165\164\x68\137\x63\x6c\x69\x65\156\x74\137\x73\x61\166\145\137\141\x70\x70\137\x73\145\164\x74\x69\156\x67\x73\x5f\151\156\164\145\x72\156\x61\154");
    }
    public function change_app_settings($post, $Bs)
    {
        global $lT;
        $PB = '';
        $U0 = '';
        $Ts = '';
        $Ig = sanitize_text_field(wp_unslash(isset($post[\MoOAuthConstants::POST_APP_NAME]) ? $post[\MoOAuthConstants::POST_APP_NAME] : ''));
        if ("\145\166\x65\157\156\154\x69\156\145" === $Ig) {
            goto Ox;
        }
        $Rv = isset($post["\155\157\137\157\141\x75\164\150\137\144\x69\163\x63\x6f\166\145\162\x79"]) ? $post["\155\x6f\137\x6f\x61\165\x74\150\x5f\x64\x69\163\x63\157\166\145\162\x79"] : null;
        if (!empty($Rv)) {
            goto zL;
        }
        $PB = isset($post["\x6d\x6f\137\x6f\141\x75\x74\150\x5f\x61\x75\x74\x68\157\x72\x69\x7a\145\x75\x72\x6c"]) ? stripslashes($post["\155\157\137\x6f\141\165\x74\x68\x5f\x61\165\x74\x68\x6f\x72\151\172\x65\x75\162\x6c"]) : '';
        $U0 = isset($post["\155\157\137\x6f\x61\x75\164\150\137\141\x63\143\145\163\163\x74\157\153\x65\x6e\165\x72\154"]) ? stripslashes($post["\155\x6f\137\157\x61\x75\164\x68\x5f\141\x63\x63\145\163\x73\164\157\153\145\x6e\x75\162\154"]) : '';
        $Ts = isset($post["\x6d\157\x5f\157\141\x75\x74\150\x5f\162\145\x73\x6f\165\162\143\145\x6f\167\x6e\145\162\144\x65\164\141\151\154\163\165\x72\x6c"]) ? stripslashes($post["\155\x6f\137\157\x61\x75\164\150\x5f\162\145\163\x6f\165\162\143\x65\x6f\x77\x6e\145\162\x64\145\164\141\x69\x6c\x73\165\x72\154"]) : '';
        goto jh;
        zL:
        $Bs["\x65\170\151\x73\164\151\156\x67\137\141\160\x70\137\146\154\157\x77"] = true;
        if (isset($post["\155\x6f\x5f\x6f\141\x75\164\150\137\x70\162\157\x76\151\x64\145\162\137\144\157\x6d\141\x69\x6e"])) {
            goto DV;
        }
        if (!isset($post["\155\157\137\x6f\x61\x75\164\x68\x5f\160\162\157\166\151\x64\145\162\137\x74\145\156\x61\156\164"])) {
            goto P9;
        }
        $xY = stripslashes(trim($post["\155\157\x5f\x6f\141\165\x74\150\x5f\160\x72\157\166\151\x64\x65\162\x5f\164\145\156\x61\156\164"]));
        $Rv = str_replace("\164\x65\156\141\156\164", $xY, $Rv);
        $Bs["\x74\145\156\141\156\x74"] = $xY;
        P9:
        goto XM;
        DV:
        $eK = stripslashes(rtrim($post["\155\x6f\137\157\x61\165\164\x68\x5f\160\x72\x6f\166\x69\144\145\x72\x5f\x64\x6f\155\141\151\x6e"], "\x2f"));
        $Rv = str_replace("\144\x6f\x6d\141\x69\156", $eK, $Rv);
        $Bs["\144\157\x6d\141\151\156"] = $eK;
        XM:
        if (isset($post["\155\157\x5f\x6f\x61\165\164\150\137\160\162\x6f\x76\x69\x64\x65\162\x5f\x70\x6f\154\151\x63\171"])) {
            goto gs;
        }
        if (!isset($post["\155\x6f\137\x6f\141\165\x74\x68\x5f\160\162\157\x76\x69\144\x65\162\137\x72\145\x61\154\x6d"])) {
            goto DK;
        }
        $iC = stripslashes(trim($post["\x6d\x6f\137\x6f\141\x75\x74\x68\x5f\x70\x72\157\x76\x69\x64\x65\162\137\162\145\x61\154\155"]));
        $Rv = str_replace("\x72\x65\x61\x6c\x6d\156\141\x6d\145", $iC, $Rv);
        $Bs["\162\x65\141\154\155"] = $iC;
        DK:
        goto cA;
        gs:
        $bt = stripslashes(trim($post["\x6d\157\x5f\157\141\165\x74\x68\x5f\x70\162\x6f\166\151\x64\145\x72\x5f\160\157\154\151\143\171"]));
        $Rv = str_replace("\160\157\x6c\x69\143\171", $bt, $Rv);
        $Bs["\160\x6f\x6c\x69\143\x79"] = $bt;
        cA:
        $Lx = null;
        if (filter_var($Rv, FILTER_VALIDATE_URL)) {
            goto rs;
        }
        $Bs["\x69\163\x5f\144\151\163\x63\157\x76\x65\x72\x79\137\166\141\154\151\x64"] = "\146\141\154\163\145";
        goto st;
        rs:
        $lT->mo_oauth_client_update_option("\155\x6f\137\x6f\143\137\x76\x61\x6c\151\x64\x5f\144\x69\163\143\x6f\x76\x65\162\x79\x5f\145\x70", true);
        $LU = array("\x73\x73\x6c" => array("\166\145\162\x69\x66\x79\137\x70\x65\x65\162" => false, "\166\x65\x72\151\146\x79\x5f\x70\x65\x65\162\137\x6e\x61\155\145" => false));
        $VI = @file_get_contents($Rv, false, stream_context_create($LU));
        $Lx = array();
        if ($VI) {
            goto b0;
        }
        $Bs["\151\163\x5f\144\151\x73\143\157\x76\145\162\x79\x5f\166\141\x6c\x69\144"] = "\146\141\x6c\x73\145";
        goto Pd;
        b0:
        $Lx = json_decode($VI);
        $Bs["\151\x73\137\144\151\x73\143\x6f\x76\x65\162\171\137\x76\141\x6c\x69\144"] = "\x74\162\x75\145";
        Pd:
        $wW = isset($Lx->scopes_supported[0]) ? $Lx->scopes_supported[0] : '';
        $Yd = isset($Lx->scopes_supported[1]) ? $Lx->scopes_supported[1] : '';
        $Sr = stripslashes($wW) . "\40" . stripslashes($Yd);
        $Bs["\x64\x69\163\x63\157\166\x65\x72\171"] = $Rv;
        $Bs["\163\143\157\x70\x65"] = isset($us) && !empty($us) ? $us : $Sr;
        $PB = isset($Lx->authorization_endpoint) ? stripslashes($Lx->authorization_endpoint) : '';
        $U0 = isset($Lx->token_endpoint) ? stripslashes($Lx->token_endpoint) : '';
        $Ts = isset($Lx->userinfo_endpoint) ? stripslashes($Lx->userinfo_endpoint) : '';
        st:
        jh:
        goto NH;
        Ox:
        $lT->mo_oauth_client_update_option("\155\157\137\x6f\x61\x75\164\x68\137\145\x76\x65\157\156\x6c\x69\156\x65\x5f\x65\x6e\141\x62\x6c\145", 1);
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\x75\164\150\137\145\x76\x65\x6f\x6e\154\151\156\x65\x5f\x63\x6c\x69\145\x6e\x74\x5f\151\x64", $zb);
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\141\x75\164\150\137\x65\x76\x65\157\x6e\x6c\x69\156\x65\137\x63\154\x69\x65\156\164\137\163\x65\143\x72\x65\x74", $tN);
        if (!($lT->mo_oauth_client_get_option("\155\x6f\137\157\141\x75\x74\150\137\145\x76\145\x6f\x6e\154\x69\x6e\145\x5f\x63\x6c\151\145\156\164\137\x69\144") && $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\x75\164\x68\x5f\x65\166\145\157\x6e\154\x69\156\x65\137\x63\x6c\x69\x65\x6e\x74\137\x73\x65\x63\162\x65\x74"))) {
            goto Xt;
        }
        $HW = new Customer();
        $kv = $HW->add_oauth_application("\145\x76\145\x6f\x6e\154\x69\x6e\x65", "\x45\x56\x45\40\117\156\x6c\x69\x6e\145\x20\117\x41\165\x74\x68");
        if ("\x41\x70\160\154\x69\x63\x61\164\x69\157\x6e\40\103\x72\145\x61\x74\145\x64" === $kv) {
            goto oz;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $kv);
        $this->mo_oauth_show_error_message();
        goto Yn;
        oz:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\x6f\x75\162\x20\x73\x65\x74\164\x69\156\x67\163\40\167\145\x72\145\x20\163\x61\x76\145\144\56\x20\107\x6f\40\164\157\x20\x41\144\166\x61\156\143\145\x64\x20\105\126\105\x20\x4f\156\x6c\151\156\145\40\123\145\164\x74\x69\156\x67\163\40\146\x6f\x72\40\143\157\156\146\151\147\x75\x72\x69\x6e\x67\x20\162\145\x73\164\x72\x69\143\x74\151\x6f\x6e\163\x20\157\x6e\x20\x75\x73\x65\x72\x20\163\x69\147\x6e\40\x69\156\x2e");
        $this->mo_oauth_show_success_message();
        Yn:
        Xt:
        NH:
        isset($post["\x6d\157\137\157\x61\x75\164\x68\x5f\x73\x63\x6f\x70\x65"]) && !empty($post["\155\157\137\157\x61\x75\x74\150\137\x73\143\157\x70\x65"]) ? $Bs["\x73\143\x6f\x70\x65"] = sanitize_text_field(wp_unslash($post["\155\x6f\137\x6f\141\x75\164\150\137\x73\x63\157\x70\x65"])) : '';
        $Bs["\165\156\x69\161\165\x65\137\x61\160\160\151\x64"] = isset($post["\x6d\157\x5f\157\141\165\x74\150\137\143\x75\163\164\157\155\x5f\x61\160\160\x5f\x6e\141\x6d\x65"]) ? stripslashes($post["\155\x6f\137\157\141\165\x74\150\x5f\143\x75\x73\164\x6f\x6d\137\x61\x70\x70\x5f\156\x61\155\x65"]) : '';
        $Bs["\x63\x6c\x69\x65\x6e\x74\x5f\x69\144"] = $lT->mooauthencrypt(sanitize_text_field(wp_unslash(isset($post["\x6d\157\137\x6f\x61\x75\x74\x68\x5f\143\154\x69\145\156\164\137\x69\x64"]) ? $post["\155\157\x5f\x6f\141\165\164\150\137\x63\154\x69\145\x6e\x74\x5f\151\x64"] : '')));
        $Bs["\143\x6c\x69\x65\156\164\x5f\x73\x65\x63\x72\145\x74"] = $lT->mooauthencrypt(wp_unslash(isset($post["\155\157\137\157\x61\165\164\x68\x5f\x63\x6c\x69\x65\x6e\x74\137\x73\145\143\162\145\164"]) ? stripslashes(trim($post["\x6d\157\x5f\x6f\x61\x75\164\x68\137\x63\x6c\x69\145\156\x74\137\163\x65\x63\x72\x65\164"])) : ''));
        $Bs["\143\154\151\145\x6e\164\x5f\143\162\145\x64\163\x5f\145\x6e\x63\x72\x70\x79\164\x65\x64"] = true;
        $Bs["\x73\x65\x6e\144\x5f\150\x65\141\144\145\162\x73"] = isset($post["\x6d\x6f\137\157\141\165\x74\x68\137\x61\x75\164\x68\157\162\x69\172\141\x74\x69\x6f\156\137\x68\145\141\x64\145\162"]) ? (int) filter_var($post["\x6d\x6f\137\157\141\165\x74\150\137\141\165\x74\x68\157\162\x69\172\x61\x74\151\157\156\137\150\x65\x61\144\145\x72"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $Bs["\x73\145\156\144\137\x62\157\x64\171"] = isset($post["\155\157\x5f\157\x61\165\164\x68\x5f\x62\x6f\144\171"]) ? (int) filter_var($post["\155\x6f\137\x6f\x61\x75\164\150\x5f\x62\157\x64\171"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $Bs["\x73\x65\156\x64\x5f\x73\164\141\164\x65"] = isset($_POST["\155\157\137\157\141\x75\x74\x68\x5f\x73\x74\141\x74\x65"]) ? (int) filter_var($_POST["\155\157\x5f\157\x61\165\164\x68\137\163\164\x61\164\x65"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $Bs["\x73\x65\156\x64\x5f\156\157\x6e\x63\145"] = isset($_POST["\x6d\x6f\x5f\157\141\165\x74\150\x5f\x6e\157\156\x63\x65"]) ? (int) filter_var($_POST["\155\x6f\x5f\157\x61\x75\164\x68\137\x6e\x6f\156\x63\x65"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $Bs["\x73\x68\157\x77\x5f\157\x6e\x5f\154\x6f\147\x69\156\137\160\x61\x67\x65"] = isset($post["\155\157\x5f\157\x61\x75\x74\x68\x5f\163\x68\157\x77\137\x6f\156\x5f\x6c\157\x67\151\156\x5f\x70\141\x67\145"]) ? (int) filter_var($post["\x6d\x6f\137\x6f\141\165\164\x68\x5f\x73\150\x6f\167\x5f\x6f\x6e\x5f\154\157\x67\x69\x6e\137\160\x61\x67\x65"], FILTER_SANITIZE_NUMBER_INT) : 0;
        if (!(!empty($Bs["\141\160\160\137\x74\171\x70\145"]) && $Bs["\x61\x70\x70\137\x74\x79\x70\145"] === "\x6f\x61\x75\x74\150\x31")) {
            goto fc;
        }
        $Bs["\x72\x65\x71\x75\x65\x73\x74\165\162\154"] = isset($post["\155\157\x5f\x6f\141\x75\164\x68\137\x72\x65\161\165\145\163\164\x75\162\154"]) ? stripslashes($post["\155\x6f\x5f\x6f\141\x75\x74\150\137\162\x65\161\165\x65\163\164\x75\x72\x6c"]) : '';
        fc:
        if (isset($Bs["\141\x70\160\111\144"])) {
            goto pi;
        }
        $Bs["\x61\160\160\111\x64"] = $Ig;
        pi:
        $Bs["\162\145\x64\151\162\x65\143\164\137\165\x72\x69"] = sanitize_text_field(wp_unslash(isset($post["\x6d\157\137\x75\x70\x64\141\x74\145\137\165\162\154"]) ? $post["\x6d\x6f\x5f\x75\160\x64\x61\x74\x65\137\x75\x72\x6c"] : site_url()));
        $Bs["\x61\x75\164\150\157\162\x69\x7a\x65\165\162\x6c"] = $PB;
        $Bs["\141\143\143\x65\x73\163\164\x6f\153\x65\x6e\x75\162\x6c"] = $U0;
        $Bs["\141\x70\x70\137\x74\x79\160\x65"] = isset($post["\155\x6f\137\x6f\141\x75\164\x68\137\141\x70\x70\137\164\x79\160\145"]) ? stripslashes($post["\x6d\157\x5f\x6f\141\x75\164\150\137\141\160\x70\x5f\x74\x79\x70\x65"]) : stripslashes("\157\141\165\164\150");
        if (!($Bs["\x61\160\x70\137\x74\171\x70\145"] == "\157\141\165\164\x68" || $Bs["\x61\x70\160\x5f\164\171\x70\145"] == "\157\141\165\164\150\x31" || isset($post["\x6d\x6f\137\157\x61\165\164\x68\x5f\162\x65\x73\x6f\165\x72\143\x65\x6f\x77\x6e\x65\162\x64\145\164\x61\x69\x6c\163\165\162\x6c"]))) {
            goto cc;
        }
        $Bs["\x72\145\163\157\165\x72\x63\x65\157\x77\156\145\x72\x64\145\x74\141\x69\x6c\x73\165\162\154"] = $Ts;
        cc:
        return $Bs;
    }
    public function change_attribute_mapping($post, $Bs)
    {
        $jd = stripslashes($post["\155\157\137\157\141\165\x74\x68\x5f\165\x73\x65\x72\156\141\x6d\x65\137\x61\x74\x74\x72"]);
        $Bs["\x75\x73\145\x72\x6e\x61\155\145\137\141\164\164\x72"] = $jd;
        return $Bs;
    }
}
