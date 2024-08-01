<!DOCTYPE html>
<html>
<head>
    <title>Quizzly</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Stylesheet and scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/app.css">
    
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
        h1 {
            font-size: 2.5em;
            color: #fff;
            text-align: center;
        }

        .admin-panel button{
            height:50px !important;
            border-bottom: 1px grey solid;
            border-top: none;
            border-left: none;
            border-right: none;
            transition: 1s;
        }

        .admin-panel h5{
            border-bottom: 1px grey solid;
        }


        .admin-panel{
            border-radius: 20px;
        }
        .admin-panel button:hover{
            color: white !important;
            background-color: rgba(0, 0, 0, .8);
        }

        .wrapper{
            height: 75%;
        }

        .flashcard{
            cursor: pointer;
            border-radius: 30px;
            background-color:  rgba(55,2,144);
            height: 350px;
            padding: 0px !important;
        }

        .flashcard .image-container{
            border-radius: 30px;
            height: 75%;
            width: 100%;
        }

        .flashcard img{
            border-radius: 30px 30px 0px 0px;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<div class="scrolling-image"></div>
    <div class="container-fluid box-shadow">
        <!--Top navbar  -->
        <div class="navbar row col-12 d-flex align-items-baseline">
            <div class="col-auto col-sm-2 col-md-2 col-xl-2 px-sm-2 d-flex align-items-center icon">
                <span>Quizzly</span>
                <div class="vl"></div>
                <i class="fa-solid fa-lightbulb" style="color:var(--bs-warning)"></i>
            </div>    
        </div>
        <!-- Sidebar -->
        <div class="row flex-nowrap">
            <div class="col-auto col-sm-2 px-0 m-0">
                <div class="d-flex flex-column align-items-center align-items-sm-start p-2 text-white overflow-hidden" 
                    style="
                    background: linear-gradient(180deg, rgba(56,2,144,1) 0%, rgba(61,13,140,1) 50%, rgba(33,5,80,1) 100%); 
                    position:sticky; 
                    top:50px;
                    padding-top:50px;
                    z-index:9;
                    height:calc(100vh - 50px)
                    ">
                    <!-- Permanent content -->
                    <a href="/" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa-solid fa-house"></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Home</span>
                    </a>
                    <a href="/logout" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa fa-sign-out" aria-hidden="true"></i></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Logout</span>
                    </a>
                    <div class="bg-light w-100" style="height:2px"></div>
                    <!-- Navbar List -->
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
                        @if (isset($quizzes) && $quizzes->count() > 0)
                        @foreach ($quizzes->all() as $quiz)
                            <li class="nav-item w-100 my-0">
                                <a href="{{ route('quiz.view', $quiz->id) }}" class="d-flex align-items-center my-2 text-white text-decoration-none " style="column-gap:5px; width: 100%;">
                                    <i class="fa-brands fa-flipboard"></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">{{$quiz->name}}</span>
                                </a>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col-sm-10 col-md-10 col-xl-10 py-3 ">
                <div class="row">
                    <!-- Content Area -->
                    <div class="col-12 bg-dark text-left p-0 text-light rounded" style="background: linear-gradient(112.1deg, rgb(32, 38, 57) 11.4%, rgb(63, 76, 119) 70.2%);">
                        <div class="m-2 p-5 border-light border rounded">
                        <h1 class="text-left">Hello Quizmaster</h1>
                        <h6 class="text-left">start managing your quizzes now!</h6>
                        </div>
                    </div>
                    <!-- Quizzes -->
                    <div class="col-12 col-md-8 mt-5">
                        <div class="bg-light rounded">
                            <h5 class="p-3 text-center font-italic font-weight-bold mb-0">Your Quizzes</h5>
                            <hr>
                            <!-- Flex container for items -->
                            <div class="flex-wrap" style="display:flex;">
                            <!-- Item 1-->
                            @if (isset($quizzes) && $quizzes->count() > 0)
                                @foreach ($quizzes->all() as $quiz)
                                <div class="wrapper col-12 col-lg-6 p-2">
                                    <a class="flashcard d-flex flex-column flex-nowrap" href="{{ route('quiz.view', $quiz->id) }}">
                                        <div class="image-container">
                                            <img src="https://canopylab.com/wp-content/uploads/2023/01/Blog-Creating-multiple-choice-quizzes-with-the-CanopyLAB-Quiz-engine.jpg"  alt="image">
                                        </div>
                                        <div class="flashcard-info text-light p-0" style="display:flex;flex-direction:row;">
                                            <div style="flex:6;padding:10px;display:flex;flex-direction:column">
                                                <div style="flex:100%;box-sizing: border-box;">{{$quiz->name}}</div>
                                                <div style="flex:100%;box-sizing: border-box;">{{$quiz->description}}</div>
                                            </div>
                                            <div style="flex:1;display:flex; justify-content: center; align-items: center; ">
                                                <div><i class="fa-solid fa-chevron-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            @endif
                                <!-- Add new -->
                                <div class="wrapper col-12 col-lg-6 p-2">
                                    <div data-toggle="modal" data-target="#modalNew" class="flashcard d-flex flex-column flex-wrap "  data-toggle="modal" data-target="#exampleModal" style="flex:1;display:flex; justify-content: center; align-items: center; flex-direction:row">
                                        <div><i class="fa-solid fa-plus text-light" style="font-size:10rem"></i></div>
                                        <div class="h3 text-light">New Quiz</div>                                      
                                    </div>
                                <!-- Modal Form -->
                                    <div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Quiz</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('quiz.create')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="Quiz Name" class="col-form-label" >Quiz Name:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Descriptiomn" class="col-form-label" >Description:</label>
                                                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Admin controls -->
                    <div class="col-12 col-md-4 mt-5 ">
                        <div class="bg-light admin-panel pb-5">
                            <h5 class="p-3 pt-3 italic text-left text-primary m-0"><i class="fa-solid fa-user-tie mr-2"></i>Admin Controls</h5>
                            <button class="col-12 text-secondary text-left "><i class="fa-solid fa-arrow-right mr-2"></i>Manage this account</button>
                            <button class="col-12 text-secondary text-left "><i class="fa-solid fa-arrow-right mr-2"></i>Register an account</button>
                            <button class="col-12 text-secondary text-left "><i class="fa-solid fa-arrow-right mr-2"></i>See created accounts</button>
                            <a class="col-12 text-secondary text-left" href="{{route('user.logout')}}"><i class="fa-solid fa-arrow-right mr-2"></i>Logout</a>
                        </div>
                    </div>
                </div>            
            </div>
        </div>    
    </div>
</body>
</html>