<?php


namespace MoOauthClient\Base;

use MoOauthClient\Licensing;
use MoOauthClient\MoAddons;
use MoOauthClient\Base\InstanceHelper;
class Loader
{
    private $instance_helper;
    public function __construct()
    {
        add_action("\x61\x64\155\151\x6e\137\x65\156\x71\x75\145\x75\145\137\x73\143\x72\x69\x70\x74\x73", array($this, "\160\154\165\x67\151\156\x5f\x73\x65\164\164\x69\156\x67\x73\x5f\x73\x74\x79\154\x65"));
        add_action("\141\x64\x6d\151\x6e\x5f\145\156\161\165\x65\165\x65\x5f\163\143\162\x69\x70\x74\x73", array($this, "\x70\154\165\x67\151\x6e\x5f\163\x65\x74\164\x69\x6e\147\x73\137\x73\x63\x72\x69\160\x74"));
        $this->instance_helper = new InstanceHelper();
    }
    public function plugin_settings_style()
    {
        wp_enqueue_style("\155\157\137\x6f\x61\x75\x74\x68\x5f\x61\144\x6d\151\156\x5f\163\x65\164\x74\151\x6e\147\x73\x5f\163\x74\x79\x6c\x65", MOC_URL . "\162\x65\x73\157\x75\162\143\x65\163\x2f\143\x73\163\x2f\x73\164\171\x6c\145\137\x73\x65\x74\x74\x69\x6e\147\163\x2e\x63\x73\x73", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        wp_enqueue_style("\x6d\157\137\x6f\x61\165\164\150\x5f\x61\x64\155\x69\x6e\137\x73\145\x74\164\151\x6e\147\163\x5f\160\x68\157\156\x65\137\x73\x74\171\154\145", MOC_URL . "\162\x65\x73\x6f\165\162\143\x65\x73\57\143\163\x73\x2f\160\150\157\x6e\x65\56\x63\163\x73", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        wp_enqueue_style("\x6d\x6f\x5f\157\141\x75\x74\x68\x5f\141\x64\x6d\x69\156\137\163\x65\164\164\151\x6e\147\x73\x5f\144\141\164\141\164\x61\x62\154\x65", MOC_URL . "\x72\145\163\x6f\165\162\x63\145\163\x2f\x63\x73\x73\57\x6a\x71\165\x65\x72\171\x2e\144\x61\164\141\124\x61\x62\x6c\145\x73\x2e\155\151\156\x2e\x63\163\163", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        wp_enqueue_style("\x6d\157\x2d\x77\x70\55\x62\x6f\157\164\x73\164\162\x61\160\x2d\163\157\x63\151\x61\x6c", MOC_URL . "\x72\x65\x73\x6f\165\x72\143\145\x73\57\x63\163\163\x2f\x62\157\157\164\x73\164\x72\141\x70\55\163\x6f\x63\x69\141\154\x2e\x63\x73\x73", array(), $jm = null, $XF = false);
        wp_enqueue_style("\x6d\x6f\55\x77\160\55\142\x6f\x6f\x74\x73\164\x72\x61\x70\55\155\x61\x69\x6e", MOC_URL . "\x72\x65\163\x6f\x75\x72\x63\x65\x73\57\143\x73\x73\57\x62\x6f\x6f\x74\x73\164\x72\141\160\56\155\x69\x6e\x2d\x70\162\145\166\151\145\x77\x2e\143\x73\163", array(), $jm = null, $XF = false);
        wp_enqueue_style("\x6d\157\x2d\x77\x70\55\146\157\156\x74\x2d\141\167\x65\x73\x6f\155\145", MOC_URL . "\x72\x65\163\x6f\165\162\143\145\163\x2f\x63\163\x73\57\146\157\x6e\x74\55\x61\167\145\x73\x6f\x6d\x65\x2e\x6d\x69\x6e\x2e\x63\163\163", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        if (!(isset($_REQUEST["\x74\141\142"]) && "\x6c\x69\143\145\156\163\x69\156\x67" === $_REQUEST["\x74\141\x62"])) {
            goto RH;
        }
        wp_enqueue_style("\155\x6f\x5f\x6f\141\x75\164\150\x5f\142\x6f\157\164\x73\164\x72\141\x70\x5f\x63\163\163", MOC_URL . "\162\145\x73\157\165\x72\143\x65\163\57\143\x73\163\x2f\142\x6f\x6f\x74\x73\x74\162\141\x70\x2f\x62\x6f\157\164\163\x74\162\x61\x70\56\x6d\x69\156\56\143\x73\163", array(), $jm = null, $XF = false);
        wp_enqueue_style("\155\x6f\137\x6f\x61\165\x74\150\137\154\x69\143\145\x6e\x73\x65\x5f\x70\x61\147\145\x5f\163\x74\x79\x6c\x65", MOC_URL . "\162\x65\163\x6f\165\x72\143\x65\163\57\x63\163\163\57\x6d\x6f\55\x6f\x61\165\x74\x68\55\x6c\151\x63\x65\x6e\163\x69\x6e\147\56\143\163\163", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        RH:
    }
    public function plugin_settings_script()
    {
        wp_enqueue_script("\x6d\x6f\x5f\157\141\x75\164\x68\137\x61\144\x6d\151\x6e\137\x73\x65\164\164\x69\x6e\147\163\137\163\143\162\151\160\x74", MOC_URL . "\x72\145\x73\x6f\165\x72\x63\x65\x73\x2f\x6a\x73\57\163\145\164\164\x69\156\147\163\56\x6a\163", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        wp_enqueue_script("\x6d\157\x5f\157\141\x75\164\150\x5f\x61\144\x6d\x69\x6e\x5f\163\145\164\164\x69\x6e\x67\163\137\160\150\157\156\x65\x5f\x73\x63\162\151\160\164", MOC_URL . "\162\145\x73\x6f\165\162\143\145\163\57\152\x73\x2f\160\x68\157\x6e\x65\x2e\x6a\x73", array(), $jm = null, $XF = false);
        wp_enqueue_script("\155\157\137\157\x61\x75\164\150\137\x61\x64\x6d\151\156\137\163\145\164\x74\x69\156\147\163\x5f\144\x61\x74\141\x74\141\x62\154\145", MOC_URL . "\162\145\163\157\165\x72\143\x65\163\57\x6a\163\57\x6a\161\x75\x65\x72\171\56\144\x61\x74\x61\124\x61\142\x6c\145\x73\x2e\x6d\x69\156\56\x6a\x73", array(), $jm = MO_OAUTH_PREMIUM_CSS_JS_VERSION, $XF = false);
        if (!(isset($_REQUEST["\x74\x61\x62"]) && "\x6c\x69\x63\145\x6e\163\151\x6e\x67" === $_REQUEST["\x74\x61\142"])) {
            goto GS;
        }
        wp_enqueue_script("\x6d\x6f\x5f\157\x61\165\x74\150\137\x6d\157\x64\145\x72\156\x69\172\x72\x5f\x73\x63\162\151\x70\164", MOC_URL . "\162\x65\x73\157\165\162\x63\x65\x73\x2f\x6a\163\x2f\155\x6f\144\x65\162\156\151\172\x72\x2e\152\163", array(), $jm = null, $XF = true);
        wp_enqueue_script("\x6d\x6f\137\x6f\141\x75\164\150\x5f\160\x6f\x70\157\166\x65\162\137\163\x63\x72\x69\160\x74", MOC_URL . "\162\145\x73\157\165\x72\143\145\x73\57\x6a\x73\57\142\x6f\x6f\164\x73\164\162\141\x70\57\x70\x6f\x70\160\x65\162\x2e\x6d\151\156\x2e\x6a\x73", array(), $jm = null, $XF = true);
        wp_enqueue_script("\155\157\x5f\x6f\141\165\x74\x68\x5f\142\x6f\157\164\x73\164\x72\141\160\x5f\x73\x63\x72\151\x70\x74", MOC_URL . "\x72\x65\163\157\x75\x72\x63\145\x73\x2f\152\163\x2f\x62\x6f\157\164\163\x74\162\x61\x70\x2f\x62\157\x6f\164\x73\x74\x72\141\x70\x2e\155\x69\156\56\x6a\163", array(), $jm = null, $XF = true);
        GS:
    }
    public function load_current_tab($fC)
    {
        global $lT;
        $Ep = 0 === $lT->get_versi();
        $mC = false;
        if ($Ep) {
            goto x8;
        }
        $mC = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\165\x74\x68\137\143\154\151\x65\x6e\164\137\x6c\x6f\x61\144\x5f\141\x6e\x61\154\171\x74\151\x63\x73");
        $mC = boolval($mC) ? boolval($mC) : false;
        $Ep = $lT->check_versi(1) && $lT->mo_oauth_is_clv();
        x8:
        if ("\x61\143\x63\157\165\x6e\x74" === $fC || !$Ep) {
            goto xq;
        }
        if ("\143\165\163\164\x6f\x6d\151\x7a\141\164\x69\x6f\x6e" === $fC && $Ep) {
            goto ET;
        }
        if ("\x73\151\147\156\x69\x6e\163\x65\x74\x74\151\x6e\x67\163" === $fC && $Ep) {
            goto OS;
        }
        if ("\x73\x75\x62\x73\151\x74\145\163\145\x74\164\x69\156\147\x73" === $fC && $Ep) {
            goto Qr;
        }
        if ($mC && "\141\156\141\x6c\171\x74\x69\x63\163" === $fC && $Ep) {
            goto YS;
        }
        if ("\154\x69\x63\x65\x6e\163\x69\x6e\147" === $fC) {
            goto YY;
        }
        if ("\x72\145\161\x75\x65\163\x74\x66\157\x72\144\x65\x6d\x6f" === $fC && $Ep) {
            goto VS;
        }
        if ("\141\x64\144\x6f\x6e\x73" === $fC) {
            goto Yz;
        }
        $this->instance_helper->get_clientappui_instance()->render_free_ui();
        goto vV;
        xq:
        $w1 = $this->instance_helper->get_accounts_instance();
        if ($lT->mo_oauth_client_get_option("\166\145\x72\x69\146\x79\137\143\165\163\164\x6f\x6d\145\x72") === "\164\162\x75\x65") {
            goto Bo;
        }
        if (trim($lT->mo_oauth_client_get_option("\155\157\137\x6f\x61\165\x74\150\x5f\x61\x64\155\151\156\x5f\145\x6d\x61\x69\154")) !== '' && trim($lT->mo_oauth_client_get_option("\155\x6f\137\157\x61\165\164\x68\137\x61\144\x6d\x69\x6e\137\141\x70\151\137\153\x65\171")) === '' && $lT->mo_oauth_client_get_option("\x6e\x65\x77\137\x72\145\x67\151\163\x74\x72\141\x74\x69\x6f\156") !== "\164\162\x75\145") {
            goto lw;
        }
        if (!$lT->mo_oauth_is_clv() && $lT->check_versi(1) && $lT->mo_oauth_is_customer_registered()) {
            goto Rs;
        }
        $w1->register();
        goto m1;
        Bo:
        $w1->verify_password_ui();
        goto m1;
        lw:
        $w1->verify_password_ui();
        goto m1;
        Rs:
        $w1->mo_oauth_lp();
        m1:
        goto vV;
        ET:
        $this->instance_helper->get_customization_instance()->render_free_ui();
        goto vV;
        OS:
        $this->instance_helper->get_sign_in_settings_instance()->render_free_ui();
        goto vV;
        Qr:
        $this->instance_helper->get_subsite_settings()->render_ui();
        goto vV;
        YS:
        $this->instance_helper->get_user_analytics()->render_ui();
        goto vV;
        YY:
        (new Licensing())->show_licensing_page();
        goto vV;
        VS:
        $this->instance_helper->get_requestdemo_instance()->render_free_ui();
        goto vV;
        Yz:
        (new MoAddons())->addons_page();
        vV:
    }
}
