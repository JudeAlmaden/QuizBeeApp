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
    <style>/* Container for each question row */
.table-row {
    display: flex;                       /* Use flexbox for layout */
    align-items: center;                /* Center items vertically */
    padding: 15px;                      /* Padding around each row */
    margin: 10px 0;                    /* Margin between rows */
    background-color: #f9f9f9;         /* Light background color */
    border: 1px solid #ddd;            /* Border around each row */
    border-radius: 5px;                /* Rounded corners */
    transition: background-color 0.3s; /* Transition effect for hover */
}

/* Change background color on hover */
.table-row:hover {
    background-color: #f1f1f1;         /* Slightly darker on hover */
}

/* Style for question ID */
.question-id {
    flex: 0 0 80px;                    /* Fixed width for ID */
    font-weight: bold;                 /* Bold text */
    color: #333;                       /* Dark color */
}

/* Style for the question text */
.question {
    flex: 1;                           /* Take remaining space */
    padding: 0 15px;                  /* Horizontal padding */
    color: #555;                       /* Medium color */
}

/* Style for the timestamp */
.timestamp {
    flex: 0 0 150px;                   /* Fixed width for timestamp */
    color: #999;                       /* Lighter color */
}

/* Button styling */
.btn-view {
    padding: 10px 15px;                /* Padding for the button */
    background-color: #007bff;        /* Bootstrap primary color */
    color: white;                      /* Text color */
    border: none;                      /* No border */
    border-radius: 5px;               /* Rounded corners */
    cursor: pointer;                   /* Pointer cursor */
    transition: background-color 0.3s; /* Transition effect */
}

/* Change button color on hover */
.btn-view:hover {
    background-color: #0056b3;        /* Darker blue on hover */
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
                    <div class="table-head  h3 py-2 px-3 text-light bg-dark">
                        <div><a href="{{ route('quiz.view', $quizId) }}"class="return p-1 text-light mr-5"><i class="fa-solid fa-chevron-left"></i></a> Previous Questions</div>                    
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