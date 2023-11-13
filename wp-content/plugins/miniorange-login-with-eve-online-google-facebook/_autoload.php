<?php


if (defined("\101\x42\x53\x50\x41\x54\x48")) {
    goto Q30;
}
exit;
Q30:
define("\115\x4f\103\137\104\x49\122", plugin_dir_path(__FILE__));
define("\115\117\103\x5f\x55\x52\114", plugin_dir_url(__FILE__));
define("\x4d\x4f\137\125\x49\x44", "\x44\106\70\x56\113\x4a\x4f\x35\x46\104\x48\x5a\101\122\102\x52\x35\132\x44\123\x32\x56\65\x4a\x36\66\125\x32\x4e\x44\122");
define("\126\105\122\123\111\x4f\x4e", "\x6d\x6f\137\160\x72\145\155\x69\x75\x6d\137\x76\x65\162\x73\x69\157\x6e");
mo_oauth_include_file(MOC_DIR . "\x2f\x63\154\x61\163\163\x65\163\57\143\x6f\x6d\155\x6f\156");
mo_oauth_include_file(MOC_DIR . "\57\143\154\141\x73\x73\x65\163\x2f\x46\162\x65\145");
mo_oauth_include_file(MOC_DIR . "\57\x63\154\x61\x73\163\145\163\57\123\164\x61\x6e\x64\141\162\x64");
mo_oauth_include_file(MOC_DIR . "\57\143\154\141\x73\x73\145\x73\x2f\120\x72\145\x6d\151\x75\x6d");
mo_oauth_include_file(MOC_DIR . "\57\x63\x6c\141\163\x73\145\x73\x2f\x45\156\x74\145\x72\160\162\x69\x73\x65");
function mo_oauth_get_dir_contents($en, &$tb = array())
{
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($en, RecursiveDirectoryIterator::KEY_AS_PATHNAME), RecursiveIteratorIterator::CHILD_FIRST) as $O6 => $D4) {
        if (!($D4->isFile() && $D4->isReadable())) {
            goto IbX;
        }
        $tb[$O6] = realpath($D4->getPathname());
        IbX:
        lDC:
    }
    OJX:
    return $tb;
}
function mo_oauth_get_sorted_files($en)
{
    $bn = mo_oauth_get_dir_contents($en);
    $D8 = array();
    $m0 = array();
    foreach ($bn as $O6 => $My) {
        if (!(strpos($My, "\56\x70\150\160") !== false)) {
            goto X9c;
        }
        if (strpos($My, "\x49\x6e\164\145\162\x66\141\143\x65") !== false) {
            goto QgA;
        }
        $m0[$O6] = $My;
        goto mnB;
        QgA:
        $D8[$O6] = $My;
        mnB:
        X9c:
        V3m:
    }
    yqk:
    return array("\151\x6e\x74\x65\x72\x66\141\143\x65\163" => $D8, "\143\x6c\141\163\x73\145\x73" => $m0);
}
function mo_oauth_include_file($en)
{
    if (is_dir($en)) {
        goto slM;
    }
    return;
    slM:
    $en = mo_oauth_sane_dir_path($en);
    $v9 = realpath($en);
    if (!(false !== $v9 && !is_dir($en))) {
        goto DB1;
    }
    return;
    DB1:
    $kR = mo_oauth_get_sorted_files($en);
    mo_oauth_require_all($kR["\x69\x6e\x74\x65\162\x66\141\143\x65\x73"]);
    mo_oauth_require_all($kR["\x63\x6c\141\x73\x73\145\x73"]);
}
function mo_oauth_require_all($bn)
{
    foreach ($bn as $O6 => $My) {
        require_once $My;
        vIc:
    }
    s4f:
}
function mo_oauth_is_valid_file($GM)
{
    return '' !== $GM && "\56" !== $GM && "\x2e\56" !== $GM;
}
function mo_oauth_get_valid_html($nt = array())
{
    $Zh = array("\x73\164\x72\157\x6e\147" => array(), "\145\x6d" => array(), "\x62" => array(), "\151" => array(), "\x61" => array("\x68\162\145\x66" => array(), "\x74\141\162\147\x65\x74" => array()));
    if (empty($nt)) {
        goto ZNk;
    }
    return array_merge($nt, $Zh);
    ZNk:
    return $Zh;
}
function mo_oauth_get_version_number()
{
    $De = get_file_data(MOC_DIR . "\57\x6d\x6f\x5f\157\x61\165\x74\x68\x5f\163\145\164\x74\151\x6e\147\163\56\x70\150\160", ["\126\x65\x72\163\x69\157\156"], "\160\x6c\x75\147\x69\156");
    $kO = isset($De[0]) ? $De[0] : '';
    return $kO;
}
function mo_oauth_sane_dir_path($en)
{
    return str_replace("\57", DIRECTORY_SEPARATOR, $en);
}
if (!function_exists("\155\x6f\137\x6f\x61\x75\164\150\x5f\x69\x73\137\x72\x65\x73\164")) {
    function mo_oauth_is_rest()
    {
        $r8 = rest_get_url_prefix();
        if (!(defined("\122\x45\123\x54\137\122\x45\x51\x55\x45\x53\x54") && REST_REQUEST || isset($_GET["\x72\x65\163\x74\137\162\157\165\164\145"]) && strpos(trim($_GET["\x72\x65\163\164\x5f\162\157\165\164\145"], "\134\57"), $r8, 0) === 0)) {
            goto hWs;
        }
        return true;
        hWs:
        global $x3;
        if (!($x3 === null)) {
            goto x3_;
        }
        $x3 = new WP_Rewrite();
        x3_:
        $fO = wp_parse_url(trailingslashit(rest_url()));
        $c5 = wp_parse_url(add_query_arg(array()));
        return strpos($c5["\160\x61\x74\150"], $fO["\x70\x61\164\x68"], 0) === 0;
    }
}
