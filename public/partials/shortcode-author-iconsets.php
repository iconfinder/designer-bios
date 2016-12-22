<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php if ( $iconsets ) : ?>
    <div class="iconsets">
         <ul>
            <?php foreach ( $iconsets as $iconset ) : ?>
                <?php
                    $identifier = Utils::get( $iconset, 'identifier' );
                    $preview    = get_iconfinder_preview_url( 'medium', $identifier );
                    $alt_text   = Utils::get( $iconset, 'name' );
                ?>
                <li>
                    <a href="https://iconfinder.com/iconsets/<?php echo $identifier; ?>?ref=<?php echo $username; ?>" target="_blank">
                        <img src="<?php echo $preview; ?>" title="<?php echo $alt_text; ?>" alt="<?php echo $alt_text; ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<p class="iconfinder-username">
    <a href="https://iconfinder.com/<?php echo $username; ?>?ref=<?php echo $username; ?>" title="Follow <?php echo $username; ?> on Iconfinder" target="_blank">Follow <?php echo $username; ?> on Iconfinder.com</a>
</p>