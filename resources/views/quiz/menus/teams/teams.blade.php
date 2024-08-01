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

        .table-title{
            background-color: rgb(50,0,115);
            border-radius: 20px 20px 0px 0px;
            display: flex;
            align-items: center;
        }

        .return{
            background-color: transparent;
            color: white;
            border: none;
        }

        /* For table  */
        .table-header{
            width: 100%;
            display: flex;
            padding:10px;
            flex-direction: row;
            gap: 10px;
            transition: .25s;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        


        /* For table head */
        .table-header div{
            background-color: rgb(58,0,132);
            color: white;
            padding:10px;
            text-align: center;
        }

        /* For table items */
        .table-row{
            width: 100%;
            text-align: center;
            gap: 10px;
            display: flex;
            padding:10px;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            transition: .25s;
            margin-bottom: 10px;
            border: 1px grey solid;
            border-radius: 5px;
        }

        .table-row:hover{
            background-color: grey;
            color: white !important;
        }

        .return{
            background-color: transparent !important;
            border: none;
            margin-left: 0px;
            background-color: transparent;
            color: white;
            border:none;
            text-align: center;
        }


    </style>
</head>
<body>
<div class="scrolling-image"></div>
    <div class="container-fluid box-shadow" >
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
                    
                    <hr>
                </div>
            </div>

            <div class="col-sm-10 col-md-10 col-xl-10 py-3">
                <div class="row p-5">
                    <!-- Content Area -->
                    <div class="col-12 table">
                        <!-- Table head -->
                        <div class="table-title h3 py-2 px-3 text-light" style="gap:10px">
                            <a class="return" href="{{ route('quiz.view', $quizId) }}">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                            <div>Teams</div>                    
                        </div>
                        <!-- Table content area -->
                        <div class="py-4 bg-light" style="min-height:80vh;">
                            <!-- Table item -->
                            @if (isset($results) && count($results) > 0)
                                @foreach ($results as $result)
                                    <div class="table-row">
                                        <div class="col-2">{{ $result->id }}</div>
                                        <div class="col-2">{{ $result->team_name }}</div>
                                        <div class="col-4">
                                            @foreach ($result->members as $member)
                                                <div>{{ $member }}</div>
                                            @endforeach
                                        </div>
                                        <div class="col-2">{{ $result->relation }}</div>
                                        <div class="col-2">
                                            <a href="{{route('team.remove', [$quizId, $result->rel_id])}}"title="" class="btn btn-danger" style="margin-left:0px">Remove</a>

                                            @if ( $result->relation =="Pending")
                                            <a href="{{route('team.approve', [$quizId, $result->rel_id])}}" class="btn btn-success">Approve</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="table-row text-center">
                                    No teams have applied nor joined
                                </div>
                            @endif
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
</body>
</html>