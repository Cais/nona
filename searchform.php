<?php
/**
 * Search Form Template
 *
 * @package     NoNa
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/nona/
 * @link        https://github.com/Cais/nona/
 * @link        http://wordpress.org/extend/themes/nona
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 */ ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
    <label class="hidden" for="s"><?php _e( 'Search for:', 'nona' ); ?></label>
    <div id="search-container">
        <input type="text" value="<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>" onblur="if(this.value == '') {this.value = '<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>';}" onfocus="if(this.value == '<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>') {this.value = '';}" name="s" id="s" />
        <input type="submit" class="hidden" id="search-submit" value="<?php _e( 'Search' , 'nona' ); ?>" />
    </div><!-- #search-container -->
</form>