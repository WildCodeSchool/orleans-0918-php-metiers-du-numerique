$(document).on('click', '.like', function (e) {
    e.preventDefault();
    let commentId = $(this).attr('data-commentId');
    const likeBtn = $(this);
    $.post('/comment/addlike/'+commentId).done(function (likeBtn) {
        likeBtn.next().html(likeBtn);
    });
    let nblike = $('#like'+commentId).text();
    nblike++;
    $('#like'+commentId).text(nblike);
});