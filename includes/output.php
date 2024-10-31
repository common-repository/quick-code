<!-- Enter your own code here! -->
<?php $user = wp_get_current_user(); ?>
<!-- Edit the CSS file to change the paragraph tag styles, or enter your own in-line -->
<p class="p1">Hello, <?php echo $user->first_name; ?>. Welcome to the 'Quick Code' Plugin.</p>
<p class="p2"><?php qc_test(); ?></p>