<form role="search" action="/" method="get" class="search-form d-flex ms-auto">
    <input
        placeholder="Search topics and more"
        class="form-control me-2"
        type="text"
        name="s"
        id="search"
        value="<?php the_search_query(); ?>" />
    <button
        class="btn btn-outline-success"
        type="submit">Search</button>
</form>