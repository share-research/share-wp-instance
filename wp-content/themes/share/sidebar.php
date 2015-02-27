<aside id="sidebar" role="complementary">
  <div id="primary" class="widget-area">
    <ul class="xoxo">
    
    <?php 
      // News sidebar
      if (get_post_type() === 'news') {
        dynamic_sidebar('news-sidebar');
      }
      // Knowledge Base sidebar
      if (get_post_type() === 'knowledge-base') {
        // Build subnavigation based on the section this knowledge domain is in
        $currentPageID = $post->ID;
        $terms = wp_get_post_terms($post->ID, 'section');

        foreach( $terms as $term ) : 
          
          echo '<li class="pagenav knowledge-base-items">';
          echo '<h3>' . $term->name . '</h3>';
          echo '<ul>';

          $posts = new WP_Query( "taxonomy=section&term=$term->slug" );

          if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post();
              if (get_the_ID() === $currentPageID) { // Mark current item as active
                echo '<li class="current_page_item">';
              }
              else {
                echo '<li>';
              }
              echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a>';
              echo '</li>';
          endwhile; endif;

          echo '<li><a href="' . get_bloginfo('url') . '/knowledge-base/" title="SHARE Knowledge Base">&laquo; SHARE Knowledge Base home</a></li>';
          echo '</ul>';
          echo '</li>';

        endforeach;
      }
      else {
        // Create subnav for this section, if subnav exists
        echo list_section_navigation();
        // dynamic_sidebar('primary-widget-area'); 
      }
    ?>

    </ul>
  </div>
</aside>