<div id="sidebar">
	<div id="sidebar-inside">
		<div id="sidebar-1">
			<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
				<div class="widget-top"></div>
				<div class="widget">
					<ul id="search"><li><?php get_search_form(); ?></li></ul> <!-- #search -->
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Calendar', 'nona' ); ?></h2>
					<div align="center">
						<?php get_calendar(0); ?>
					</div>
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
				<div class="widget-top"></div>
				<div class="widget">
					<?php wp_list_bookmarks( 'title_li=&title_before=<h2 class="widget-title">&title_after=</h2>&category_before=&category_after=' ); ?>
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Categories', 'nona' ); ?></h2>
					<ul><?php wp_list_categories( 'title_li=&show_count=1' ); ?></ul>
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Archives', 'nona' ); ?></h2>
					<ul><?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?></ul>
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e('Meta', 'nona'); ?></h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
				</div> <!-- .widget -->
				<div class="widget-bottom"></div>
				
			<?php endif; ?>
		</div> <!-- #sidebar-1 -->
		
		<div id="sidebar-2">
			<?php if ( dynamic_sidebar( 'sidebar-2' ) ) : else : ?>
			<?php endif; ?> <!-- end widget zone sidebar-middle -->
		</div> <!-- #sidebar-2 -->
		
		<div id="sidebar-3">
			<?php if ( dynamic_sidebar( 'sidebar-3' ) ) : else : ?>
			<?php endif; ?> <!-- end widget zone sidebar-bottom -->
		</div> <!-- #sidebar-3 -->
	</div> <!-- #sidebar-inside -->
</div> <!-- #sidebar -->
<?php /* Last Revision: January 9, 2011 v1.3 */ ?>