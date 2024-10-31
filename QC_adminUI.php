<?php
	
	if($_POST['qc_hidden'] == 'Y') {
		//Process form data
		//echo "processing form";

		$code_fr=(!isset($_POST['quickcode_input'])? '': $_POST['quickcode_input']);
        $code_fr_inc=(!isset($_POST['quickcode_includes'])? '': $_POST['quickcode_includes']);
		if( get_magic_quotes_gpc() )
	    {
         // if magic quotes on, get rid of escape slashes inserted into text
	     $code_fr = stripslashes($code_fr);
	     $code_fr_inc = stripslashes($code_fr_inc);
		}
        update_option('qc_default', $code_fr);

		// Drop down box
		$qc_dropdown_hidden = (!isset($_POST['qc_dropdown_hidden'])? '': $_POST['qc_dropdown_hidden']);
        $qc_dropdown = (!isset($_POST['qc_dropdown'])? '': $_POST['qc_dropdown']);
        //echo '$qc_dropdown_hidden = '.$qc_dropdown_hidden."\r\n";
		//echo '$qc_dropdown = '.$qc_dropdown."\r\n";
		if($qc_dropdown_hidden != $qc_dropdown) {
			update_option('qc_dropdown', $qc_dropdown);
			//echo "Don't update option content!!";
		} else
		{
			//echo "Form not processed by drop down box!!! :-)";
			// update one of the three include files (javascript, php, or css) depending on which is active
			if($qc_dropdown == 'javascript_inc'){
			  update_option('qc_javascript_content', $code_fr_inc);   // update javascript file
			  $file = WP_PLUGIN_DIR.'/quick-code/includes/';
			  file_put_contents($file.'qc_javascript.js', $code_fr_inc);
			} else if($qc_dropdown == 'css_inc'){
			  update_option('qc_css_content', $code_fr_inc);   // update css file
			  $file = WP_PLUGIN_DIR.'/quick-code/includes/';
			  file_put_contents($file.'qc_style.css', $code_fr_inc);
			} else {
			  update_option('qc_php_content', $code_fr_inc);   // update php file
			}
		}

		?>
		<!-- <div class="updated"><?php _e('Code processed. See output box for results...' ); ?></div> -->
		<?php
	} else { /* Put code here when form data is not processed */
		// echo "NOT processing form";
}

        $qc_dropdown = get_option('qc_dropdown');
		if($qc_dropdown == 'javascript_inc'){
          $javascript_file_include = 'selected="selected"';
          $css_file_include = '';
		  $php_file_include = '';
		} else if($qc_dropdown == 'css_inc'){
          $javascript_file_include = '';
          $css_file_include = 'selected="selected"';
		  $php_file_include = '';
		} else {
          $javascript_file_include = '';
          $css_file_include = '';
		  $php_file_include = 'selected="selected"';
		}

?>

<div class="wrap">
<?php    echo "<h2>" . __( 'Quick Code', 'qc_domain' ) . "</h2>"; ?>
<form name="qcform" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="qc_hidden" value="Y">
<div style="width:68%;margin-top:10px;font-size:12px;color:#777;line-height:18px;">Place your code in the 'Edit Code' box, then click 'Refresh Output' to update.</div>
<table cellpadding="0px" cellspacing="0px">
<tr>
   <td><table width="700px"><tr valign="bottom"><td><?php echo "<h3 style=\"margin-bottom:0px;padding-bottom:0px;line-height:26px;\">".__( 'Code Output', 'qc_domain')."&nbsp;&nbsp;<span style=\"color:#bbb;font-weight:normal;\"><small><em>(read only)</em></small></span></h3>"; ?></td><td align="right"><div><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4053495" style="text-decoration:none;"><small>donate</small></a></div></td></tr></table></td>
