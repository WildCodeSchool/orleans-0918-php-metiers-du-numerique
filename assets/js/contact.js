let checkForm = $("#checkForm");
$(checkForm).on("click", function (e) {

    if ($(checkForm).is(':checked')) {
        document.getElementById("linkForm").style.display = "block";
    } else {
        document.getElementById("linkForm").style.display = "none";
    }});
