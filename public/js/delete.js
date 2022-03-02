$(document).on("click", ".delete", function () {
    $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(t => {
        1 == t.value && $(this).parent().parent().find(".delete-action")[0].click()
    })
});