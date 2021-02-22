<article class="tilePanel visible <?php if ($days == 0) : ?>tilePanel--achieved <?php else: ?>tilePanel--active <?php endif; ?>" address="<?php the_field('tile_address'); ?>" targetPrice="<?php the_field('tile_info_price'); ?>" postid="<?php echo get_the_ID(); ?>">
    
    <div class="tilePanel__thumb">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php the_field('tile_image'); ?>" />
            <div class="tilePanel__date" from="<?php echo current_time('d.m.Y') ?>" to="<?php the_field('tile_info_date'); ?>" days="<?php echo $days; ?>">
                <?php
                if ($days >= 2) {
                    echo "Zostało " . $days . " dni";
                } else if ($days == 1) {
                    echo "Został " . $days . " dzień";
                } else if ($days == 0) {
                    echo "Zakończone";
                }
                ?>
            </div>
        </a>
    </div>
    <div class="tilePanel__financialInfo">
        <div class="tilePanel__financialInfo--target">
            <div class="tilePanel_financialInfo--donations">
                <?php
                $post_id = get_the_ID();
                $total = 0;
                $blogusers = get_users('blog_id=2');
                foreach ($blogusers as $user) :
                    $user_id = 'user_' . esc_html($user->ID);
                ?>
                    <?php if (have_rows('user_investment', $user_id)) : ?>
                        <?php while (have_rows('user_investment', $user_id)) : the_row();
                            $investments = get_sub_field('user_investment_name');
                            $investmentID = $investments['selected_posts'][0];
                            $value = get_sub_field('user_investment_value');
                            $requestAccept = get_sub_field('user_investment_accept');
                        ?>
                            <?php if ($requestAccept == 'true'): ?>
                                <?php if ($investmentID == $post_id) : ?>
                                    <span class="value" style="display: none;"><?php echo $value; ?></span>
                                    <span class="investor" style="display: none;">1</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <p><b><span class="targetPercent">0</span>% zrealizowanego celu</b></p>
            <p class="status"><span class="total">0</span> / <span class="target"><?php the_field('tile_info_price'); ?></span> PLN</p>
        </div>
        <div class="tilePanel__financialInfo--investors">
            <img src="/wp-content/themes/waterbridge/images/icons/investments_ico.svg" />
            <p><span class="investors">0</span> inwestorów</p>
        </div>
    </div>
    <div class="tilePanel__statusBar">
        <div class="tilePanel__statusBar--current"></div>
    </div>
    <div class="tilePanel__content">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="address"><?php the_field('tile_address'); ?></p>
        <p class="desc"><?php the_field('tile_short_desc'); ?></p>
        <div class="requestInfo" style="display: none;">
            <p>Kwota inwestycji</p>
            <p class="value"><span>0</span> zł</p>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn"><span>Zobacz szczegóły</span></a>
        <p class="requestProcess" style="display: none;">Nie dostałeś umowy? <a href="#">Wyślij jeszcze raz</a>.</p>
    </div>
</article>