</tr>
<tr>
  <td><?php

  $update_output = get_option('qc_default');
  $update_php_functions = get_option('qc_php_content');
  $file = WP_PLUGIN_DIR.'/quick-code/includes/';
  file_put_contents($file.'output.php', $update_output);
  file_put_contents($file.'qc_php_functions.php', $update_php_functions);

  if (file_exists($file.'output.php')) {
    include($file.'qc_php_functions.php'); // include the php functions file first, outside div
	?>
	<div style="background-color:#fff;border:1px #bbb solid;width:700px;height:auto;">
	<?php
	include($file.'output.php'); // include main editable code file, inside div
  } else {
    echo "<div class=\"updated\">The code fragment file does not exist. Please make sure there is an 'output.php' file in the includes folder inside the main Quick Code Plugin folder.<div>";
  }
  
  ?></td>
 </tr>
  <tr>
  <td><?php echo "<h3 style=\"color: #BD1B1B;margin-bottom:0px;padding-bottom:0px;line-height:26px;\">".__( 'Edit Code', 'qc_domain')."</h3>"; ?></td>
 </tr>
 <tr valign="top">
  <td><textarea name="quickcode_input" rows="12" style="background-color:#fff;border:1px #bbb solid;width:700px;font-family:courier;"><?php echo get_option('qc_default'); ?></textarea></td>
</tr>
<tr><td>
<p class="submit" style="margin:3px 0px 0px 0px;padding:0px;"><input type="submit" name="Submit" value="<?php _e('Refresh Output', 'qc_domain' ) ?>" /></p>
</td></tr>
<tr>
 <td><div style="border-top:1px dashed #ddd;border-bottom:1px dashed #ddd;padding:5px 0px;width:700px;margin:20px 0px 0px 0px;font-size:11px;color:#777;line-height:18px;">In the section below you can edit an external JavaScript and CSS file, which are both automatically included in the admin header. There is also an editable PHP file where you can store functions to reference from the main 'Edit Code' box.</div><table style="width:100%;margin:0px;padding:0px;"><tr valign="bottom"><td><?php echo "<h3 style=\"color: #2798c9;margin-bottom:0px;padding-bottom:0px;line-height:26px;\">".__( 'Include Files', 'qc_domain')."&nbsp;&nbsp;<span style=\"color:#bbb;font-weight:normal;\"><small><em>(select external CSS, JavaScript, or PHP file to edit)</em></small></span></h3>"; ?></td>
 <td align="right"><table><tr><td>Select File:</td><td><input type="hidden" name="qc_dropdown_hidden" value="<?php echo $qc_dropdown; ?>"><select onchange="javascript:source();" style="width:100px;" name="qc_dropdown">
 <option value="javascript_inc" <?php echo $javascript_file_include ?>>JavaScript</option>
 <option value="css_inc" <?php echo $css_file_include ?>>CSS</option>
 <option value="php_inc" <?php echo $php_file_include ?>>PHP</option>
</select></td></tr></table></td></tr></table></td>
</tr>
 <tr valign="top">
  <td><textarea name="quickcode_includes" rows="12" style="background-color:#f4f9fa;border:1px #bbb solid;width:700px;font-family:courier;"><?php 

  if($qc_dropdown == 'javascript_inc') {
	  echo get_option('qc_javascript_content');
  } else if($qc_dropdown == 'css_inc') {
	  echo get_option('qc_css_content');
  } else {
	  echo get_option('qc_php_content');
  }
  
  ?></textarea></td>
</tr>
<tr><td>
<p class="submit" style="margin:3px 0px 0px 0px;padding:0px;"><input type="submit" name="Submit" value="<?php _e('Save File', 'qc_domain' ) ?>" /></p>
</td></tr>
</table>

</form>
<div style="margin-top:150px;padding:5px;">
<table style="border-top:1px #d8d8d8 solid;">
 <tr valign="top">
  <td width="425px"><span style="color:#aaaaaa;font-style:italic;font-size:10px;"><?php _e('This plugin, and any future version, is provided free of charge - as is any support. If this plugin has been of any help to you then your support is greatly appreciated!', 'contfilt_domain' ) ?></span></td>
  <td width="270px" align="right">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="4053495">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
  </td>
 </tr>
</table>
</div>
</div>