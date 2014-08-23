<?php
function scrollup_custom_style(){
	$options = get_option( 'sis_scrooltotop_settings' );

	// Get style when button type == image
	if ( $options['btn_type'] == 'image' ):

		?><style>
			#scrollUp {
				bottom: <?php echo $options['btn_bottom']; ?>;
				right: <?php echo $options['btn_right']; ?>;
				height: 50px;
				width: 50px;
				background: url(<?php echo plugins_url( '/img/back-top.png' , __FILE__ ); ?>) no-repeat;
				opacity: 0.4;
			}
			#scrollUp:hover{opacity: 1;}
		</style><?php

	endif;

	// Get style when button type == image
	if ( $options['btn_type'] == 'tab' ):

		?><style>
			#scrollUp {
			    bottom: 0;
			    right: <?php echo $options['btn_right']; ?>;
			    width: 70px;
			    height: 70px;
			    margin-bottom: -10px;
			    padding: 10px 5px;
			    font: 14px/20px sans-serif;
			    text-align: center;
			    text-decoration: none;
			    box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
			    background-repeat: repeat-x;
			    transition: margin-bottom 150ms linear;
			    color: <?php echo $options['tab_txt_color']; ?>;
			    background-color: <?php echo $options['tab_bg_color']; ?>;
			}
			#scrollUp:hover {
			    margin-bottom: 0;
			}
		</style><?php

	endif;

	// Get style when button type == pill
	if ( $options['btn_type'] == 'pill' ):

		?><style>
			#scrollUp {
			    background-color: <?php echo $options['pill_bg_color']; ?>;
			    color: <?php echo $options['pill_txt_color']; ?>;
			    right: <?php echo $options['btn_right']; ?>;
			    bottom: <?php echo $options['btn_bottom']; ?>;
			    font-size: 12px;
			    font-family: sans-serif;
			    text-decoration: none;
			    opacity: .9;
			    padding: 10px 20px;
			    -webkit-border-radius: 16px;
			    -moz-border-radius: 16px;
			    border-radius: 16px;
			    -webkit-transition: background 200ms linear;
			    -moz-transition: background 200ms linear;
			    -o-transition: background 200ms linear;
			    transition: background 200ms linear;
			    -webkit-backface-visibility: hidden;
			}

			#scrollUp:hover {
			    background-color: <?php echo $options['pill_bghover_color']; ?>;
			}
		</style><?php

	endif;

	// Get style when button type == link
	if ( $options['btn_type'] == 'link' ):

		?><style>
			#scrollUp {
			    bottom: <?php echo $options['btn_bottom']; ?>;
			    right: <?php echo $options['btn_right']; ?>;
			}
		</style><?php

	endif;
}
add_action('wp_head','scrollup_custom_style');