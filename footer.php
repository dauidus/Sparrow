<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<div class="slash-top" style="width:auto;"></div>
    <div class="footer">
        <div class="footer-960">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third Footer Area') ) : ?><?php endif; ?>
            <div class="clear"></div>
        </div>
    </div>
<div class="slash-top-rv" style="width:auto;"></div>
    <div class="copyright-wrapper">
        <div class="copyright-holder">
            <p class="copyright-text-left">
            	Sparrow's Nest Consignment &copy; 2011-<?php echo date( 'Y' ); ?> &nbsp; | &nbsp; 7451 Warner Ave, Ste. I, Huntington Beach, CA 92647 &nbsp; | &nbsp; 714-975-3548
            </p>
            <div class="copyright-text-right">
				<div id="credit">
					<a id="dd" href="http://www.dauid.us/" target="_blank">
						<div id="dauidusdesign">from the studio of dauid.us</div>
					</a>
				</div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
		<?php echo $options['tracking_footer'] ?>
	</script>
    <?php wp_footer(); ?>
    

    
</body>

</html>
