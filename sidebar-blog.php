
        <aside class="blog-sidebar sidebar">

            <?php if (get_field('sidebar_menu', $args['ID'])) : ?>

                <div class="widget">

                    <h3 class="txt-center widget__title h3"><?= get_field('titulo_del_menu', $args['ID']) ?></h3>

                    <?php wp_nav_menu(array('menu' => get_field('sidebar_menu', $args['ID']), 'menu_class' => 'categories__items', 'container_class' => 'categories widget__content')) ?>

                </div>

            <?php endif ?>


            <?php if (get_field('blog_sidebar_menu', $args['ID'])) : ?>

                <div class="widget">

                    <h3 class="txt-center widget__title h3"><?= get_field('titulo_del_blog_menu', $args['ID']) ?></h3>

                    <?php wp_nav_menu(array('menu' => get_field('blog_sidebar_menu', $args['ID']), 'menu_class' => 'categories__items', 'container_class' => 'categories widget__content')) ?>

                </div>

            <?php endif ?>

            <?php dynamic_sidebar('blog_sidebar') ?>

        </aside>

