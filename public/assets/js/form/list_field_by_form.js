function formFieldListByForm(form_id, callback) {
    let route = '/form_fields/listByForm',
        data = {
            form_id: form_id,
            '_token': $('[name="_token"]').val()
        };

    sendPost(route, data)
        .then((response) => {
            if (response.STATUS === "SUCCESS") {

                if (callback)
                    callback(response.DATA)
            }
        })
        .catch((err) => console.log(err));
}
