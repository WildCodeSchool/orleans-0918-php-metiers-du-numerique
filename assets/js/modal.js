
let buttonCompany = $("#btn-modalCompany");
$(buttonCompany).on("click", function (e) {
    document.getElementById("myModalCompany").style.width = "100%";

});

let closebuttonCompany = $("#closebtnCompany");
$(closebuttonCompany).on("click", function (e) {
    document.getElementById("myModalCompany").style.width = "0%";
});


let buttonLearning = $("#btn-modalLearning");
$(buttonLearning).on("click", function (e) {
    document.getElementById("myModalLearning").style.width = "100%";

});

let closebuttonLearning = $("#closebtnLearning");
$(closebuttonLearning).on("click", function (e) {
    document.getElementById("myModalLearning").style.width = "0%";
});