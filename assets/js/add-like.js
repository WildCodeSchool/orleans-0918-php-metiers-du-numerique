$(document).on('click', '.like', function (e) {
    e.preventDefault();
    let commentId = $(this).attr('data-commentId');
    $.post('/comment/addlike/'+commentId).done(function (likeView) {
        $('#comment'+commentId).replaceWith(likeView);
    });
});