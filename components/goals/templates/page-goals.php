<?php

$args = [
  'post_type' => 'acfg_goal',
  'numberposts' => -1
];
$posts = get_posts( $args );

?>


<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <button id="goal-create-button" class="btn btn-primary">Set Goal</button>
      <form id="goal-create-form">

        <label>Title</label>
        <input type="text" name="field_title" id="field_title" />

        <input type="submit" value="SAVE" />

        <a href="#">Cancel</a>

      </form>
    </div>
  </div>
</div>

<div class="container">
  <?php if( $posts ): foreach( $posts as $post ): ?>
    <div class="row">
      <div class="col-md-12">
        <h6><?php print $post->ID; ?></h6>
        <h4><?php print $post->post_title; ?></h4>
        <a href="<?php print get_permalink( $post ); ?>" class="btn btn-secondary">View Goal</a>
      </div>
    </div>
  <?php endforeach; endif; ?>
</div>

<?php get_footer(); ?>
