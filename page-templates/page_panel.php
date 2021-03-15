<?php
/*
*   Template name: Panel inwestora
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--projects">
    <section class="subpageHeader container subpageHeader--projects">
        <div class="breadcrumb">
            <a href="http://waterbridge.pl/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
        <h1>Panel <b>inwestora</b></h1>
        <?php $current_user = wp_get_current_user(); ?>
        <p>Witaj, <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname ?></p>
        <div class="catSelect">
            <button class="catSelect__btn active" select="all">Wszystkie projekty (<span class="all">0</span>)</button>
            <button class="catSelect__btn" select="request">Twoje dyspozycje (<span class="request">0</span>)</button>
            <button class="catSelect__btn" select="accepted">Zatwierdzone pozycje (<span class="accepted">0</span>)</button>
        </div>
    </section>
    <section class="projectsFilter container">
        <div class="projectsFilter__database">
        <?php
            $args = array(
                'posts_per_page'   => -1,
                'post_type'     => 'projects',
                'post_status'   => 'publish',
            );
            $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()) : ?>
            <ul class="prices">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <li data="<?php the_field('tile_info_price'); ?>"></li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </div>
        <div class="projectsFilter__wrap">
            <div class="projectsFilter__filter">
                <p class="projectsFilter__secTitle">Filtruj według:</p>
                <div class="filterRow filterRow--value">
                    <p><span class="value">Wartość inwestycji</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
                    <div class="filterDropdown dropdown">
                        <label class="amount amount--from">Koszt inwestycji od: <input type="text" id="valFrom" value="10 PLN" /></label>
                        <label class="amount amount--to">Koszt inwestycji do: <input type="text" id="valTo" value="100 PLN" /></label>
                        <div id="slider-range"></div>
                    </div>
                </div>
                <div class="filterRow filterRow--location">
                    <p><span class="value">Lokalizacja</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
                    <div class="filterDropdown dropdown">
                        <p class="title">Dostępne lokalizacje</p>
                        <?php
                            $args = array(
                                'numberposts'   => -1,
                                'post_type'     => 'projects',
                                'post_status'   => 'publish',
                            );
                            $the_query = new WP_Query($args);
                        ?>
                        <?php if ($the_query->have_posts()) : ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="dropdown__checkbox not-checked">
                                <input type="checkbox" name="<?php the_field('tile_address'); ?>"/>
                                    <label for="<?php the_field('tile_address'); ?>"><?php the_field('tile_address'); ?></label>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
            <div class="projectsFilter__sort sortBy">
                <!-- <p class="projectsFilter__secTitle">Sortuj według: <span>Najnowsze</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
                <div class="sortBy__dropdown">
                    <div class="sortBy__select not-checked">
                        <input type="checkbox" name="od_najmniejszej"/>
                        <label for="od_najmniejszej">Od najmniejszej kwoty</label>
                    </div>
                    <div class="sortBy__select not-checked">
                        <input type="checkbox" name="od_najwiekszej"/>
                        <label for="od_najwiekszej">Od najwiekszej kwoty</label>
                    </div>
                    <div class="sortBy__select not-checked">
                        <input type="checkbox" name="najmniej_wplat"/>
                        <label for="najmniej_wplat">Najmniej wpłat</label>
                    </div>
                    <div class="sortBy__select not-checked">
                        <input type="checkbox" name="najwiecej_wplat"/>
                        <label for="najwiecej_wplat">Najwiecej wpłat</label>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <?php
    $args = array(
        'numberposts'    => -1,
        'post_type'        => 'projects',
        'post_status'   => 'publish',
    );
    $the_query = new WP_Query($args);
    ?>
    <?php if ($the_query->have_posts()) : ?>
        <section class="projectList container">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php
                    $date_from  = current_time('d.m.Y');
                    $date_to    = get_field('tile_info_date');

                    $date_1     = new DateTime(date('Y-m-d', strtotime($date_from)));
                    $date_2     = new DateTime(date('Y-m-d', strtotime($date_to)));

                    $days       = $date_1->diff($date_2)->days;
                    if($date_1 >= $date_2){
                        $days = 0;
                    }
                    ?>
                    <?php include get_template_directory() . '/template-parts/_tilePanel.php'; ?>
                <?php endwhile; ?>
        </section>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
    <?php switch_to_blog(1); ?>
    <section class="investorChangeData">
        <div class="investorChangeData__content">
            <h2>Chcesz zmienić swoje dane?</h2>
            <p>Twoje dane chronione są przed niepożądanymi zmianami, oraz w celu prawidłowej obsługi umowy inwestycyjnej.</p>
            <p>Aby je zmienić <a href="<?php echo get_site_url() . '/kontakt'; ?>">skontaktuj się z działem obsługi prywatnych inwestorów</a>.</p>
        </div>
    </section>
    <?php switch_to_blog(2); ?>
    <section class="investorPrivate">
        <div class="investorPrivate__content">
            <h2><?php the_field('inwestorPanel_bok_title'); ?></h2>
            <div class="investorPrivate__persons">
                <img src="<?php the_field('inwestorPanel_bok_image'); ?>"/>
                <p class="person"><?php the_field('inwestorPanel_bok_name'); ?></p>
                <p class="position"><?php the_field('inwestorPanel_bok_position'); ?></p>
            </div>
            <div class="investorPrivate__contact">
                <a href="tel:<?php the_field('inwestorPanel_bok_phone'); ?>" class="btn"><span>Zadzwoń <?php the_field('inwestorPanel_bok_phone'); ?></span></a>
                <p>lub napisz do nas na adres e-mail <a href="mailto:<?php the_field('inwestorPanel_bok_email'); ?>"><?php the_field('inwestorPanel_bok_email'); ?></a></p>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>