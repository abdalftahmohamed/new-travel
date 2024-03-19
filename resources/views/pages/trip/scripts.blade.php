{{--images--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        function previewFile(input, target) {
            input.change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        }
        // Call the function for each file input
        previewFile($('#image'), '#showImage');
        previewFile($('#images'), '#showImages');
        previewFile($('#documents'), '#showDocuments');
        previewFile($('#videos'), '#showVideos');
    });
</script>



{{--address--}}
<script>
    $(document).ready(function () {
        // Initialize a global counter variable
        var rowCounter = 2;

        // Event handler for the "Add New Address" button
        $('input[data-repeater-create1]').on('click', function () {

                // Clone the first row
            var newRow = $('#exampleTable1 #exampleModal1Label tr[data-repeater-address]:first').clone();

            // Set the counter value in the cloned row
            newRow.find('td:first').text(rowCounter);

            // Increment the counter for the next row
            rowCounter++;

            // Clear input values in the cloned row
            newRow.find('#name_address_ar').val('');
            newRow.find('#name_address_en').val('');
            newRow.find('#name_address_ur').val('');


            // // Append the cloned row to the table
            // $('#exampleTable1 #exampleModal1Label').append(newRow);
            //
            // // Clone the expandable body row and append it after the cloned row
            // var newExpandableBody1 = $('#exampleTable1 #exampleModal1Label #expandable-body1:first').clone();
            // newExpandableBody1.find('#description_address_ar').val('');
            // $('#exampleTable1 #exampleModal1Label').append(newExpandableBody1);
            //
            // var newExpandableBody2 = $('#exampleTable1 #exampleModal1Label #expandable-body2:first').clone();
            // newExpandableBody2.find('#description_address_en').val('');
            // $('#exampleTable1 #exampleModal1Label').append(newExpandableBody2);
            //
            // var newExpandableBody3 = $('#exampleTable1 #exampleModal1Label #expandable-body3:first').clone();
            // newExpandableBody3.find('#description_address_ur').val('');
            // $('#exampleTable1 #exampleModal1Label').append(newExpandableBody3);


            // Append the cloned row to the table
            $('#exampleModal1Label').append(newRow);

            // Clone and append expandable body rows for each language
            var expandableBodies = ['#expandable-body1', '#expandable-body2', '#expandable-body3'];
            var languages = ['ar', 'en', 'ur'];

            for (var i = 0; i < expandableBodies.length; i++) {
                var newExpandableBody = $('#exampleModal1Label ' + expandableBodies[i] + ':first').clone();
                newExpandableBody.find('#description_address_' + languages[i]).val('');
                $('#exampleModal1Label').append(newExpandableBody);
            }
        });

        // Event handler for the "Delete" button
        $('table').on('click', 'input[data-repeater-delete1]', function () {
            if ($('.repeater tr[data-repeater-address]').length > 1 ) {
                // Get the closest parent <tr> and remove it
                var deletedRow = $(this).closest('tr');
                deletedRow.slideUp(function () {
                    $(this).next('#expandable-body1').remove(); // Remove corresponding expandable body row
                    $(this).next('#expandable-body2').remove(); // Remove corresponding expandable body row
                    $(this).next('#expandable-body3').remove(); // Remove corresponding expandable body row
                    $(this).remove(); // Remove the main row
                });
            } else {
                alert("At least one row must remain!");
            }
        });


        // Function to collect and format data for address
        function collectFormDataAddress() {
            var formData = [];

            // Iterate over each repeater item
            $('.repeater [data-repeater-address]').each(function () {
                var addressData = {
                    "name_address_ar": $(this).find('[name="name_address_ar"]').val(),
                    "name_address_en": $(this).find('[name="name_address_en"]').val(),
                    "name_address_ur": $(this).find('[name="name_address_ur"]').val(),
                    "description_address_ar": $(this).nextAll('.expandable-body').eq(0).find('[name="description_address_ar"]').val(),
                    "description_address_en": $(this).nextAll('.expandable-body').eq(1).find('[name="description_address_en"]').val(),
                    "description_address_ur": $(this).nextAll('.expandable-body').eq(2).find('[name="description_address_ur"]').val(),
                };
                formData.push(addressData);
            });

            return formData;
        }

        // Function to handle form submission
        $('form.custom-validation').submit(function (event) {
            event.preventDefault();

            // Collect form data
            var addressList = collectFormDataAddress();
            // Create hidden input fields and append them to the form
            $('<input>').attr({
                type: 'hidden',
                name: 'List_Address',
                value: JSON.stringify(addressList),
            }).appendTo($(this));

            // Submit the form
            $(this).unbind('submit').submit();
        });

    });
