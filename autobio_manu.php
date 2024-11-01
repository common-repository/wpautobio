<?php

add_filter('user_contactmethods','hide_profile_fields',10,1);
function hide_profile_fields( $contactmethods ) {
$contactmethods['twitter'] = 'Twitter (URL)';
$contactmethods['facebook'] = 'Facebook (URL)';
$contactmethods['gplus'] = 'Google+ (URL)';
$contactmethods['youtube'] = 'Youtube (URL)';
return $contactmethods; 
}

function autobio_gravatar( $email ) {
$string = get_avatar( $email, '60' ); 
$patterns = array(); 
$patterns[0] = '/img/'; 
$replacements = array(); 
$replacements[0] = 'img style="background:#FFF;float:left;margin:0 10px 0 10px;padding:3px;border:1px solid #CCC;"';  
return preg_replace($patterns, $replacements, $string); 
}

function autobio_manual(){  		  
if( is_single() ) { 
$autobio_showauttxt = get_option('autobio_showauttxt'); 
$autobio_auttxt1 = get_option('autobio_auttxt1');
$autobio_auttxt2 = get_option('autobio_auttxt2');
$autobio_showautbio = get_option('autobio_showautbio'); 
$autobio_showautintro = get_option('autobio_showautintro'); 
$autobio_showautgra = get_option('autobio_showautgra');
$author = array(); 
$author['name'] = get_the_author();
$author['twitter'] = get_the_author_meta('twitter'); 
$author['facebook'] = get_the_author_meta('facebook'); 
$author['gplus'] = get_the_author_meta('gplus');
$author['youtube'] = get_the_author_meta('youtube');
$author['posts'] = (int)get_the_author_posts();
$email = get_the_author_email();  
ob_start(); 
?> 			  
<div id="autobio-div" style="background:#F7F7F7; margin:20px 0px 0px 0px; padding:10px 0; border:1px solid #E6E6E6; overflow:hidden; width:100%;" >  
<div class="autobio-bio-div-info"> 
<?php if($autobio_showautgra== 'y'){ ?> 					 
<?php echo autobio_gravatar( $email ); ?> 
<?php } ?> 					 
<h4 style"margin:0 0 4px 90px; padding:0;" > 
<?php printf( esc_attr__( '%s %s'), $autobio_showautintro, get_the_author() ); 
?></h4>
<?php if($autobio_showauttxt== 'y'){ ?> 
<p style="margin:0 0 0 90px; padding:0;" class="autobio-div-text"> 
<?php echo esc_attr(sprintf(__ngettext('%s %s %d %s', '%s %s %d %s', $author['posts'], $autobio_auttxt1, $autobio_auttxt2, 'autobio-div'), get_the_author_firstname().' '.get_the_author_lastname(), $autobio_auttxt1, $author['posts'], $autobio_auttxt2 ));
?>.</p> 
<?php } else echo "<br />"; ?> 
<?php if($autobio_showautbio== 'y'){ ?> 
<p style="margin:0 0 0 90px; padding:0;" class="autobio-div-meta"> 
<?php echo get_the_author_meta('description'); ?> 
</p> 					 
<?php } else echo "<br />"; ?> 

<ul style="overflow:hidden; margin:0 0 0 90px; padding:0;" > 
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/rss.png" width="32px" height="32px" /></a> </li>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo get_the_author_meta('url'); ?>" title="<?php echo esc_attr(sprintf(__('Blog de %s', 'autobio-div'), $author['name'])); ?>"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/Wordpress-icon.png" width="32px" height="32px" /></a></li> 
<?php if(!empty($author['twitter'])): ?>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['twitter']; ?>" title="<?php echo esc_attr(sprintf(__('Seguir a %s en Twitter', 'autobio-div'), $author['name'])); ?>" rel="external"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/Twitter-icon.png" width="32px" height="32px" /></a></li> 
<?php endif; ?>
<?php if(!empty($author['facebook'])): ?>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['facebook']; ?>" title="<?php echo esc_attr(sprintf(__('Hacerte amigo de %s  en Facebook', 'autobio-div'), $author['name'])); ?>" rel="external"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/Facebook-icon.png" width="32px" height="32px" /></a></li>
<?php endif; ?>
<?php if(!empty($author['gplus'])): ?>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['gplus']; ?>" rel="author" title="<?php echo esc_attr(sprintf(__('A&ntilde;ade a %s en tu circulo de amigos', 'autobio-div'), $author['name'])); ?>" rel="external"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/Google-icon.png" width="32px" height="32px" /></a></li>
<?php endif; ?>
<?php if(!empty($author['youtube'])): ?>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['gplus']; ?>" rel="author" title="<?php echo esc_attr(sprintf(__('A&ntilde;ade a %s en tu circulo de amigos', 'autobio-div'), $author['name'])); ?>" rel="external"><img src="<?php echo get_site_url(); ?>/wp-content/plugins/WPautobio/img/Youtube-icon.png" width="32px" height="32px" /></a></li>
<?php endif; ?>
</ul> 
</div>
<div class="comparte">Si te ha gustado este post, comp&aacute;rtelo!</div>
</div>
<?php }  
$autobio_bio = ob_get_clean();  
echo $autobio_bio;  
}     

function  autobio_shortcode(){  
$autobio_ab = autobio_manual(); 	 
return $autobio_ab;   
add_shortcode('author_bio', 'autobio_shortcode');  
}   
?>