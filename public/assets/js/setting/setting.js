// form submit add, update and delete customer
$("#formUpdateSettings").on('submit', function (e) {
    e.preventDefault();

    let form = $(this),
        data = new FormData(this),
        submit_url = form.attr("action");

    form.parsley().validate();
    if (form.parsley().isValid()) {
        form.find('[type="submit"]').attr("disabled", true);
        sendPostFormData(submit_url, data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {

                    form.parents(".modal").modal("hide");

                    delete_validate_error(form);

                    delete_warning(form);

                    if (form.find(".nav-tabs > li:first-child > a").length) {
                        form.find(".nav-tabs > li:first-child > a")[0].click();
                    }
                    refreshImages()
                }

                if (response.STATUS === "ERROR") {
                    show_validate_error(response, form);
                }
                if (response.STATUS === "WARNING") {
                    show_warning(response, form);
                }

                form.find('[type="submit"]').attr("disabled", false);

                showNotification(response.STATUS.toLowerCase(), response.MESSAGE);
            })
            .catch((err) => console.log(err));
    }
});