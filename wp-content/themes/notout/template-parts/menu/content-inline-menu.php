<div class="header-bg-box">
<div class="header-top-bar">
  <div class="header-content-box">
   <div class="left-list">
      <ul>
	     <li>🎯 সর্বোচ্চ অডস গ্যারান্টি</li>
	     <li>⚡ ৫ মিনিটে তাৎক্ষণিক উত্তোলন</li>
		 <li>🎁 প্রতিদিন নতুন বোনাস</li>
	  </ul>
   </div>
   <div class="right-list">
   <ul>
	     <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><script xmlns="" id="eppiocemhmnlbhjplcgkofciiegomcon"/><script xmlns=""/><script xmlns=""/><path fill="#31373D" d="M34.06 26.407l-3.496-3.496c-1.93-1.93-5.06-1.93-6.989 0-.719.718-1.167 1.603-1.351 2.528-5.765-1.078-11.372-6.662-11.721-11.653.947-.176 1.854-.627 2.586-1.36 1.93-1.93 1.93-5.06 0-6.99L9.594 1.94c-1.93-1.93-5.06-1.93-6.99 0-10.486 10.486 20.97 41.942 31.456 31.456 1.929-1.929 1.929-5.059 0-6.989z"/></svg> ২৪/৭ সাপোর্ট</a></li>
	     <li><a herf="#">বাংলা</a> <a herf="#">| EN</a></li>
		 
	  </ul>
   </div>
   </div>
</div>
<header id="masthead" class="notout-header notout-inline-menu">
		<nav id="site-navigation" class="notout-navbar">
		    <div class="container">
				<div class="notout-menu-wrap">
					<div class="notout-brand-wrap">
						<?php  
							/**
							 * notout_before_logo hook
							 */
							do_action( 'notout_before_logo' );
						?>
						<a class="notout-navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php notout_custom_logo(); ?>
						</a>
						<?php  
							/**
							 * notout_after_logo hook
							 */
							do_action( 'notout_after_logo' );
						?>
						<span class="notout-navbar-toggler js-show-nav">
							<i class="fas fa-bars"></i>
						</span>
					</div>
					<?php
						if( has_nav_menu( 'primary' ) ) :
							wp_nav_menu( array(
								'theme_location'	=> 'primary',
								'container'			=> false,
								'menu_class'		=> 'notout-main-menu notout-inline-menu',
								'menu_id'			=> false,
							) );
						endif;
					?>
				</div>
				<div class="head-right-button">
		      <ul>
			      <li class="login-btn"><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.25 2.25H14.25C14.6478 2.25 15.0294 2.40804 15.3107 2.68934C15.592 2.97064 15.75 3.35218 15.75 3.75V14.25C15.75 14.6478 15.592 15.0294 15.3107 15.3107C15.0294 15.592 14.6478 15.75 14.25 15.75H11.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 12.75L11.25 9L7.5 5.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.25 9H2.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span>লগইন</span></a></li>
				  <li class="nibondon-btn"><a href="#">নিবন্ধন করুন</a></li>
			 </ul>
		</div>
		    </div>
			
		</nav>
		
	</header><!-- #masthead -->
	</div>