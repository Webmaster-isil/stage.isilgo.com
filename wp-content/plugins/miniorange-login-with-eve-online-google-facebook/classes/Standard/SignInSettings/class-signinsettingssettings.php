<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Config;
class SignInSettingsSettings
{
    private $plugin_config;
    public function __construct()
    {
        $h0 = $this->get_config_option();
        if ($h0 && isset($h0)) {
            goto s5e;
        }
        $this->plugin_config = new Config();
        $this->save_config_option($this->plugin_config);
        goto Cgn;
        s5e:
        $this->save_config_option($h0);
        $this->plugin_config = $h0;
        Cgn:
    }
    public function save_config_option($zB = array())
    {
        global $lT;
        if (!(isset($zB) && !empty($zB))) {
            goto gEx;
        }
        return $lT->mo_oauth_client_update_option("\x6d\157\137\157\141\x75\x74\150\137\x63\154\x69\145\156\164\x5f\x63\x6f\x6e\146\151\147", $zB);
        gEx:
        return false;
    }
    public function get_config_option()
    {
        global $lT;
        return $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\x75\164\x68\137\143\154\x69\145\156\164\137\143\157\156\146\x69\x67");
    }
    public function get_sane_config()
    {
        $zB = $this->plugin_config;
        if ($zB && isset($zB)) {
            goto VMf;
        }
        $zB = $this->get_config_option();
        VMf:
        if (!(!$zB || !isset($zB))) {
            goto Wul;
        }
        $zB = new Config();
        Wul:
        return $zB;
    }
    public function mo_oauth_save_settings()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\151\x73\141\x62\154\145\144";
        if (empty($zB["\155\x6f\137\144\164\145\x5f\163\164\141\164\145"])) {
            goto FAh;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\157\x5f\144\164\x65\137\x73\x74\141\x74\145"]);
        FAh:
        if (!($M9 == "\x64\x69\163\x61\x62\x6c\x65\144")) {
            goto TWz;
        }
        $zB = $this->get_sane_config();
        if (!(isset($_POST["\x6d\x6f\x5f\x73\151\147\x6e\x69\156\x73\145\164\x74\151\156\x67\x73\137\x6e\x6f\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\163\x69\147\x6e\x69\x6e\x73\145\164\164\151\156\147\163\137\156\157\156\143\145"])), "\x6d\157\x5f\x6f\141\x75\x74\150\137\143\x6c\x69\145\156\x74\137\x73\x69\147\x6e\137\151\x6e\x5f\x73\145\164\x74\151\156\x67\x73") && (isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\141\x75\x74\x68\x5f\143\154\x69\x65\156\164\137\x61\x64\166\x61\156\x63\x65\x64\x5f\x73\145\164\164\151\x6e\147\163" === $_POST[\MoOAuthConstants::OPTION]))) {
            goto A5l;
        }
        $zB = $this->change_current_config($_POST, $zB);
        $zB->save_settings($zB->get_current_config());
        $this->save_config_option($zB);
        A5l:
        TWz:
    }
    public function change_current_config($post, $zB)
    {
        $zB->add_config("\141\x66\x74\x65\x72\137\154\157\147\151\156\x5f\x75\162\x6c", isset($post["\x63\x75\x73\x74\157\x6d\137\141\146\164\x65\x72\x5f\x6c\157\x67\151\x6e\x5f\165\x72\x6c"]) ? stripslashes(wp_unslash($post["\143\165\163\x74\x6f\155\x5f\x61\x66\x74\145\x72\x5f\154\157\147\151\156\x5f\165\x72\154"])) : '');
        $zB->add_config("\141\146\x74\x65\162\137\154\x6f\x67\x6f\x75\164\x5f\x75\162\x6c", isset($post["\x63\165\x73\x74\157\155\137\141\146\164\145\x72\137\154\x6f\x67\157\x75\x74\137\x75\x72\154"]) ? stripslashes(wp_unslash($post["\143\x75\163\164\157\155\x5f\x61\146\164\145\x72\137\x6c\x6f\147\x6f\165\x74\x5f\x75\162\x6c"])) : '');
        $zB->add_config("\x70\x6f\160\165\x70\x5f\154\157\x67\151\156", isset($post["\x70\x6f\x70\165\160\x5f\x6c\157\x67\151\x6e"]) ? stripslashes(wp_unslash($post["\x70\x6f\160\165\x70\x5f\154\x6f\147\x69\x6e"])) : 0);
        $zB->add_config("\141\165\164\x6f\x5f\x72\x65\x67\x69\163\164\x65\162", isset($post["\141\165\164\x6f\x5f\x72\145\x67\x69\163\x74\x65\x72"]) ? stripslashes(wp_unslash($post["\x61\x75\164\157\x5f\162\x65\147\x69\x73\x74\145\x72"])) : 0);
        $zB->add_config("\143\157\x6e\x66\x69\162\155\x5f\x6c\x6f\x67\x6f\x75\x74", isset($post["\143\157\x6e\146\x69\x72\155\137\x6c\x6f\x67\x6f\165\x74"]) ? stripslashes(wp_unslash($post["\x63\157\x6e\x66\x69\x72\x6d\x5f\x6c\x6f\x67\157\x75\164"])) : 0);
        return $zB;
    }
}
