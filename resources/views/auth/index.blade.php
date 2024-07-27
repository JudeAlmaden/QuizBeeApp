<!DOCTYPE html>
<html>
<head>
    <title>Quizly</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Stylesheet and scripts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="description" content="Quizz Bee Application">
    <meta name="keywords" content="Quiz">
    <meta name="author" content="Justine Jude Almaden">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: auto;
            height: 500px;
            box-shadow: 0 0 60px #000;
            border-radius: 10px;
        }
        h1 {
            font-size: 2.5em;
            color: #fff;
            text-align: center;
        }
        .input-group {
            position: relative;
            width: 100%;
            margin: 30px 0;
        }
        .input-group input {
            width: 100%;
            height: 40px;
            font-size: 1em;
            color: #fff;
            padding: 0 10px 0 35px;
            background: transparent;
            border: 1px solid #fff;
            outline: none;
            border-radius: 5px;
        }
        .input-group input::placeholder {
            color: rgba(255, 255, 255, .3);
        }
        .input-group .icon {
            position: absolute;
            display: block;
            left: 10px;
            color: #fff;
            font-size: 1.2em;
            line-height: 45px;
        }
        .btn {
            position: relative;
            width: 100%;
            height: 40px;
            background: #00c2a7;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
            font-size: 1em;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: .5s;
        }
        .btn:hover {
            background: #fff;
            color: #00c2a7;
        }
        .sign-link {
            font-size: .9em;
            text-align: center;
            margin: 25px 0;
        }
        .sign-link p {
            color: #fff;
        }
        .sign-link p a {
            color: #00c2a7;
            text-decoration: none;
            font-weight: 600;
        }

        form h1 b{
            color:var(  --bs-orange);
        }

        .icon{
            background-color: transparent;
        }

        .error{
            opacity: 0;
            height: 0px ;
            padding: 0px ;
            margin: 0px;
            overflow: hidden;
            animation: fade 5s forwards; 
        }

        @keyframes fade{
            0%    { 
                opacity: 0; 
            }

            10%    { 
                height: auto;
                padding: auto;
                overflow:auto;
                opacity: 1; 
            }
            90%   { 
                height: auto;
                padding: auto;
                overflow: auto;
                opacity: 1; 
            
            }

            100%{
                height: 0px ;
                padding: 0px ;
                margin: 0px;
                opacity: 0;
            }
        }
    </style>
</head>
<body class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center  align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 wrapper">
                <form method="post" action="{{route('user.login')}}">
                @csrf
                    <h1>Welcome to <b>Quizzly</b></h1>
                    <div class="input-group">
                        <span class="icon">
                            <ion-icon name="person"></ion-icon>
                        </span>
                        <input type="text" placeholder="Your account ID" name="id" >
                    </div>
                    <div class="input-group">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input type="password" placeholder="Password" name="password" >
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <div class="sign-link">
                        <p>Don't have an account? <a class="register-link">Ask your quiz organizer</a></p>

                    @if ($errors->any())
                        <div class="bg-danger pt-3 pb-2 px-5 rounded text-light text-left error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>