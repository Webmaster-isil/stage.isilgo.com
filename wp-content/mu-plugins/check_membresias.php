
<?php

add_action('wp_ajax_nopriv_checkmembresias', 'check_membresias');
add_action('wp_ajax_checkmembresias', 'check_membresias');

function check_membresias(){
    $user = get_user_by('email', $_GET['email_user']);
    if ($user->ID && !empty(get_field('membresia', 'user_' . $user->ID))) {
        delete_field('membresia', 'user_' . $user->ID);
    }
    die('next');
}
?>
