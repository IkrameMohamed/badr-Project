function resetDropify(classSelector) {
    var json = asset + "plugins/dropify/lang/" + theLanguage + ".json";
    $.getJSON(json, function (result) {
        $(classSelector).dropify({
            messages: {
                default: result.default,
                replace: result.replace,
                remove: result.remove,
                error: result.error
            }
        });
    });
}
$(document).ready(function () {
    resetDropify($('.dropify'));
});

