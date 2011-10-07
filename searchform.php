<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<label class="hidden" for="s"><?php _e( 'Search for:', 'nona' ); ?></label>
	<div id="search-container">
		<input type="text" value="<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>" onblur="if(this.value == '') {this.value = '<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>';}" onfocus="if(this.value == '<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>') {this.value = '';}" name="s" id="s" />
		<input type="submit" class="hidden" id="search-submit" value="<?php _e( 'Search' , 'nona' ); ?>" />
	</div> <!-- #search-container -->
</form>
<?php /* Last Revision: January 13, 2011 v1.3.1 */ ?>