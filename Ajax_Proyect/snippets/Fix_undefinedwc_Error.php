<?php
/*
Snippet Name: Fix undefinedwc Error
Description: Polyfill for wcSettings when not defined by WooCommerce Blocks. Fixes the "undefinedwc" URL error in the Mini Cart.
*/

add_action( 'wp_head', function() {
    ?>
    <script>
        // Ensure wcSettings exists to prevent "undefinedwc" errors in API requests
        if ( typeof wcSettings === 'undefined' ) {
            var wcSettings = {
                rest: {
                    url: '<?php echo esc_url_raw( rest_url() ); ?>'
                }
            };
        }
    </script>
    <?php
}, 1 );
