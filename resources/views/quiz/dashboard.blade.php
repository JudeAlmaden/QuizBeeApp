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


        .wrapper{
            height: 75%;
        }

        .flashcard{
            border-radius: 30px;
            background-color:  rgba(55,2,144);
            padding: 10px;
            height: auto;
            text-overflow: ellipsis
        }

        .flashcard .image-container{
            border-radius: 30px;
            max-height: 350px;
            height: 75%;
            width: 100%;
        }

        .flashcard img{
            object-fit: cover;
            border-radius: 30px 30px 0px 0px;
            width: 100%;
            max-height: 350px;
            height: 100%;
        }


        .menu a{
            width: 24%;
            aspect-ratio: 1/1;
            border-radius: 20px;
            transition: 1s;
            flex:40% !important;
            color: white;
            display:flex;
            align-items: center;
            justify-content: center;
        }

        @media only screen and (min-width: 768px) {
        .menu a{
                width: 24%;
                aspect-ratio: 1/1;
                border-radius: 20px;
                transition: 1s;
                flex:20% !important;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color:white
                
        }
        }

        .menu a:hover{
            background-color: grey !important;
            margin-bottom:-10px;
            color:black;
            text-decoration: none;
            cursor: pointer;
        }

        .play-button:hover{
            cursor: pointer;
            color: goldenrod;
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
                    <a href="{{route('homepage')}}" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa-solid fa-house"></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Home</span>
                    </a>
                    <a href="{{route('logout')}}" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa fa-sign-out" aria-hidden="true"></i></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Logout</span>
                    </a>
                    <div class="bg-light w-100" style="height:2px"></div>
                    <!-- Navbar List -->
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
                        <li class="nav-item">
                            @if (isset($quizzes) && $quizzes->count() > 0)
                            @foreach ($quizzes->all() as $quiz)
                                <li class="nav-item w-100">
                                    <a href="{{ route('quiz.view', $quiz->id) }}" class="d-flex align-items-center pb-3 mt-3 mb-0 text-white text-decoration-none " style="column-gap:5px; width: 100%;">
                                        <i class="fa-brands fa-flipboard"></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">{{$quiz->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                            @endif
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col-sm-10 col-md-10 col-xl-10 py-3 content-area">
                <div class="row">
                    <!-- Content Area -->
                    <div class="col-12">
                        <div class="flashcard d-flex flex-column flex-wrap">
                            <div class="image-container">
                                    <button data-toggle="modal" data-target="#confirmDeleteModal"  
                                            data-quiz="{{$quiz->id}}"
                                            class="text-danger"
                                            style="border:none;background:transparent;position:absolute;right:30px;top:10px">
                                            <i class="fa-solid fa-trash text-danger h4"></i>
                                    </button>
                                <img  src="https://canopylab.com/wp-content/uploads/2023/01/Blog-Creating-multiple-choice-quizzes-with-the-CanopyLAB-Quiz-engine.jpg"  alt="image">
                            </div>
                            <div class="flashcard-info text-light p-0" style="display:flex;flex-direction:row;flex-wrap:nowrap;height:auto">
                                    @if (isset($quiz))
                                        <div style="flex:9;padding:15px">
                                            <div><strong>{{ $quiz -> name}}</strong> - Code: {{$quiz->code}}</div>
                                            <div>{{ $quiz ->description}}</div>
                                        </div>
                                        <div style="flex:1;display:flex; justify-content: end; align-items: center; padding-right: 30px;">
                                            <!-- Route for playing quiz as quizmaker -->
                                            <a class="play-button" href="{{route('quiz.playQuizAsAdmin', $quiz->id)}}"><i class="fa-solid fa-chevron-right" style="font-size: 2rem;"></i></a>
                                        </div>     
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap p-5 text-light menu" style="gap:10px;position:relative; font-size:4rem;">
                        <a class="bg-warning" href="{{route('leaderboards.view', $quiz->id)}}">     
                            <i class="fa-solid fa-ranking-star"></i>
                            <h6>Rankings</h6>
                        </a>
                        <a class="bg-danger" href="{{route('categories.view', $quiz->id)}}">
                            <i class="fa-solid fa-question" ></i>
                            <h6>Questions</h6>
                        </>
                        <a class="bg-success"  href="{{route('questions.review', $quiz->id)}}">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <h6>Previous answers</h6>
                        </a>
                        <a class="bg-info" href="{{route('teams.view',$quiz->id)}}">
                            <i class="fa-solid fa-people-group"></i>
                            <h6>Teams</h6>
                        </a>
                    </div>
                </div>            
            </div>
        </div>
    <!-- Modal for  Delete confirmation -->
        <div class="modal fade text-dark" id="confirmDeleteModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete <span id="category-name"></span>?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteQuiz" action="{{route('quiz.delete',$quiz->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="confirm-delete-button">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var quizId = button.data('quiz'); 
        var modal = $(this);

        modal.find('.modal-title').text('Are you sure you want to delete this?' )

        });
</script>