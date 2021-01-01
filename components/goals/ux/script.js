jQuery(document).ready(function( $ ) {

  $('#goal-create-button').on('click', function() {

    $('#goal-create-form').show();

  });

  /* Goal create form process */
  $('#goal-create-form').submit( function( e ) {

    e.preventDefault();

    let title = $('#field_title').val();

    let data = {
      postId: 0,
      title: title,
    }
    wp.ajax.post( 'goal_save', data ).done(
      function( response ) {
        console.log( response );
      }
    );


  });


  /* Goal save form process */
  $('#goal-save-form').submit( function( e ) {

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
