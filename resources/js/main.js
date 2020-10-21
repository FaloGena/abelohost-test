$(document).ready(function () {
    // Token header on every ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sendAjax (url, data, handler = defaultHandler) {
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            data: data,
            cache: false,
            success: function (response) {
                handler(response);
            },
            error: function (data) {
                if (data.status === 422) {
                    let response = data.responseJSON.errors;
                    let message = "";
                    $.each(response, function (key, el) {
                        message += el[0] + "\n";
                    });
                    alert(message);
                }
                else alert('Error!');
            }
        });
    }

    function defaultHandler (response) {
        location.href = '/';
    }
    function stayHandler (response) {
        location.reload();
    }

    // Submitting registration form
    $('form.registration-form').on('submit', function () {
        let formData = $(this).serialize();
        sendAjax('/register', formData);
    });

    // Attempt to Log in
    function loginHandler (response) {
        if (response.auth == false) alert('Password is incorrect!');
        else stayHandler(response);
    }
    $('form.login-form').on('submit', function () {
        let formData = $(this).serialize();
        sendAjax('/login', formData, loginHandler);
    });

    // Task completion checkbox
    $('.task-checkbox button.unchecked').on('click', function () {
        let data = {'done': true};
        let taskId = $(this).data('id');
        sendAjax('/tasks/' + taskId + '/done', data, stayHandler);
    });

    // Links for tasks on task list
    $('.task-item .task-body').on('click', function () {
        location.href = '/tasks/' + $(this).data('id');
    });
});
