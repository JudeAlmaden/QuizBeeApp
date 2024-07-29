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

        .table-head{
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

        .table-row{
            width: 100%;
            display: flex;
            padding:10px;
            flex-direction: row;
            justify-content: center;
            transition: .25s;
            margin-bottom: 10px;
            border: 1px grey solid;
            border-radius: 5px;
        }

        .table-row:hover{
            background-color: grey;
            color: white !important;
        }

        .question-id{
            flex:1;
            padding-left: 10px;
        }

        .question{
            flex:3
        }

        .timestamp{
            flex:1
        }

        .btn-view{
            flex:1;
            text-decoration: underline;
            border: none;
            background-color: transparent;
        }
        .return{
            color: grey;
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

    </style>
</head>
<body>
<div class="scrolling-image"></div>
    <div class="container-fluid box-shadow">
        <!--Top navbar  -->
        <div class="col-12 p-5">
            <div class="row p-5">
                <!-- Content Area -->
                <div class="col-12 table p-5">
                    <!-- Table head -->
                    <div class="table-head  h3 py-2 px-3 text-light">
                        <a href="{{ route('quiz.view', $quizId) }}"class="return p-1 text-light mr-5"><i class="fa-solid fa-chevron-left"></i></a> 
                        <div>Previous Questions</div>                    
                    </div>
                    <!-- Table content area -->
                    <div class="py-4 bg-light" style="min-height:70vh;">
                        <!-- Table item -->
                        @foreach ($results as $result)
                            <form class="table-row" action="{{ route('answers.review', ['quizId'=>$quizId, 'questionId' => $result->id]) }}" method="GET">
                                <div class="question-id">{{ $result->id }}</div>
                                <div class="question">{{ $result->question }}</div>
                                <div class="timestamp">{{ $result->updated_at }}</div>
                                <button type="submit" class="btn-view">View</button>
                            </form>
                        @endforeach        
                    </div>
                </div>
            </div>            
        </div>
    </div>

</html>