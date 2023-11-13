<?php


namespace MoOauthClient\Free;

use MoOauthClient\AppUI;
use MoOauthClient\App\UpdateAppUI;
use MoOauthClient\AppGuider;
class ClientAppUI
{
    private $common_app_ui;
    public function __construct()
    {
        $this->common_app_ui = new AppUI();
    }
    public function render_free_ui()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\151\x73\141\142\x6c\145\x64";
        if (empty($zB["\155\x6f\x5f\x64\x74\x65\x5f\x73\x74\141\x74\145"])) {
            goto w9;
        }
        $M9 = $lT->mooauthdecrypt($zB["\x6d\x6f\137\144\x74\x65\x5f\163\x74\141\164\145"]);
        w9:
        $Re = $this->common_app_ui->get_apps_list();
        if (!($M9 == "\144\x69\x73\141\142\x6c\145\x64")) {
            goto mu;
        }
        if (!(isset($_GET["\141\143\x74\151\x6f\x6e"]) && "\x64\145\154\x65\164\x65" === $_GET["\x61\x63\164\x69\157\156"])) {
            goto Vh;
        }
        if (!(isset($_GET["\141\x70\160"]) && check_admin_referer("\155\x6f\137\157\141\165\164\150\137\x64\145\x6c\145\164\145\x5f" . sanitize_text_field(wp_unslash($_GET["\x61\x70\160"]))))) {
            goto BW;
        }
        $this->common_app_ui->delete_app($_GET["\141\x70\x70"]);
        return;
        BW:
        Vh:
        mu:
        if (!(isset($_GET["\141\x63\x74\151\157\x6e"]) && "\x69\156\163\164\162\x75\x63\164\151\157\x6e\163" === $_GET["\141\x63\x74\151\157\156"] || isset($_GET["\x73\150\x6f\x77"]) && "\x69\x6e\x73\164\x72\x75\x63\x74\x69\x6f\156\163" === $_GET["\x73\150\x6f\x77"])) {
            goto VG;
        }
        if (!(isset($_GET["\141\x70\x70\111\144"]) && isset($_GET["\146\x6f\x72"]))) {
            goto Np;
        }
        $BH = new AppGuider($_GET["\141\x70\160\x49\144"], $_GET["\x66\157\162"]);
        $BH->show_guide();
        Np:
        if (!(isset($_GET["\163\x68\x6f\x77"]) && "\x69\156\163\164\x72\165\x63\164\151\x6f\156\x73" === $_GET["\163\x68\x6f\167"])) {
            goto AB;
        }
        $BH = new AppGuider($_GET["\141\x70\x70\x49\144"]);
        $BH->show_guide();
        $this->common_app_ui->add_app_ui();
        return;
        AB:
        VG:
        if (!(isset($_GET["\141\143\x74\151\x6f\x6e"]) && "\141\x64\144" === $_GET["\141\143\164\x69\157\x6e"])) {
            goto Mb;
        }
        $this->common_app_ui->add_app_ui();
        return;
        Mb:
        if (!(isset($_GET["\141\143\164\151\x6f\x6e"]) && "\165\x70\144\141\x74\145" === $_GET["\141\143\x74\x69\157\156"])) {
            goto vk;
        }
        if (!isset($_GET["\141\160\160"])) {
            goto Cw;
        }
        $kp = $this->common_app_ui->get_app_by_name($_GET["\x61\160\160"]);
        new UpdateAppUI($_GET["\x61\x70\160"], $kp);
        return;
        Cw:
        vk:
        if (!(isset($_GET["\141\x63\x74\x69\157\156"]) && "\141\144\x64\x5f\x6e\x65\x77" === $_GET["\x61\x63\x74\151\157\x6e"])) {
            goto zO;
        }
        $this->common_app_ui->add_app_ui();
        return;
        zO:
        if (!(is_array($Re) && count($Re) > 0)) {
            goto YG;
        }
        $this->common_app_ui->show_apps_list_page();
        return;
        YG:
        $this->common_app_ui->add_app_ui();
    }
}
