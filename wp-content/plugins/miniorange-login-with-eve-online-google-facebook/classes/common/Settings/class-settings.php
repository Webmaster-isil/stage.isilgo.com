<?php


namespace MoOauthClient;

use MoOauthClient\Backup\BackupHandler;
use MoOauthClient\mc_utils;
use MoOauthClient\Customer;
use MoOauthClient\Config;
class Settings
{
    public $config;
    public $util;
    public function __construct()
    {
        global $lT;
        $this->util = $lT;
        add_action("\x61\x64\155\x69\x6e\x5f\x69\156\151\164", array($this, "\155\x69\x6e\x69\x6f\162\x61\156\147\x65\137\x6f\141\165\164\150\137\x73\141\x76\x65\x5f\163\145\x74\x74\x69\156\x67\163"));
        add_shortcode("\x6d\x6f\x5f\157\x61\165\x74\150\x5f\x6c\157\x67\151\x6e", array($this, "\x6d\157\x5f\x6f\141\165\x74\150\x5f\x73\x68\x6f\162\x74\x63\157\144\x65\x5f\154\157\x67\x69\156"));
        add_action("\x61\144\x6d\x69\156\x5f\x69\x6e\151\164", array($this, "\155\x6f\x5f\x6f\141\165\x74\150\137\144\x65\x62\165\x67\x5f\x6c\x6f\147\x5f\141\x6a\141\170\137\x68\x6f\157\x6b"));
        $this->config = $this->util->get_plugin_config();
    }
    function mo_oauth_debug_log_ajax_hook()
    {
        add_action("\167\160\137\x61\152\x61\x78\137\155\157\x5f\x6f\x61\165\164\x68\137\144\145\x62\165\x67\x5f\141\152\141\170", array($this, "\155\x6f\137\x6f\x61\x75\x74\150\137\x64\x65\142\165\147\x5f\154\157\x67\137\141\x6a\141\170"));
    }
    function mo_oauth_debug_log_ajax()
    {
        if (!isset($_POST["\x6d\x6f\x5f\x6f\x61\165\x74\150\137\156\157\x6e\x63\x65"]) || !wp_verify_nonce(sanitize_text_field($_POST["\x6d\x6f\x5f\x6f\x61\x75\x74\x68\137\156\157\x6e\143\145"]), "\x6d\157\55\x6f\x61\165\164\150\55\104\145\x62\x75\147\x2d\x6c\157\147\x73\x2d\165\156\x69\161\165\145\x2d\163\x74\162\151\156\147\x2d\x6e\x6f\156\143\145")) {
            goto p8;
        }
        switch (sanitize_text_field($_POST["\155\x6f\x5f\x6f\141\165\164\150\137\x6f\160\x74\151\157\x6e"])) {
            case "\155\x6f\x5f\157\x61\x75\164\x68\x5f\162\x65\163\x65\x74\137\x64\145\142\165\147":
                $this->mo_oauth_reset_debug();
                goto mq;
        }
        qC:
        mq:
        goto tW;
        p8:
        wp_send_json("\x65\x72\162\157\x72");
        tW:
    }
    public function mo_oauth_reset_debug()
    {
        global $lT;
        if (isset($_POST["\155\157\137\x6f\141\165\x74\x68\x5f\x6f\x70\164\151\157\x6e"]) and sanitize_text_field(wp_unslash($_POST["\155\157\x5f\157\141\165\x74\150\x5f\x6f\160\x74\x69\x6f\156"])) == "\155\157\137\x6f\141\165\x74\x68\x5f\162\x65\163\145\164\x5f\144\145\x62\x75\x67" && isset($_REQUEST["\x6d\x6f\137\x6f\x61\x75\x74\150\x5f\156\157\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST["\155\157\137\x6f\x61\165\164\x68\x5f\156\157\156\143\145"])), "\155\x6f\x2d\157\141\165\x74\x68\x2d\x44\x65\x62\x75\147\55\x6c\x6f\147\163\x2d\165\156\151\161\165\x65\55\163\164\x72\x69\156\147\x2d\156\x6f\156\x63\145")) {
            goto Tn;
        }
        echo "\x65\x72\x72\x6f\x72";
        goto IC;
        Tn:
        $xb = false;
        if (!isset($_POST["\155\157\137\x6f\141\165\164\150\137\x6d\157\137\x6f\x61\165\164\x68\137\x64\x65\x62\x75\x67\x5f\x63\x68\x65\x63\153"])) {
            goto v9;
        }
        $xb = sanitize_text_field($_POST["\x6d\157\137\x6f\141\165\164\x68\x5f\x6d\x6f\x5f\157\x61\x75\164\150\x5f\x64\145\142\x75\147\x5f\143\150\x65\143\153"]);
        v9:
        $p0 = current_time("\164\x69\155\x65\x73\164\141\155\160");
        $lT->mo_oauth_client_update_option("\155\x6f\137\x64\x65\142\x75\147\137\x65\156\x61\x62\154\145", $xb);
        if (!$lT->mo_oauth_client_get_option("\x6d\x6f\137\144\x65\x62\165\147\137\x65\156\141\x62\x6c\x65")) {
            goto hN;
        }
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\144\145\142\165\x67\x5f\x63\150\x65\143\153", 1);
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x64\x65\142\x75\147\137\164\x69\155\145", $p0);
        hN:
        if (!$lT->mo_oauth_client_get_option("\x6d\x6f\x5f\144\145\142\x75\147\x5f\145\x6e\141\142\154\x65")) {
            goto eA;
        }
        $lT->mo_oauth_client_update_option("\155\157\137\x6f\x61\x75\x74\150\x5f\x64\x65\142\x75\x67", "\x6d\157\137\157\x61\x75\x74\150\x5f\144\145\142\x75\147" . uniqid());
        $H9 = $lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\x75\164\150\137\x64\145\x62\165\147");
        $hl = dirname(__DIR__) . DIRECTORY_SEPARATOR . "\117\x41\165\164\150\x48\x61\156\x64\154\x65\162" . DIRECTORY_SEPARATOR . $H9 . "\x2e\x6c\x6f\x67";
        $JC = fopen($hl, "\167");
        chmod($hl, 0644);
        $lT->mo_oauth_client_update_option("\x6d\157\137\x64\145\x62\x75\x67\x5f\x63\150\145\x63\153", 1);
        MO_Oauth_Debug::mo_oauth_log('');
        $lT->mo_oauth_client_update_option("\155\157\137\x64\145\x62\165\147\137\x63\150\x65\x63\153", 0);
        eA:
        $AV = $lT->mo_oauth_client_get_option("\155\x6f\137\144\x65\x62\165\x67\x5f\x65\x6e\141\x62\x6c\145");
        $Qv["\163\167\x69\164\x63\150\137\163\164\x61\x74\x75\163"] = $AV;
        wp_send_json($Qv);
        IC:
    }
    public function miniorange_oauth_save_settings()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\x69\x73\x61\x62\x6c\145\x64";
        if (empty($zB["\x6d\x6f\x5f\x64\164\x65\137\x73\164\x61\x74\x65"])) {
            goto Sw;
        }
        $M9 = $lT->mooauthdecrypt($zB["\x6d\157\137\144\x74\x65\137\x73\x74\x61\164\145"]);
        Sw:
        if (!(isset($_POST["\143\x68\x61\x6e\147\145\x5f\155\151\156\151\157\x72\x61\156\147\145\x5f\156\x6f\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\143\x68\x61\x6e\147\x65\x5f\155\x69\x6e\151\157\162\x61\x6e\x67\145\137\156\x6f\156\x63\145"])), "\143\150\141\x6e\147\x65\x5f\155\x69\156\151\157\x72\x61\x6e\x67\145") && isset($_POST[\MoOAuthConstants::OPTION]) && "\143\150\141\156\x67\145\x5f\155\x69\156\x69\157\162\141\x6e\147\145" === $_POST[\MoOAuthConstants::OPTION])) {
            goto ql;
        }
        mo_oauth_deactivate();
        return;
        ql:
        if (!(isset($_POST["\x6d\x6f\x5f\x6f\x61\x75\x74\150\137\x65\156\141\x62\154\x65\137\144\145\142\x75\x67\x5f\144\x6f\x77\156\154\157\141\x64\137\x6e\x6f\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\141\x75\164\x68\137\x65\156\x61\142\x6c\x65\137\x64\145\142\x75\x67\x5f\x64\x6f\x77\x6e\154\157\x61\x64\x5f\156\157\x6e\143\x65"])), "\155\x6f\x5f\x6f\141\x75\x74\150\137\145\x6e\x61\x62\154\x65\137\x64\x65\142\x75\x67\137\x64\157\167\156\154\x6f\141\x64") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\157\137\x6f\x61\x75\164\x68\137\x65\156\x61\x62\x6c\x65\x5f\144\x65\142\165\x67\137\144\x6f\167\x6e\x6c\157\x61\144" === $_POST[\MoOAuthConstants::OPTION])) {
            goto P7;
        }
        $Iu = plugin_dir_path(__FILE__) . "\57\56\x2e\x2f\117\x41\x75\164\150\x48\141\156\144\154\x65\x72\x2f" . $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\x75\x74\150\137\144\x65\x62\165\x67") . "\x2e\x6c\157\x67";
        if (is_file($Iu)) {
            goto B9;
        }
        echo "\64\60\x34\40\106\x69\154\145\40\156\x6f\164\40\146\x6f\165\156\x64\41";
        exit;
        B9:
        $Qu = filesize($Iu);
        $ei = basename($Iu);
        $qq = strtolower(pathinfo($ei, PATHINFO_EXTENSION));
        $gj = "\141\160\160\154\151\x63\x61\164\x69\x6f\x6e\x2f\146\x6f\162\x63\x65\55\144\157\167\156\x6c\x6f\x61\x64";
        if (!ob_get_contents()) {
            goto Co;
        }
        ob_clean();
        Co:
        header("\x50\x72\x61\x67\155\141\72\x20\160\x75\142\x6c\151\143");
        header("\x45\170\x70\x69\162\x65\x73\x3a\40\60");
        header("\x43\x61\x63\150\x65\55\x43\x6f\x6e\x74\162\157\x6c\72\40\155\165\x73\164\55\162\x65\x76\x61\154\151\144\141\164\x65\54\x20\x70\157\163\164\x2d\x63\150\x65\143\x6b\75\60\54\40\160\162\x65\x2d\x63\150\x65\143\153\75\60");
        header("\x43\x61\143\150\145\x2d\103\157\156\x74\x72\x6f\x6c\x3a\x20\x70\165\142\154\x69\143");
        header("\x43\x6f\156\164\145\156\x74\x2d\x44\145\x73\x63\x72\x69\x70\x74\151\157\x6e\x3a\x20\x46\x69\154\x65\40\124\x72\x61\x6e\163\x66\145\x72");
        header("\x43\x6f\x6e\x74\145\156\x74\x2d\x54\171\160\x65\x3a\40{$gj}");
        $ZJ = "\103\x6f\x6e\x74\x65\156\164\x2d\104\x69\x73\x70\157\x73\x69\x74\151\x6f\x6e\72\x20\x61\x74\x74\x61\143\x68\x6d\145\x6e\164\x3b\x20\x66\x69\154\145\156\141\155\x65\75" . $ei . "\73";
        header($ZJ);
        header("\x43\x6f\x6e\164\145\156\x74\x2d\x54\x72\x61\156\x73\146\x65\x72\x2d\105\156\x63\x6f\x64\151\x6e\x67\x3a\x20\x62\x69\156\141\x72\x79");
        header("\103\x6f\156\164\x65\x6e\164\x2d\x4c\x65\156\147\164\150\72\x20" . $Qu);
        @readfile($Iu);
        exit;
        P7:
        if (!(isset($_POST["\155\x6f\x5f\x6f\141\x75\x74\150\x5f\x63\x6c\145\141\x72\x5f\154\157\147\137\156\157\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\x6f\141\x75\x74\150\137\143\154\x65\x61\162\x5f\x6c\157\147\137\156\x6f\156\143\x65"])), "\155\x6f\x5f\157\x61\x75\164\150\137\143\154\x65\x61\162\137\154\157\147") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\x61\165\164\x68\x5f\x63\x6c\145\x61\162\x5f\x6c\x6f\147" === $_POST[\MoOAuthConstants::OPTION])) {
            goto pb;
        }
        $Iu = plugin_dir_path(__FILE__) . "\x2f\56\56\57\117\101\x75\164\x68\110\141\x6e\x64\154\x65\162\x2f" . $lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\x75\x74\150\137\x64\145\142\x75\x67") . "\x2e\x6c\157\x67";
        if (is_file($Iu)) {
            goto DQ;
        }
        echo "\64\x30\x34\40\x46\151\x6c\145\40\156\x6f\164\40\146\157\165\156\x64\41";
        exit;
        DQ:
        file_put_contents($Iu, '');
        file_put_contents($Iu, "\x54\150\x69\x73\x20\x69\x73\x20\x74\150\x65\40\x6d\151\x6e\x69\117\162\141\156\x67\x65\x20\117\x41\x75\164\150\40\x70\154\165\x67\x69\x6e\x20\x44\145\142\x75\147\40\x4c\157\147\40\146\151\x6c\x65");
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\104\145\x62\x75\x67\x20\x4c\x6f\147\x73\x20\x63\154\145\141\x72\145\x64\40\x73\165\x63\x63\x65\x73\x73\146\x75\154\154\x79\56");
        $this->util->mo_oauth_show_success_message();
        pb:
        if (!(isset($_POST["\155\x6f\x5f\x6f\x61\x75\164\150\137\162\x65\x67\151\x73\x74\145\x72\137\x63\x75\x73\164\x6f\x6d\145\162\x5f\x6e\x6f\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\157\x61\x75\164\x68\x5f\162\145\147\151\x73\x74\x65\162\x5f\143\165\x73\164\x6f\x6d\145\162\x5f\x6e\157\x6e\143\x65"])), "\155\157\x5f\157\141\165\x74\150\137\162\145\147\151\x73\164\145\x72\x5f\143\165\x73\x74\x6f\155\145\x72") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\137\x6f\141\x75\x74\150\137\162\145\x67\151\163\x74\x65\x72\137\143\x75\163\x74\157\x6d\145\162" === $_POST[\MoOAuthConstants::OPTION])) {
            goto eO;
        }
        $q3 = '';
        $O8 = '';
        $W4 = '';
        $F2 = '';
        $AW = '';
        $GU = '';
        $bH = '';
        if (!($this->util->mo_oauth_check_empty_or_null($_POST["\145\x6d\141\151\x6c"]) || $this->util->mo_oauth_check_empty_or_null($_POST["\x70\x61\163\x73\167\157\x72\144"]) || $this->util->mo_oauth_check_empty_or_null($_POST["\143\x6f\x6e\x66\x69\162\x6d\x50\141\163\163\167\x6f\162\144"]))) {
            goto St;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x41\154\x6c\x20\164\150\145\x20\x66\151\145\154\144\x73\40\141\162\145\x20\162\145\161\165\151\x72\145\x64\x2e\40\x50\x6c\145\x61\163\x65\x20\x65\156\164\x65\162\40\166\x61\154\x69\x64\40\x65\156\164\x72\x69\145\x73\x2e");
        $this->util->mo_oauth_show_error_message();
        return;
        St:
        if (strlen($_POST["\160\141\163\163\167\157\x72\x64"]) < 8 || strlen($_POST["\143\157\156\146\151\x72\x6d\120\x61\x73\163\x77\157\162\x64"]) < 8) {
            goto xM;
        }
        $q3 = sanitize_email($_POST["\145\155\x61\151\154"]);
        $O8 = stripslashes($_POST["\x70\x68\157\156\x65"]);
        $W4 = stripslashes($_POST["\160\x61\163\163\x77\x6f\x72\144"]);
        $F2 = stripslashes($_POST["\x66\156\x61\x6d\145"]);
        $AW = stripslashes($_POST["\154\156\x61\155\x65"]);
        $GU = stripslashes($_POST["\x63\157\155\x70\x61\156\x79"]);
        $bH = stripslashes($_POST["\143\x6f\x6e\146\151\x72\155\120\141\163\163\x77\157\x72\x64"]);
        goto Ki;
        xM:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\103\x68\x6f\157\163\145\x20\x61\x20\160\141\x73\x73\x77\x6f\162\x64\40\x77\151\164\150\x20\155\x69\x6e\x69\155\165\155\x20\x6c\145\156\147\164\150\x20\70\x2e");
        $this->util->mo_oauth_show_error_message();
        return;
        Ki:
        $this->util->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\141\x75\x74\150\137\x61\144\155\151\x6e\x5f\x65\x6d\141\x69\x6c", $q3);
        $this->util->mo_oauth_client_update_option("\155\157\137\157\x61\x75\x74\x68\137\141\x64\155\151\156\137\x70\x68\x6f\x6e\x65", $O8);
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\141\x75\164\x68\x5f\x61\144\155\x69\156\137\x66\x6e\141\155\x65", $F2);
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\157\141\165\x74\150\137\141\144\x6d\151\156\x5f\x6c\x6e\141\155\145", $AW);
        $this->util->mo_oauth_client_update_option("\155\x6f\137\157\141\x75\x74\x68\137\x61\144\155\151\x6e\137\143\157\x6d\160\x61\x6e\171", $GU);
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto vz;
        }
        return $this->util->mo_oauth_show_curl_error();
        vz:
        if (strcmp($W4, $bH) === 0) {
            goto bl;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x61\163\x73\x77\x6f\162\144\x73\40\144\157\x20\x6e\157\x74\40\155\x61\164\x63\150\x2e");
        $this->util->mo_oauth_client_delete_option("\166\x65\162\x69\x66\x79\137\143\x75\163\164\x6f\155\x65\x72");
        $this->util->mo_oauth_show_error_message();
        goto c2;
        bl:
        $this->util->mo_oauth_client_update_option("\x70\141\163\163\x77\x6f\162\144", $W4);
        $HW = new Customer();
        $q3 = $this->util->mo_oauth_client_get_option("\155\x6f\x5f\157\141\x75\164\150\x5f\x61\x64\155\151\156\x5f\145\155\x61\151\154");
        $VI = json_decode($HW->check_customer(), true);
        if (strcasecmp($VI["\x73\x74\141\164\165\x73"], "\x43\x55\x53\124\117\115\x45\122\137\116\x4f\x54\x5f\106\x4f\x55\x4e\104") === 0) {
            goto qv;
        }
        $this->mo_oauth_get_current_customer();
        goto tx;
        qv:
        $this->create_customer();
        tx:
        c2:
        eO:
        if (!(isset($_POST["\x6d\157\137\x6f\141\165\x74\150\x5f\x76\x65\162\151\146\171\137\x63\165\163\x74\157\155\145\x72\137\156\157\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\x6f\141\x75\164\x68\137\x76\145\x72\x69\146\171\x5f\143\x75\163\x74\x6f\155\145\x72\x5f\156\x6f\x6e\x63\145"])), "\x6d\157\137\x6f\x61\165\x74\x68\x5f\166\145\162\151\x66\171\x5f\x63\x75\163\164\x6f\x6d\x65\x72") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\x5f\157\x61\165\x74\x68\137\166\x65\x72\151\x66\171\x5f\143\x75\163\x74\x6f\x6d\145\162" === $_POST[\MoOAuthConstants::OPTION])) {
            goto ZG;
        }
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto LU;
        }
        return $this->util->mo_oauth_show_curl_error();
        LU:
        $q3 = isset($_POST["\145\155\141\x69\x6c"]) ? sanitize_email(wp_unslash($_POST["\145\155\x61\151\x6c"])) : '';
        $W4 = isset($_POST["\x70\x61\163\163\x77\157\162\144"]) ? $_POST["\x70\141\x73\x73\x77\x6f\x72\144"] : '';
        if (!($this->util->mo_oauth_check_empty_or_null($q3) || $this->util->mo_oauth_check_empty_or_null($W4))) {
            goto T4;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x41\154\154\x20\164\x68\145\40\x66\151\x65\154\144\x73\x20\x61\162\x65\x20\162\x65\161\165\x69\162\145\x64\56\40\x50\154\x65\x61\163\x65\40\x65\156\164\x65\x72\40\x76\141\154\x69\144\x20\x65\156\x74\162\x69\x65\x73\56");
        $this->util->mo_oauth_show_error_message();
        return;
        T4:
        $this->util->mo_oauth_client_update_option("\155\x6f\137\x6f\141\x75\x74\150\137\141\144\x6d\x69\x6e\x5f\145\155\x61\x69\154", $q3);
        $this->util->mo_oauth_client_update_option("\160\141\x73\163\167\x6f\162\144", $W4);
        $HW = new Customer();
        $VI = $HW->get_customer_key();
        $Vo = json_decode($VI, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto OV;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\111\156\x76\x61\154\x69\144\x20\x75\x73\x65\162\x6e\141\x6d\145\x20\157\x72\40\x70\141\163\163\167\157\x72\x64\x2e\x20\x50\x6c\x65\x61\x73\145\40\164\162\171\x20\x61\x67\141\x69\156\x2e");
        $this->util->mo_oauth_show_error_message();
        goto xK;
        OV:
        $this->util->mo_oauth_client_update_option("\155\157\x5f\157\141\x75\164\x68\x5f\x61\144\155\151\x6e\x5f\x63\165\x73\x74\157\155\145\162\137\153\x65\171", $Vo["\x69\x64"]);
        $this->util->mo_oauth_client_update_option("\x6d\157\137\x6f\141\165\164\x68\137\141\144\155\151\156\x5f\x61\x70\x69\137\x6b\x65\171", $Vo["\x61\160\151\113\145\x79"]);
        $this->util->mo_oauth_client_update_option("\x63\x75\x73\x74\157\x6d\x65\162\137\x74\x6f\153\x65\x6e", $Vo["\x74\x6f\153\145\156"]);
        if (!isset($FM["\x70\x68\x6f\156\145"])) {
            goto uf;
        }
        $this->util->mo_oauth_client_update_option("\155\x6f\137\x6f\x61\x75\164\150\x5f\x61\x64\x6d\x69\x6e\x5f\160\x68\157\156\145", $Vo["\160\150\157\156\145"]);
        uf:
        $this->util->mo_oauth_client_delete_option("\160\141\163\163\167\x6f\162\x64");
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\103\165\x73\164\157\x6d\145\x72\x20\x72\145\x74\x72\x69\x65\x76\x65\x64\x20\x73\165\143\x63\x65\163\x73\146\x75\154\x6c\171");
        $this->util->mo_oauth_client_delete_option("\x76\145\162\151\x66\x79\x5f\x63\165\x73\x74\157\x6d\145\x72");
        $this->util->mo_oauth_show_success_message();
        xK:
        ZG:
        if (!(isset($_POST["\x6d\x6f\137\x6f\141\x75\x74\x68\x5f\x63\150\x61\x6e\x67\x65\x5f\145\x6d\141\151\154\137\156\157\x6e\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\x6f\x61\165\x74\150\137\x63\x68\141\x6e\x67\145\137\x65\x6d\x61\151\x6c\137\x6e\157\x6e\143\145"])), "\x6d\x6f\x5f\x6f\x61\165\x74\150\x5f\143\x68\x61\x6e\147\145\137\x65\155\141\x69\x6c") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\137\x6f\x61\x75\164\150\x5f\x63\150\141\156\147\x65\137\x65\x6d\141\151\154" === $_POST[\MoOAuthConstants::OPTION])) {
            goto S6;
        }
        $this->util->mo_oauth_client_update_option("\166\145\162\151\x66\x79\x5f\x63\x75\x73\x74\157\x6d\145\162", '');
        $this->util->mo_oauth_client_update_option("\155\x6f\137\x6f\141\165\164\150\137\162\145\x67\151\163\x74\162\x61\164\151\157\156\x5f\163\164\x61\164\165\x73", '');
        $this->util->mo_oauth_client_update_option("\156\x65\167\137\x72\145\x67\151\163\164\x72\x61\164\x69\157\156", "\164\x72\165\x65");
        S6:
        if (!(isset($_POST["\155\157\137\157\x61\x75\x74\x68\x5f\x63\x6f\x6e\x74\141\143\164\137\165\163\x5f\161\165\145\162\x79\137\x6f\x70\x74\x69\x6f\x6e\137\x6e\x6f\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\137\157\x61\x75\x74\x68\137\143\x6f\x6e\x74\x61\143\164\x5f\165\163\137\x71\x75\x65\x72\x79\x5f\x6f\x70\x74\x69\x6f\x6e\x5f\156\157\x6e\143\145"])), "\155\157\137\157\x61\165\x74\150\x5f\143\x6f\x6e\164\x61\x63\164\x5f\165\163\x5f\161\x75\x65\x72\x79\x5f\157\160\164\151\x6f\156") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\157\137\157\141\165\164\x68\137\143\157\156\x74\141\x63\164\x5f\165\163\x5f\x71\x75\x65\x72\171\137\x6f\160\x74\x69\x6f\156" === $_POST[\MoOAuthConstants::OPTION])) {
            goto HU;
        }
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto SD;
        }
        return $this->util->mo_oauth_show_curl_error();
        SD:
        $q3 = isset($_POST["\x6d\157\137\x6f\x61\165\164\x68\x5f\143\x6f\156\164\141\143\164\137\x75\x73\x5f\145\x6d\x61\151\x6c"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\x6f\x61\x75\164\150\x5f\143\x6f\156\164\141\143\x74\x5f\165\163\137\x65\155\141\x69\x6c"])) : '';
        $O8 = isset($_POST["\155\157\137\157\141\165\164\150\x5f\x63\x6f\156\x74\x61\x63\164\x5f\x75\163\137\x70\x68\157\x6e\x65"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\x61\165\164\150\x5f\x63\x6f\156\x74\141\143\x74\x5f\165\163\137\x70\x68\157\x6e\x65"])) : '';
        $Vz = isset($_POST["\x6d\x6f\x5f\x6f\x61\x75\164\x68\x5f\143\157\156\x74\x61\x63\x74\x5f\165\163\x5f\161\165\145\162\171"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\x6f\x61\165\x74\150\x5f\x63\157\156\164\x61\x63\x74\x5f\x75\x73\x5f\x71\165\145\x72\171"])) : '';
        $ay = isset($_POST["\x6d\157\x5f\157\x61\x75\x74\x68\137\x73\x65\156\144\137\x70\154\165\x67\151\156\x5f\x63\157\156\146\x69\147"]);
        $HW = new Customer();
        if ($this->util->mo_oauth_check_empty_or_null($q3) || $this->util->mo_oauth_check_empty_or_null($Vz)) {
            goto zb;
        }
        $gr = $HW->submit_contact_us($q3, $O8, $Vz, $ay);
        if (false === $gr) {
            goto Rt;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\124\150\141\156\x6b\163\40\x66\x6f\x72\x20\x67\145\x74\164\x69\156\147\40\x69\156\40\164\x6f\165\x63\x68\x21\x20\127\145\40\x73\150\x61\x6c\x6c\40\147\x65\164\x20\x62\141\x63\x6b\x20\164\157\40\171\157\x75\40\163\150\x6f\162\164\154\x79\x2e");
        $this->util->mo_oauth_show_success_message();
        goto Hz;
        Rt:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\x75\162\x20\161\165\145\x72\x79\40\143\x6f\165\x6c\x64\40\156\157\x74\x20\x62\x65\x20\163\x75\x62\155\151\164\x74\x65\144\56\x20\120\x6c\145\x61\163\x65\40\164\x72\x79\x20\141\147\x61\x69\x6e\56");
        $this->util->mo_oauth_show_error_message();
        Hz:
        goto QJ;
        zb:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x50\154\145\141\163\145\40\146\151\x6c\x6c\x20\165\x70\x20\x45\155\x61\x69\154\x20\141\x6e\x64\40\121\x75\145\162\x79\40\146\x69\145\x6c\x64\x73\x20\x74\x6f\40\163\x75\x62\155\151\x74\x20\x79\x6f\x75\162\40\x71\165\x65\162\171\x2e");
        $this->util->mo_oauth_show_error_message();
        QJ:
        HU:
        if (!(isset($_POST["\x6d\157\137\x6f\x61\x75\x74\x68\137\143\x6f\x6e\164\x61\x63\164\137\x75\x73\137\x71\x75\145\162\x79\x5f\x6f\160\164\x69\157\156\x5f\165\x70\147\x72\x61\144\x65\137\x6e\x6f\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x6f\141\x75\164\150\x5f\x63\157\x6e\164\141\x63\164\137\165\x73\x5f\x71\x75\x65\x72\x79\x5f\157\160\x74\151\x6f\x6e\x5f\165\x70\x67\x72\x61\144\x65\x5f\x6e\157\x6e\143\x65"])), "\155\x6f\x5f\x6f\x61\x75\x74\150\x5f\x63\x6f\156\164\x61\143\x74\x5f\x75\x73\x5f\x71\x75\x65\162\171\137\x6f\x70\x74\x69\x6f\x6e\137\x75\160\147\x72\x61\x64\x65") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\137\157\x61\165\x74\x68\x5f\143\x6f\156\x74\x61\143\164\x5f\x75\x73\x5f\161\x75\145\x72\x79\x5f\x6f\x70\164\x69\x6f\x6e\137\x75\160\147\x72\x61\x64\x65" === $_POST[\MoOAuthConstants::OPTION])) {
            goto ec;
        }
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto UV;
        }
        return $this->util->mo_oauth_show_curl_error();
        UV:
        $q3 = isset($_POST["\x6d\x6f\137\157\x61\165\164\150\x5f\143\157\x6e\164\141\x63\164\137\x75\163\x5f\145\x6d\x61\151\x6c"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\157\137\157\x61\165\164\150\137\143\x6f\156\x74\141\143\164\137\x75\163\137\145\x6d\x61\x69\154"])) : '';
        $nZ = isset($_POST["\155\x6f\x5f\x6f\x61\165\x74\150\137\143\165\x72\x72\x65\x6e\164\137\x76\x65\162\x73\151\x6f\156"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x6f\141\165\x74\150\x5f\143\x75\x72\162\x65\x6e\x74\137\x76\145\162\163\151\x6f\156"])) : '';
        $wU = isset($_POST["\x6d\157\x5f\157\141\x75\164\x68\137\165\x70\147\x72\141\144\x69\x6e\x67\137\164\157\137\x76\145\x72\x73\x69\x6f\x6e"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x6f\x61\x75\x74\x68\x5f\165\160\147\x72\141\x64\151\156\x67\137\x74\x6f\x5f\166\145\x72\x73\x69\x6f\156"])) : '';
        $iN = isset($_POST["\155\x6f\x5f\146\x65\x61\164\165\x72\x65\x73\137\x72\x65\161\165\x69\162\145\x64"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\x66\145\x61\x74\x75\162\145\x73\x5f\x72\x65\161\x75\x69\162\145\144"])) : '';
        $HW = new Customer();
        if ($this->util->mo_oauth_check_empty_or_null($q3)) {
            goto uX;
        }
        $gr = $HW->submit_contact_us_upgrade($q3, $nZ, $wU, $iN);
        if (false === $gr) {
            goto BB;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\124\150\141\x6e\153\x73\x20\146\157\162\x20\147\x65\x74\164\151\156\x67\40\151\156\x20\x74\x6f\165\x63\150\x21\x20\127\x65\40\163\150\141\154\x6c\40\147\145\x74\x20\x62\141\143\x6b\40\164\x6f\x20\x79\x6f\165\40\163\150\x6f\x72\164\x6c\x79\40\x77\x69\x74\150\x20\161\x75\157\164\141\164\x69\157\x6e");
        $this->util->mo_oauth_show_success_message();
        goto EE;
        BB:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\165\162\x20\161\x75\x65\162\171\40\143\157\x75\x6c\144\40\x6e\157\x74\40\142\145\x20\x73\165\x62\x6d\x69\x74\x74\x65\x64\56\40\x50\154\x65\141\163\145\x20\164\x72\171\40\x61\147\141\x69\x6e\56");
        $this->util->mo_oauth_show_error_message();
        EE:
        goto sU;
        uX:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x50\x6c\x65\x61\163\x65\x20\x66\151\x6c\x6c\x20\x75\160\40\105\x6d\x61\151\x6c\x20\146\x69\x65\154\144\x20\164\157\40\x73\165\x62\x6d\151\x74\40\x79\157\x75\162\x20\x71\165\145\162\x79\x2e");
        $this->util->mo_oauth_show_error_message();
        sU:
        ec:
        if (!($M9 == "\144\x69\x73\141\142\154\145\144")) {
            goto PM;
        }
        if (!(isset($_POST["\155\x6f\137\x6f\x61\x75\x74\x68\137\x72\x65\163\164\157\x72\x65\x5f\x62\x61\143\x6b\165\x70\x5f\156\157\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\x6f\x61\165\164\150\x5f\x72\x65\163\164\157\x72\x65\x5f\x62\x61\x63\153\165\160\x5f\156\157\156\x63\x65"])), "\x6d\x6f\x5f\157\141\x75\x74\x68\137\x72\x65\163\164\x6f\x72\145\x5f\x62\141\x63\153\x75\160") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\x61\165\164\150\137\x72\x65\163\164\x6f\162\x65\137\142\x61\x63\153\165\160" === $_POST[\MoOAuthConstants::OPTION])) {
            goto e0;
        }
        $WG = "\124\x68\x65\x72\x65\x20\167\141\x73\40\141\156\40\x65\162\x72\157\162\40\165\160\x6c\157\x61\x64\151\x6e\147\40\x74\150\x65\x20\x66\151\154\145";
        if (isset($_FILES["\x6d\x6f\x5f\157\141\x75\164\x68\137\x63\x6c\151\145\x6e\x74\137\142\141\143\153\x75\x70"])) {
            goto j8;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $WG);
        $this->util->mo_oauth_show_error_message();
        return;
        j8:
        if (!function_exists("\167\160\x5f\150\x61\156\x64\x6c\145\x5f\165\x70\x6c\x6f\141\x64")) {
            require_once ABSPATH . "\x77\x70\x2d\141\x64\155\151\x6e\x2f\x69\156\143\x6c\165\x64\x65\163\x2f\146\x69\154\x65\x2e\x70\150\x70";
        }
        $oF = $_FILES["\x6d\157\x5f\157\141\x75\x74\x68\x5f\x63\154\x69\x65\x6e\x74\137\142\x61\143\153\x75\x70"];
        if (!(!isset($oF["\145\x72\x72\x6f\x72"]) || is_array($oF["\145\x72\162\157\162"]) || UPLOAD_ERR_OK !== $oF["\x65\x72\162\157\x72"])) {
            goto bo;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $WG . "\72\x20" . json_encode($oF["\x65\x72\x72\x6f\162"], JSON_UNESCAPED_SLASHES));
        $this->util->mo_oauth_show_error_message();
        return;
        bo:
        $I0 = new \finfo(FILEINFO_MIME_TYPE);
        $Rs = array_search($I0->file($oF["\164\x6d\160\x5f\x6e\141\155\145"]), array("\164\145\x78\164" => "\164\x65\170\x74\x2f\x70\x6c\x61\x69\156", "\152\x73\x6f\156" => "\141\160\x70\x6c\151\x63\x61\164\x69\x6f\156\57\152\x73\x6f\x6e"), true);
        $ZV = explode("\56", $oF["\156\x61\x6d\145"]);
        $ZV = $ZV[count($ZV) - 1];
        if (!(false === $Rs || $ZV !== "\152\163\x6f\x6e")) {
            goto kw;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $WG . "\x3a\40\111\x6e\x76\141\x6c\x69\144\40\106\x69\x6c\145\40\x46\x6f\x72\x6d\141\x74\x2e");
        $this->util->mo_oauth_show_error_message();
        return;
        kw:
        $y1 = file_get_contents($oF["tmp_name"]);
        $zB = json_decode($y1, true);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto Wz;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $WG . "\x3a\x20\x49\x6e\x76\141\x6c\x69\x64\40\106\151\154\145\40\106\157\162\155\141\164\56");
        $this->util->mo_oauth_show_error_message();
        return;
        Wz:
        $Lr = BackupHandler::restore_settings($zB);
        if (!$Lr) {
            goto Cf;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x53\x65\164\164\x69\156\147\x73\40\x72\145\x73\164\157\162\x65\144\40\163\x75\143\143\145\x73\163\146\x75\x6c\x6c\171\x2e");
        $this->util->mo_oauth_show_success_message();
        return;
        Cf:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\x68\x65\x72\145\40\167\x61\x73\40\141\156\40\151\x73\x73\x75\x65\40\x77\x68\151\154\145\40\x72\145\163\164\x6f\162\151\156\147\40\x74\150\145\x20\143\157\x6e\146\151\147\x75\162\x61\164\151\x6f\x6e\x2e");
        $this->util->mo_oauth_show_error_message();
        return;
        e0:
        if (!(isset($_POST["\155\x6f\x5f\x6f\x61\x75\x74\x68\137\x64\157\x77\x6e\x6c\157\141\144\x5f\x62\141\x63\x6b\x75\x70\137\156\x6f\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\x61\x75\164\150\137\144\x6f\167\x6e\x6c\157\x61\144\x5f\142\x61\x63\153\165\160\x5f\156\x6f\x6e\x63\145"])), "\x6d\x6f\137\x6f\141\165\164\150\137\144\157\167\x6e\x6c\x6f\x61\144\x5f\x62\141\143\153\x75\x70") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\141\x75\164\x68\x5f\144\x6f\x77\x6e\154\x6f\141\144\x5f\142\141\143\153\x75\160" === $_POST[\MoOAuthConstants::OPTION])) {
            goto J0;
        }
        $YD = BackupHandler::get_backup_json();
        header("\103\x6f\x6e\164\145\x6e\x74\x2d\x54\x79\x70\x65\72\40\141\160\160\x6c\x69\143\x61\164\x69\157\x6e\57\152\163\157\156");
        header("\x43\x6f\x6e\x74\x65\x6e\164\55\x44\151\x73\x70\157\x73\x69\x74\151\157\156\72\40\141\x74\164\141\143\150\155\145\156\x74\73\x20\x66\x69\154\x65\156\141\155\x65\75\42\160\154\165\x67\151\x6e\x5f\x62\x61\143\x6b\x75\160\x2e\x6a\x73\157\156\x22");
        header("\x43\x6f\156\x74\145\156\164\55\114\145\x6e\x67\164\x68\72\40" . strlen($YD));
        header("\103\x6f\x6e\x6e\145\x63\x74\x69\x6f\156\72\x20\x63\154\x6f\163\145");
        echo $YD;
        exit;
        J0:
        PM:
        do_action("\x64\157\137\155\141\151\156\137\163\x65\x74\x74\151\156\x67\x73\x5f\151\156\164\145\162\x6e\x61\154", $_POST);
    }
    public function mo_oauth_get_current_customer()
    {
        $HW = new Customer();
        $VI = $HW->get_customer_key();
        $Vo = json_decode($VI, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto B6;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\165\40\141\x6c\162\x65\141\x64\x79\x20\x68\x61\x76\145\x20\x61\156\40\x61\x63\143\x6f\x75\156\x74\40\167\151\x74\150\40\155\x69\156\151\117\162\x61\x6e\x67\x65\x2e\40\x50\154\x65\141\163\x65\40\145\x6e\x74\145\x72\x20\x61\x20\x76\x61\x6c\151\x64\x20\160\141\163\163\167\157\162\x64\56");
        $this->util->mo_oauth_client_update_option("\x76\x65\x72\151\x66\x79\137\x63\165\163\x74\x6f\x6d\x65\162", "\164\162\165\145");
        $this->util->mo_oauth_show_error_message();
        goto r2;
        B6:
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\164\x68\137\141\144\x6d\151\x6e\137\x63\165\163\x74\157\x6d\x65\162\x5f\x6b\x65\171", $Vo["\151\x64"]);
        $this->util->mo_oauth_client_update_option("\155\x6f\x5f\157\141\165\164\x68\137\141\144\x6d\151\x6e\137\x61\x70\x69\x5f\153\x65\x79", $Vo["\141\x70\x69\113\x65\171"]);
        $this->util->mo_oauth_client_update_option("\x63\x75\163\164\157\x6d\x65\162\137\164\157\x6b\x65\x6e", $Vo["\164\157\153\145\156"]);
        $this->util->mo_oauth_client_update_option("\160\141\163\x73\167\157\162\144", '');
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\103\x75\x73\x74\x6f\155\145\162\x20\162\x65\164\x72\151\145\166\145\144\40\x73\165\x63\x63\145\163\x73\146\165\154\x6c\x79");
        $this->util->mo_oauth_client_delete_option("\x76\145\x72\151\x66\171\137\143\x75\163\x74\x6f\x6d\145\162");
        $this->util->mo_oauth_client_delete_option("\156\145\167\x5f\162\145\x67\x69\163\x74\162\141\164\151\x6f\x6e");
        $this->util->mo_oauth_show_success_message();
        r2:
    }
    public function create_customer()
    {
        global $lT;
        $HW = new Customer();
        $Vo = json_decode($HW->create_customer(), true);
        if (strcasecmp($Vo["\163\164\141\x74\165\163"], "\103\125\123\124\117\x4d\x45\122\137\125\x53\x45\122\116\x41\115\105\x5f\x41\114\x52\x45\x41\x44\131\x5f\x45\130\x49\x53\124\x53") === 0) {
            goto r4;
        }
        if (strcasecmp($Vo["\163\x74\x61\164\165\163"], "\123\x55\103\103\105\123\123") === 0) {
            goto jR;
        }
        goto JE;
        r4:
        $this->mo_oauth_get_current_customer();
        $this->util->mo_oauth_client_delete_option("\155\x6f\137\x6f\141\165\164\150\137\x6e\x65\167\x5f\x63\165\163\164\157\155\x65\162");
        goto JE;
        jR:
        $this->util->mo_oauth_client_update_option("\x6d\157\137\157\141\165\164\150\x5f\x61\144\155\x69\156\137\143\x75\163\164\x6f\x6d\x65\162\137\x6b\145\171", $Vo["\151\x64"]);
        $this->util->mo_oauth_client_update_option("\155\x6f\x5f\x6f\x61\x75\164\150\x5f\x61\x64\155\x69\x6e\x5f\x61\160\151\137\153\x65\x79", $Vo["\x61\x70\x69\113\x65\171"]);
        $this->util->mo_oauth_client_update_option("\x63\x75\163\164\157\x6d\x65\162\x5f\x74\x6f\x6b\x65\156", $Vo["\x74\157\x6b\x65\x6e"]);
        $this->util->mo_oauth_client_update_option("\x70\x61\x73\163\x77\157\162\x64", '');
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\122\145\x67\151\x73\164\x65\x72\x65\144\x20\x73\165\x63\143\x65\163\x73\x66\165\x6c\x6c\171\x2e");
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\x74\150\137\x72\x65\147\x69\163\x74\162\141\x74\x69\157\x6e\137\163\164\141\164\165\163", "\x4d\x4f\137\117\x41\x55\x54\110\x5f\x52\x45\x47\x49\123\124\122\101\x54\111\x4f\x4e\x5f\x43\117\115\120\x4c\105\x54\x45");
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\141\165\x74\x68\x5f\156\145\x77\137\x63\165\163\x74\x6f\x6d\145\x72", 1);
        $this->util->mo_oauth_client_delete_option("\166\x65\162\x69\146\171\137\x63\165\163\x74\x6f\155\x65\162");
        $this->util->mo_oauth_client_delete_option("\x6e\145\167\x5f\162\x65\x67\151\163\x74\162\x61\x74\151\x6f\156");
        $this->util->mo_oauth_show_success_message();
        JE:
    }
}
