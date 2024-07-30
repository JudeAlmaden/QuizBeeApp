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
        }

        .table-row{
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            transition: .25s;
            margin-bottom: 10px;
        }

        .table-row:hover{
            background-color: grey;
            color: white !important;
        }
        .deck-icon{
            flex:1;
        }

        .category-name{
            flex:4;
        }

        .button-container{
            flex:1;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: end;
        }

        .button-container button{
            flex:1;
            background-color: transparent !important;
            border: none;
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

        .btn-viewQuestions, .btn-categoryDelete{
            flex:1;
            text-align: center;
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
                    <hr>
                </div>
            </div>
            <div class="col-sm-10 col-md-10 col-xl-10 py-3 content-area">
                <div class="row p-5">
                    <!-- Content Area -->
                    <div class="col-12 table">
                        <!-- Table head -->
                        <div class="table-head  h3 py-2 px-3 text-light" style="display:flex;justify-content: space-between;">
                            <!-- Return to quiz dashboard  -->
                            <a class="return" href="{{ route('quiz.view', $quizId) }}">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                            <div>Categories</div>

                            <!-- Button to add a new category -->
                            <button data-toggle="modal" data-target="#modalNewCategory"  data-toggle="modal" data-target="#exampleModal" class="add">
                                <i class="fa-solid fa-plus" data-toggle="tooltip" data-placement="top" title="Add question"></i>
                            </button> 

                            <!-- Modal form for creating a new category-->
                            <div class="modal fade" id="modalNewCategory" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog text-dark" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('category.create',$quizId)}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="Quiz Name" class="col-form-label" >Category name:</label>
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

                        <!-- Table content area -->
                        <div class="py-5 bg-light" style="min-height:80vh">
                            <!-- Table item -->
                            @if (isset($categories) && $categories->count() > 0)
                                @foreach ($categories->all() as $category)
                                <div class="table-row px-5 py-2" title="{{$categories->description}}">
                                    <i class="deck-icon fa-solid fa-layer-group h1"></i>
                                    <div class="category-name">{{$category->name}}</div>
                                    <div class="button-container">

                                        <!-- View questions in this category -->
                                        <a class="btn-viewQuestions" href='{{ route('questions.view',['quizId'=>$quizId,'categoryId'=>$category->id]) }}' style="background-color: transparent;border:none">
                                            <i class="fa-solid fa-play h4"></i>
                                        </a>

                                        <!-- Delete this category and all its -->
                                        <button class="btn-categoryDelete"data-toggle="modal" data-target="#confirmDeleteModal"  
                                            data-quiz="{{$category->quiz}}" 
                                            data-name="{{$category->name}}" 
                                            data-id="{{$category->id}}">
                                            <i class="fa-solid fa-trash text-danger h4"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            @else  
                                <h5 class="text-center">Looks like you havent made a category yet. Click the plus icon above to categorize your quiz questions!</h5>
                            @endif
                        </div>

                        <!--Modal to confirm delete-->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Are you sure you want to delete <span id="category-name"></span>?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <form id="deleteCategoryForm" method="POST" action="">
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


<script>

    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var categoryId = button.data('id')
    var quiz = button.data('quiz')
    var name = button.data('name') 
    var modal = $(this)
    modal.find('.modal-title').text('Are you sure you want to delete ' + name +" ?")

    var confirmButton = modal.find('#confirm-delete-button');
        confirmButton.off('click').on('click', function() {
            $('#deleteCategoryForm').attr('action', '/quiz/' + quiz + '/category/' + categoryId );
            $('#deleteCategoryForm').submit();
        });
    });

</script>