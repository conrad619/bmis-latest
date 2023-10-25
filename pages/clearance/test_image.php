

<form  method="POST" enctype="multipart/form-data">
        <input type="file" name="attached_photo" accept="image/*" required>
        <input type="submit" value="Upload" id="upload">
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
$(document).ready(function() {
    $("#upload").click(function() {
        var data = new FormData();

        //Form data
        var form_data = $("#save_and_review").serializeArray();
        $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
        });

        //File data
        var file_data = $('input[name="attached_photo"]')[0].files;
        data.append("attached_photo", file_data[0]);
        
    $.ajax({
            type: "POST",
            url: 'test_back.php',
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {

            }
        })
    })
})

</script>