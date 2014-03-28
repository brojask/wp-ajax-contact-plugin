<?php
/*
 * Plugin Name: Contact
 * Plugin URI: # 
 * Author: brojask
 * Author URI: #
 */


function vista(){
    ?>
<script type="text/javascript">
//<![CDATA[
ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
//]]>
</script>
    <?php
    include('form.php');
}

function send_mail(){
    $admin_email = get_option('admin_email');
    $nombre = $_POST['name'];
    $mensaje = $_POST['message'];
    $email_cliente = $_POST['email'];    
    $headers = 'From:' . $email_cliente . "rn";
    $enviado = wp_mail($admin_email, 'Code Factory', $mensaje, $headers);    
    if ($enviado) {
        $json['state'] = true;
        $json['message'] = '¡Enviado!';
    } else {
        $json['state'] = false;
        $json['message'] = '¡No enviado!';
    }
    echo json_encode($json);
    die();
}

add_action( 'wp_ajax_nopriv_send_mail', 'send_mail' );
add_action( 'wp_ajax_send_mail', 'send_mail' );

add_shortcode('contact', 'vista');
