
$(function () {

    $(".one-comment").each( (id) => {
        id++;
        let commentElt = $(".one-comment:nth-child("+id+")");
        if(id>3) commentElt.hide();
    });
    $("#showMore").on('click', function (e) {
        e.preventDefault();
        $(".one-comment:hidden").slice(0, 3).slideDown();
        if ($(".one-comment:hidden")) {
            $("#load").fadeOut('slow');
        }
    });

});
