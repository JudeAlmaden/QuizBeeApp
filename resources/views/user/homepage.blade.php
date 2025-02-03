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

        .admin-panel {
            height:50px !important;
            border-bottom: 1px grey solid;
            border-top: none;
            border-left: none;
            border-right: none;
            transition: 1s;
            background-color: transparent !important;
            border: none !important;
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
            position:relative;
            cursor: pointer;
            border-radius: 30px;
            background-color:  rgba(55,2,144);
            aspect-ratio: 9/6;
            width: 40%;
            padding: 10px !important;
            transition: .5s;
        }

        .flashcard:hover{
            margin-top:-10px;
            background-color: goldenrod;
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

        .member-input{
            display:flex;
            margin-bottom: 10px;
        }

        .fade{
            animation: 5s fade-anim ;
        }

        a{
            text-decoration: none !important;
        }

        @keyframes fade-anim{
            0%    { 
                opacity: 0; 
            }

            10%    { 
                opacity: 1; 
            }
            
            90%   { 
                opacity: 1; 
            }

            100%{
                opacity: 0;
            }
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
                <i class="fa-solid fa-lightbulb" style="color:var(--bs-warning)">
                </i>
            </div>    
            <div class="text-light text-right px-3">
                By: Almaden, Justine Jude D. (BSIT-III)
            </div>
        </div>
        <!-- Sidebar -->

        <div class="row flex-nowrap no-gutters">
            <div class="col-auto col-sm-2 px-0 m-0">
                <div class="side-nav d-flex flex-column align-items-center align-items-sm-start p-2 text-white overflow-hidden" 
                    style="
                    background: linear-gradient(180deg, rgba(56,2,144,1) 0%, rgba(61,13,140,1) 50%, rgba(33,5,80,1) 100%); 
                    position:sticky; 
                    top:50px;
                    padding-top:50px;
                    z-index:9;
                    height:calc(100vh - 50px)
                    ">
                    <!-- Permanent sidebar content -->
                    <a href="{{route("homepage")}}" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa-solid fa-house"></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Home</span>
                    </a>
                    <button data-toggle="modal" data-target="#modalMembers"  class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100 " style="column-gap:5px; background-color:transparent !important; border:none">
                        <i class="fa-solid fa-gear"></i></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Team settings</span>
                    </button>
                    <a href="/logout" class="d-flex align-items-center pb-3 mb-0 text-white text-decoration-none w-100" style="column-gap:5px;">
                        <i class="fa fa-sign-out" aria-hidden="true"></i></i><span class="fs-5 d-none d-sm-inline pb-0 pt-auto">Logout</span>
                    </a>
                    <div class="bg-light w-100" style="height:2px"></div>
                    <!-- Navbar List -->

                    <hr>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-sm-10 col-md-10 col-xl-10 py-2">
                <div class="row">
                        <div class="col-12 text-left p-0 text-light rounded" style="background: rgb(11,0,33)">
                            <h1 class="text-left pl-5 pt-2">Quizzes!<i class="fa-solid fa-lightbulb" style="color:var(--bs-warning)"></i></h1>
                        </div>
                    </div>
                    <!-- Flex container for quizzes -->
                    <div class="col-12 mt-5" style="display:flex;gap:20px;flex-wrap:wrap;justify-content:center">
                        <!-- Item Display Quizzes-->
                        @if (isset($quizzes) && $quizzes->count() > 0)
                            @foreach ($quizzes->all() as $quiz)

                            <!-- Quiz -->
                            <a class="flashcard d-flex flex-column flex-nowrap gx-2" href="{{route('quiz.view',$quiz->id)}}">
                                <div class="image-container">
                                <img  src="/images/bg.jfif"  alt="image">
                                </div>
                                <div class="flashcard-info text-light p-0" style="display:flex;flex-direction:row;">
                                    <div style="flex:6;padding:10px;display:flex;flex-direction:column">
                                        <div style="flex:100%;box-sizing: border-box;">{{$quiz->name}}</div>
                                        <div style="flex:100%;box-sizing: border-box;">{{$quiz->description}}</div>
                                        <div style="flex:100%;box-sizing: border-box;">{{$quiz->relation}}</div>
                                    </div>
                                    <div style="flex:1;display:flex; justify-content: center; align-items: center; ">
                                        <div><i class="fa-solid fa-chevron-right"></i></div>
                                    </div>
                                </div>
                            </a>

                            @endforeach
                        @endif
                        
                        <!-- Flashcard for making Joining a Quiz -->
                        <div class="flashcard d-flex flex-column flex-nowrap gx-2">
                            <div data-toggle="modal" data-target="#modalJoin" class="d-flex flex-column flex-wrap col-12"  data-toggle="modal" data-target="#exampleModal" style="display:flex; justify-content: center; align-items: center; flex-direction:row">
                                <div><i class="fa-solid fa-plus text-light" style="flex:1; font-size:5rem"></i></div>
                                <div class="h3 text-light text-center">Join Quiz</div>                                    
                            </div>
                        </div>
                        
                        <!-- Flashcard for making Joining Creating a Quiz -->
                        <div class="flashcard d-flex flex-column flex-nowrap gx-5">
                            <div data-toggle="modal" data-target="#modalNew" class="d-flex flex-column flex-wrap "  data-toggle="modal" data-target="#exampleModal" style="flex:1;display:flex; justify-content: center; align-items: center; flex-direction:row">
                                <div><i class="fa-solid fa-plus text-light" style="flex:1; font-size:5rem"></i></div>
                                <div class="h3 text-light text-center">New Quiz</div>                                      
                            </div>
                        </div>
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success fade" style="position:fixed;width:100%; margin-top:10vh">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Modal Form For Joining Quiz-->
                    <div class="modal" id="modalJoin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Join Quiz</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('quiz.join')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quizId" class="col-form-label" >Quiz Code:</label>
                                        <input type="text" class="form-control" id="code" name="code" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">join</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Form For Hosting A Quiz-->
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
                    
                    <!-- Modal For Members -->
                    <div class="modal" id="modalMembers" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Manage </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('team.update')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Team Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{Session::get('user')->name}}">
                                    </div>
                                    <div class="form-group" id="members-container">
                                        <label for="member-input" class="col-form-label">Team Members:</label>

                                        @foreach ( $members as $member)
                                            @if( $loop->iteration ==1)
                                                <div class="member-input">
                                                    <input type="text" class="form-control" name="members[]"  value="{{$member->memberName}}" required>
                                                </div>
                                            @else
                                                <div class="member-input">
                                                    <input type="text" class="form-control" name="members[]" value="{{$member->memberName}}" required>
                                                    <button type="button" class="btn btn-danger" onclick="removeMember(this)" >X</button>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <button type="button" class="btn btn-secondary" onclick="addMember()">Add Member</button>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<script>
    
    function addMember() {
        const container = document.getElementById('members-container');
        const newMemberDiv = document.createElement('div');
        newMemberDiv.className = 'member-input';
        newMemberDiv.innerHTML = `
            <input type="text" class="form-control" name="members[]" placeholder="Member Name" required>
            <button type="button" class="btn btn-danger" onclick="removeMember(this)" >X</button>
        `;
        container.appendChild(newMemberDiv);
    }

    function removeMember(button) {
        const memberDiv = button.parentElement;
        memberDiv.remove();
    }

</script>

