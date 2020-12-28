jQuery(document).ready(function( $ ) {

  $('form').submit( function( e ) {

    e.preventDefault();

    let postId = $('#field_post_id').val();
    let dueDate = $('#field_due_date').val();
    $('.goal-due-date').html( dueDate );

    /* do post */

    let data = {
      postId: postId,
      dueDate: dueDate
    }
    wp.ajax.post( 'goal_save', data ).done(
      function( response ) {
        console.log( response );
      }
    );

  });

});
