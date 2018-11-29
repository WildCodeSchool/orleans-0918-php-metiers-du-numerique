
button = $("#btn-modal");
$(button).on("click", function (e) {
    document.getElementById("myModal").style.width = "100%";


})
closebutton = $("#closebtn");
$(closebutton).on("click", function (e) {
    document.getElementById("myModal").style.width = "0%";
})