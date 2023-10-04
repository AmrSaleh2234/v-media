$(document).ready(function() {


    $('.checkRow').on('change', function() {
        // Check if any checkbox with the specified class is checked
        if ($('.checkRow:checked').length > 0) {
          // Do something when a checkbox is checked
          var checkedValues = $('.checkRow:checked').map(function() {
            return this.value;
          }).get();

          if($('.checkRow:checked').length == 1) {
            $('.editedId').val(checkedValues);
            $('#edit').removeClass('disabled');
          } else {
            $('.editedId').val('');
            $('#edit').addClass('disabled');
          }

          $('.deletedIds').val(checkedValues);
          $('#delete').removeClass('disabled');

        } else {
          // Do something when no checkbox is checked
          $('#delete').addClass('disabled');
          $('#edit').addClass('disabled');
          $('.deletedIds').val('');
          $('.editedId').val('');
        }
      });
});
