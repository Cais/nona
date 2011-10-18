</div> <!-- #head2toe -->
<div id="footer">
    <div id="footer-top"></div>

    <div id="footer-widgets-above"></div>
    <!-- NB: It is very important to maintain the order of the following widget code to insure the formatting and style does not break!!! -->
    <div id="footer-widgets">
        <div id="fw-middle" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-middle" ) ) : else : ?>
                <div class="widget-top"></div>
                <div class="footer-widget">
                    <!-- Middle Footer Widget -->
                    <?php nona_login(); ?>
                </div>
                <div class="widget-bottom"></div>
            <?php endif; ?> <!-- end widget zone footer-middle -->
        </div> <!-- #fw-middle -->

        <div id="fw-left" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-left" ) ) : else :
            endif; ?> <!-- end widget zone footer-left -->
        </div> <!-- #fw-left -->

        <div id="fw-right" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-right" ) ) : else :
            endif; ?> <!-- end widget zone footer-right -->
        </div> <!-- #fw-right -->
    </div> <!-- #footer-widgets -->
    <div id="footer-widgets-below"></div>

    <div id="footer-middle">
        <p>
            <?php nona_dynamic_copyright();
            nona_theme_version(); ?>
        </p>
    </div> <!-- #footer-middle -->

    <div id="footer-bottom"><?php wp_footer(); ?></div>
</div> <!-- #footer -->
</div> <!-- #outside -->
</div> <!-- #full-screen -->
<?php /* Last revised October 12, 2011 v1.4 */ ?>
</body>
</html>