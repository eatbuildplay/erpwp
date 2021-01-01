<?php get_header(); ?>

<div class="container">

  <button class="btn open-add-form-button">Add Recruit</button>

  <form id="add-form">

    <div class="row">
      <label>First Name</label>
      <input class="form-control" type="text" />
    </div>

    <div class="row">
      <label>Last Name</label>
      <input id="field_last_name" class="form-control" type="text" />
    </div>

    <div class="row">
      <input id="field_first_name" class="btn btn-success" type="submit" value="SAVE" />
    </div>

  </form>

</div><!-- ./container -->

<?php get_footer(); ?>
