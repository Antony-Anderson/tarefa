<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Tarefas</title>


    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/skeleton.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script src="{{ url(mix('js/app.js')) }}" defer></script>




</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="app">

        <div style="margin-left: 20px">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <router-link :to="{name: 'Tarefa'}" class="navbar-brand">Tarefa</router-link>
                <router-link :to="{name: 'Pomodoro'}" class="navbar-brand">Pomodoro</router-link>
                <div class="collapse navbar-collapse d-flex justify-content-end" style="margin-right: 50px" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                {{-- <a class="dropdown-item" href="#">Profile</a> --}}
                                {{-- <router-link :to="{name: 'Tarefa'}"  class="dropdown-item">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    tarefas
                                </router-link> --}}
                                <router-link :to="{name: 'Tarefa'}"  class="dropdown-item">Tarefa</router-link>
                                <router-link :to="{name: 'Perfil'}"  class="dropdown-item">Perfil</router-link>
                                <logout></logout>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    

        <div id="wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>


    <script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
