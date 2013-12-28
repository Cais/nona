<?php
/**
 * Footer Template
 *
 * @package     NoNa
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/nona/
 * @link        https://github.com/Cais/nona/
 * @link        http://wordpress.org/extend/themes/nona
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * @version     1.8
 * @date        March 15, 2013
 * Drop `nona_login` call ... better left as plugin territory, see BNS Login.
 *
 * @version     1.8.1
 * @date        July 18, 2013
 * @todo        Fix hack to hide middle footer widget area frame if it is empty
 */
?>

<div id="footer">
	<div id="footer-top"></div>

	<div id="footer-widgets-above"></div>
	<!-- NB: It is very important to maintain the order of the following widget code to insure the formatting and style does not break!!! -->
	<div id="footer-widgets">
		<div id="fw-middle" class="fw-column">
			<?php
			if (dynamic_sidebar( "footer-middle" )) :
			else :
			if ( ! is_active_sidebar( 'footer-middle' ) ) {
				echo '<div class="hidden">' . __( 'This is hidden for aesthetics but still required for the layout!', 'nona' ) . '</div>';
			} /** End if - not active sidebar */
			?>
			<?php endif; ?><!-- end widget zone footer-middle -->
		</div>
		<!-- #fw-middle -->

		<div id="fw-left" class="fw-column">
			<?php if ( dynamic_sidebar( "footer-left" ) ) : else : endif; ?>
		</div>
		<!-- #fw-left -->

		<div id="fw-right" class="fw-column">
			<?php if ( dynamic_sidebar( "footer-right" ) ) : else : endif; ?>
		</div>
		<!-- #fw-right -->
	</div>
	<!-- #footer-widgets -->
	<div id="footer-widgets-below"></div>

	<div id="footer-middle">
		<p>
			<?php nona_dynamic_copyright();
			nona_theme_version(); ?>
		</p>
	</div>
	<!-- #footer-middle -->

	<div id="footer-bottom"><?php wp_footer(); ?></div>
</div><!-- #footer -->
</div><!-- #outside -->
</body>
</html>