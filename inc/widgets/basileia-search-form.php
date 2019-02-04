<?php ?>
<div class="search-block">    
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input  id="menu-search" type="search" class="search-field basileia-search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'basileia' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button id="searchsubmit" type="submit" class="fa fa-search" name="post_type" value="product"></button>
</form>
</div>
