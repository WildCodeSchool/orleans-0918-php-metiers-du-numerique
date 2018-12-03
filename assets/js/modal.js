
button = $("#btn-modalCompany");
$(button).on("click", function (e) {
    document.getElementById("myModalCompany").style.width = "100%";


})
closebutton = $("#closebtnCompany");
$(closebutton).on("click", function (e) {
    document.getElementById("myModalCompany").style.width = "0%";
})


button = $("#btn-modalLearning");
$(button).on("click", function (e) {
    document.getElementById("myModalLearning").style.width = "100%";


})
closebutton = $("#closebtnLearning");
$(closebutton).on("click", function (e) {
    document.getElementById("myModalLearning").style.width = "0%";
})