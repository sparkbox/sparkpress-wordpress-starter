<?php
/**
 * Search Form
 */

?>

<form
	role="search"
	method="get"
	id="search"
	class="cmp-search"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
>
	<label for="s">Search Website</label>
	<input
		type="text"
		value="<?php echo get_search_query(); ?>"
		placeholder="Search"
		name="s"
		id="s"
	/>
</form>
