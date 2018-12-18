$("#btn-modalCompany").on("click", function (e) {
    modal('#myModalCompany','width','100%');
});

$("#closebtnCompany").on("click", function (e) {
    modal('#myModalCompany','width','0%');
});

$("#btn-modalLearning").on("click", function (e) {
    modal('#myModalLearning','width','100%');
});

$("#closebtnLearning").on("click", function (e) {
    modal('#myModalLearning','width','0%');
});

$('#btn-modalSearch').on('click', function() {
    modal('#myModalSearch','height','100%');
});

$("#closebtnSearch").on("click", function (e) {
    modal('#myModalSearch','height','0%');
});

function modal(buttonId, sizeName, sizeValue) {
    $(buttonId).css(sizeName, sizeValue);
}
