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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/app.css">
    @vite('resources/js/bootstrap.js')
    
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
            font-size: 2.2em;
            color: #fff;
            text-align: center;
        }

        a{
            text-decoration: none !important;
            color: inherit;
        }

        a:hover{
            color: inherit !important;
        }


        #board {
            border-radius: 20px;
            background-color: rgba(55, 5, 145, 0.90);
            box-sizing: border-box;
            height: 55vh;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 30px;
            animation: animate 10s infinite;
            }


        @keyframes animate {
            0% {
                height: 55vh;
                margin: 4.5vh -.5vw  .5vh -.5vw ;
            }
            50% {
                height: 55vh;
                margin: 4.5vh 0 .5vh 0 ;
            }
            100% {
                height: 55vh;
                margin: 4.5vh -.5vw .5vh -.5vw ;
            }
        }

        #answer-area{
            display: flex;
            flex-direction: row;
            gap:5%;
            flex-wrap: wrap;
            min-height:27.5vh;
            margin-top: 2.5vh;
            margin-bottom: 2.5vh;
            padding:0px 75px 0px 75px;
            
        }

        .glow{
            flex:47.5%;
            padding: 5px;
            border-radius: 20px;
            position: relative;
            background: rgb(207,0,255);
            background: linear-gradient(90deg, rgba(207,0,255,1) 0%, rgba(247,255,0,1) 19%, rgba(0,255,87,1) 35%, rgba(255,0,0,1) 56%, rgba(67,53,204,1) 77%, rgba(207,0,255,1) 100%);
            background-size: 400%;

            animation: glower 20s linear infinite;
            }

            @keyframes glower {
            0% {
                background-position: 0 0;
                margin: 0px -1vw 0px -1vw;
            }
            
            50% {
                background-position: 400% 0;
                margin: 0px 0px;
                width: 100%;
            }
            
            100% {
                background-position: 0 0;
                margin: 0px -1vw 0px -1vw;
            }

        }

        /* Main container for each answer */
        .area{
            border-radius: 20px;
            background-color: rgb(11,0,33);
            height: 100%;
            width: 100%;
            display: flex;
            transition: .5s;
            
        }

        /* Contains the icon  */
        .shape-container{
            flex:1;
            padding: 5px;
            display: flex;
            text-align: center;
            align-items: center;
            color: white;
            border-radius: 50%;
            height: 100%;

        }

        /* Icon margin */
        .shape-background{
            display: flex;
            text-align: center;
            align-items: center;
            height: 100%;
            height: 50px;
            width: 50px;
            border-radius: 40px;
            font-size: 1.5rem;
            background-color: rgba(55,5,145,.30);
        }

        /* Answer text */
        .answer{
            flex:5;
            display: flex;
            align-items: center;
            color:white;
            font-size: 1rem;
            height: 100%;
        }

        /* Icon colors */
        .fa-heart{
            color:red
        }
        .fa-diamond{
            color:cyan
        }
        .fa-square{
            color:limegreen
        }
        .fa-circle{
            color:yellow
        }

        #bottom-nav{
            min-height: 6vh;
            background-color: rgb(11,0,33);
            margin-bottom: 1.5vh;
            padding: 5px;
            gap: 5px;
        }

        .nav-button{
            background-color: transparent;
            color:white;
            border: none;
            border-radius: 10px;
            height: 100%;
            min-width: 75px;
            font-size: 30px;
            transition: 1s;
            text-align: center;
        }

        .nav-button:hover{
            background-color:white;
            color:grey;
        }

        .area:hover{
            background-color:rgba(55,5,145,1);
        }

        #identification_input{
            background-color: transparent;
            color: white;
            width: 70%;
            transition: 2s;
        }

        #identification_input:focus{
            border: none;
            outline: none;
            width: 100%;
        }

        .fade{
            animation: fade 5s forwards
        }

        @keyframes fade{
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
        <div class="row" >
            <!-- Question board -->
            <div class="col-12" style="padding: 0 4vw 0 4vw; position: relative;">
                <div class="text-center" id="board" style="position: relative; z-index: 2;">
                    <h1 class="font-italic">
                        @if (isset($currentQuestion))
                        {{ $currentQuestion->format }} - {{ $currentQuestion->points }}pts
                        <br id="questionId" value="{{ $currentQuestion->id }}">
                        Question: {{ $currentQuestion->question }} 
                        @else
                        Waiting for next question
                        @endif   
                    </h1>
                </div>
                
                <!-- Centered Logo Image -->
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding:10%;">
                    <img src="/images/sacliLogo.png" alt="Logo" style="width: 90%; max-height: 70%; min-height:70%">
                </div>
            </div>
            <!-- Anaswer area -->
            <div class="col-12" id="answer-area">
            
                <!-- if Multiple choice -->
                @if (isset($currentQuestion) && $currentQuestion -> format == "Multiple Choice" && !$hasAnswered)  
                    @php $choices = $currentQuestion->choices;
                        shuffle($choices);
                        $icons = ["fa-diamond", "fa-square", "fa-heart" , "fa-circle"]
                    @endphp
                    @foreach ($choices as $index => $choice)
                        <form class="glow" method="POST" action="{{ route('player.answer.submit') }}">
                            @csrf

                            <!-- Hidden input fields -->
                            <input type="hidden" name="questionId" value="{{ $currentQuestion->id }}">
                            <input type="hidden" name="quizId" value="{{ $quizId }}">
                            <input type="hidden" name="answer" value="{{ $choice }}">

                            <!-- Submit -->
                            <button type="submit" class="area" style="flex:100%;">
                                <div class="shape-container">
                                    <div class="shape-background">
                                        <i class="fa-solid {{ $icons[$index % count($icons)] }}" style="flex:1"></i>
                                    </div>
                                </div>
                                <div class="answer">
                                    <div class="answer-holder">{{ $choice }}</div>
                                </div>
                            </button>
                        </form>
                    @endforeach
                @endif

                <!-- For true or false type of question -->
                @if (isset($currentQuestion) && $currentQuestion -> format == "True or False" && !$hasAnswered)  
                    <form class="glow" method="POST" action="{{route('player.answer.submit')}}">
                        @csrf
                        <!-- Hidden input fields -->
                        <input type="hidden" name="questionId" value="{{ $currentQuestion->id }}">
                        <input type="hidden" name="quizId" value="{{ $quizId }}">
                        <input type="hidden" name="answer" value="True">
                        
                        <!-- Submit -->
                        <button type="submit" class="area" style="flex:100%;">
                            <div class="shape-container">
                                <div class="shape-background"><i class="fa-solid fa-diamond" style="flex:1"></i></div>
                            </div>
                            <div class="answer">
                                <div class="answer-holder">True</div>
                            </div>
                        </button>
                    </form>           
                    <form class="glow" method="POST" action="{{route('player.answer.submit')}}">
                        @csrf
                        <!-- Hidden input fields -->
                        <input type="hidden" name="questionId" value="{{ $currentQuestion->id }}">
                        <input type="hidden" name="quizId" value="{{ $quizId }}">
                        <input type="hidden" name="answer" value="False">
                        
                        <!-- Submit -->
                        <button type="submit" class="area" style="flex:100%;">
                            <div class="shape-container">
                                <div class="shape-background"><i class="fa-solid fa-diamond" style="flex:1"></i></div>
                            </div>
                            <div class="answer">
                                <div class="answer-holder">False</div>
                            </div>
                        </button>
                    </form>
                    <!-- Spacer -->
                    <div style="flex:100%; visibility:hidden"></div>
                @endif

                @if (isset($currentQuestion) && $currentQuestion -> format == "Identification" && !$hasAnswered)  
                    <div class="glow" style="flex:50% !important">
                        <div class="area" >
                            <form style="flex:100%;display:flex;align-items:center;justify-content:center;padding:0px 10% 0px 10%; column-gap: 15px;" 
                                method="POST" 
                                action="{{route('player.answer.submit')}}">
                                @csrf

                                <!-- Hidden input fields for questionId and quizId -->
                                <input type="hidden" name="questionId" value="{{ $currentQuestion->id }}">
                                <input type="hidden" name="quizId" value="{{ $quizId }}">

                                <div style="flex:2fr; color:white">Answer:</div>
                                <input type="text" id="identification_input" style="flex:9fr;border:none; border-bottom:2px solid goldenrod;" name="answer"></input>
                                <button type="submit" class="btn btn-primary"style="flex:2fr"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Spacer -->
                    <div style="flex:100%; visibility:hidden"></div>
                @endif
            </div>
            
                @if (session('success'))
                    <div class="alert alert-success fade">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger fade">
                        {{ session('error') }}
                    </div>
                @endif
        </div>
        
        <!-- Navigation -->
        <div class="row">
            <div class="col-12 d-flex" id="bottom-nav">
                <a class="nav-button" href="{{route('homepage')}}" style="display:flex;align-items:center; justify-content:center;text-decoration:none;height:100%;"><i class="fa-solid fa-chevron-left"></i></a>
                <a class="ml-auto nav-button" href="{{route('leaderboards.view',$quizId)}}"><i class="fa-solid fa-ranking-star"></i></a>
                <a class="nav-button" href="{{ route('questions.review', $quizId) }}"><i class="fa-solid fa-clipboard-question"></i></a>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quizId = {{$quizId}};



        // // Checks if the question on this device is same as one in db
        // setInterval(() => {
        //     //Gets the current selected question
        //     console.log("Sent request");
        //     fetch(`{{ route('currentQuestion.get', ['quizId' => '__QUIZ_ID__']) }}`.replace('__QUIZ_ID__', quizId))
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             console.log("received response");
        //             return response.json();
        //         })
        //         .then(data => {
        //             //Refresh page if there is an update
        //             if(data.id != questionId && data.id != undefined){
        //                 location.reload(); 
        //             }else if(questionId != -1 && data.id == undefined){
        //                 location.reload(); 
        //             }
        //         })
        //         .catch(error => {
        //             console.error('There was a problem with the fetch operation:', error);
        //         });
        // }, 10000);

        
        window.Echo.connector.pusher.connection.bind('connected', () => {
            console.log('Echo connection established.');
        });

        window.Echo.connector.pusher.connection.bind('disconnected', () => {
            console.log('Echo connection lost.');
        });

        window.Echo.connector.pusher.connection.bind('failed', () => {
            console.log('Echo connection failed.');
        });

        // Subscribe to the channel and listen for all events
        window.Echo.channel('CH1')
        .listen('QuestionChangedByAdmin', (event) => {
            location.reload();
        });

        window.Echo.channel('CH1')
        .listen('AcceptingAnswersToggledByAdmin', (event) => {
            if(event.data.isAccepting == "True"){
                alert(`Accepting answers has been enabled.`);
            }else{
                alert(`Accepting answers has been disabled.`);
            }
        });
    });
</script>