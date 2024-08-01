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

        .question{
            display: flex;
            flex-direction: row;
            align-items: center;
            column-gap: 20px;
            padding-left:20px;
            flex:1;
            border-left: 5px solid goldenrod;
        }

        .answer-container{
            border-left: 1px grey solid;
            padding-left: 25px;
            flex:1;
            display: flex;
            align-items: center;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .info{
            flex:80%
        }

        .A{
            flex:20%
        }

        .btn-more{
            border: none;
            background-color: transparent;
            font-size: 2rem;
        }

        .return:hover, .add:hover{
            color:goldenrod
        }

        .add, .return{
            flex:1;
            background-color: transparent !important;
            border: none;
            margin-left: auto;
            margin-right: 0px;
            background-color: transparent;
            color: white;
            border:none;
            text-align: center;
        }

        .col-form-label{
            font-size:1rem !important
        }

        .choices{
            padding-left: 10%;
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
                    <hr>
                </div>
            </div>
            <div class="col-sm-10 col-md-10 col-xl-10 py-3 content-area">
                <div class="row p-5">
                    <!-- Content Area -->
                    <div class="col-12 table">
                        <!-- Table head -->
                        <div class="table-head  h3 py-2 px-3 text-light" style="display:flex;justify-content: space-between;">
                            <!--Route back to list of categories-->
                            <a class="return" href='{{ route('categories.view', $quizId) }}'>
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                            <div>Questions</div>

                            <!-- Button to add a new question -->
                            <button data-toggle="modal" data-target="#modalNew"  data-toggle="modal" data-target="#exampleModal" class="add">
                                <i class="fa-solid fa-plus" data-toggle="tooltip" data-placement="top" title="Add question"></i>
                            </button> 

                            <div class="modal fade" id="modalNew" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog text-dark" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a new question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" style="font-size:1rem">
                                                @csrf
                                                <!-- Your question -->
                                                <div class="form-group">
                                                    <label for="Descriptiomn" class="col-form-label" >Question </label>
                                                    <textarea class="form-control" id="question" name="question" rows="5" required></textarea>
                                                </div>

                                                <!-- Settings -->
                                                <!-- Points -->
                                                <div class="form-group">
                                                    <label for="points" class="col-form-label" >Points</label>
                                                    <input type="number" class="form-control" id="points" name="points" value="100" rows="5" required></input>
                                                </div>
                                                <!-- Point Multipler -->
                                                <div class="form-group">
                                                    <label for="points-bonus" class="col-form-label" >Additional Points for answering first %</label>
                                                    <input type="number" class="form-control" id="bonus" name="bonus" rows="5" value="0" required></input>
                                                </div>

                                                <select class="form-select" aria-label="Default select example" name="format" id="questionTypeSelect">
                                                    <option selected disabled>Open this select menu</option>
                                                    <option value="True or False">True or False</option>
                                                    <option value="Identification">Identification</option>
                                                    <option value="Multiple Choice">Multiple Choice</option>
                                                </select>

                                                <div id="tabs" class="h5">
                                                    <!-- Tab for true or false -->
                                                    <div id="trueFalseTab" class="tab p-2" style="display: none;">
                                                        <!-- True -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="TrFalse-answer" type="radio" value="True" id="radio-true" checked>
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                True
                                                            </label>
                                                        </div>
                                                        <!-- False -->
                                                       <div class="form-check">
                                                            <input class="form-check-input" name="TrFalse-answer" type="radio" value="False" id="radio-false">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                False
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Tab for identification -->
                                                    <div id="identificationTab" class="tab" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="identification-answer" class="col-form-label" >Answer</label>
                                                            <input type="text" class="form-control" id="question" name="identification-answer" rows="5" required></input>
                                                        </div>
                                                    </div>

                                                    <!-- Tab for multiple choice -->
                                                    <div id="multipleChoiceTab" class="tab" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="Descriptiomn" class="col-form-label" >Answer</label>
                                                            <input type="text" class="form-control" id="question" name="choice-correct" rows="5" required></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Descriptiomn" class="col-form-label" >Choice </label>
                                                            <input type="text" class="form-control" id="question" name="choice-incorrect-1" rows="5" required></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Descriptiomn" class="col-form-label" >Choice </label>
                                                            <input type="text" class="form-control" id="question" name="choice-incorrect-2" rows="5" required></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Descriptiomn" class="col-form-label" >Choice</label>
                                                            <input type="text" class="form-control" id="question" name="choice-incorrect-3" rows="5" required></input>
                                                        </div>
                                                    </div>
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
                        <!-- Table content area -->
                        <div class="py-4 px-2 bg-light" style="min-height:80vh;">
                            <!-- Table item -->                           
                            @if (isset($questions) && $questions->count() > 0)
                                @foreach ($questions->all() as $question)
                                <div class="table-row p-2">
                                    <div class="question"><div>Q:</div><div>{{$question->question}}</div></div>
                                    <div class="answer-container">
                                        <!-- Information about the question -->
                                        <div class="A text-danger">Points: </div>
                                        <div class="info">{{$question->points}} </div>
                                        <div class="A ">Bonus: </div>
                                        <div class="info">{{$question->bonus}} </div>
                                        <div class="A text-primary">Status: </div>
                                        <div class="info">{{$question->status}} </div>
                                        <div class="A text-success">Answer: </div>
                                        <div class="info">{{$question->answer}} </div>
                                        <div class="A text-warning">Format: </div>
                                        <div class="info">{{$question->format}} </div>
                                        <!-- List of choices if there is any -->
                                        @if($question -> format == "Multiple Choice")
                                            <div class="choices" style="flex:100%;padding-left:20%">
                                                @foreach ( $question -> choices as $choice)
                                                <div class="choice-item">>{{$choice}}</div>
                                                @endforeach
                                        </div>
                                        @endif

                                        
                                    </div>

                                    <!-- Delete button -->
                                    <button data-toggle="modal" data-target="#confirmDeleteModal"  
                                            data-question="{{$question->id}}" 
                                            data-quiz="{{$quizId}}"
                                            data-category="{{$categoryId}}"
                                          
                                            style="border:none;background:transparent">
                                            <i class="fa-solid fa-trash text-danger h4"></i>
                                    </button>

                                    <!-- Delete confirmation -->
                                    <div class="modal fade text-dark" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure you want to delete <span id="category-name"></span>?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deleteQuestion" method="post" action="">
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

                                @endforeach
                            @else 
                                <h5 class="text-center">No questions in this category!</h5>
                            @endif

                        </div>
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
        var questionId = button.data('question');
        var quizId = button.data('quiz'); 
        var categoryId = button.data('category'); 
        var modal = $(this);

        modal.find('.modal-title').text('Are you sure you want to delete this?' )

        // Route when pressing confirm
        var confirmButton = modal.find('#confirm-delete-button');
            confirmButton.off('click').on('click', function() {
                $('#deleteQuestion').attr('action', '/quiz/' + quizId + '/category/' + categoryId + '/question/' + questionId);
                $('#deleteQuestion').submit();
            });
        });

    document.getElementById('questionTypeSelect').addEventListener('change', function () {
        var value = this.value;

        // Hide all tabs and disable their inputs
        document.getElementById('trueFalseTab').style.display = 'none';
        document.querySelectorAll('#trueFalseTab input').forEach(function(input) {
            input.disabled = true;
        });

        document.getElementById('identificationTab').style.display = 'none';
        document.querySelectorAll('#identificationTab input').forEach(function(input) {
            input.disabled = true;
        });

        document.getElementById('multipleChoiceTab').style.display = 'none';
        document.querySelectorAll('#multipleChoiceTab input').forEach(function(input) {
            input.disabled = true;
        });

        // Show the selected tab and enable its inputs
        if (value === 'True or False') {
            document.getElementById('trueFalseTab').style.display = 'block';
            document.querySelectorAll('#trueFalseTab input').forEach(function(input) {
                input.disabled = false;
            });
        } else if (value === 'Identification') {
            document.getElementById('identificationTab').style.display = 'block';
            document.querySelectorAll('#identificationTab input').forEach(function(input) {
                input.disabled = false;
            });
        } else if (value === 'Multiple Choice') {
            document.getElementById('multipleChoiceTab').style.display = 'block';
            document.querySelectorAll('#multipleChoiceTab input').forEach(function(input) {
                input.disabled = false;
            });
        }
    });
</script>