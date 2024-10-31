<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="container bg-white my-4 px-0 border rounded shadow" style="max-width: 800px;">       
        <?php     
        if ( have_posts() ):			
            // Load posts loop.
            while ( have_posts() ) :
                the_post();
                ?>
                <?php
                if(has_post_thumbnail()){
                    the_post_thumbnail( 'full', ['class' => 'w-100 h-auto'] );
                }
                ?>
                <div class="p-4">
                    <?php the_title('<h1>', '</h1>'); ?>
                    <?php the_content(); ?>
                </div>
                <?php
            endwhile;
        endif;
        ?>
        </div>
    </div>
<?php wp_footer(); ?>
</body>
</html>