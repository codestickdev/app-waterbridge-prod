<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Waterbridge_APP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="/wp-content/themes/waterbridge/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/waterbridge/plugins/slick/slick.css"/>
	
	<?php wp_head(); ?>	
</head>
<?php
	$currentUserID = get_current_user_id();
	$user_info = get_userdata($currentUserID);
?>
<body <?php body_class(); ?> userid="<?php echo get_current_user_id(); ?>" username="<?php echo $user_info->first_name . ' ' . $user_info->last_name; ?>" email="<?php echo $user_info->user_email; ?>" logout="<?php echo wp_logout_url( home_url() ); ?>">
<?php wp_body_open(); ?>
<div id="userBase" style="display: none !important;">
	<?php if (have_rows('user_investment', $user_info)) : ?>
		<div class="investmentPositions">
			<?php while (have_rows('user_investment', $user_info)) : the_row();
				$investments = get_sub_field('user_investment_name');
				$investmentID = $investments['selected_posts'][0];
				$value = get_sub_field('user_investment_value');
				$accept = get_sub_field('user_investment_accept');
			?>
				<div class="investmentPosition">
					<span class="investmentID"><?php echo $investmentID; ?></span>
					<span class="investmentValue"><?php echo $value; ?></span>
					<span class="investmentAccepted"><?php if($accept == 'true'){echo 'TAK';}else{echo 'NIE';}; ?></span>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'waterbridge' ); ?></a>

	<header id="masthead" class="siteHeader siteHeader--subpage container">
		<div class="siteHeader__logo">
			<a href="http://waterbridge.pl/" rel="home" class="logo_dark"><img src="/wp-content/themes/waterbridge/images/logo.svg"/></a>
			<a href="http://waterbridge.pl/" rel="home" class="logo_white"><img src="/wp-content/themes/waterbridge/images/logo_white.svg"/></a>
		</div>
		<nav id="site-navigation" class="main-navigation siteHeader__menu">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<?php
			switch_to_blog(1);
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			switch_to_blog(2);
			?>
		</nav>
	</header>
