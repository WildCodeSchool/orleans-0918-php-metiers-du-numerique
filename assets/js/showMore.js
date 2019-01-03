$('#showMore').click(function () {
    let nbComments = $('.one-comment').length;
    let jobId = $('#comments').attr('data-jobId');
    $.post('/job/load-comment', {jobId: jobId, offset: nbComments}).done(function (comments) {
        $('#row-comments').append(comments);
    });
});