<?php


namespace MoOauthClient\Base;

use MoOauthClient\Backup;
use MoOauthClient\Support;
use MoOauthClient\Debug;
use MoOauthClient\MO_Oauth_Debug;
require_once "\x63\x6c\141\x73\163\x2d\x6c\x6f\141\144\x65\x72\x2e\x70\150\160";
class BaseStructure
{
    private $loader;
    public function __construct()
    {
        global $lT;
        $VU = is_multisite() && $lT->is_multisite_versi() ? "\x6e\145\164\x77\x6f\162\x6b\137" : '';
        add_action("{$VU}\141\x64\x6d\151\156\x5f\155\x65\x6e\165", array($this, "\141\144\155\x69\156\x5f\155\145\x6e\x75"));
        $this->loader = new Loader();
    }
    public function admin_menu()
    {
        $NY = add_menu_page("\x4d\x4f\x20\117\101\165\164\150\40\123\145\164\x74\151\x6e\x67\x73\40" . __("\103\157\x6e\146\x69\147\165\162\145\40\117\x41\165\x74\150", "\155\157\137\157\141\x75\x74\150\x5f\163\145\x74\x74\x69\156\x67\x73"), "\x6d\151\x6e\151\117\x72\141\156\147\145\40\117\101\165\x74\x68", "\x61\x64\x6d\x69\156\x69\163\164\x72\x61\x74\x6f\162", "\x6d\157\x5f\x6f\141\x75\164\x68\x5f\x73\145\164\x74\151\156\147\163", array($this, "\x6d\x65\156\x75\137\157\160\164\151\157\x6e\x73"), MOC_URL . "\162\x65\163\157\x75\162\x63\x65\163\57\x69\155\x61\147\x65\163\57\x6d\x69\x6e\151\x6f\x72\x61\x6e\x67\145\x2e\x70\156\x67");
        $NY = add_submenu_page("\155\157\137\x6f\x61\165\164\x68\x5f\163\145\x74\x74\x69\x6e\x67\x73", "\155\151\x6e\x69\117\162\141\x6e\x67\145\40\x4f\101\x75\x74\x68", __("\x3c\x64\x69\x76\x20\x69\144\75\42\155\157\137\x6f\x61\x75\x74\150\x5f\141\x64\144\157\156\163\137\x73\x75\x62\155\145\156\165\42\x3e\x41\144\x64\55\x4f\x6e\x73\x3c\x2f\144\151\166\x3e", "\x6d\x69\156\x69\157\x72\x61\x6e\147\x65\55\x6f\x61\165\x74\150\55\157\x69\144\143\x2d\163\151\x6e\x67\154\x65\x2d\163\x69\147\x6e\x2d\157\x6e"), "\x6d\x61\156\141\x67\x65\137\x6f\160\x74\x69\157\156\x73", "\x6d\x6f\137\157\141\165\164\150\137\x73\145\164\164\x69\156\147\x73\x26\164\141\x62\75\x61\x64\144\x6f\156\x73", array($this, "\x6d\x65\156\165\x5f\x6f\160\164\151\157\156\163"));
        global $LS;
        if (!(is_array($LS) && isset($LS["\x6d\x6f\x5f\157\141\x75\x74\150\137\163\x65\164\x74\151\x6e\147\x73"]))) {
            goto K2;
        }
        $LS["\x6d\157\137\157\141\x75\x74\x68\x5f\163\x65\164\x74\x69\156\147\163"][0][0] = __("\x43\157\x6e\146\x69\x67\165\162\x65\40\117\101\165\x74\x68", "\x6d\x6f\x5f\157\x61\165\164\150\137\154\157\147\151\156");
        K2:
    }
    public function menu_options()
    {
        $fC = isset($_GET["\164\141\142"]) ? $_GET["\164\x61\x62"] : '';
        echo "\x9\x9\74\144\151\x76\40\x69\x64\x3d\x22\155\x6f\x5f\x6f\x61\x75\164\150\137\x73\145\164\x74\x69\x6e\x67\x73\42\x3e\12\x9\x9\11\74\144\151\x76\x20\x69\x64\75\47\x6d\157\x62\x6c\x6f\143\x6b\x27\40\x63\x6c\141\163\x73\75\x27\x6d\x6f\x63\55\x6f\x76\x65\162\x6c\x61\171\x20\144\141\x73\x68\x62\157\141\162\x64\47\76\74\x2f\144\151\x76\76\xa\x9\11\x9\x3c\144\151\166\x20\143\154\141\163\163\x3d\x22\155\151\156\x69\157\x72\x61\156\147\145\x5f\143\157\156\164\141\151\x6e\145\162\x22\x3e\12\11\x9\x9\11";
        $this->content_navbar($fC);
        echo "\11\x9\x9\11\x3c\x74\x61\142\x6c\x65\40\x73\x74\x79\x6c\x65\x3d\42\x77\151\144\x74\150\x3a\61\x30\60\45\x3b\x22\x3e\xa\x9\x9\11\11\x9\x3c\164\162\x3e\xa\x9\11\11\11\x9\x9\x3c\164\144\40\163\x74\x79\154\145\75\x22\x76\x65\162\x74\x69\143\141\154\x2d\141\154\151\x67\156\x3a\164\x6f\x70\x3b\x77\151\144\x74\x68\x3a\66\65\45\x3b\x22\x20\143\x6c\141\163\x73\x3d\x22\155\157\137\157\141\x75\x74\x68\137\143\x6f\x6e\164\145\156\164\42\x3e\12\11\x9\x9\11\x9\x9\x9";
        $this->loader->load_current_tab($fC);
        echo "\x9\11\11\11\11\x9\x3c\57\x74\x64\76\xa\11\11\x9\x9\x9\x9";
        if (!("\154\x69\143\x65\156\163\x69\156\147" !== $fC && "\141\144\144\x6f\x6e\163" !== $fC)) {
            goto UF;
        }
        echo "\x9\11\x9\x9\x9\x9\x9\x3c\x74\x64\40\x73\x74\171\154\x65\x3d\x22\x76\x65\162\164\151\143\x61\x6c\x2d\141\154\151\147\156\72\x74\157\x70\73\160\141\x64\x64\151\156\147\x2d\154\145\146\164\72\61\45\73\42\40\143\x6c\141\x73\163\x3d\42\155\157\137\157\141\x75\164\x68\x5f\x73\x69\144\145\x62\141\x72\42\x3e\xa\x9\x9\11\11\11\x9\x9";
        $y_ = new Support();
        $y_->support();
        echo "\40\x20\x20\40\40\x20\40\40\40\40\x20\x20\40\x20\40\40\x20\x20\40\40\x20\40\40\x20\40\40\40\40\x3c\142\162\x3e\xa\x20\x20\x20\x20\x20\40\x20\x20\x20\40\40\x20\40\x20\40\40\x20\x20\x20\40\40\40\40\x20\x20\40\40\40\74\142\162\x3e\12\40\x20\x20\x20\x20\x20\x20\40\x20\x20\40\x20\x20\40\x9\11\11\11";
        $xM = new Debug();
        $xM->debug();
        echo "\40\40\40\x20\40\40\40\40\x20\x20\x20\x20\x20\x20\x20\x20\40\40\x20\x20\x20\40\40\40\x20\x20\40\x20";
        $yD = new Backup();
        $yD->backup();
        echo "\11\11\x9\x9\x9\x9\11\x3c\x2f\x74\x64\x3e\12\x9\x9\x9\x9\11\11";
        UF:
        echo "\x9\x9\x9\x9\x9\74\x2f\164\162\76\12\x9\11\11\11\74\57\164\141\142\154\x65\x3e\12\11\11\11\x3c\57\144\x69\166\76\xa\xa\x9\11\x3c\x2f\x64\151\166\x3e\xa\x9\x9";
    }
    public function logfile_delete()
    {
        global $lT;
        $wC = dirname(__DIR__) . DIRECTORY_SEPARATOR . "\x4f\101\165\x74\x68\110\141\156\x64\x6c\145\x72" . DIRECTORY_SEPARATOR . $lT->mo_oauth_client_get_option("\155\x6f\137\x6f\141\165\x74\150\x5f\144\x65\x62\165\x67") . "\56\154\157\147";
        if (!file_exists($wC)) {
            goto we;
        }
        unlink($wC);
        we:
    }
    public function content_navbar($fC)
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\144\x69\x73\x61\142\x6c\x65\144";
        if (empty($zB["\155\157\137\x64\164\145\137\x73\164\141\164\145"])) {
            goto RQ;
        }
        $M9 = $lT->mooauthdecrypt($zB["\x6d\157\137\x64\x74\145\137\163\164\x61\x74\x65"]);
        RQ:
        if (!$lT->mo_oauth_client_get_option("\155\157\137\144\x65\x62\165\x67\137\x63\x68\145\143\153")) {
            goto Zm;
        }
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\144\x65\142\x75\x67\x5f\143\150\x65\143\x6b", 0);
        Zm:
        $DR = dirname(__DIR__) . DIRECTORY_SEPARATOR . "\x4f\101\x75\164\150\110\141\x6e\x64\x6c\x65\162" . DIRECTORY_SEPARATOR . $lT->mo_oauth_client_get_option("\155\x6f\137\x6f\141\165\164\150\137\144\145\x62\x75\147") . "\56\154\157\147";
        $T3 = $lT->mo_oauth_client_get_option("\155\x6f\137\144\145\x62\x75\147\x5f\x65\156\141\x62\x6c\145");
        $kU = $lT->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\164\x68\x5f\x64\x65\x62\x75\147");
        if ($T3) {
            goto jO;
        }
        $this->logfile_delete();
        $lT->mo_oauth_client_delete_option("\x6d\x6f\137\157\141\x75\x74\150\137\144\145\142\x75\147");
        goto Mk;
        jO:
        $HH = 604800;
        $bW = $lT->mo_oauth_client_get_option("\155\x6f\137\x64\x65\142\165\x67\x5f\164\151\155\145");
        $Br = current_time("\164\151\155\145\x73\164\141\155\160");
        $rP = (int) (($Br - $bW) / $HH);
        if (!($rP >= 1)) {
            goto Z1;
        }
        $lT->mo_oauth_client_update_option("\155\157\x5f\x64\145\x62\x75\x67\x5f\164\x69\x6d\x65", $bW + $rP * $HH);
        $lT->mo_oauth_client_update_option("\155\157\137\x64\x65\x62\165\147\x5f\x65\x6e\x61\x62\154\145", 0);
        $this->logfile_delete();
        $lT->mo_oauth_client_delete_option("\155\x6f\x5f\157\x61\x75\164\x68\x5f\x64\x65\x62\x75\147");
        Z1:
        Mk:
        if (!($T3 && !$kU || $T3 && !file_exists($DR))) {
            goto NM;
        }
        $lT->mo_oauth_client_update_option("\155\157\137\x6f\141\x75\164\x68\137\x64\145\142\165\x67", "\155\x6f\137\157\x61\x75\x74\150\x5f\x64\x65\x62\165\x67" . uniqid());
        $H9 = $lT->mo_oauth_client_get_option("\155\x6f\137\157\141\x75\164\150\137\x64\145\x62\x75\x67");
        $hl = dirname(__DIR__) . DIRECTORY_SEPARATOR . "\117\x41\165\x74\150\110\x61\156\x64\x6c\x65\162" . DIRECTORY_SEPARATOR . $H9 . "\x2e\154\x6f\x67";
        $JC = fopen($hl, "\167");
        chmod($hl, 0644);
        $lT->mo_oauth_client_update_option("\155\x6f\x5f\x64\x65\142\165\x67\x5f\x63\150\x65\143\x6b", 1);
        MO_Oauth_Debug::mo_oauth_log('');
        $lT->mo_oauth_client_update_option("\155\157\x5f\x64\145\x62\165\x67\x5f\143\x68\145\x63\x6b", 0);
        NM:
        echo "\11\11\x3c\144\x69\x76\40\x63\154\141\x73\163\x3d\42\167\162\141\160\42\x3e\12\11\11\x9\x3c\x64\x69\x76\x20\143\x6c\141\x73\x73\x3d\42\x68\145\x61\x64\x65\162\x2d\167\x61\x72\160\42\76\xa\x9\11\x9\x9";
        if (!($fC != "\154\151\x63\x65\x6e\x73\151\x6e\147")) {
            goto KY;
        }
        echo "\11\11\11\x9\x3c\x68\x31\x3e\155\151\156\151\117\162\141\156\x67\x65\x20\x4f\101\x75\x74\x68\x2f\x4f\160\145\x6e\x49\x44\x20\x43\x6f\156\x6e\145\143\164\x20\x53\x69\x6e\147\x6c\x65\40\123\151\147\156\x20\117\x6e\xa\x9\x9\11\x9\46\x65\x6d\x73\160\73\74\x61\40\151\x64\x3d\42\154\151\143\145\x6e\163\x69\x6e\x67\x5f\142\165\x74\164\157\156\x5f\151\x64\42\40\143\154\141\163\163\75\42\154\151\x6e\153\137\x62\x75\164\x74\x6f\x6e\x20\164\157\160\137\154\x69\x63\145\156\163\x65\42\40\150\x72\145\x66\75\x22\x61\144\155\151\x6e\56\x70\x68\x70\x3f\160\x61\147\x65\75\155\x6f\x5f\157\x61\x75\x74\x68\x5f\163\145\x74\164\151\x6e\147\163\46\164\x61\x62\x3d\154\x69\143\x65\156\x73\151\x6e\147\x22\x3e\x50\162\x65\x6d\x69\165\x6d\40\x50\x6c\141\x6e\163\x3c\57\x61\x3e\xa\11\11\11\x9\x26\156\142\x73\160\x3b\74\141\x20\151\x64\75\42\146\x61\161\x5f\142\x75\164\164\157\156\x5f\x69\x64\x22\40\x63\154\x61\x73\x73\75\x22\x6c\x69\x6e\x6b\137\x62\165\x74\x74\157\x6e\42\40\150\162\x65\146\75\x22\150\164\x74\160\x73\x3a\57\57\146\141\161\x2e\x6d\x69\x6e\x69\157\162\141\156\x67\145\x2e\143\x6f\x6d\57\x6b\142\57\x6f\141\x75\164\x68\55\x6f\x70\x65\156\x69\144\55\143\157\x6e\156\x65\x63\164\57\x22\40\164\141\x72\147\145\164\75\x22\x5f\142\154\x61\x6e\153\x22\76\x46\x41\121\x73\74\x2f\x61\x3e\12\x9\x9\x9\11\x26\x6e\x62\163\160\x3b\x3c\x61\40\151\144\75\x22\146\x61\x71\x5f\142\x75\x74\x74\157\x6e\137\x69\x64\42\x20\143\154\141\163\x73\75\42\154\151\156\x6b\137\x62\x75\164\164\x6f\x6e\x22\x20\x68\162\x65\x66\75\x22\x68\x74\164\x70\x73\72\x2f\x2f\x66\157\162\x75\x6d\x2e\x6d\x69\x6e\x69\157\x72\x61\x6e\x67\x65\x2e\143\x6f\155\x2f\x22\40\164\141\x72\x67\145\164\x3d\x22\137\142\x6c\141\156\x6b\42\76\101\163\153\x20\161\x75\145\x73\164\151\x6f\156\163\40\x6f\156\x20\157\165\x72\40\x66\x6f\162\165\x6d\74\x2f\141\x3e\12\40\40\x20\40\40\x20\40\x20\40\x20\40\40\x20\40\x20\x20\x20\x20\40\x20\x3c\x61\x20\151\x64\75\42\x66\x65\x61\164\165\162\x65\x73\x5f\x62\x75\x74\164\x6f\156\137\x69\x64\x22\40\x63\x6c\141\x73\x73\x3d\42\x6c\151\x6e\x6b\x5f\x62\x75\x74\x74\x6f\156\x22\x20\x68\x72\145\146\x3d\42\x68\164\x74\x70\x73\x3a\57\57\144\x65\x76\145\154\x6f\x70\x65\x72\x73\56\155\x69\x6e\151\x6f\162\141\156\147\145\x2e\x63\157\x6d\x2f\x64\157\143\x73\57\157\141\165\x74\x68\57\167\157\x72\144\160\162\x65\x73\x73\x2f\x63\154\x69\145\x6e\164\42\x20\164\x61\162\147\x65\x74\x3d\42\x5f\142\154\141\156\x6b\x22\76\x46\x65\x61\164\165\x72\x65\40\x44\145\164\x61\151\154\x73\74\57\141\x3e\xa\40\x20\40\40\x20\x20\40\x20\40\x20\x20\x20\40\x20\40\40\x3c\x2f\x68\61\x3e\12\x20\40\x20\40\x20\40\x20\x20\40\40\x20\40\40\40\40\x20";
        if (!("\x61\144\144\x6f\x6e\163" == $fC)) {
            goto XY;
        }
        echo "\74\x73\143\x72\151\x70\x74\x20\164\x79\x70\x65\75\x27\164\x65\170\x74\57\x6a\x61\x76\x61\163\x63\162\x69\x70\164\x27\76\12\40\x20\x20\40\x20\x20\x20\x20\40\x20\40\40\x20\40\x20\x20\11\x6a\121\165\x65\162\x79\x28\144\157\x63\165\155\145\156\164\51\56\x72\145\x61\x64\x79\x28\146\x75\x6e\143\164\151\157\x6e\50\51\xa\x20\40\40\40\x20\40\40\40\x20\x20\40\x20\40\40\x20\x20\x9\173\xa\x20\40\x20\40\40\x20\x20\40\40\x20\x20\40\x20\40\40\x20\11\x9\x6a\x51\165\145\x72\171\50\x27\43\x6d\157\x5f\157\141\165\164\150\137\141\144\144\x6f\x6e\163\x5f\x73\x75\x62\x6d\x65\156\165\47\51\56\160\x61\162\x65\156\x74\50\x29\56\x70\141\x72\x65\156\x74\x28\x29\56\160\x61\x72\x65\x6e\x74\50\51\56\146\151\156\144\50\47\x6c\151\x27\x29\x2e\x72\145\155\x6f\166\x65\103\154\141\163\x73\x28\47\143\x75\162\x72\145\x6e\x74\x27\x29\x3b\12\x20\40\x20\x20\40\40\40\x20\x20\x20\40\40\x20\40\x20\40\x9\x9\x6a\121\x75\145\x72\171\50\x27\43\155\x6f\x5f\x6f\141\165\164\150\x5f\141\144\144\157\156\x73\x5f\x73\165\142\155\145\156\x75\47\x29\x2e\160\x61\x72\145\x6e\164\50\51\x2e\x70\x61\162\145\x6e\164\50\x29\56\x61\x64\144\x43\x6c\x61\163\163\x28\47\143\165\162\x72\145\x6e\164\47\51\73\xa\40\x20\40\x20\40\40\x20\40\40\x20\40\x20\40\40\40\40\11\175\x29\73\12\x20\40\40\40\40\40\40\40\40\40\40\40\x20\40\40\40\x9\x3c\x2f\x73\x63\162\151\160\164\76";
        echo "\x9\11\11\11\x3c\150\61\x3e\74\x64\151\x76\40\x73\164\171\154\145\75\42\x66\154\157\141\164\72\154\x65\x66\x74\73\x20\x6d\141\x72\147\x69\156\55\162\151\147\x68\x74\72\40\x35\x70\x78\x3b\x22\x3e\x3c\x61\40\x20\x63\x6c\141\163\x73\x3d\x22\141\144\x64\55\156\145\167\55\x68\62\42\40\163\164\x79\x6c\x65\75\x22\x66\x6f\156\164\55\163\x69\x7a\x65\x3a\40\61\x34\160\170\73\42\40\x68\162\145\146\75\42\x61\144\155\151\x6e\56\160\150\160\77\x70\141\147\x65\x3d\155\157\x5f\x6f\141\165\164\150\x5f\x73\x65\x74\164\x69\x6e\x67\163\46\164\x61\x62\75\x63\x6f\156\x66\151\x67\x22\x3e\74\163\160\141\x6e\x20\x63\154\x61\163\x73\x3d\42\144\x61\163\150\x69\x63\x6f\x6e\163\x20\144\141\x73\150\151\x63\x6f\156\x73\x2d\x61\x72\162\157\x77\x2d\154\x65\146\164\x2d\x61\x6c\164\42\40\x73\164\171\x6c\x65\x3d\x22\166\145\162\164\151\x63\x61\154\55\x61\x6c\x69\x67\x6e\x3a\x20\142\157\x74\x74\157\155\x3b\x22\76\74\57\x73\160\x61\156\x3e\x20\x42\x61\x63\153\x20\x54\x6f\40\120\x6c\x75\x67\151\x6e\x20\103\157\x6e\146\151\x67\x75\x72\x61\x74\151\157\x6e\74\57\x61\x3e\74\57\144\x69\x76\x3e\x3c\57\x68\x31\76\40";
        XY:
        echo "\11\x9\x9\11\12\11\x9\x9\11";
        if (!("\x61\x64\144\x6f\156\x73" !== $fC)) {
            goto nb;
        }
        if (!($lT->mo_oauth_is_clv() && $M9 == "\x65\x6e\141\x62\x6c\145\x64")) {
            goto Dr;
        }
        echo "\x9\x9\11\x9\11\11\74\x64\x69\166\40\x69\x64\75\x22\x6d\x65\163\163\141\x67\145\x22\40\x73\x74\x79\154\145\x3d\x22\142\141\143\153\147\162\x6f\165\156\x64\x3a\43\146\146\x65\70\x65\70\73\40\142\157\x72\144\x65\162\55\x72\x61\x64\x69\165\163\72\x34\x70\x78\x3b\x20\146\x6f\156\164\55\163\x69\172\145\72\x31\63\160\170\x3b\x20\142\x6f\162\144\145\x72\x3a\x20\61\x70\x78\x20\163\x6f\x6c\x69\x64\40\x72\145\144\42\x20\40\x63\x6c\x61\163\x73\75\42\156\x6f\164\x69\143\145\x20\x6e\x6f\x74\x69\143\x65\x20\156\x6f\x74\151\143\x65\55\167\x61\162\156\x69\x6e\147\42\76\x3c\x70\x20\163\164\171\154\145\40\x3d\x20\x22\x66\x6f\156\164\55\163\151\172\145\x3a\61\x34\x70\170\x3b\x20\146\157\156\164\x2d\x77\x65\x69\x67\150\x74\72\x20\65\x30\x30\73\42\76\x20\74\142\40\x73\164\171\x6c\x65\x20\75\x20\x22\x20\x66\157\156\164\55\167\x65\x69\147\150\x74\x3a\40\x37\60\x30\x3b\x22\x3e\40\x4e\117\x54\105\x3a\40\74\57\x62\x3e\40\131\x6f\165\x72\x20\155\151\156\151\x4f\162\x61\x6e\147\x65\x20\74\141\40\x68\162\145\146\x3d\42\150\x74\164\x70\x73\72\x2f\x2f\x70\154\x75\x67\151\156\163\56\155\x69\156\x69\157\x72\141\156\x67\x65\x2e\x63\x6f\155\57\x77\x6f\x72\144\160\x72\145\x73\163\55\163\x73\157\42\x20\x74\x61\162\147\x65\x74\x3d\42\137\142\x6c\141\156\153\42\76\x4f\x41\x75\x74\150\40\x2f\x20\117\x70\145\156\111\x44\40\x43\157\156\x6e\145\x63\x74\x20\x53\x69\156\x67\x6c\145\40\123\x69\147\156\x2d\x4f\156\x3c\57\x61\76\40\x70\162\145\155\151\165\155\40\x6c\x69\x63\145\x6e\163\x65\x20\151\x73\40\145\170\x70\151\x72\145\144\x2e\x20\124\x68\x69\x73\40\x6d\x65\141\x6e\x73\40\x79\x6f\165\x20\143\141\156\156\x6f\164\40\x61\x64\x64\40\x6f\x72\40\145\144\x69\164\x20\164\150\x65\40\x61\x70\160\154\151\x63\x61\164\x69\157\x6e\163\40\x75\156\x74\151\154\x6c\40\171\157\165\162\x20\x70\x6c\x61\x6e\x20\151\163\40\162\145\156\145\167\x65\144\56\x3c\x2f\x70\x3e\12\11\11\x9\x9\x9";
        Dr:
        echo "\12\11\x9\11\x9\x3c\x64\x69\166\76\x3c\x69\x6d\x67\x20\x73\x74\x79\154\x65\75\x22\146\154\x6f\x61\164\72\154\145\146\164\73\40\x70\157\x73\x69\x74\x69\x6f\x6e\72\x72\145\154\x61\x74\151\x76\145\73\x20\155\141\162\x67\x69\156\72\61\64\160\170\40\x30\160\x78\40\x30\x70\x78\x20\55\61\64\x70\170\73\x22\x20\x73\x72\143\75\42";
        echo MOC_URL . "\57\162\x65\x73\x6f\x75\162\143\x65\x73\x2f\x69\x6d\141\x67\145\163\57\x6c\157\x67\157\56\160\x6e\x67";
        echo "\x22\x3e\74\x2f\144\151\166\76\12\x9\11\x9\x9";
        if (!($lT->get_versi() === 0)) {
            goto Cj;
        }
        echo "\x9\x9\x9\x9\x9\74\144\151\x76\40\x63\154\141\163\163\75\42\142\x75\x74\x73\42\x20\x73\x74\x79\154\145\x3d\x22\146\154\157\x61\164\x3a\162\x69\147\x68\x74\73\42\76\xa\11\x9\x9\x9\11\x9\74\144\x69\x76\x20\151\x64\75\42\x72\x65\163\164\141\x72\164\x5f\164\157\165\x72\137\142\x75\164\164\x6f\156\42\x20\x63\x6c\x61\x73\x73\x3d\42\155\x6f\x2d\x6f\x74\x70\55\150\145\x6c\x70\55\142\x75\164\x74\x6f\156\x20\x73\x74\141\164\x69\x63\42\40\163\164\171\154\x65\75\42\155\x61\162\147\x69\156\x2d\162\151\147\x68\x74\x3a\61\x30\x70\170\73\172\55\151\x6e\x64\145\170\x3a\61\60\42\x3e\xa\x9\11\x9\x9\11\x9\11\11\74\141\x20\143\154\141\163\x73\75\x22\142\165\164\164\x6f\156\x20\142\x75\164\164\x6f\156\55\x70\x72\x69\x6d\141\x72\x79\x20\x62\165\164\x74\x6f\156\55\x6c\x61\162\x67\x65\x22\x3e\12\x9\11\11\11\11\11\x9\x9\x9\x3c\x73\160\x61\x6e\x20\x63\x6c\141\x73\x73\x3d\x22\x64\x61\x73\x68\151\143\x6f\x6e\163\x20\x64\141\x73\150\x69\x63\x6f\156\163\55\143\157\156\164\162\x6f\x6c\x73\x2d\x72\x65\x70\x65\141\164\42\40\x73\x74\x79\154\x65\x3d\42\155\x61\162\x67\x69\x6e\x3a\65\45\x20\60\x20\60\x20\x30\73\x22\76\x3c\57\163\160\x61\156\x3e\12\11\x9\11\11\11\x9\11\11\x9\11\x52\x65\x73\164\141\162\x74\x20\124\157\x75\x72\xa\x9\x9\x9\11\11\11\11\x9\74\57\x61\x3e\xa\x9\11\x9\11\11\x9\74\x2f\x64\151\166\76\12\x9\11\11\x9\x9\74\57\144\x69\x76\76\12\11\x9\x9\x9";
        Cj:
        echo "\x9\x9\x3c\x2f\x64\x69\x76\76\11\11\12\x9\x9\x9\x3c\144\151\x76\x20\x69\144\x3d\x22\x74\141\142\42\40\x73\164\x79\x6c\145\75\42\155\141\162\x67\151\x6e\x3a\x31\x36\x70\x78\42\76\xa\x9\x9\11\x3c\x68\62\x20\143\154\x61\163\x73\x3d\x22\x6e\x61\x76\x2d\x74\141\142\x2d\167\x72\141\x70\160\145\162\42\76\12\11\x9\11\11\74\x61\x20\151\x64\75\x22\164\141\142\x2d\x63\157\156\146\x69\147\x22\40\x63\154\x61\163\163\x3d\42\x6e\141\x76\55\x74\x61\x62\40";
        echo "\x63\157\x6e\x66\151\x67" === $fC ? "\156\141\166\x2d\164\141\x62\x2d\x61\x63\x74\151\x76\145" : '';
        echo "\x22\40\150\x72\x65\x66\75\x22\141\144\x6d\x69\x6e\56\160\x68\x70\x3f\160\x61\x67\145\75\155\x6f\x5f\157\141\165\164\x68\x5f\163\x65\x74\x74\151\156\x67\x73\46\x74\x61\142\x3d\x63\157\156\x66\151\147\x22\76\103\157\156\146\151\147\x75\x72\145\x20\117\x41\x75\x74\x68\74\57\x61\x3e\12\x9\x9\11\11\x3c\141\x20\x69\x64\x3d\x22\164\141\x62\55\143\x75\163\164\157\155\151\172\x61\x74\x69\157\156\42\40\143\154\x61\163\x73\75\42\x6e\141\166\x2d\164\x61\142\40";
        echo "\x63\165\163\x74\x6f\155\x69\172\141\x74\151\x6f\156" === $fC ? "\156\x61\x76\x2d\x74\x61\x62\x2d\x61\143\164\151\166\x65" : '';
        echo "\42\40\150\x72\x65\x66\75\x22\141\144\155\x69\x6e\56\160\150\160\77\x70\x61\147\145\x3d\x6d\x6f\x5f\157\141\x75\x74\150\137\163\145\x74\x74\x69\x6e\147\163\x26\x74\x61\x62\75\143\x75\163\164\157\x6d\151\x7a\x61\164\x69\x6f\x6e\42\x3e\103\165\163\x74\x6f\155\151\172\x61\x74\151\x6f\156\163\74\57\x61\76\xa\x9\11\x9\11";
        if (!($lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\164\x68\x5f\x65\166\x65\x6f\156\154\x69\156\x65\x5f\145\156\141\142\x6c\145") === 1)) {
            goto Tx;
        }
        echo "\x9\x9\x9\x9\11\74\141\x20\x69\x64\x3d\42\x74\141\142\x2d\145\166\x65\x22\40\143\x6c\141\x73\163\75\42\x6e\141\166\55\x74\141\142\x20";
        echo "\155\157\137\157\141\x75\164\150\x5f\x65\x76\145\x5f\157\x6e\154\151\x6e\x65\x5f\163\x65\164\x75\160" === $fC ? "\156\x61\166\x2d\164\x61\142\x2d\x61\x63\x74\151\166\145" : '';
        echo "\x22\x20\150\x72\x65\146\75\42\x61\x64\x6d\x69\156\x2e\x70\150\x70\x3f\x70\x61\x67\145\75\155\157\x5f\157\141\165\x74\x68\x5f\x65\166\x65\137\x6f\156\154\x69\x6e\x65\x5f\163\145\164\165\x70\42\76\x41\144\166\141\156\x63\145\x64\x20\105\126\105\40\x4f\x6e\154\x69\x6e\x65\x20\123\x65\164\164\x69\x6e\x67\163\x3c\57\141\x3e\xa\11\x9\11\x9";
        Tx:
        echo "\x9\11\x9\11\x3c\x61\40\x69\144\x3d\x22\x74\x61\x62\x2d\163\x69\x67\156\x69\156\163\x65\164\x74\x69\156\x67\x73\x22\x20\x63\x6c\x61\163\x73\75\42\x6e\x61\x76\55\x74\141\142\x20";
        echo "\x73\151\x67\156\151\x6e\163\145\164\164\151\156\x67\163" === $fC ? "\x6e\x61\x76\55\164\x61\142\x2d\x61\143\x74\151\166\145" : '';
        echo "\x22\x20\150\162\x65\146\x3d\42\141\x64\155\x69\x6e\56\x70\150\160\77\160\141\x67\145\75\155\x6f\x5f\x6f\x61\x75\x74\x68\x5f\x73\x65\x74\x74\x69\x6e\x67\163\46\164\x61\142\x3d\163\151\147\x6e\151\x6e\x73\145\x74\164\x69\156\147\163\x22\76\123\x69\x67\x6e\x20\x49\x6e\x20\x53\x65\164\x74\x69\156\x67\x73\74\x2f\141\x3e\12\x9\11\x9\x9";
        do_action("\155\157\x5f\x6f\x61\165\x74\150\137\x63\x6c\151\x65\156\164\x5f\141\x64\x64\x5f\x6e\141\166\x5f\x74\141\x62\x73\x5f\x75\x69\x5f\x69\156\x74\x65\162\x6e\141\x6c", $fC);
        echo "\x9\x9\x9\x9";
        if (!(is_multisite() && $lT->is_multisite_plan())) {
            goto P2;
        }
        do_action("\155\x6f\x5f\157\x61\165\x74\150\137\x63\154\151\145\x6e\x74\x5f\141\x64\x64\137\156\x61\166\x5f\164\x61\142\x73\x5f\x6d\x75\x6c\x74\151\163\x69\x74\x65\137\x75\x69\x5f\x69\156\164\x65\162\156\141\x6c", $fC);
        P2:
        echo "\11\x9\x9\x9";
        if (!($lT->get_versi() === 0)) {
            goto R9;
        }
        echo "\x9\11\x9\x9\x9\74\141\40\x69\144\75\x22\164\141\x62\55\x72\145\x71\x75\145\163\164\x64\x65\155\157\42\40\x63\x6c\x61\x73\163\x3d\42\x6e\x61\x76\55\164\x61\142\40";
        echo "\162\145\x71\165\x65\x73\x74\x66\157\x72\x64\x65\155\x6f" === $fC ? "\156\x61\x76\x2d\x74\141\x62\55\141\x63\164\x69\x76\x65" : '';
        echo "\x22\40\150\162\x65\x66\x3d\x22\141\144\155\x69\156\x2e\160\150\x70\77\160\141\x67\145\75\155\157\137\x6f\141\165\164\x68\137\163\x65\164\164\x69\x6e\147\x73\46\x74\x61\142\x3d\162\x65\161\165\x65\163\164\146\x6f\x72\144\x65\x6d\157\x22\76\122\x65\161\x75\145\163\x74\x20\106\157\162\x20\x44\145\x6d\x6f\x3c\x2f\141\x3e\12\11\11\11\x9";
        R9:
        echo "\11\11\11\11\74\x61\x20\x69\x64\75\42\x61\x63\143\137\x73\145\164\x75\x70\x5f\x62\x75\x74\x74\x6f\x6e\137\x69\144\42\40\x63\154\x61\x73\163\x3d\42\156\141\166\x2d\164\x61\142\x20";
        echo "\x61\x63\x63\x6f\165\x6e\x74" === $fC ? "\x6e\141\166\x2d\164\x61\x62\x2d\x61\x63\164\x69\166\x65" : '';
        echo "\42\40\x68\x72\x65\x66\75\x22\141\144\155\x69\156\56\160\x68\x70\77\160\x61\147\145\x3d\x6d\157\x5f\157\141\x75\x74\x68\x5f\x73\x65\164\164\x69\156\x67\x73\46\164\141\142\75\x61\x63\x63\x6f\x75\156\164\x22\x3e\x41\143\x63\157\x75\x6e\x74\40\x53\x65\164\x75\160\74\57\141\x3e\12\11\11\11\x3c\x2f\150\x32\x3e\12\11\x9\11\74\57\144\x69\166\76\xa\x9\11\11";
        nb:
        KY:
        if (!("\154\151\143\145\156\163\x69\156\147" === $fC)) {
            goto Fz;
        }
        echo "\11\11\11\x9\x3c\x64\x69\x76\40\x73\164\171\154\x65\x3d\x22\x62\141\x63\153\x67\162\157\x75\x6e\x64\55\143\157\x6c\x6f\x72\x3a\x23\146\x39\146\71\x66\71\73\x20\40\x64\151\x73\160\x6c\141\171\x3a\146\154\x65\x78\x3b\x20\x6a\x75\x73\164\x69\146\171\55\x63\157\x6e\x74\145\156\x74\72\143\x65\156\x74\x65\x72\73\x20\160\141\x64\144\x69\156\147\x2d\142\157\164\164\x6f\x6d\72\67\x70\x78\x3b\x70\x61\144\x64\151\156\147\55\164\157\x70\x3a\63\x35\160\170\x3b\42\x20\151\144\75\42\156\141\166\55\143\x6f\156\x74\141\x69\156\x65\162\x22\x3e\12\x20\x20\x20\x20\x20\x20\40\40\40\40\x20\x20\74\144\151\x76\76\xa\x20\40\40\x20\x20\40\40\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3c\x61\40\163\x74\x79\x6c\x65\75\42\x66\x6f\x6e\x74\55\x73\x69\172\x65\72\x20\61\66\160\x78\x3b\40\143\x6f\x6c\x6f\162\72\x20\43\x30\60\60\73\x74\x65\x78\x74\55\x61\154\x69\147\156\72\x20\x63\145\x6e\x74\x65\x72\73\x74\x65\170\x74\55\144\145\x63\x6f\162\x61\164\151\157\156\72\x20\156\x6f\156\x65\x3b\144\x69\163\x70\154\141\171\72\40\x69\x6e\154\151\x6e\145\55\142\154\x6f\x63\153\73\x22\40\150\x72\145\x66\x3d\42";
        echo add_query_arg(array("\x74\x61\142" => "\x64\145\146\x61\165\x6c\164"), htmlentities($_SERVER["\122\105\121\125\105\123\124\137\125\122\111"]));
        echo "\x22\76\xa\40\x20\40\40\40\x20\40\x20\40\40\x20\x20\40\40\x20\40\40\x20\40\40\x3c\x62\x75\x74\x74\x6f\x6e\x20\x69\144\75\x22\x42\x61\x63\153\x2d\x54\x6f\55\x50\x6c\165\147\x69\156\55\103\x6f\156\x66\x69\147\x75\x72\141\164\x69\157\x6e\42\40\164\x79\x70\x65\x3d\42\142\x75\164\164\157\156\42\x20\166\x61\x6c\x75\145\x3d\42\x42\141\x63\x6b\x2d\x54\157\55\120\154\165\x67\x69\x6e\55\x43\157\156\146\151\x67\165\162\141\164\151\x6f\x6e\42\40\x63\x6c\x61\163\x73\x3d\x22\142\x75\164\164\157\x6e\40\142\x75\x74\164\157\156\x2d\x70\x72\151\155\x61\x72\171\x20\x62\x75\164\x74\x6f\156\55\x6c\141\x72\x67\x65\42\x20\163\x74\x79\154\x65\x3d\42\x70\157\163\x69\164\x69\157\x6e\72\141\x62\x73\157\x6c\165\x74\x65\73\154\x65\146\164\72\x31\60\x70\x78\73\x62\x61\x63\x6b\147\x72\157\x75\x6e\144\55\x63\x6f\x6c\157\x72\x3a\40\x23\60\x39\x33\65\65\x33\73\42\76\xa\x20\40\x20\x20\40\40\40\x20\40\x20\40\x20\x20\x20\x20\40\x20\x20\x20\x20\x20\40\40\x20\x3c\x73\160\x61\x6e\40\x63\x6c\x61\x73\163\75\x22\144\141\x73\150\x69\x63\157\x6e\163\x20\x64\x61\x73\x68\151\x63\157\156\x73\55\x61\x72\162\157\167\x2d\x6c\145\146\x74\x2d\x61\154\164\x22\40\163\164\171\154\145\x3d\x22\x76\x65\162\x74\x69\143\141\x6c\x2d\x61\x6c\151\x67\x6e\72\x20\155\x69\x64\144\154\x65\x3b\42\x3e\74\57\163\160\x61\x6e\76\x20\12\40\x20\x20\x20\x20\40\40\x20\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\x20\40\x20\40\40\x50\154\x75\147\x69\156\x20\x43\157\x6e\146\151\147\x75\x72\x61\164\151\157\156\12\x20\40\x20\x20\x20\40\x20\x20\x20\x20\x20\x20\x20\40\40\40\x20\40\x20\x20\74\57\142\x75\x74\164\157\x6e\x3e\x20\xa\40\40\x20\40\40\40\x20\x20\x20\x20\40\40\x20\40\40\x20\74\57\x61\76\x20\xa\x20\x20\x20\40\x20\40\x20\x20\x20\40\x20\x20\x3c\x2f\144\x69\166\76\12\x20\40\40\x20\40\40\40\40\40\40\40\40\74\144\x69\166\x20\163\164\171\154\145\x3d\42\x64\x69\163\160\154\x61\171\x3a\x62\154\x6f\143\153\x3b\40\164\145\x78\164\x2d\x61\x6c\x69\x67\x6e\72\154\145\x66\x74\x3b\x20\155\x61\162\x67\151\156\x3a\65\160\x78\73\40\x22\x3e\xa\11\11\11\x9\74\150\62\x20\x73\x74\171\154\145\75\42\146\x6f\x6e\x74\55\163\x69\172\145\x3a\62\x32\x70\170\73\40\x74\x65\170\164\x2d\x61\154\151\x67\x6e\72\x63\145\x6e\164\x65\162\x3b\x70\x61\x64\x64\151\x6e\147\x2d\x62\x6f\164\x74\157\155\72\x31\x70\170\42\x3e\155\151\x6e\151\117\x72\x61\x6e\x67\145\x20\117\101\165\164\150\x20\x26\40\x4f\111\104\x43\x20\123\151\x6e\x67\x6c\145\x20\123\151\x67\156\x2d\x4f\156\x3c\x2f\x68\62\x3e\12\40\40\x20\x20\40\x20\40\40\40\x20\x20\x20\x3c\x2f\x64\x69\x76\76\xa\x20\x20\40\x20\x20\40\40\40\x3c\x2f\x64\151\166\x3e\12\11\11\x9";
        Fz:
    }
}