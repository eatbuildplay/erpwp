jQuery(document).ready(function( $ ) {

  $('.add-button').on('click', function() {
    console.log('add click...')
  });

  $('#add-form').submit( function( e ) {

    e.preventDefault();

    let firstName = $('#field_last_name').val();
    let lastName = $('#field_first_name').val();

    let data = {
      firstName: firstName,
      lastName: lastName
    }
    wp.ajax.post( 'recruit_create', data ).done(
      function( response ) {
        console.log( response );
      }
    );

  });

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
