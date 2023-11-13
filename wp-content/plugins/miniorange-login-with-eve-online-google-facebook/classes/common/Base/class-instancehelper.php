<?php


namespace MoOauthClient\Base;

class InstanceHelper
{
    private $current_version = "\x46\x52\x45\105";
    private $utils;
    public function __construct()
    {
        $this->utils = new \MoOauthClient\MOUtils();
        $this->current_version = $this->utils->get_versi_str();
    }
    public function get_sign_in_settings_instance()
    {
        if (class_exists("\115\x6f\117\141\x75\164\150\x43\154\x69\145\156\x74\134\105\156\164\145\162\x70\162\151\x73\x65\x5c\123\151\147\x6e\x49\156\123\x65\x74\164\151\156\x67\163") && $this->utils->check_versi(4)) {
            goto GA;
        }
        if (class_exists("\x4d\x6f\x4f\x61\x75\164\x68\x43\x6c\151\145\156\x74\134\120\162\x65\x6d\x69\x75\x6d\134\x53\151\x67\x6e\x49\x6e\123\145\164\x74\151\156\147\x73") && $this->utils->check_versi(2)) {
            goto On;
        }
        if (class_exists("\x4d\x6f\117\141\x75\x74\x68\x43\x6c\151\145\156\x74\134\123\164\141\156\x64\x61\x72\144\x5c\123\x69\147\156\111\156\x53\x65\164\x74\151\156\x67\163") && $this->utils->check_versi(1)) {
            goto F5;
        }
        if (class_exists("\x5c\115\x6f\117\x61\165\164\150\x43\154\151\x65\x6e\x74\134\106\162\145\x65\x5c\x53\151\x67\x6e\111\x6e\x53\x65\x74\164\151\156\147\163") && $this->utils->check_versi(0)) {
            goto RT;
        }
        wp_die("\x50\154\x65\x61\x73\x65\x20\x43\x68\x61\x6e\147\145\x20\x54\x68\x65\40\166\145\162\x73\151\x6f\156\x20\x62\141\143\153\40\x74\x6f\40\167\x68\141\x74\40\x69\164\x20\162\145\x61\x6c\x6c\x79\40\167\x61\x73");
        exit;
        goto sY;
        GA:
        return new \MoOauthClient\Enterprise\SignInSettings();
        goto sY;
        On:
        return new \MoOauthClient\Premium\SignInSettings();
        goto sY;
        F5:
        return new \MoOauthClient\Standard\SignInSettings();
        goto sY;
        RT:
        return new \MoOauthClient\Free\SignInSettings();
        sY:
    }
    public function get_requestdemo_instance()
    {
        if (!class_exists("\x5c\x4d\157\117\x61\165\x74\150\x43\154\x69\145\156\164\134\x46\x72\145\x65\134\122\x65\x71\165\145\163\x74\146\157\x72\144\x65\155\x6f")) {
            goto Q_;
        }
        return new \MoOauthClient\Free\Requestfordemo();
        Q_:
    }
    public function get_customization_instance()
    {
        if (class_exists("\115\157\x4f\x61\x75\x74\x68\x43\154\151\145\156\164\x5c\x45\156\x74\x65\x72\160\162\x69\x73\145\x5c\x43\x75\163\164\157\x6d\x69\x7a\x61\x74\x69\157\156") && $this->utils->check_versi(4)) {
            goto E8;
        }
        if (class_exists("\115\157\x4f\x61\x75\164\150\103\x6c\x69\x65\156\x74\134\120\x72\x65\x6d\x69\165\x6d\x5c\103\x75\163\x74\x6f\x6d\151\x7a\x61\164\151\157\156") && $this->utils->check_versi(2)) {
            goto tu;
        }
        if (class_exists("\x4d\157\x4f\141\165\164\150\103\154\151\145\156\164\134\x53\164\x61\156\x64\141\x72\x64\x5c\x43\x75\x73\x74\x6f\x6d\151\172\141\x74\x69\157\x6e") && $this->utils->check_versi(1)) {
            goto VA;
        }
        if (class_exists("\134\x4d\157\117\x61\165\164\150\x43\154\x69\x65\156\164\x5c\106\x72\x65\145\134\x43\x75\163\164\x6f\155\x69\x7a\141\x74\x69\157\x6e") && $this->utils->check_versi(0)) {
            goto IK;
        }
        wp_die("\x50\154\145\x61\163\x65\x20\103\150\141\156\x67\145\x20\124\150\x65\40\x76\145\x72\163\x69\x6f\156\x20\x62\141\143\153\40\164\157\x20\167\x68\x61\164\40\151\164\x20\x72\145\141\154\x6c\x79\x20\167\x61\163");
        exit;
        goto dL;
        E8:
        return new \MoOauthClient\Enterprise\Customization();
        goto dL;
        tu:
        return new \MoOauthClient\Premium\Customization();
        goto dL;
        VA:
        return new \MoOauthClient\Standard\Customization();
        goto dL;
        IK:
        return new \MoOauthClient\Free\Customization();
        dL:
    }
    public function get_clientappui_instance()
    {
        if (class_exists("\115\157\117\x61\165\x74\150\103\154\151\145\156\x74\x5c\x45\156\x74\145\x72\x70\162\x69\163\145\x5c\103\x6c\x69\x65\x6e\164\101\x70\160\x55\x49") && $this->utils->check_versi(4)) {
            goto oh;
        }
        if (class_exists("\115\157\117\x61\x75\164\x68\103\x6c\151\x65\x6e\164\x5c\x50\x72\x65\155\x69\x75\155\x5c\x43\x6c\x69\145\156\x74\101\x70\x70\125\111") && $this->utils->check_versi(2)) {
            goto J7;
        }
        if (class_exists("\115\157\117\x61\165\164\x68\103\x6c\151\145\156\164\x5c\123\164\x61\x6e\144\x61\x72\x64\134\103\x6c\151\145\x6e\x74\x41\x70\x70\125\111") && $this->utils->check_versi(1)) {
            goto aO;
        }
        if (class_exists("\134\x4d\157\x4f\141\165\164\x68\103\x6c\x69\145\x6e\x74\134\x46\162\145\145\x5c\x43\154\151\x65\156\x74\x41\160\160\125\x49") && $this->utils->check_versi(0)) {
            goto lb;
        }
        wp_die("\x50\x6c\x65\x61\x73\145\40\x43\150\141\x6e\x67\x65\x20\124\x68\145\x20\166\x65\162\163\x69\x6f\156\40\x62\141\x63\x6b\x20\164\x6f\x20\167\x68\141\164\40\x69\x74\x20\162\x65\141\x6c\154\171\40\167\x61\163");
        exit;
        goto iH;
        oh:
        return new \MoOauthClient\Enterprise\ClientAppUI();
        goto iH;
        J7:
        return new \MoOauthClient\Premium\ClientAppUI();
        goto iH;
        aO:
        return new \MoOauthClient\Standard\ClientAppUI();
        goto iH;
        lb:
        return new \MoOauthClient\Free\ClientAppUI();
        iH:
    }
    public function get_login_handler_instance()
    {
        if (class_exists("\115\x6f\117\141\x75\164\x68\x43\154\x69\x65\x6e\x74\134\x45\x6e\164\145\162\160\x72\151\163\145\x5c\114\x6f\147\151\156\x48\x61\156\x64\x6c\145\162") && $this->utils->check_versi(4)) {
            goto M8;
        }
        if (class_exists("\115\x6f\x4f\x61\x75\x74\150\103\154\x69\x65\x6e\164\134\x50\x72\145\x6d\x69\x75\155\134\x4c\157\x67\151\156\110\x61\x6e\x64\154\x65\x72") && $this->utils->check_versi(2)) {
            goto RS;
        }
        if (class_exists("\115\x6f\117\x61\x75\164\x68\103\154\x69\145\x6e\x74\x5c\123\x74\x61\156\x64\x61\x72\144\x5c\114\157\x67\151\156\110\141\156\144\x6c\145\162") && $this->utils->check_versi(1)) {
            goto OI;
        }
        if (class_exists("\134\115\x6f\x4f\x61\165\x74\x68\103\x6c\151\145\156\164\x5c\x4c\x6f\147\151\156\x48\x61\156\x64\x6c\x65\x72") && $this->utils->check_versi(0)) {
            goto R0;
        }
        wp_die("\x50\x6c\145\x61\163\x65\40\103\x68\141\x6e\x67\x65\40\x54\x68\x65\40\166\x65\162\163\x69\157\156\x20\x62\x61\143\153\40\x74\x6f\x20\x77\150\x61\164\x20\x69\164\40\162\x65\141\x6c\x6c\x79\x20\x77\141\x73");
        exit;
        goto WM;
        M8:
        return new \MoOauthClient\Enterprise\LoginHandler();
        goto WM;
        RS:
        return new \MoOauthClient\Premium\LoginHandler();
        goto WM;
        OI:
        return new \MoOauthClient\Standard\LoginHandler();
        goto WM;
        R0:
        return new \MoOauthClient\LoginHandler();
        WM:
    }
    public function get_settings_instance()
    {
        if (class_exists("\x4d\x6f\117\x61\165\x74\150\103\x6c\x69\x65\156\164\134\x45\x6e\164\x65\162\160\x72\x69\163\x65\134\x45\x6e\x74\x65\x72\160\x72\x69\x73\x65\x53\x65\x74\x74\x69\x6e\x67\163") && $this->utils->check_versi(4)) {
            goto xs;
        }
        if (class_exists("\x4d\157\117\141\165\164\x68\103\x6c\151\145\156\x74\x5c\120\x72\x65\x6d\151\165\155\x5c\120\162\145\155\x69\x75\155\x53\x65\164\164\x69\156\147\x73") && $this->utils->check_versi(2)) {
            goto af;
        }
        if (class_exists("\x4d\157\x4f\x61\165\x74\x68\x43\154\151\145\x6e\164\x5c\x53\164\x61\x6e\x64\141\162\144\134\x53\x74\141\156\144\x61\x72\x64\x53\145\x74\x74\151\156\147\163") && $this->utils->check_versi(1)) {
            goto u6;
        }
        if (class_exists("\x4d\157\117\141\x75\164\x68\x43\154\151\145\x6e\x74\134\x46\162\x65\145\x5c\x46\x72\145\x65\123\x65\x74\164\151\156\x67\x73") && $this->utils->check_versi(0)) {
            goto jx;
        }
        wp_die("\120\x6c\x65\x61\x73\x65\x20\x43\x68\x61\156\x67\145\40\x54\x68\145\x20\166\x65\x72\x73\x69\157\x6e\x20\142\x61\x63\153\x20\164\157\x20\167\x68\x61\x74\40\x69\x74\40\x72\x65\x61\x6c\x6c\x79\40\x77\x61\163");
        exit;
        goto Ma;
        xs:
        return new \MoOauthClient\Enterprise\EnterpriseSettings();
        goto Ma;
        af:
        return new \MoOauthClient\Premium\PremiumSettings();
        goto Ma;
        u6:
        return new \MoOauthClient\Standard\StandardSettings();
        goto Ma;
        jx:
        return new \MoOauthClient\Free\FreeSettings();
        Ma:
    }
    public function get_accounts_instance()
    {
        if (class_exists("\115\157\x4f\x61\x75\164\x68\103\154\151\x65\156\x74\x5c\120\x61\151\x64\x5c\101\x63\x63\157\165\156\164\163") && $this->utils->check_versi(1)) {
            goto jJ;
        }
        return new \MoOauthClient\Accounts();
        goto hi;
        jJ:
        return new \MoOauthClient\Paid\Accounts();
        hi:
    }
    public function get_subsite_settings()
    {
        if (class_exists("\x4d\x6f\117\141\x75\164\x68\103\154\x69\x65\156\164\134\x50\162\145\155\151\x75\x6d\134\x4d\x75\154\164\151\x73\x69\164\x65\123\145\x74\164\151\156\x67\x73") && $this->utils->is_multisite_versi(5)) {
            goto TC;
        }
        wp_die("\120\x6c\x65\141\x73\145\x20\x43\x68\141\156\147\x65\x20\124\x68\145\40\166\145\162\x73\151\x6f\x6e\x20\142\x61\143\153\40\x74\157\40\x77\150\141\164\40\x69\x74\x20\162\x65\x61\154\x6c\171\40\x77\141\163");
        exit;
        goto Wo;
        TC:
        return new \MoOauthClient\Premium\MultisiteSettings();
        Wo:
    }
    public function get_user_analytics()
    {
        if (class_exists("\115\157\117\141\x75\x74\150\x43\154\x69\145\x6e\164\x5c\105\x6e\x74\x65\162\160\x72\x69\163\x65\134\x55\x73\x65\162\101\156\141\x6c\x79\164\x69\x63\x73") && $this->utils->check_versi(4)) {
            goto x2;
        }
        wp_die("\x50\154\145\x61\163\145\x20\103\x68\x61\x6e\147\x65\x20\x54\x68\145\40\x76\145\x72\x73\151\157\156\x20\142\141\143\153\40\164\x6f\40\167\150\141\164\40\151\164\x20\162\x65\x61\x6c\154\x79\x20\x77\141\x73");
        exit;
        goto Cs;
        x2:
        return new \MoOauthClient\Enterprise\UserAnalytics();
        Cs:
    }
    public function get_utils_instance()
    {
        if (!(class_exists("\115\157\117\141\165\164\x68\103\154\151\x65\x6e\x74\x5c\123\164\x61\x6e\x64\x61\x72\144\134\115\x4f\125\x74\151\154\163") && $this->utils->check_versi(1))) {
            goto d6;
        }
        return new \MoOauthClient\Standard\MOUtils();
        d6:
        return $this->utils;
    }
}
