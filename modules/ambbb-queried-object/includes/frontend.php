<?php
// receives:
// - $module
// - $id
// - $settings

$queried_object = get_queried_object();
do_action( 'ambbb_queried_object', $queried_object );
