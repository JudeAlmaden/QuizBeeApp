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
            font-size: 2.2em;
            color: #fff;
            text-align: center;
        }

        body{
            background-attachment: fixed; /* Fix the image so it doesn't move */
            background-position: center; /* Center the background image */
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
            animation: animate 3s infinite;
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

            animation: glower 5s linear infinite;
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
            display: flex;
            align-items: center;
            justify-content: center;
            color:white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            height: 100%;
            min-width: 75px;
            font-size: 30px;
            /* transition: .5s; */
        }

        /* For selection */
        .nav-button:hover{
            background-color:white;
            color:grey;
        }

        .btn-stop{
            /* transition:1s; */
        }

        .btn-reveal:disabled, 
        .btn-stop:disabled, 
        .nav-button:disabled, 
        #btn-select-new:disabled {
            color: grey !important;
        }

        .btn-reveal:disabled:hover, 
        .btn-stop:disabled:hover, 
        #reviewAnswers:disabled:hover, 
        #btn-select-new:disabled:hover {
            background-color: transparent;
            cursor: default;
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

        /* Animations */
        .fade{
            animation: fade 5s forwards
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
        
        /* Also navigation control */
        .controls{
            flex:5;
            display:flex;
            justify-content: center;
            align-items: center;
        }

        #categorySelect{
            padding:5px;
            border-radius: 10px;
            background-color: transparent;
            border: 2px solid white;
            color:white
        }
    
        #categorySelect option{
            color:black
        }

        #categorySelect option:disabled{
            color:grey
        }

        #btn-getQuestion{
            padding:5px;
            border-radius: 10px;
            background-color: transparent;
            border: 2px solid white;
            color:white;
            transition:1s
        }

        #btn-getQuestion:hover, .nav-button:hover, .btn-reveal:hover{
            background-color: white;
            color:grey
        }

        /* For animating incorrect answers */
        .correct-answer-animate {
            animation: correctAnswerAnimation 5s;
        }

        .incorrect-answer-animate {
            animation: incorrectAnswerAnimation 5s;
        }

        @keyframes correctAnswerAnimation {
            10% { background-color: green; }
            90% { background-color: green; }
        }

        @keyframes incorrectAnswerAnimation {

            10% { background-color: red; }
            90% { background-color: red; }
        }

        .hidden { display: none; }

        .nav-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 0.75rem; /* Make text smaller */
            padding: 5px;
        }

        .nav-button i {
            font-size: 1.2rem; /* Adjust icon size */
            margin-bottom: 2px;
        }

        .nav-button span {
            display: block;
            font-size: 0.7rem; /* Adjust text size */
            line-height: 1.2;
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

            <!-- Answwer area -->
            <div class="col-12" id="answer-area">

             <!-- if Multiple choice -->
            @if (isset($currentQuestion) && $currentQuestion -> format == "Multiple Choice")  
                    @php $choices = $currentQuestion->choices;
                        shuffle($choices);
                        $icons = ["fa-diamond", "fa-square", "fa-heart" , "fa-circle"]
                    @endphp

                    @foreach ($choices as $index => $choice)
                        <div class="glow  answer-wrapper" method="POST" action="{{ route('player.answer.submit') }}">
                            @csrf
                            <!-- Submit -->
                            <div class="area {{ $currentQuestion->answer == $choice ? 'correct-answer' : 'incorrect-answer' }}" style="flex:100%;">
                                <div class="shape-container">
                                    <div class="shape-background">
                                        <i class="fa-solid {{ $icons[$index % count($icons)] }}" style="flex:1"></i>
                                    </div>
                                </div>
                                <div class="answer">
                                    <div class="answer-holder" style="font-size:1.5rem">{{ $choice }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- For true or false type questions -->
                @if (isset($currentQuestion) && $currentQuestion->format == "True or False")
                    <button class="glow  answer-wrapper" id="trueButton">
                        <div class="area {{ $currentQuestion->answer == 'True' ? 'correct-answer' : 'incorrect-answer' }}">
                            <div class="shape-container">
                                <div class="shape-background"><i class="fa-solid fa-square" style="flex:1"></i></div>
                            </div>
                            <div class="answer">
                                <div class="answer-holder" style="font-size: 2rem;">True</div>
                            </div>
                        </div>
                    </button>

                    <button class="glow answer-wrapper">
                        <div class="area {{ $currentQuestion->answer == 'False' ? 'correct-answer' : 'incorrect-answer' }}">
                            <div class="shape-container">
                                <div class="shape-background"><i class="fa-solid fa-diamond" style="flex:1"></i></div>
                            </div>
                            <div class="answer">
                                <div class="answer-holder" style="font-size: 2rem;">False</div>
                            </div>
                        </div>
                    </button>
                    <div style="flex:100%;visibility:hidden"></div>
                @endif

                <!-- For identification type -->
                @if (isset($currentQuestion) && $currentQuestion -> format == "Identification")  
                    <div class="glow answer-wrapper" style="flex:50% !important">
                        <div class="area" >
                            <div style="flex:100%;display:flex;align-items:center;justify-content:center;padding:0px 10% 0px 10%; column-gap: 15px;">
                                <h3 id="identification-answer" class="text-light" style="font-size:0px">{{$currentQuestion->answer}}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Spacer -->
                    <div style="flex:100%; visibility:hidden"></div>
                    <div style="flex:100%; visibility:hidden"></div>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        <div class="row">
            <div class="col-12 d-flex" id="bottom-nav">
                <button class="nav-button">
                    <a href="{{ route('quiz.view', $quizId) }}">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </button>
                
                <div class="controls" style="height:100%">
                    @if (!isset($currentQuestion))
                        <form action="{{route('quiz.play.question.get',$quizId)}}" method="POST" style="padding:0px" style="height:100%">
                            @csrf
                                <!-- Label text -->
                                <label for="categorySelect text-light" style="height:100%; margin:0px; color:white !important">Ask next question:</label>

                                <!-- Options -->
                                <select class="form-select" id="categorySelect" name="category_id" style="height:100%; margin:0px" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach($availableCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}({{$category->available_questions_count}})</option>
                                    @endforeach
                                </select>
                                <!-- Submit button -->
                                <button id="btn-getQuestion" type="submit" class="mt-0" style="height:100%">Submit</button>      
                        </form>
                    @endif
                
                </div>

                @if (isset($currentQuestion))
                <!-- Nav controls -->
                <button class="nav-button hidden btn-select-new"  title="Select a new question" onclick="location.href='{{ route('quiz.play.question.clear', $quizId) }}'" disabled>
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                    <span>Select</span>
                </button>
            
                <!-- Stop accepting answers -->
                <button class="nav-button btn-stop" title="Toggle accepting answers">
                    <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                    <span>Start Timer</span>
                </button>
            
                <!-- Reveal answer -->
                <button class="nav-button btn-reveal" title="Reveal Answer">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    <span>Reveal</span>
                </button>
            
                <!-- See answer of players on this question -->
                <button onclick="location.href='{{ route('answers.review', [$quizId, $currentQuestion->id]) }}'"
                    class="nav-button" id="reviewAnswers" title="See Player Answers" disabled>
                    <i class="fa-solid fa-clipboard-question"></i>
                    <span>See Answers</span>
                </button>
            @endif
            
            <!-- To Check leaderboard -->
            <a href="{{ route('leaderboards.view', $quizId) }}" class="ml-auto nav-button" title="Check Leaderboards">
                <i class="fa-solid fa-ranking-star"></i>
                <span>Ranking</span>
            </a>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>

    <!-- For audio if you want -->
    <audio id="audio" src=""></audio>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        btnReveal =   document.querySelector('.btn-reveal');
        btnStop =   document.querySelector('.btn-stop');
        btnStopText = btnStop.querySelector('span');
        btnReview =   document.getElementById('reviewAnswers');
        btnNew = document.getElementById('btn-select-new');
        btnSelectNew = document.querySelector('.btn-select-new');

        const questionId = document.getElementById('questionId').getAttribute('value');

        //I have no clue what this does
        fetch(`{{ route('currentQuestion.view', ['questionId' => '__QUESTION_ID__']) }}`.replace('__QUESTION_ID__', questionId))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.isAccepting === "True") {
                btnReveal.disabled = true;
                btnReview.disabled=true;
                btnStop.style.color = "red";
                btnStop.title = "Stop accepting answers"
            } else {
                btnReveal.disabled = false;
                btnReview.disabled=false;
                btnStop.style.color = "white"
                btnStop.title = "Allow answers"
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

        //Toggle for accepting answers
        btnStop.addEventListener('click', function() {
            fetch(`{{ route('currentQuestion.toggleRequest', ['questionId' => '__QUESTION_ID__', 'userId' => session('user')->id]) }}`.replace('__QUESTION_ID__', questionId))
            .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Ensure you're returning JSON
                })
                .then(data => {
                    console.log(data); 
                    if (data.isAccepting === "True") {
                        btnStopText.innerText = "Stop Timer";
                        btnReveal.disabled = true;
                        btnSelectNew.disabled = true;
                        btnStop.style.color = "red";
                        btnStop.title = "Stop accepting answers"
                    } else {
                        btnStopText.innerText = "Start Timer";
                        btnSelectNew.disabled = true;
                        btnReveal.disabled = false;
                        btnStop.style.color = "white"
                        btnStop.title = "Allow answers"
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            });

            
        //For revealing the answer
        btnReveal.addEventListener('click', function() {
            //Prevent quiz master clicking these again
            btnReveal.disabled = true;
            btnStop.disabled = true;
            btnReview.disabled= false;
            btnSelectNew.disabled = false;
            btnNew.classList.remove('hidden');
            //Get all choice container
            const answerWrappers = document.querySelectorAll('.answer-wrapper');

            //Loop through each and look for the .area class which contains the answer
            answerWrappers.forEach(wrapper => {
            const area = wrapper.querySelector('.area');

            // Play sound if there is any
            audio.play();
                if (area) {
                    if (area.classList.contains('correct-answer')) {
                        area.style.backgroundColor = 'green'; // Set background to green for correct
                    } else if (area.classList.contains('incorrect-answer')) {
                        area.style.backgroundColor = 'red'; // Set background to red for incorrect
                    }else if (answer = document.getElementById('identification-answer')){
                        answer.style.fontSize = '2rem'
                    }
                }
            })
        });
});
</script>
