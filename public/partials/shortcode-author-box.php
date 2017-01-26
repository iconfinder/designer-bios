<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="designer-bio <?php echo $username; ?>-bio vcard">
    <?php if ( ICF_Utils::is_true($show_avatar ) ) : ?>
    <div class="avatar">
        <?php echo $avatar; ?>
    </div>
    <?php endif; ?>
    <?php if ( $show_bio ) : ?>
    <div class="bio">
        <h4 class="name fn n">Article by <?php echo $username; ?></h4>
        <p><?php echo $bio; ?></p>
    </div>
    <?php else : ?>
        <h4>Icon sets by <?php echo $username; ?></h4>
    <? endif; ?>
    <?php if ( $iconsets ) : ?>
    <div class="samples col-<?php echo $count; ?>">
        <div class="iconsets">
            <ul>
                <?php foreach ( $iconsets as $iconset ) : ?>
                    <?php
                    $identifier = ICF_Utils::get( $iconset, 'identifier' );
                    $preview    = ICF_Utils::get_iconfinder_preview_url( 'medium', $identifier );
                    $alt_text   = ICF_Utils::get( $iconset, 'name' );
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
