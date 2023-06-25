jQuery(document).ready(function($) {
  // Check if we are on the edit page of the mltp_contact post type
  if ($('#post_type').val() === 'mltp_contact') {
    var isTitleFocused = false;

    // Function to update first_name, last_name, and title
    function updateFields() {
      // Get the current values of first_name, last_name, and title
      var currentFirstName = $.trim($('#first_name').val());
      var currentLastName = $.trim($('#last_name').val());
      var currentTitle = $.trim($('#title').val());
      var currentCompany = $.trim($('#company').val());

      // Check if the changes were made by the user
      var isTitleFieldFocused = document.activeElement === $('#title')[0];
      var isTitlePartFocused = document.activeElement === $('#first_name')[0] || document.activeElement === $('#last_name')[0]  || document.activeElement === $('#company')[0];
      var userModified =
        (isTitleFocused && currentTitle !== '') ||
        (isTitlePartFocused && (currentFirstName !== '' || currentLastName !== '' || currentCompany !== ''));

      // Update the title if first_name or last_name is modified
      if (userModified && isTitlePartFocused && (currentFirstName + currentLastName + currentCompany !== '')) {
        var updatedTitle = $.trim(currentFirstName + ' ' + currentLastName);
        if (currentCompany !== '') {
          var separator = ( updatedTitle !== '' ) ? ' - ' : '';
          updatedTitle = updatedTitle + separator + currentCompany;
        }
        $('#title').val(updatedTitle);
        $('#title-prompt-text').hide();
      } else if (isTitleFieldFocused && currentTitle !== '') {
        // Split the title by the first space to update first_name and last_name
        var spaceIndex = currentTitle.indexOf(' ');

        if (spaceIndex === -1) {
          // Update first_name when there is no space in the title
          if (currentFirstName !== currentTitle) {
            $('#first_name').val(currentTitle);
          }
          // Clear last_name
          if (currentLastName !== '') {
            $('#last_name').val('');
          }
        } else {
          var cleanTitle = currentTitle.replace(/ - .*/, ''); // Strip the " - .*" part of the title
          var updatedFirstName = $.trim(cleanTitle.substring(0, spaceIndex));
          var updatedLastName = $.trim(cleanTitle.substring(spaceIndex + 1));

          // Update first_name and last_name if the values are different
          if (currentFirstName !== updatedFirstName) {
            $('#first_name').val(updatedFirstName);
          }
          if (currentLastName !== updatedLastName) {
            $('#last_name').val(updatedLastName);
          }
        }
      }

      // Append company to the title with separator if company field is not empty
    }

    // Bind the updateFields function to the input and focus events of first_name, last_name, company, and title fields
    $('#first_name, #last_name, #company, #title').on({
      input: updateFields,
      focus: function() {
        if (this.id === 'title') {
          isTitleFocused = true;
        } else {
          isTitleFocused = false;
        }
      },
      blur: function() {
        isTitleFocused = false;
      }
    });

    // Trigger the updateFields function on page load
    updateFields();
  }
});
