// Theme color settings
$(document).ready(function () {

    function store(name, val) {
        if (typeof (Storage) !== "undefined") {
            localStorage.setItem(name, val);
        } else {
            window.alert('Please use a modern browser to properly view this template!');
        }
    }




    if (currentTheme) {
        let colorUrl = asset +'css/colors/' + currentTheme + '.css';

        $('#theme').attr({href: colorUrl});
        $('#themecolors li a').removeClass('working');
        $('#themecolors li a[data-theme="' + currentTheme + '"]').addClass('working')
    }
    // color selector
    $('#themecolors').on('click', 'a', function () {

        let data = {
                theme_color: $(this).attr('data-theme'),
                '_token': $('[name="_token"]').val()
            },
            currentStyle = $(this).attr('data-theme');

        sendPost('/settings/updateThemeColor', data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {

                    $('#themecolors li a').removeClass('working');
                    $(this).addClass('working');

                    change_theme(currentStyle);
                }

                Toast.fire({
                    icon: response.STATUS.toLowerCase(),
                    title: response.MESSAGE,
                    position: 'top'
                })
            })
            .catch((err) => console.log(err));


    });
    function change_theme(currentStyle) {


        store('theme', currentStyle);
        let colorUrl =asset +'css/colors/' + currentStyle + '.css';

        $('#theme').attr({href: colorUrl})
    }
});



function get(name) {

}

/*
$(document).ready(function(){
    $("*[data-theme]").click(function(e){
      e.preventDefault();
        var currentStyle = $(this).attr('data-theme');
        store('theme', currentStyle);
        $('#theme').attr({href: 'css/colors/'+currentStyle+'.css'})
    });

    var currentTheme = get('theme');
    if(currentTheme)
    {
      $('#theme').attr({href: 'css/colors/'+currentTheme+'.css'});
    }
    // color selector
$('#themecolors').on('click', 'a', function(){
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
      });
});*/
