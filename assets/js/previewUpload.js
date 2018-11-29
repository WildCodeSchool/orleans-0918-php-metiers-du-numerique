$('#partner_pictureFile_file').on('input', function (e) {
    const pictureName = $(this).val().split('\\').pop()
    $(this).next().text(pictureName)
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#previewPicture');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
    if (f.size > 2000000) {
        $('#errorFile').html("Image trop volumineuse")
    } else {
        $('#errorFile').html(" ")
    }
});