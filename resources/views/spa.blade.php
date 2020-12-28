<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
            integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
            crossorigin="anonymous"></script>
    <script>
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.withCredentials = true;
        jQuery(function ($) {
            // axios.get('/sanctum/csrf-cookie').then(response => {window.xxx = response;console.dir(response);});
            /*
            axios.post('/auth/signup', {
                name: 'Alexander',
                email: 'alexander@example.com',
                password: '123',
            }).then(response => {
                window.xxx = response;
                console.dir(response);
                if (!xxx.data.success) {
                    alert('Error:\n\n' + xxx.data.error);
                }
            }).catch(error => {
                if (error.response.status == 422) {
                    var flatError = error.response.data.message + ': ' + Object.entries(error.response.data.errors).map(([field, errors]) => field + ': ' + errors.join(', ')).join(' ');
                    prompt(flatError, flatError);
                    // error.response.data.message;
                    // error.response.data.errors;
                } else {

                }
                window.xxx = error.response;
                window.xxx2 = error;
                console.error(error);
            });
            */
            axios.post('/auth/whoami').then(response => {
                window.xxx = response;
                console.dir(response);
            }).catch(error => {
                if (error.response.status == 422) {
                    var flatError = error.response.data.message + ': ' + Object.entries(error.response.data.errors).map(([field, errors]) => field + ': ' + errors.join(', ')).join(' ');
                    prompt(flatError, flatError);
                    // error.response.data.message;
                    // error.response.data.errors;
                }
                window.xxx = error.response;
                window.xxx2 = error;
                console.error(error);
            });
        });
    </script>
    <title>SPA</title>
</head>
<body>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
        @endauth
    </div>
    @endif


    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) (User:
    @auth
    Authenticated
    @else
    Logged out
    @endif
    )
</div>
</body>
</html>
