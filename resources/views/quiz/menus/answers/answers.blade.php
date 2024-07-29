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

        body {
            animation: fadeInAnimation ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
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
            font-size: 4rem;
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
            min-height: 80vh;
        }

        .table-row{
            background-color: rgb(192,192,192);
            min-height: 15vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            transition: 1s;
        }

        .table-row div{
            padding: 10px;
            color:black;
        }

        .table-row:hover{
            min-height: 16vh;
            filter: brightness(85%);
        }

        .team-info{
            flex:8; 
            display:flex;
            flex-direction:row;
            flex-wrap:wrap
        }

        .team-name{
            font-size: 2.25rem;
            flex:1fr;
            padding-bottom: 0px !important;
        }

        .first-correct{
            font-size: 1.5rem;
            text-align: center;
            flex:100%;
            padding-top: 0px !important;
        }

        .control{
            flex:2;
        }

        .answer-wrapper{
            flex:8; 
            font-size: 2.25rem;
            align-items: center;
            justify-content: center;
        }

        .answer{
            padding-bottom: 0px !important;
        }

        .evaluation{
            font-style: italic;
            padding-top: 0px !important;
            font-size: 1.5rem;
        }

        .fa-exchange{
            text-align: center;
            font-size: 2rem;
        }

        .correct{
            background-color: rgb(150, 180, 200);
        }

        .incorrect{
            background-color: rgb(255, 160, 100);
        }

        .control button{
            background-color: transparent;
            border: none;
            transition: 1s;
        }

        .control button:hover{
            color: white;
        }

        .table .gold{
            background-color: rgb(255, 169, 2) !important;
        }

        .table form{
            background-color: rgb(218,218,218);
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
            display: flex;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="scrolling-image"></div>
    <div class="container-fluid box-shadow ">
        <div class="col-12" style="padding:5vh 3vw 0vw 3vw;display:flex;flex-direction:column;align-items:center;">
            <div class="nav-container">
            <a href="{{URL::previous()}}" class="btn-nav"><i class="fa-solid fa-chevron-left "></i></a>
            </div>
                <div class="table-name" style="padding:0vw 3vw 0vw 3vw;display:flex;flex-direction:column;align-items:center;">
                    Answers to this question
                </div>
                <div class="table">
                <!-- Iterate through each result -->
                @if (isset($results))
                    @foreach ($results as $result)
                    <!-- Unique style for first correct answer -->
                        @if( $loop->index == 0 && $result->evaluation=="Correct")
                            <form class="table-row gold" method="POST" action="{{route('answers.review.toggle')}}">
                            @csrf
                            <div class="team-info">
                                <div class="team-name">{{$result->name}}</div>
                                <div class="first-correct text-light">
                                    1st To answer correctly <br>
                                    <i class="text-success"> {{($result->bonus /100)* $result->basepoints}}pts Bonus </i>
                                    <i class="text-success"> + {{$result->basepoints}}</i>
                                </div>
                            </div>
                            <div class="answer-wrapper">
                                <div class="answer">{{$result->answer}}</div>
                                <div class="evaluation
                                @if ($result->evaluation =="Correct")
                                text-success
                                @else
                                text-danger
                                @endif
                                ">{{$result->evaluation}}</div>
                                <input name="questionId" value="{{$result->questionId}}" hidden>
                                <input name="answerId" value="{{$result->answerId}}" hidden>
                                <input name="initialEvaluation" value="{{$result->evaluation}}" hidden>
                            </div>
                            @if ($isAdmin)
                            <div class="control">
                                <button type="submit"><i class="fa fa-exchange" aria-hidden="true"></i></button>
                            </div>
                            @endif
                        </form>
                        <!-- General style -->
                        @else
                            <form class="table-row " method="POST" action="{{route('answers.review.toggle')}}">
                                @csrf
                                <div class="team-info">
                                    <div class="team-name">{{$result->name}}</div>
                                    <div class="first-correct text-light">
                                    </div>
                                </div>
                                <div class="answer-wrapper">
                                    <div class="answer">{{$result->answer}}</div>
                                    <div class="evaluation
                                    @if ($result->evaluation =="Correct")
                                    text-success
                                    @else
                                    text-danger
                                    @endif
                                    ">{{$result->evaluation}}</div>
                                    <input name="questionId" value="{{$result->questionId}}" hidden>
                                    <input name="answerId" value="{{$result->answerId}}" hidden>
                                    <input name="initialEvaluation" value="{{$result->evaluation}}" hidden>
                                </div>
                                @if ($isAdmin)
                                <div class="control">
                                    <button type="submit"><i class="fa fa-exchange" aria-hidden="true"></i></button>
                                </div>
                                @endif
                            </form>
                        @endif
                    @endforeach
                @endif
                @if (isset($results) && count($results) < 0)
                    <div class="text-dark table-row h1">No one was able to answer</div>
                @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>