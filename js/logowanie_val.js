$(document).ready(function () {
$('#log').validate({ // initialize the plugin
        rules: {
            login: {
                required: true,
                email: true
            },
            haslo: {
                required: true,
                minlength: 5
            }
        }
    });
});