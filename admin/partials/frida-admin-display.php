<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mattwoods.io/
 * @since      1.0.0
 *
 * @package    Frida
 * @subpackage Frida/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

  <h2 style="margin-bottom: 1rem;"><?php echo esc_html(get_admin_page_title()); ?></h2>

  <form method="post" name="frida_options" action="options.php">

    <?php
    $options = get_option($this->plugin_name);

    $refresh = $options['refresh'];

    settings_fields($this->plugin_name);
    do_settings_sections($this->plugin_name);
    ?>

    <fieldset>
      <legend class="screen-reader-text"><span>Refresh head section</span></legend>
      <label for="<?php echo $this->plugin_name; ?>-refresh">
        <input type="checkbox" id="<?php echo $this->plugin_name; ?>-refresh" name="<?php echo $this->plugin_name; ?>[refresh]" value="1" <?php checked($refresh, 1) ?> />
        <span class="dashicons dashicons-format-gallery" style="margin-left: 0.5rem;"></span>
        <span><?php esc_attr_e('Refresh thumbnails', $this->plugin_name); ?></span>
      </label>
    </fieldset>

    <?php submit_button('Save changes', 'primary', 'submit', TRUE); ?>

  </form>

  <h2>Thumbnails</h2>

  <?php
  $all_posts_query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1)); ?>

  <?php if ($all_posts_query->have_posts()) : ?>

    <table class="form-table">
      <tr>
        <th class="row-title"><?php esc_attr_e('Thumbnail', 'WpAdminStyle'); ?></th>
        <th><?php esc_attr_e('Post', 'WpAdminStyle'); ?></th>
      </tr>

      <!-- the loop -->
      <?php while ($all_posts_query->have_posts()) : $all_posts_query->the_post(); ?>


        <tr valign="top" class="<?= $all_posts_query->current_post % 2 === 0 ? 'alternate' : null ?>">
          <td scope=" row"><label for="tablecell">

              <div style="margin-bottom: 4rem;">
                <a href="<?= get_edit_post_link() ?>">
                  <?php
                      if (has_post_thumbnail()) {
                        the_post_thumbnail('medium_large');
                      }
                      ?>
                </a>


                <?php
                    $args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => get_the_ID());
                    $attachments = get_children($args);

                    if (count($attachments) > 1) {
                      echo ('<h4>Attached Images</h4>');
                      if ($attachments) {
                        foreach ($attachments as $attachment) {
                          the_attachment_link($attachment->ID, false);
                        }
                      }
                    }
                    ?>
              </div>
            </label></td>
          <td>
            <a href="<?php the_permalink(); ?>">
              <h3><?php the_title(); ?></h3>
            </a>
            <?php edit_post_link('Edit post', '<p>', '</p>'); ?>

            <p>Last edited:
              <?= the_modified_date() ?>
            </p>
          </td>
        </tr>

      <?php endwhile; ?>

    </table>




    <?php wp_reset_postdata(); ?>

  <?php else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>

</div>