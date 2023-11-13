<?php


namespace MoOauthClient\Standard;

use MoOauthClient\App;
use MoOauthClient\Free\AppSettings as FreeAppSettings;
class AppSettings extends FreeAppSettings
{
    public function __construct()
    {
        parent::__construct();
        add_action("\x6d\157\137\157\141\x75\x74\150\x5f\143\154\151\x65\x6e\x74\137\163\x61\x76\145\137\x61\x70\x70\137\x73\x65\x74\164\x69\x6e\147\x73\137\151\x6e\x74\x65\x72\x6e\141\x6c", array($this, "\x73\x61\166\x65\x5f\162\157\x6c\145\x5f\155\x61\x70\160\x69\156\x67"));
    }
    public function change_app_settings($post, $Bs)
    {
        $Bs = parent::change_app_settings($post, $Bs);
        $Bs["\144\151\163\x70\154\141\x79\x61\x70\x70\156\141\155\145"] = isset($post["\x6d\157\137\x6f\141\x75\164\x68\137\x64\151\163\x70\x6c\x61\171\137\x61\160\x70\x5f\156\x61\155\145"]) ? trim(stripslashes($post["\x6d\x6f\x5f\x6f\141\x75\x74\x68\137\144\151\x73\x70\x6c\141\x79\x5f\141\160\x70\x5f\x6e\141\155\145"])) : '';
        return $Bs;
    }
    public function change_attribute_mapping($post, $Bs)
    {
        $Bs = parent::change_attribute_mapping($post, $Bs);
        $Bs["\145\155\141\151\154\x5f\x61\x74\164\x72"] = isset($post["\x6d\157\137\157\x61\165\x74\150\137\145\x6d\141\151\154\x5f\x61\x74\164\x72"]) ? trim(stripslashes($post["\155\157\137\x6f\141\x75\164\150\137\x65\x6d\141\x69\x6c\x5f\141\x74\x74\x72"])) : '';
        $Bs["\x66\x69\x72\x73\164\156\141\155\x65\137\141\x74\x74\x72"] = isset($post["\155\157\137\157\141\x75\x74\150\137\x66\151\162\163\x74\x6e\x61\155\145\137\x61\164\x74\x72"]) ? trim(stripslashes($post["\155\157\x5f\157\x61\x75\164\150\x5f\146\151\162\x73\x74\156\141\155\x65\x5f\141\x74\164\162"])) : '';
        $Bs["\154\x61\x73\x74\156\x61\x6d\x65\137\141\164\164\162"] = isset($post["\x6d\157\137\x6f\x61\x75\x74\x68\x5f\154\141\163\x74\156\141\x6d\145\x5f\141\x74\164\x72"]) ? trim(stripslashes($post["\x6d\157\137\157\x61\165\x74\x68\x5f\154\x61\x73\x74\156\141\155\x65\137\x61\164\x74\x72"])) : '';
        $Bs["\145\156\x61\x62\x6c\x65\137\162\x6f\154\x65\137\x6d\x61\x70\160\x69\x6e\x67"] = isset($post["\x65\x6e\141\x62\x6c\145\137\162\157\154\x65\137\155\x61\160\160\x69\156\147"]) ? sanitize_text_field(wp_unslash($_POST["\145\x6e\141\142\x6c\145\137\162\x6f\154\145\137\x6d\x61\160\160\x69\x6e\x67"])) : false;
        $Bs["\x61\x6c\x6c\x6f\167\x5f\144\x75\160\x6c\x69\143\141\164\145\137\145\155\x61\x69\x6c\163"] = isset($post["\x61\x6c\154\157\167\137\x64\x75\x70\154\x69\143\141\x74\x65\x5f\x65\x6d\141\151\154\163"]) ? sanitize_text_field(wp_unslash($_POST["\141\154\x6c\157\167\x5f\x64\165\160\154\x69\x63\141\164\x65\137\x65\155\141\x69\x6c\163"])) : false;
        $Bs["\144\151\163\160\154\141\x79\x5f\x61\164\x74\162"] = isset($post["\157\141\165\x74\150\x5f\x63\x6c\x69\x65\x6e\164\137\x61\155\x5f\144\x69\163\160\154\141\x79\137\x6e\141\x6d\145"]) ? trim(stripslashes($post["\x6f\141\165\x74\x68\137\x63\x6c\151\145\156\164\x5f\141\155\x5f\x64\x69\163\160\x6c\141\171\137\156\141\x6d\145"])) : '';
        return $Bs;
    }
    public function save_role_mapping()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\x64\151\163\x61\142\154\145\144";
        if (empty($zB["\x6d\x6f\x5f\144\164\x65\137\163\x74\141\x74\x65"])) {
            goto jIG;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\157\x5f\144\x74\145\x5f\x73\164\141\164\145"]);
        jIG:
        if (!($M9 == "\144\151\163\x61\x62\x6c\x65\x64")) {
            goto I1y;
        }
        if (!(isset($_POST["\x6d\157\137\x6f\x61\x75\x74\150\x5f\x63\154\x69\145\x6e\164\137\x73\x61\166\x65\x5f\x72\x6f\154\x65\x5f\155\x61\160\x70\x69\x6e\x67\x5f\156\157\x6e\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\157\x61\165\164\x68\137\143\x6c\x69\x65\156\x74\137\163\141\166\x65\137\162\x6f\154\145\x5f\x6d\141\x70\x70\151\156\147\x5f\156\x6f\156\143\145"])), "\x6d\x6f\x5f\x6f\x61\x75\164\x68\137\143\x6c\x69\x65\156\x74\137\163\141\x76\x65\x5f\162\157\x6c\x65\137\155\x61\160\x70\x69\156\x67") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\137\157\x61\x75\164\x68\x5f\143\154\x69\x65\x6e\164\x5f\163\141\x76\145\137\162\157\x6c\x65\x5f\155\141\160\x70\x69\x6e\x67" === $_POST[\MoOAuthConstants::OPTION])) {
            goto teZ;
        }
        $Ig = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::POST_APP_NAME]) ? $_POST[\MoOAuthConstants::POST_APP_NAME] : ''));
        $kp = $lT->get_app_by_name($Ig);
        $FK = $kp->get_app_config('', false);
        $FK["\x5f\x6d\x61\x70\160\x69\156\x67\x5f\x76\x61\x6c\x75\145\x5f\144\x65\146\x61\x75\154\164"] = isset($_POST["\155\141\160\x70\x69\x6e\147\x5f\x76\x61\x6c\165\145\137\144\x65\x66\x61\165\x6c\164"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x61\160\x70\x69\156\147\x5f\x76\141\x6c\x75\145\137\x64\145\146\141\x75\154\x74"])) : false;
        $FK["\153\145\x65\x70\137\x65\170\x69\x73\x74\151\x6e\x67\137\165\x73\145\x72\137\x72\157\154\145\163"] = isset($_POST["\153\145\x65\x70\137\145\170\151\163\x74\x69\156\147\137\x75\163\145\162\137\x72\x6f\x6c\x65\163"]) ? sanitize_text_field(wp_unslash($_POST["\153\x65\145\x70\x5f\x65\x78\151\163\x74\151\156\147\x5f\165\x73\145\x72\x5f\x72\x6f\x6c\145\163"])) : 0;
        $oR = $lT->set_app_by_name($Ig, $FK);
        teZ:
        I1y:
    }
}
