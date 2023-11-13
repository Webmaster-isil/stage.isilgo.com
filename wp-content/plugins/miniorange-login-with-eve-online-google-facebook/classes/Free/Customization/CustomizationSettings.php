<?php


namespace MoOauthClient\Free;

class CustomizationSettings
{
    public function save_customization_settings()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\151\163\x61\x62\x6c\145\144";
        if (empty($zB["\155\157\x5f\144\x74\x65\x5f\x73\164\141\x74\145"])) {
            goto Oa;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\x6f\137\144\164\x65\x5f\x73\x74\x61\x74\145"]);
        Oa:
        if (!($M9 == "\x64\151\163\x61\142\154\145\x64")) {
            goto BU;
        }
        if (!(isset($_POST["\155\x6f\x5f\157\141\165\164\150\x5f\141\160\160\x5f\x63\x75\x73\164\x6f\155\x69\x7a\141\164\x69\157\x6e\x5f\156\x6f\x6e\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\x6f\141\x75\x74\x68\137\x61\x70\160\x5f\x63\x75\163\x74\x6f\155\151\172\x61\164\x69\157\156\137\156\157\x6e\143\x65"])), "\155\x6f\x5f\x6f\x61\x75\164\150\137\x61\x70\x70\137\x63\x75\x73\164\157\155\x69\x7a\141\164\x69\157\156") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\157\141\x75\164\x68\137\141\160\160\x5f\x63\165\x73\164\157\x6d\151\x7a\141\x74\x69\157\x6e" === $_POST[\MoOAuthConstants::OPTION])) {
            goto qD;
        }
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x6f\141\165\x74\x68\x5f\151\143\x6f\156\137\x74\x68\x65\155\x65", stripslashes($_POST["\155\157\x5f\157\141\165\x74\x68\137\151\143\x6f\x6e\137\x74\x68\x65\155\145"]));
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\141\x75\164\150\x5f\x69\x63\x6f\x6e\x5f\163\150\x61\160\x65", stripslashes($_POST["\x6d\x6f\137\x6f\141\x75\x74\x68\137\151\143\x6f\156\x5f\x73\x68\141\160\145"]));
        isset($_POST["\155\157\x5f\157\141\x75\x74\150\x5f\151\x63\157\156\137\x65\146\146\145\143\x74\137\x73\143\141\x6c\x65"]) ? $lT->mo_oauth_client_update_option("\155\x6f\x5f\157\x61\x75\x74\x68\137\x69\143\x6f\156\137\x65\146\x66\145\143\x74\x5f\163\x63\141\x6c\145", stripslashes($_POST["\x6d\157\137\157\x61\165\x74\x68\137\151\x63\157\156\137\x65\x66\146\145\143\164\x5f\163\x63\141\154\x65"])) : $lT->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\x75\x74\150\x5f\151\143\x6f\x6e\137\145\146\146\145\x63\x74\x5f\163\x63\x61\154\x65", '');
        isset($_POST["\155\157\137\157\x61\x75\x74\x68\x5f\151\143\157\156\x5f\145\146\146\x65\x63\x74\137\163\150\x61\144\x6f\167"]) ? $lT->mo_oauth_client_update_option("\x6d\x6f\137\x6f\x61\x75\x74\x68\x5f\151\143\157\156\137\x65\146\146\x65\143\x74\137\163\x68\141\144\157\x77", stripslashes($_POST["\155\x6f\137\x6f\x61\165\x74\x68\137\x69\143\157\x6e\137\145\x66\x66\x65\x63\164\137\163\150\141\144\157\167"])) : $lT->mo_oauth_client_update_option("\155\157\137\157\141\x75\164\150\x5f\151\x63\157\x6e\x5f\x65\x66\x66\x65\143\x74\x5f\163\150\x61\x64\157\167", '');
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\157\141\165\164\150\x5f\151\143\x6f\x6e\x5f\x77\151\x64\164\x68", stripslashes($_POST["\155\x6f\137\x6f\x61\165\164\150\137\151\x63\x6f\156\x5f\167\x69\x64\164\150"]));
        $lT->mo_oauth_client_update_option("\155\157\137\157\x61\165\x74\150\137\151\x63\157\x6e\x5f\150\x65\151\147\x68\x74", stripslashes($_POST["\155\157\137\157\x61\165\164\150\x5f\x69\x63\157\x6e\137\x68\145\x69\147\150\164"]));
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\157\x61\165\164\x68\137\151\x63\x6f\156\x5f\143\x6f\154\x6f\x72", stripslashes($_POST["\x6d\157\137\157\141\165\164\x68\x5f\x69\x63\157\156\137\x63\x6f\x6c\x6f\162"]));
        $lT->mo_oauth_client_update_option("\x6d\157\137\157\141\x75\164\x68\x5f\151\143\x6f\x6e\x5f\x63\x75\x73\164\x6f\x6d\137\143\157\x6c\x6f\162", stripslashes($_POST["\155\157\x5f\157\x61\x75\164\x68\137\x69\143\x6f\x6e\x5f\x63\165\x73\164\x6f\155\x5f\143\x6f\x6c\157\162"]));
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\x74\150\x5f\x69\x63\x6f\x6e\137\x73\x6d\x61\x72\164\x5f\x63\157\x6c\157\x72\137\61", stripslashes($_POST["\155\x6f\137\x6f\x61\165\164\150\x5f\x69\x63\157\156\137\163\x6d\141\162\x74\x5f\x63\x6f\154\x6f\162\x5f\x31"]));
        $lT->mo_oauth_client_update_option("\x6d\157\137\157\x61\x75\164\150\x5f\151\143\x6f\156\x5f\x73\155\141\x72\x74\x5f\x63\157\154\157\x72\x5f\62", stripslashes($_POST["\x6d\157\x5f\157\x61\165\164\150\x5f\151\x63\x6f\x6e\137\x73\155\141\x72\x74\x5f\143\157\x6c\157\x72\x5f\x32"]));
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x6f\141\165\x74\x68\x5f\x69\143\157\x6e\137\143\165\x72\166\145", stripslashes($_POST["\x6d\x6f\x5f\157\x61\x75\x74\x68\137\x69\143\157\156\x5f\x63\x75\162\166\x65"]));
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\x69\143\x6f\156\137\x73\x69\172\x65", stripslashes($_POST["\x6d\157\x5f\x6f\141\165\x74\x68\137\151\x63\157\156\137\163\x69\172\x65"]));
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\157\x61\165\x74\x68\x5f\151\x63\157\x6e\x5f\155\x61\162\x67\x69\156", stripslashes($_POST["\155\157\137\x6f\141\x75\164\150\x5f\x69\143\157\x6e\137\155\141\162\147\151\x6e"]));
        $uA = preg_replace("\x2f\x5c\156\53\x2f", "\xa", trim($_POST["\x6d\157\x5f\x6f\x61\165\x74\x68\x5f\151\143\157\156\x5f\x63\x6f\156\146\151\x67\165\162\145\x5f\143\163\x73"]));
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\x61\x75\x74\150\137\151\143\x6f\x6e\137\x63\157\x6e\x66\151\147\x75\162\x65\x5f\x63\x73\x73", $uA);
        $lT->mo_oauth_client_update_option("\155\157\137\x6f\141\x75\164\x68\x5f\x63\165\163\164\157\x6d\x5f\x6c\x6f\147\x6f\165\164\x5f\164\x65\x78\x74", stripslashes($_POST["\x6d\157\x5f\x6f\141\x75\164\150\x5f\143\165\163\x74\x6f\155\137\x6c\x6f\147\157\x75\164\x5f\164\x65\x78\x74"]));
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\157\141\165\164\x68\137\167\151\x64\x67\145\x74\137\143\165\163\x74\x6f\155\x69\172\x65\137\x74\145\170\x74", !empty($_POST["\155\x6f\x5f\x6f\x61\x75\x74\150\x5f\x77\x69\144\x67\x65\164\x5f\143\165\x73\x74\157\x6d\x69\172\145\x5f\164\145\170\164"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\x6f\141\165\x74\x68\137\x77\x69\144\x67\x65\164\x5f\x63\x75\x73\x74\157\155\x69\172\145\x5f\164\x65\x78\164"])) : '');
        $Tx = $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\165\x74\x68\x5f\141\x70\x70\163\x5f\154\x69\163\x74");
        $bc = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\164\150\137\x6c\157\x67\151\156\137\142\x75\x74\x74\157\x6e\x5f\143\165\x73\164\x6f\x6d\151\172\x65\137\x64\151\x73\160\x6c\141\171\137\x74\145\170\x74");
        foreach ($Tx as $HH => $kp) {
            $rC = '' !== $kp->get_app_config("\x75\x6e\151\161\x75\145\137\141\160\160\x69\x64") ? $kp->get_app_config("\x75\156\151\x71\x75\x65\137\141\160\160\x69\144") : $kp->get_app_config("\141\x70\x70\x49\x64");
            $rC = str_replace("\40", "\x5f", $rC);
            $bc["\x6d\x6f\137\x6f\141\x75\164\150\137\x6c\157\147\x69\x6e\x5f\142\165\164\x74\x6f\x6e\x5f\143\165\x73\x74\x6f\x6d\x69\172\145\x5f\144\151\163\160\x6c\141\x79\x5f\x74\x65\x78\164\137" . $rC] = !empty($_POST["\155\157\137\157\141\x75\x74\150\x5f\154\x6f\147\x69\156\137\x62\165\x74\x74\157\156\x5f\143\165\163\x74\x6f\155\x69\x7a\145\137\x64\151\163\x70\x6c\x61\171\137\164\x65\x78\x74\137" . $rC]) ? sanitize_text_field(wp_unslash($_POST["\x6d\157\137\x6f\x61\x75\164\x68\137\154\157\147\x69\156\137\x62\x75\x74\x74\x6f\156\137\x63\165\x73\x74\157\155\x69\x7a\145\137\x64\151\163\x70\154\x61\x79\137\x74\145\x78\164\x5f" . $rC])) : '';
            bk:
        }
        b2:
        $lT->mo_oauth_client_update_option("\155\x6f\137\x6f\141\x75\164\150\x5f\x6c\x6f\147\x69\156\x5f\142\x75\164\164\157\x6e\x5f\x63\x75\163\164\157\155\x69\172\145\137\x64\x69\163\x70\154\x61\171\137\164\x65\170\x74", $bc);
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x63\165\163\x74\157\x6d\137\150\164\155\154\137\x77\x69\164\150\x5f\154\x6f\x67\157\x75\x74\137\154\151\x6e\x6b", isset($_POST["\155\x6f\x5f\143\165\x73\x74\x6f\x6d\x5f\150\164\155\154\x5f\x77\151\164\x68\137\x6c\x6f\x67\157\x75\x74\x5f\154\x69\156\153"]) ? sanitize_text_field(wp_unslash(isset($_POST["\x6d\x6f\x5f\x63\x75\163\x74\157\155\137\150\164\155\x6c\137\x77\x69\164\x68\137\154\157\x67\x6f\165\164\x5f\154\x69\156\x6b"]))) : "\146\141\154\x73\145");
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\141\160\x70\x6c\x79\137\143\x75\x73\x74\x6f\x6d\x69\172\145\x64\137\163\145\x74\x74\x69\x6e\147\137\x6f\x6e\137\x77\160\x5f\x61\144\155\x69\x6e", isset($_POST["\155\157\137\141\160\x70\154\171\x5f\143\x75\163\164\157\155\x69\x7a\145\x64\137\163\145\164\x74\x69\156\x67\x5f\157\156\x5f\x77\x70\137\141\x64\155\x69\x6e"]) ? sanitize_text_field(wp_unslash(isset($_POST["\x6d\x6f\x5f\141\x70\160\154\171\x5f\x63\x75\163\164\157\x6d\151\172\x65\144\137\x73\145\164\164\151\x6e\147\137\157\156\137\x77\160\137\x61\x64\155\151\x6e"]))) : false);
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\157\x75\x72\40\x73\x65\164\164\x69\x6e\x67\163\x20\167\145\162\x65\x20\163\x61\166\145\x64");
        $lT->mo_oauth_show_success_message();
        qD:
        BU:
    }
    public function set_default_customize_value()
    {
        global $lT;
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\x6f\141\x75\x74\x68\x5f\151\143\157\x6e\x5f\164\150\145\155\x65", "\160\x72\x65\166\151\x6f\x75\163");
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\x75\164\150\137\x69\143\x6f\156\137\163\150\x61\x70\x65", "\x6c\157\156\147\142\165\x74\x74\157\156");
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\157\x61\x75\x74\x68\137\151\x63\x6f\x6e\137\145\146\146\x65\x63\x74\x5f\x73\143\x61\x6c\145", '');
        $lT->mo_oauth_client_update_option("\155\157\137\157\x61\x75\164\x68\x5f\151\143\x6f\156\137\145\x66\x66\x65\x63\x74\137\163\x68\141\144\x6f\167", '');
        if ($lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\x75\164\150\137\x69\143\x6f\x6e\x5f\x77\x69\144\164\150")) {
            goto L1;
        }
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\157\141\165\x74\x68\x5f\151\143\157\156\137\x77\x69\144\x74\x68", "\x32\67\60");
        L1:
        if (!$lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\141\x75\164\x68\x5f\151\143\157\x6e\x5f\150\145\151\147\x68\x74")) {
            goto Sm;
        }
        $VH = $lT->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\x75\164\150\x5f\162\x65\x63\x74\x69\x66\171\x5f\x69\143\x6f\x6e\x5f\150\x65\151\x67\x68\164\x5f\x66\x6c\x61\147");
        if (!($VH == false)) {
            goto Q2;
        }
        $dZ = $lT->mo_oauth_client_get_option("\155\157\137\157\x61\x75\164\150\137\x69\143\x6f\x6e\137\x68\x65\151\147\x68\164");
        $dZ = (int) $dZ;
        $dZ = $dZ * 2;
        $dZ = (string) $dZ;
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\x69\x63\x6f\x6e\137\x68\145\x69\147\150\164", $dZ);
        $lT->mo_oauth_client_update_option("\155\157\137\157\x61\x75\x74\x68\x5f\162\x65\x63\164\151\146\171\137\x69\143\157\x6e\x5f\x68\x65\151\147\x68\x74\x5f\146\154\x61\x67", True);
        Q2:
        goto Ax;
        Sm:
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\x61\165\164\x68\x5f\151\143\x6f\x6e\137\150\145\x69\147\150\x74", "\63\x30");
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\164\150\x5f\x72\145\x63\x74\x69\146\171\x5f\151\143\x6f\156\137\150\145\x69\147\x68\x74\x5f\146\x6c\141\147", True);
        Ax:
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\x75\x74\150\137\151\x63\157\156\137\x63\157\x6c\157\x72", "\43\x30\x30\x30\60\x30\x30");
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\157\141\x75\164\150\137\x69\x63\x6f\x6e\137\x63\x75\163\164\157\155\x5f\143\157\154\x6f\x72", "\x23\x30\x30\x38\145\x63\x32");
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x6f\141\165\164\150\x5f\x69\x63\x6f\x6e\137\x73\x6d\x61\x72\164\137\143\x6f\x6c\157\162\x5f\x31", "\x23\106\106\x31\x46\64\x42");
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\157\141\x75\164\150\137\x69\x63\157\x6e\137\163\155\141\x72\x74\x5f\143\157\154\157\x72\137\62", "\43\x32\60\x30\70\106\x46");
        $lT->mo_oauth_client_update_option("\155\x6f\137\x6f\141\x75\x74\150\137\x69\143\x6f\156\137\143\165\162\166\145", "\x34");
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\x6f\x61\165\x74\x68\x5f\x69\143\157\156\137\163\151\172\x65", "\63\x30");
        if ($lT->mo_oauth_client_get_option("\155\x6f\137\157\141\x75\164\x68\x5f\x69\x63\x6f\156\x5f\x6d\x61\x72\x67\151\x6e")) {
            goto y3;
        }
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\x75\x74\x68\x5f\x69\x63\x6f\156\137\x6d\141\162\x67\151\156", "\x34");
        y3:
    }
    public function mo_oauth_custom_icons_intiater()
    {
        global $lT;
        $v4 = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\164\150\x5f\151\143\x6f\156\137\164\x68\x65\x6d\x65");
        $Kg = $lT->mo_oauth_client_get_option("\x6d\x6f\137\157\141\165\x74\x68\137\151\143\157\156\x5f\163\x68\141\x70\145");
        if (!((!$v4 || empty($v4)) && (!$Kg || empty($Kg)))) {
            goto gH;
        }
        $m5 = $this->set_default_customize_value();
        gH:
    }
}
