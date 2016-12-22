<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="designer-bio <?php echo $username; ?>-bio vcard">
    <?php if ( Utils::is_true($show_avatar ) ) : ?>
    <div class="avatar">
        <?php echo $avatar; ?>
    </div>
    <?php endif; ?>
    <?php if ( Utils::is_true($show_bio ) ) : ?>
    <div class="bio">
        <h4 class="name fn n">Article by <?php $nickname; ?></h4>
        <?php if ( $show_bio ) : ?>
            <p><?php echo $bio; ?></p>
        <?php endif; ?>
    </div>
    <?php else : ?>
        <h2>Icon sets by <?php echo $username; ?></h2>
    <? endif; ?>
    <?php if ( $iconsets ) : ?>
    <div class="samples col-<?php echo $count; ?>">
        <div class="iconsets">
            <ul>
                <?php foreach ( $iconsets as $iconset ) : ?>
                    <?php
                    $identifier = Utils::get( $iconset, 'identifier' );
                    $preview    = get_iconfinder_preview_url( 'medium', $identifier );
                    $alt_text   = Utils::get( $iconset, 'name' );
                    ?>
                    <li>
                        <a href="https://iconfinder.com/iconsets/<?php echo $identifier; ?><?php echo $ref_code; ?>" target="_blank">
                            <img src="<?php echo $preview; ?>" title="<?php echo $alt_text; ?>" alt="<?php echo $alt_text; ?>" />
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    <p class="iconfinder-username">
        <a href="https://iconfinder.com/<?php echo $username; ?><?php echo $ref_code; ?>" title="Follow <?php echo $username; ?> on Iconfinder" target="_blank">Follow <?php echo $username; ?> on Iconfinder.com</a>
    </p>
</div>
