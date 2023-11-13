<?php


namespace MoOauthClient\Premium;

use MoOauthClient\App;
use MoOauthClient\Standard\AppSettings as StandardAppSettings;
class AppSettings extends StandardAppSettings
{
    public function __construct()
    {
        parent::__construct();
        add_action("\155\157\x5f\157\x61\165\164\150\137\x63\x6c\151\x65\x6e\x74\137\163\x61\166\x65\137\141\x70\x70\137\163\x65\x74\164\151\x6e\x67\x73\137\x69\156\164\x65\x72\156\141\154", array($this, "\163\x61\166\145\137\162\157\154\x65\x5f\155\141\x70\x70\151\x6e\147"));
    }
    public function change_app_settings($post, $Bs)
    {
        global $lT;
        $Bs = parent::change_app_settings($post, $Bs);
        $Bs["\147\162\157\165\160\144\145\x74\141\151\x6c\163\x75\162\154"] = isset($post["\155\157\x5f\157\x61\165\164\x68\x5f\x67\x72\x6f\165\x70\x64\145\164\x61\151\x6c\163\x75\162\154"]) ? trim(stripslashes($post["\155\157\x5f\x6f\141\165\x74\x68\137\x67\162\x6f\165\160\x64\x65\x74\x61\151\x6c\163\x75\162\x6c"])) : '';
        $Bs["\147\x72\x61\x6e\x74\137\x74\x79\160\x65"] = isset($post["\x67\x72\141\156\164\x5f\164\x79\160\145"]) ? stripslashes($post["\147\162\141\x6e\x74\137\164\171\x70\x65"]) : "\101\165\164\x68\157\x72\x69\172\141\164\151\x6f\x6e\40\103\157\x64\x65\x20\x47\162\x61\x6e\x74";
        if (isset($post["\145\x6e\141\x62\x6c\145\137\157\141\x75\164\x68\x5f\167\160\137\154\157\147\x69\x6e"]) && "\x6f\x6e" === $post["\145\x6e\141\x62\154\145\137\157\x61\x75\164\150\x5f\x77\160\137\154\x6f\x67\x69\x6e"]) {
            goto uN;
        }
        $lT->mo_oauth_client_delete_option("\155\x6f\x5f\157\141\165\x74\x68\137\145\156\141\142\154\x65\137\x6f\x61\165\164\150\x5f\x77\160\137\154\157\x67\x69\x6e");
        goto aw;
        uN:
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\164\x68\x5f\x65\x6e\141\142\x6c\x65\137\x6f\141\165\164\150\x5f\x77\x70\x5f\x6c\157\147\x69\156", $_GET["\141\x70\x70"]);
        aw:
        return $Bs;
    }
    public function save_advanced_grant_settings()
    {
        if (!(!isset($_POST["\x6d\x6f\x5f\x6f\141\x75\x74\150\137\x67\162\141\156\164\x5f\x73\x65\x74\164\151\156\147\x73\x5f\156\157\156\x63\145"]) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\157\141\165\164\x68\x5f\147\x72\141\156\164\137\163\x65\164\x74\151\x6e\x67\x73\x5f\x6e\x6f\x6e\143\145"])), "\x6d\x6f\137\157\141\x75\x74\x68\x5f\x67\x72\141\x6e\x74\137\163\x65\x74\x74\151\156\147\x73"))) {
            goto hP;
        }
        return;
        hP:
        $post = $_POST;
        if (!(!isset($post[\MoOAuthConstants::OPTION]) || "\x6d\157\137\157\141\x75\164\x68\137\x67\x72\141\156\x74\137\x73\x65\164\x74\x69\x6e\x67\x73" !== $post[\MoOAuthConstants::OPTION])) {
            goto OH;
        }
        return;
        OH:
        if (!(!isset($post[\MoOAuthConstants::POST_APP_NAME]) || empty($post[\MoOAuthConstants::POST_APP_NAME]))) {
            goto C5;
        }
        return;
        C5:
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\x64\x69\x73\141\x62\154\x65\x64";
        if (empty($zB["\x6d\157\x5f\144\164\x65\x5f\x73\x74\x61\164\145"])) {
            goto ld;
        }
        $M9 = $lT->mooauthdecrypt($zB["\x6d\x6f\x5f\144\164\x65\x5f\x73\164\141\164\145"]);
        ld:
        if (!($M9 == "\x64\x69\x73\x61\142\x6c\x65\x64")) {
            goto jf;
        }
        $Or = $post[\MoOAuthConstants::POST_APP_NAME];
        $Bs = $lT->get_app_by_name($Or);
        $Bs = $Bs->get_app_config('', false);
        $Bs = $this->save_grant_settings($post, $Bs);
        $lT->set_app_by_name($Or, $Bs);
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\157\x75\x72\x20\123\145\x74\x74\151\156\147\x73\40\150\x61\166\145\x20\142\145\x65\156\x20\x73\x61\166\x65\x64\40\x73\x75\143\x63\145\163\163\146\165\x6c\154\171\56");
        $lT->mo_oauth_show_success_message();
        wp_safe_redirect("\x61\x64\x6d\x69\156\x2e\160\x68\160\x3f\160\141\x67\145\75\x6d\x6f\137\x6f\141\x75\x74\x68\x5f\x73\145\x74\164\151\156\147\163\x26\x61\x63\x74\x69\157\156\x3d\165\x70\x64\x61\164\145\x26\x61\160\160\75" . rawurlencode($Or));
        jf:
    }
    public function save_grant_settings($post, $Bs)
    {
        global $lT;
        $Bs["\x6d\157\137\x6f\141\165\x74\150\x5f\162\145\163\160\157\x6e\x73\145\137\164\171\160\x65"] = isset($post["\x6d\x6f\137\157\x61\165\164\150\x5f\162\x65\x73\x70\157\x6e\x73\x65\137\x74\171\160\145"]) ? stripslashes($post["\x6d\157\137\157\141\x75\x74\x68\x5f\x72\x65\163\x70\x6f\156\x73\x65\137\164\x79\x70\145"]) : '';
        $Bs["\x6a\167\164\137\163\x75\x70\160\157\x72\164"] = isset($post["\152\x77\x74\x5f\x73\165\160\x70\157\x72\164"]) ? 1 : 0;
        $Bs["\162\x73\141\x5f\143\x65\162\164\x5f\164\171\160\145"] = isset($post["\x72\x73\141\x5f\x63\145\162\164\x5f\x74\x79\x70\x65"]) ? stripslashes($post["\x72\x73\x61\x5f\143\145\162\x74\137\x74\171\x70\x65"]) : "\x4a\x57\113\123";
        $Bs["\x6a\x77\x74\137\141\154\147\157"] = isset($post["\x6a\167\164\137\x61\x6c\147\157"]) ? stripslashes($post["\152\167\x74\x5f\141\x6c\x67\157"]) : "\110\123\101";
        if ("\x52\123\x41" === $Bs["\x6a\167\x74\x5f\x61\x6c\x67\x6f"] && "\x4a\x57\113\x53" === $Bs["\x72\x73\x61\x5f\x63\145\x72\x74\137\164\x79\x70\145"]) {
            goto OA;
        }
        if ("\x52\123\101" === $Bs["\x6a\167\164\x5f\141\154\x67\157"] && "\x58\65\60\71" === $Bs["\x72\x73\x61\x5f\143\x65\162\164\x5f\x74\x79\x70\145"]) {
            goto so;
        }
        if (!(isset($Bs["\x78\x35\60\71\137\143\x65\162\164"]) || isset($Bs["\152\167\153\163\165\162\x6c"]))) {
            goto aN;
        }
        unset($Bs["\170\x35\x30\x39\x5f\x63\x65\162\164"]);
        unset($Bs["\152\x77\153\x73\x75\x72\x6c"]);
        aN:
        goto fZ;
        so:
        $Bs["\x78\x35\x30\x39\x5f\143\145\162\x74"] = isset($post["\155\x6f\137\157\141\165\164\x68\x5f\170\65\60\x39\x5f\x63\145\162\x74"]) ? stripslashes($post["\155\x6f\137\x6f\141\x75\164\150\x5f\170\65\60\x39\137\143\145\162\x74"]) : '';
        unset($Bs["\x6a\167\x6b\x73\x75\162\x6c"]);
        fZ:
        goto Ja;
        OA:
        $Bs["\152\x77\153\163\x75\162\x6c"] = isset($post["\x6d\157\x5f\157\141\165\164\x68\137\152\x77\x6b\163\165\x72\x6c"]) ? trim(stripslashes($post["\155\157\137\157\x61\x75\164\x68\x5f\x6a\167\x6b\163\x75\x72\154"])) : '';
        unset($Bs["\170\x35\x30\71\137\143\145\x72\x74"]);
        Ja:
        return $Bs;
    }
    public function change_attribute_mapping($post, $Bs)
    {
        $Bs = parent::change_attribute_mapping($post, $Bs);
        $bv = array();
        $Ga = 0;
        foreach ($post as $HH => $W7) {
            if (!(strpos($HH, "\x6d\157\137\157\141\165\x74\150\137\143\154\151\145\x6e\x74\137\x63\x75\163\x74\x6f\155\137\141\x74\x74\x72\151\x62\x75\164\x65\137\153\145\x79") !== false && !empty($post[$HH]))) {
                goto XP;
            }
            $ng = strrpos($HH, "\137", -1);
            $Ga = substr($HH, $ng + 1);
            $vr = "\x6d\x6f\x5f\x6f\141\165\164\x68\137\x63\x6c\x69\145\156\164\x5f\x63\x75\x73\164\157\155\137\141\x74\x74\x72\151\x62\x75\x74\x65\137\x76\141\x6c\x75\x65\x5f" . $Ga;
            if (!($post[$vr] == '')) {
                goto np;
            }
            goto ZN;
            np:
            $bv[$W7] = trim(stripslashes($post[$vr]));
            XP:
            ZN:
        }
        JA:
        $Bs["\x63\165\x73\164\157\x6d\x5f\141\x74\x74\162\163\137\155\141\x70\x70\x69\156\x67"] = $bv;
        return $Bs;
    }
    public function save_role_mapping()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\151\x73\x61\x62\154\x65\144";
        if (empty($zB["\x6d\x6f\x5f\144\164\x65\x5f\x73\x74\x61\164\x65"])) {
            goto Y4;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\157\137\144\164\145\x5f\x73\164\141\164\x65"]);
        Y4:
        if (!($M9 == "\x64\x69\163\141\142\154\x65\x64")) {
            goto F2;
        }
        if (!(isset($_POST["\x6d\x6f\137\157\141\x75\164\150\137\x63\x6c\151\145\x6e\x74\x5f\x73\141\166\145\x5f\162\157\154\x65\x5f\x6d\141\160\x70\x69\x6e\147\137\156\157\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\x61\x75\164\150\137\x63\x6c\x69\x65\156\164\137\163\x61\x76\x65\x5f\x72\157\154\x65\x5f\155\141\160\160\x69\156\147\137\x6e\157\x6e\143\x65"])), "\x6d\x6f\137\157\x61\x75\164\x68\x5f\x63\x6c\x69\x65\x6e\x74\137\x73\x61\166\x65\x5f\x72\x6f\x6c\x65\x5f\x6d\x61\160\x70\x69\x6e\x67") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\x6f\x5f\157\141\165\x74\150\137\143\154\x69\x65\156\164\x5f\163\x61\x76\145\x5f\x72\x6f\154\x65\x5f\x6d\141\160\160\x69\x6e\x67" === $_POST[\MoOAuthConstants::OPTION])) {
            goto OQ;
        }
        $Ig = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::POST_APP_NAME]) ? $_POST[\MoOAuthConstants::POST_APP_NAME] : ''));
        $kp = $lT->get_app_by_name($Ig);
        $FK = $kp->get_app_config('', false);
        $FK["\x72\x65\163\x74\162\151\x63\x74\x5f\154\x6f\x67\x69\x6e\137\146\x6f\x72\137\x6d\141\x70\160\145\x64\137\x72\x6f\154\145\x73"] = isset($_POST["\162\145\163\x74\x72\x69\x63\x74\x5f\x6c\157\147\x69\156\x5f\146\157\162\137\x6d\x61\160\160\145\144\137\162\x6f\154\145\x73"]) ? sanitize_text_field(wp_unslash($_POST["\162\x65\163\164\x72\x69\x63\x74\137\x6c\x6f\x67\x69\x6e\137\x66\157\x72\x5f\x6d\x61\160\160\x65\144\x5f\162\x6f\x6c\145\163"])) : false;
        $FK["\145\170\x74\162\141\x63\x74\137\145\155\141\151\x6c\137\144\157\x6d\x61\151\x6e\x5f\146\157\162\x5f\162\157\154\145\155\141\x70\x70\151\x6e\147"] = isset($_POST["\x65\x78\x74\162\141\x63\x74\137\145\155\141\x69\154\137\x64\157\x6d\141\151\156\137\x66\x6f\x72\x5f\x72\157\154\x65\155\x61\160\160\x69\x6e\147"]) ? sanitize_text_field(wp_unslash($_POST["\145\170\x74\x72\141\x63\164\x5f\x65\x6d\x61\x69\x6c\x5f\144\x6f\x6d\x61\x69\x6e\137\x66\x6f\162\137\x72\157\x6c\x65\155\x61\160\x70\151\x6e\x67"])) : false;
        $FK["\147\x72\x6f\x75\160\156\141\x6d\x65\x5f\141\x74\x74\x72\x69\x62\x75\x74\145"] = isset($_POST["\x6d\141\160\x70\151\x6e\147\137\147\x72\x6f\165\160\x6e\141\155\x65\137\141\164\164\162\x69\x62\165\164\x65"]) ? trim(stripslashes($_POST["\155\x61\x70\x70\151\156\147\x5f\x67\162\x6f\x75\x70\156\x61\155\x65\137\x61\x74\x74\162\x69\x62\x75\164\x65"])) : '';
        $KR = 100;
        $lj = 0;
        $qf = [];
        if (!isset($_POST["\155\x61\x70\160\x69\x6e\x67\137\x6b\x65\171\x5f"])) {
            goto b4;
        }
        $qf = array_map("\163\141\x6e\x69\x74\x69\172\x65\137\x74\145\170\x74\137\146\151\x65\x6c\144", wp_unslash($_POST["\x6d\141\x70\160\151\156\x67\137\x6b\x65\x79\x5f"]));
        b4:
        $s7 = count($qf);
        $m_ = 1;
        $fw = 1;
        jN:
        if (!($fw <= $s7)) {
            goto o7;
        }
        if (isset($_POST["\x6d\x61\x70\160\151\x6e\147\137\153\145\171\137"][$m_])) {
            goto oZ;
        }
        AH:
        if (!($m_ < 100)) {
            goto b5;
        }
        if (!isset($_POST["\x6d\141\x70\160\151\156\x67\x5f\x6b\145\171\137"][$m_])) {
            goto z9;
        }
        if (!('' === $_POST["\155\x61\160\160\151\x6e\147\137\153\x65\171\x5f"][$m_]["\x76\141\x6c\165\145"])) {
            goto hm;
        }
        $m_++;
        goto AH;
        hm:
        $FK["\137\155\141\160\160\151\x6e\147\137\153\x65\171\137" . $fw] = sanitize_text_field(wp_unslash(isset($_POST["\x6d\141\x70\x70\x69\156\x67\x5f\153\145\x79\x5f"][$m_]) ? $_POST["\x6d\141\x70\x70\151\156\147\x5f\153\x65\171\137"][$m_]["\x76\x61\x6c\x75\145"] : ''));
        $FK["\137\155\141\160\160\x69\156\x67\137\x76\x61\154\x75\x65\137" . $fw] = sanitize_text_field(wp_unslash(isset($_POST["\155\x61\x70\160\x69\x6e\147\x5f\x6b\145\171\137"][$m_]) ? $_POST["\155\141\160\160\151\156\147\137\153\145\x79\x5f"][$m_]["\162\157\154\x65"] : ''));
        $lj++;
        $m_++;
        goto b5;
        z9:
        $m_++;
        goto AH;
        b5:
        goto s9;
        oZ:
        if (!('' === $_POST["\x6d\x61\x70\160\x69\x6e\x67\137\153\145\x79\x5f"][$m_]["\166\x61\154\x75\x65"])) {
            goto RP;
        }
        $m_++;
        goto IO;
        RP:
        $FK["\137\155\x61\x70\x70\x69\156\x67\137\x6b\x65\171\137" . $fw] = sanitize_text_field(wp_unslash(isset($_POST["\155\x61\x70\160\151\156\147\x5f\153\145\171\137"][$m_]) ? $_POST["\x6d\141\x70\x70\151\156\147\x5f\x6b\x65\171\x5f"][$m_]["\x76\x61\154\x75\x65"] : ''));
        $FK["\137\x6d\x61\160\160\151\156\x67\137\166\x61\x6c\x75\x65\137" . $fw] = sanitize_text_field(wp_unslash(isset($_POST["\x6d\x61\160\160\x69\x6e\147\x5f\x6b\145\171\137"][$m_]) ? $_POST["\155\x61\160\160\x69\156\x67\137\x6b\145\171\x5f"][$m_]["\162\x6f\x6c\145"] : ''));
        $m_++;
        $lj++;
        s9:
        IO:
        $fw++;
        goto jN;
        o7:
        $FK["\x72\x6f\x6c\145\137\155\141\160\x70\151\156\x67\137\x63\x6f\x75\156\x74"] = $lj;
        $oR = $lT->set_app_by_name($Ig, $FK);
        if (!$oR) {
            goto hS;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\162\x20\163\x65\164\164\x69\156\x67\x73\x20\141\162\x65\x20\x73\141\x76\145\144\x20\x73\165\x63\143\x65\163\163\x66\x75\x6c\x6c\x79\56");
        $lT->mo_oauth_show_success_message();
        goto iz;
        hS:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\150\x65\162\x65\x20\x77\x61\163\40\x61\156\x20\x65\162\162\157\x72\x20\163\141\166\x69\156\147\40\x73\x65\x74\x74\151\156\147\163\56");
        $lT->mo_oauth_show_error_message();
        iz:
        wp_safe_redirect("\141\144\155\151\x6e\x2e\160\150\x70\77\x70\141\147\x65\75\x6d\x6f\x5f\157\x61\165\x74\x68\x5f\x73\x65\x74\x74\151\156\147\163\46\x74\141\142\x3d\143\157\156\x66\x69\147\46\x61\x63\x74\x69\x6f\156\75\x75\160\x64\141\164\x65\x26\x61\x70\x70\x3d" . rawurlencode($Ig));
        OQ:
        F2:
    }
}
