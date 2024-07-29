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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        @keyframes fadeInAnimation {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        h1 {
            font-size: 2.5em;
            color: #fff;
            text-align: center;
        }

        /* Container */
        .podium{
            display:flex;
            flex-direction:column;
            align-items:center;
            width: 100%;
            justify-content: flex-end;
            text-align: center;
            animation: fadeInAnimation ease 3s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        
        /* profile */
        .profile{
            border-radius: 50%;
            background-color: white;
            width: 15vw ;
            height:15vw ;
            max-width: 15vw ;
            max-height:15vw ;
            min-width: 15vw ;
            min-height:15vw ;
            position:relative;
            top:3vh;
            left: -1vw;
        }
        /* Profile borders */
        .rank-1{
            border: .75rem goldenrod solid;
        }
        .rank-2{
            border: .75rem lawngreen solid;
        }
        .rank-3{
            border: .75rem purple solid;
        }

        /* Podium heighs */
        .podium-back{
            background-color: rgb(30,35,55);
            border-radius: 30px 30px 0px 0px;
            height: 50vh;
            display:flex;
            flex-direction:column;
            width: 100%;
            justify-content: flex-end;
        }

        .podium-1{
            border-radius: 30px 30px 0px 0px;
            max-height: max-content;
            flex: 70vh;
        }

        .podium-front{
            height: 100%;
            width: 90%;
            border-radius: 30px 30px 0px 0px;
            background-color: rgb(40,45,65);   
            text-align: center;
        }
        .podium-text{
            width: 100%;
        }

        #bottom-nav{
            min-height: 6vh;
            display: flex;
            padding:0px 5vw 0px 5vw;
        }

        .nav-button{
            flex:1;
            background-color: rgb(11,0,33);
            color:white;
            border: none;
            height: 100%;
            border-radius: 20px 20px 0px 0px;
            min-width: 75px;
            font-size: 30px;
            transition: .5s;
        }

        .return-button{
            color:white;
            background-color: transparent;
            border:none;
            padding:0px 20px 0px 20px;
            font-size: 1.2rem;
            padding: 5px 30px 5px 30px;
            transition: .5s;
        }

        .nav-button:hover, .return-button:hover{
            background-color:rgb(40,45,65);
        }

        .area:hover{
            background-color:rgba(55,5,145,1);
        }

        .points{
            margin-top: 5vh;
            color:goldenrod;
            font-size: 2.5rem;
            width: 100%;
            text-align: center;
        }

        .team-name{
            font-size: 2.5rem;
            color: white;
            width: 100%;
            text-align: center;
        }
    
        .member-name{
            color:grey;
            font-size: 1.5rem;
            width: 100%;
            text-align: center;
        }

        ul{
            list-style:none;
        }

        .table-name{
            background-color: black;
            color: white;
            text-align: center;
            font-size: 3rem;
            width: 98%;
        }

        .table{
            flex-direction: column;
            text-align: center;
            background-color: white;
            display: flex;
            height: max-content;
            row-gap: 2px;
            padding-bottom: 30px;
            border-radius: 0px 0px 20px 20px;
            box-shadow: 0px 10px 10px black;
            width: 95%;
        }
        .table-headers{
            
            width: 100%;
            flex: 100%;
            font-size: 1.25rem;
            color: grey;
            padding: 5px 0px 5px 0px;
            background-color: black;
            color: white;
            display: flex;
            font-weight: bold;
        }

        .table-row{
            background-color: rgb(192,192,192);
            font-size: 1.2rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
        }

        .table-row div{
            padding: 10px;
            color:black;
        }

        .gold{
            background-color: rgb(255, 210, 110);
        }

        .silver{
            background-color: rgb(150, 180, 200);
        }

        .bronze{
            background-color: rgb(255, 160, 100);
        }

        .btn-nav{
            color: white;
            font-size: 2.5rem;
            background-color: indigo;
            padding:20px;
            transition: .5s;
        }

        .btn-nav:hover{
            background-color:black !important;
            cursor:pointer
        }

        .nav-container{
            top:0px;
            left: 0px;
            position:fixed;
            flex-wrap: wrap;
            z-index: 10;
            flex-direction: column;
            flex-wrap: wrap;
            display: flex;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="scrolling-image"></div>
    <div class="container-fluid box-shadow">
        <div class="row" id="podium-wrapper">
        <a href="javascript:history.back()" class="btn-nav"><i class="fa-solid fa-chevron-left "></i></a>
        @if (isset($results) && count($results) > 0)
            <div class="col-12 d-flex no-gutters" style="padding:3vh 10vw 3vh 10vw; height:90vh; align-items:center; justify-content:center">
                @foreach ( $results as $result )
                    @if( $loop->index == 1 )
                        <div class="col-4 podium" style="order:1">
                            <div class="profile rank-2"></div>
                            <div class="podium-back">
                                <!-- info -->
                                <div class="podium-front">                      
                                     <div class="points">{{$result->totalPoints}} Points</div>
                                     <div class="team-name">{{$result->userName}}</div>
                                <!-- List of team members -->
                                     <ul class="list-members">
                                     @php
                                          $membersArray = explode(', ', $result->members);
                                     @endphp
                                     @foreach ($membersArray as $member)
                                         <li class="member-name">{{ $member }}</li>
                                     @endforeach
                                     </u>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if( $loop->index == 0 )
                    <div class="col-4 podium" style="order:2">
                        <i class="fa-solid fa-crown" style="font-size:3rem;color:goldenrod;position:absolute;top:-2vh;margin-right:2vw"></i>
                        <div class="profile rank-1"></div>
                        <div class="podium-text podium-back podium-1">
                            <!-- info -->
                            <div class="podium-front">                      
                                <div class="points">{{$result->totalPoints}} Points</div>
                                <div class="team-name">{{$result->userName}}</div>
                                <!-- List of team members -->
                                <ul class="list-members">
                                @php
                                    $membersArray = explode(', ', $result->members);
                                @endphp
                                @foreach ($membersArray as $member)
                                    <li class="member-name">{{ $member }}</li>
                                @endforeach
                                </u>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if( $loop->index == 2 )
                    <div class="col-4 podium" style="order:3">
                        <div class="profile rank-3"> </div>
                        <div class="podium-text podium-back">
                            <!-- Info -->
                            <div class="podium-front">
                            <div class="points">{{$result->totalPoints}} Points</div>
                            <div class="team-name">{{$result->userName}}</div>
                                <!-- List of team members -->
                                <ul class="list-members">
                                @php
                                    $membersArray = explode(', ', $result->members);
                                @endphp
                                @foreach ($membersArray as $member)
                                    <li class="member-name">{{ $member }}</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach       
            </div>
        </div>

        <div class="row">
            <div class="col-12" style="padding:0vw 3vw 0vw 3vw;margin-top: 50px; display:flex; flex-direction:column; align-items:center; min-height:100vh">
                <div class="table-name" style="padding:0vw 3vw 0vw 3vw;display:flex;flex-direction:column;align-items:center;">
                    Leaderboard
                    <div class="table-headers ">
                        <div class="" style="flex:1">Rank</div>
                        <div class="" style="flex:3">Team name</div>
                        <div class="" style="flex:2">Points</div>
                    </div>
                </div>
                <div class="table" style="min-height:80vh">
                    @foreach ( $results as $result )
                        @if( $loop->index == 0 )
                        <div class="table-row gold">
                            <div class="" style="flex:1">{{$loop->index+1}}</div>
                            <div class="" style="flex:3">{{$result->userName}}</div>
                            <div class="" style="flex:2">{{$result->totalPoints}}</div>
                        </div>
                        @endif
                        @if( $loop->index == 1 )
                        <div class="table-row silver">
                            <div class="" style="flex:1">{{$loop->index+1}}</div>
                            <div class="" style="flex:3">{{$result->userName}}</div>
                            <div class="" style="flex:2">{{$result->totalPoints}}</div>
                        </div>
                        @endif
                        @if( $loop->index == 2 )
                        <div class="table-row bronze">
                            <div class="" style="flex:1">{{$loop->index}}</div>
                            <div class="" style="flex:3">{{$result->userName}}</div>
                            <div class="" style="flex:2">{{$result->totalPoints}}</div>

                        </div>
                        @endif
                        @if($loop->index>2)
                        <div class="table-row">
                            <div class="" style="flex:1">{{$loop->index+1}}</div>
                            <div class="" style="flex:3">{{$result->userName}}</div>
                            <div class="" style="flex:2">{{$result->totalPoints}}</div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @else
                    <di class="col-12 bg-light h1 p-2 text-center">No results yet</div>
                @endif
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
</body>
</html>