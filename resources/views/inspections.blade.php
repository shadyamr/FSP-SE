<form id="inspection-form" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="inspection_id">Inspection ID:</label>
        <input type="text" name="inspection_id" id="inspection_id">
    </div>
    <div>
        <label for="inspection_info">Inspection Information:</label>
        <textarea name="inspection_info" id="inspection_info"></textarea>
    </div>
    <div>
        <label for="inspection_image">Inspection Image:</label>
        <input type="file" name="inspection_image" id="inspection_image">
    </div>
    <button type="submit">Submit Inspection</button>
</form>

<script>
    $(document).ready(function () {
    $('#inspection-form').on('submit', function (e) {
        e.preventDefault();

        // Create a form data object and append the image file and inspection data to it
        var formData = new FormData();
        formData.append('inspection_id', $('#inspection_id').val());
        formData.append('inspection_info', $('#inspection_info').val());
        formData.append('inspection_image', $('#inspection_image')[0].files[0]);

        // Send an HTTP POST request to the server
        $.ajax({
            type: 'POST',
            url: '/requests',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
</script>