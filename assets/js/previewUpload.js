const MAXSIZE = 2000000;
$('#partner_pictureFile_file').on('input', function (e) {
    previewUpload(this, e.target.files[0], MAXSIZE);
});
$('#comment_pictureFile_file').on('input', function (e) {
    previewUpload(this, e.target.files[0], MAXSIZE);
});
$('#company_pictureFile_file').on('input', function (e) {
    previewUpload(this, e.target.files[0], MAXSIZE);
});

function previewUpload(input, f, maxSize) {
    const pictureName = $(input).val().split('\\').pop();
    $(input).next().text(pictureName);
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#previewPicture');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
    if (f.size > maxSize) {
        $('#errorFile').html("Image trop volumineuse");
    } else {
        $('#errorFile').html(" ");
    }
}
