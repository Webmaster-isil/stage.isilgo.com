<?php


namespace MoOauthClient\Free;

use MoOauthClient\Free\RequestForDemoInterface;
class Requestfordemo implements RequestForDemoInterface
{
    private $versi;
    public function __construct()
    {
        $this->versi = VERSION;
    }
    public function render_free_ui()
    {
        global $lT;
        echo "\x9\11\x3c\144\x69\166\40\151\x64\75\42\155\x6f\x5f\x6f\141\165\x74\150\137\162\145\x71\165\x65\163\164\144\x65\x6d\157\x22\x20\x63\x6c\x61\x73\163\x3d\42\155\157\x5f\x74\141\x62\154\x65\137\x6c\141\171\157\x75\x74\40\x6d\x6f\x5f\x6f\141\x75\164\150\137\141\x70\160\x5f\x72\x65\161\x75\145\x73\x74\x64\x65\x6d\x6f\x20";
        echo $Wb;
        echo "\x22\76\15\12\x9\x9\74\146\x6f\x72\155\x20\x69\x64\75\x22\x66\157\x72\x6d\x2d\143\157\x6d\x6d\157\x6e\42\40\x6e\x61\x6d\x65\x3d\x22\146\157\162\155\55\x63\157\155\x6d\x6f\x6e\x22\40\155\145\x74\150\x6f\x64\x3d\x22\x70\x6f\x73\164\x22\x20\141\143\x74\151\x6f\x6e\75\x22\x61\x64\x6d\x69\x6e\56\x70\150\160\x3f\160\141\x67\x65\x3d\x6d\x6f\x5f\x6f\x61\x75\x74\150\x5f\x73\x65\x74\164\x69\156\x67\163\x26\164\x61\142\x3d\162\x65\161\x75\x65\163\164\146\x6f\162\144\x65\x6d\157\42\76\xd\xa\x9\x9\x9\74\151\x6e\x70\x75\164\40\x74\x79\160\x65\75\x22\x68\151\144\144\x65\x6e\x22\40\156\x61\155\145\x3d\x22\157\160\x74\x69\x6f\156\x22\x20\x76\141\154\165\x65\75\42\x6d\x6f\137\x6f\x61\x75\164\150\x5f\141\x70\160\137\x72\x65\x71\x75\x65\163\x74\x64\145\155\157\42\40\x2f\76\15\12\11\x9\x9";
        wp_nonce_field("\x6d\x6f\137\157\x61\x75\x74\150\x5f\x61\160\x70\137\x72\x65\161\x75\x65\163\x74\144\145\155\157", "\155\157\x5f\157\141\165\x74\x68\137\x61\x70\x70\x5f\162\x65\x71\165\x65\x73\x74\144\x65\x6d\x6f\x5f\x6e\157\156\x63\145");
        echo "\x9\x9\x9\74\164\x61\x62\154\x65\40\143\x6c\x61\x73\163\x3d\x22\155\157\x5f\x73\x65\x74\x74\x69\x6e\x67\163\137\x74\x61\142\154\x65\x22\40\143\x65\154\x6c\160\141\x64\x64\x69\x6e\x67\75\x22\x34\x22\40\143\145\x6c\154\x73\x70\x61\143\x69\x6e\147\75\x22\x34\x22\x3e\15\xa\11\x9\x9\x9\74\164\162\x3e\15\12\x9\11\11\x9\11\x3c\x74\x64\76\74\x73\x74\x72\157\x6e\x67\x3e\105\155\x61\151\154\x20\x3a\x20\x3c\x2f\x73\164\x72\x6f\156\147\76\x3c\57\164\x64\76\15\12\x9\11\x9\x9\11\x3c\x74\x64\x3e\x3c\x69\156\x70\x75\164\40\162\145\161\x75\151\162\145\x64\x20\x74\x79\160\x65\75\x22\x74\145\170\x74\42\40\x73\x74\x79\154\145\x3d\x22";
        echo $Rw;
        echo "\x22\40\x6e\x61\x6d\145\75\42\x6d\x6f\137\157\141\165\x74\150\137\143\154\x69\x65\x6e\x74\x5f\144\x65\155\x6f\137\145\155\141\151\154\42\40\160\154\141\143\x65\x68\157\x6c\x64\x65\x72\x3d\x22\x45\x6d\141\151\154\x20\x66\x6f\162\40\144\145\x6d\157\40\163\145\x74\165\160\x22\x20\166\x61\x6c\x75\x65\75\42";
        echo get_option("\x6d\x6f\x5f\x6f\x61\x75\x74\150\137\141\144\x6d\151\x6e\137\x65\155\x61\151\154");
        echo "\x22\x20\57\76\74\57\164\x64\76\15\xa\x9\x9\11\11\x3c\57\164\162\x3e\xd\12\x9\11\x9\11\x3c\164\162\x3e\xd\12\x9\x9\x9\x9\11\74\164\144\x3e\74\163\164\162\157\x6e\147\x3e\x52\145\x71\165\145\x73\x74\x20\x61\40\x64\145\x6d\x6f\x20\x66\x6f\162\x20\x3a\x20\x3c\57\x73\164\x72\x6f\156\x67\x3e\x3c\x2f\x74\144\x3e\xd\12\11\11\11\x9\x9\74\164\x64\x3e\xd\xa\x9\11\11\11\11\11\74\x73\x65\x6c\x65\143\164\x20\x72\x65\x71\165\151\x72\145\144\x20\163\164\x79\154\x65\x3d\42";
        echo $Rw;
        echo "\x22\40\x6e\x61\155\145\75\x22\x6d\157\137\x6f\x61\x75\164\x68\137\x63\154\151\145\156\164\x5f\144\x65\155\x6f\x5f\160\154\x61\x6e\42\40\151\x64\x3d\x22\155\x6f\137\157\x61\x75\x74\x68\x5f\143\154\151\x65\x6e\x74\x5f\x64\145\155\157\137\x70\154\x61\156\x5f\x69\x64\42\x20\x6f\156\143\x6c\x69\143\x6b\75\x22\155\157\x4f\141\x75\x74\150\x43\x6c\151\145\156\164\101\x64\x64\104\x65\163\143\x72\151\160\x74\x69\x6f\156\x6a\x73\x28\x29\x22\76\15\xa\11\x9\x9\x9\x9\11\x9\74\x6f\x70\x74\151\157\156\x20\144\151\163\141\x62\154\x65\x64\40\x73\145\154\145\x63\x74\145\x64\x3e\55\x2d\55\x2d\x2d\x2d\55\x2d\55\55\55\55\x2d\x2d\55\x2d\55\x2d\40\123\145\154\145\x63\x74\40\x2d\x2d\55\x2d\55\55\x2d\55\55\x2d\55\x2d\x2d\x2d\55\x2d\x2d\x2d\x3c\57\157\160\x74\151\157\x6e\x3e\xd\12\x9\x9\x9\11\x9\11\x9\74\x6f\160\x74\x69\x6f\x6e\40\166\141\154\x75\145\x3d\x22\x57\x50\40\117\101\165\x74\x68\x20\103\154\x69\x65\156\164\40\123\x74\141\x6e\x64\141\x72\x64\40\x50\154\x75\147\151\156\42\x3e\127\x50\x20\x4f\101\x75\x74\150\x20\103\x6c\151\145\156\164\x20\123\x74\141\156\144\x61\162\144\x20\120\154\165\147\151\156\74\57\157\160\x74\x69\157\156\76\xd\xa\11\11\11\11\x9\11\x9\x3c\x6f\160\164\x69\x6f\156\x20\166\141\x6c\165\x65\x3d\42\127\120\x20\117\101\x75\x74\x68\40\103\x6c\151\145\156\x74\x20\120\162\x65\155\x69\165\x6d\40\120\154\x75\147\151\x6e\42\x3e\x57\x50\40\x4f\101\165\x74\150\40\x43\154\x69\145\156\x74\40\x50\x72\x65\x6d\x69\x75\x6d\x20\x50\154\x75\147\151\x6e\74\x2f\157\x70\x74\151\157\x6e\76\xd\12\11\11\11\11\11\x9\11\x3c\x6f\x70\164\x69\157\x6e\40\x76\x61\154\165\x65\75\x22\127\x50\40\117\x41\165\164\x68\x20\103\154\151\x65\156\164\x20\105\x6e\x74\x65\162\x70\162\x69\163\x65\x20\x50\154\165\x67\x69\x6e\42\76\x57\120\40\x4f\101\x75\164\x68\x20\103\x6c\151\145\x6e\164\40\x45\156\164\x65\162\160\162\x69\x73\145\x20\120\x6c\165\147\151\156\x3c\57\157\x70\164\151\157\156\x3e\15\xa\11\x9\11\11\x9\11\x9\74\157\x70\164\151\x6f\x6e\x20\166\x61\154\165\x65\75\x22\116\157\x74\x20\123\x75\x72\145\42\x3e\x4e\x6f\x74\40\123\x75\x72\x65\74\x2f\x6f\x70\x74\x69\157\156\76\xd\xa\11\11\x9\11\11\11\x3c\57\x73\x65\154\145\143\164\x3e\15\12\11\x9\11\11\11\74\57\164\x64\76\xd\12\11\11\11\x9\74\57\x74\x72\x3e\15\xa\x9\11\11\x9\74\164\x72\x20\151\144\75\x22\x64\x65\x6d\157\x44\x65\163\143\162\151\x70\164\x69\x6f\x6e\x22\x20\163\164\x79\x6c\x65\x3d\42\x64\151\163\160\x6c\x61\x79\x3a\156\x6f\x6e\x65\x3b\x22\76\xd\12\11\11\x9\x9\x9\x3c\164\x64\x3e\x3c\x73\x74\x72\x6f\x6e\x67\x3e\x44\145\163\143\162\x69\x70\164\x69\157\156\x20\72\40\74\57\x73\164\162\x6f\x6e\x67\x3e\74\x2f\x74\144\x3e\15\12\11\x9\x9\x9\11\74\164\144\76\15\12\11\11\11\x9\x9\11\74\164\x65\170\164\141\x72\x65\141\x20\164\171\x70\145\x3d\42\x74\x65\170\x74\x22\40\x6e\x61\x6d\x65\75\x22\x6d\x6f\137\157\141\165\x74\150\x5f\143\x6c\x69\x65\156\x74\137\x64\x65\x6d\157\137\x64\x65\x73\143\x72\x69\160\164\151\x6f\156\x22\40\163\164\171\x6c\145\75\x22\162\145\163\151\172\145\72\40\x76\x65\x72\x74\151\x63\141\x6c\x3b\x20\x77\151\144\x74\150\x3a\63\65\60\160\x78\x3b\x20\x68\145\x69\147\150\164\x3a\x31\60\60\x70\x78\x3b\42\40\162\x6f\167\x73\x3d\x22\x34\42\x20\x70\154\141\x63\145\x68\x6f\x6c\144\x65\162\x3d\x22\x4e\145\145\x64\40\x61\163\163\x69\x73\x74\x61\156\143\x65\77\40\127\x72\151\164\x65\x20\165\x73\x20\x61\142\157\165\164\40\x79\157\x75\x72\x20\162\x65\161\165\x69\x72\x65\155\145\x6e\164\40\x61\156\144\x20\167\x65\x20\167\151\154\x6c\40\163\165\147\x67\145\163\x74\40\x74\x68\145\40\x72\145\x6c\145\x76\141\156\x74\x20\160\x6c\x61\156\40\x66\x6f\162\40\171\x6f\165\56\42\x20\166\141\x6c\165\x65\x3d\42";
        isset($hq);
        echo "\x22\x20\x2f\x3e\x3c\57\x74\x65\170\x74\x61\x72\145\x61\x3e\xd\xa\11\11\11\x9\11\74\57\164\144\76\15\12\x9\11\x9\x9\x3c\57\x74\x72\76\xd\xa\11\x9\11\x9\74\x74\x72\x3e\15\xa\x9\x9\11\11\x9\x3c\164\x64\76\46\156\x62\x73\x70\73\x3c\57\x74\144\x3e\xd\12\x9\11\11\11\x9\74\x74\144\76\74\x69\x6e\x70\x75\x74\40\x74\171\160\x65\x3d\42\163\165\142\x6d\151\x74\x22\40\156\141\155\x65\x3d\42\163\x75\142\x6d\x69\x74\42\40\166\x61\154\x75\x65\75\42\x53\x75\142\x6d\151\x74\x20\x44\145\x6d\157\x20\122\145\161\165\x65\163\x74\x22\40\x63\x6c\x61\163\163\75\42\142\165\164\x74\157\156\40\142\165\x74\x74\157\156\55\160\x72\151\x6d\141\162\171\x20\142\x75\x74\x74\157\x6e\55\x6c\141\162\147\145\42\40\57\x3e\74\57\x74\144\x3e\xd\12\x9\11\x9\x9\74\57\164\162\x3e\xd\12\x9\11\x9\74\57\x74\x61\142\x6c\145\x3e\xd\xa\x9\11\x3c\57\x66\x6f\x72\155\76\15\xa\x9\11\x3c\57\x64\151\166\76\xd\xa\11\11\x3c\x73\143\x72\x69\x70\164\x20\x74\171\x70\x65\75\42\x74\x65\170\x74\x2f\x6a\141\166\141\x73\143\x72\151\x70\164\x22\x3e\15\12\x9\11\11\146\165\x6e\x63\164\151\157\156\x20\x6d\x6f\x4f\141\x75\x74\x68\x43\154\151\x65\x6e\164\x41\144\x64\104\x65\163\x63\x72\151\x70\164\x69\157\156\152\163\x28\51\x20\173\15\xa\x9\x9\x9\11\57\x2f\x20\141\154\145\162\x74\x28\42\x77\157\x72\x6b\x69\x6e\147\x22\x29\x3b\xd\xa\11\11\x9\x9\166\x61\x72\40\x78\x20\75\x20\x64\157\x63\165\x6d\145\156\x74\x2e\147\x65\164\105\154\145\x6d\145\156\x74\102\171\x49\144\50\42\155\x6f\137\157\141\x75\x74\150\137\143\x6c\x69\x65\156\164\137\x64\x65\155\x6f\137\160\x6c\141\x6e\137\151\x64\x22\x29\x2e\163\145\154\145\x63\164\145\144\111\x6e\144\145\x78\x3b\xd\12\11\11\11\11\x76\x61\x72\40\x6f\164\150\x65\x72\117\x70\x74\x69\157\x6e\x20\75\x20\144\157\143\165\155\145\x6e\x74\56\x67\145\164\105\x6c\x65\155\145\156\x74\102\171\111\x64\x28\x22\155\x6f\137\x6f\141\165\164\150\x5f\143\x6c\151\x65\x6e\164\x5f\x64\x65\x6d\x6f\137\160\154\x61\156\137\151\x64\42\51\56\157\160\164\151\157\156\x73\73\xd\12\11\x9\x9\x9\151\146\x20\50\x6f\164\150\x65\162\117\160\x74\x69\x6f\156\133\x78\x5d\56\x69\156\x64\145\170\40\x3d\x3d\x20\x34\x29\x7b\xd\12\x9\11\11\x9\x9\144\x65\155\157\104\x65\x73\x63\x72\151\x70\164\x69\x6f\156\x2e\163\164\x79\x6c\145\x2e\x64\x69\x73\x70\x6c\141\x79\40\x3d\x20\42\x22\73\xd\xa\x9\x9\x9\x9\175\x20\145\x6c\x73\145\40\x7b\xd\xa\11\11\11\11\11\x64\145\x6d\x6f\x44\x65\163\143\x72\x69\160\x74\151\x6f\156\x2e\163\164\171\154\145\56\144\151\163\x70\x6c\x61\171\x20\75\x20\x22\156\157\x6e\145\x22\x3b\xd\12\x9\11\11\11\175\xd\12\x9\x9\11\175\xd\xa\11\11\x3c\x2f\163\143\162\151\x70\164\76\xd\xa\11\11";
    }
}
