<?php get_header(); ?>

<?php

//var_dump( $post );

?>

<h1><?php print $post->post_title; ?></h1>
<h3>Due By: <span class="goal-due-date">
  <?php print get_post_meta( $post->ID, 'due_date', 1 ); ?>
</span></h3>

<div class="container">
  <div class="row">
    <form>

      <input id="field_post_id" type="hidden" value="<?php print $post->ID; ?>" />

      <div class="form-group">
        <label>Due Date</label>
        <input id="field_due_date" class="form-control" type="text" />
      </div>

      <div class="form-group">
        <input class="form-control" id="field_save_button" type="submit" value="Save" />
      </div>

    </form>
  </div>
</div>







<?php get_footer(); ?>