</script>


{{--image--}}
{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        // Initialize a global counter variable--}}
{{--        var rowCounter = 2;--}}

{{--        // Event handler for the "Add New Item" button--}}
{{--        $('input[data-repeater-create2]').on('click', function () {--}}
{{--            // Clone the first row--}}
{{--            var newRow = $('#exampleTable2 #exampleModal2Label tr:first').clone();--}}

{{--            // Set the counter value in the cloned row--}}
{{--            newRow.find('td:first').text(rowCounter);--}}

{{--            // Increment the counter for the next row--}}
{{--            rowCounter++;--}}

{{--            // Clear input values in the cloned row--}}
{{--            newRow.find('#name_image').val('');--}}


{{--            // Append the cloned row to the table--}}
{{--            $('#exampleTable2 #exampleModal2Label').append(newRow);--}}

{{--            // Clone the expandable body row and append it after the cloned row--}}
{{--            var newExpandableBody = $('#exampleTable2 #exampleModal2Label tr.expandable-body:first').clone();--}}
{{--            newExpandableBody.find('[name="description_image"]').val('');--}}
{{--            $('#exampleTable2 #exampleModal2Label').append(newExpandableBody);--}}
{{--        });--}}

{{--        // Event handler for the "Delete" button--}}
{{--        $('table').on('click', 'input[data-repeater-delete2]', function () {--}}
{{--            if ($('.repeater tr[data-repeater-image]').length > 1 ) {--}}
{{--                // Get the closest parent <tr> and remove it--}}
{{--                var deletedRow = $(this).closest('tr');--}}
{{--                deletedRow.slideUp(function () {--}}
{{--                    $(this).next('tr.expandable-body').remove(); // Remove corresponding expandable body row--}}
{{--                    $(this).remove(); // Remove the main row--}}
{{--                });--}}
{{--            } else {--}}
{{--                alert("At least one row must remain!");--}}
{{--            }--}}
{{--        });--}}


{{--        function collectFormDataImage() {--}}
{{--            var formData = [];--}}

{{--            // Iterate over each repeater item--}}
{{--            $('.repeater [data-repeater-image]').each(function () {--}}
{{--                var imageData = {--}}
{{--                    "name_image": $(this).find('[name="name_image"]').val(),--}}
{{--                    "description_image": $(this).next('tr.expandable-body').find('[name="description_image"]').val(),--}}
{{--                };--}}

{{--                formData.push(imageData);--}}
{{--            });--}}

{{--            return formData;--}}
{{--        }--}}


{{--        function collectFormDataImage11() {--}}
{{--            var formData = new FormData();--}}

{{--            // Iterate over each repeater item--}}
{{--            $('.repeater [data-repeater-image]').each(function (index) {--}}
{{--                var fileInput = $(this).find('[name="name_image"]')[0].files[0];--}}
{{--                var description = $(this).next('tr.expandable-body').find('[name="description_image"]').val();--}}

{{--                // Append file and description to FormData--}}
{{--                formData.append('images[' + index + '][name_image]', fileInput);--}}
{{--                formData.append('images[' + index + '][description_image]', description);--}}
{{--            });--}}

{{--            return formData;--}}
{{--        }--}}
{{--        --}}
{{--        // Function to handle form submission--}}
{{--        $('form.custom-validation').submit(function (event) {--}}
{{--            event.preventDefault();--}}

{{--            // Collect form data--}}
{{--            var imageList = collectFormDataImage();--}}
{{--            // Create hidden input fields and append them to the form--}}
{{--            $('<input>').attr({--}}
{{--                type: 'hidden',--}}
{{--                name: 'List_Image',--}}
{{--                value: JSON.stringify(imageList),--}}
{{--            }).appendTo($(this));--}}

{{--            // Submit the form--}}
{{--            $(this).unbind('submit').submit();--}}
{{--        });--}}
{{--        --}}
{{--    });--}}
{{--</script>--}}
