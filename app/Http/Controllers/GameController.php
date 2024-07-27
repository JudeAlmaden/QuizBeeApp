<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class GameController extends Controller
{
    // Functions for the game itself
    public function playQuizAsAdmin($quizId){
        // Gets the current question if there is any
        $currentQuestion = $this -> getCurrentQuestion($quizId);
        $availableCategories = $this -> getCategoriesWithAvailableQuestions($quizId);

        return view('/quiz/adminPlay', compact('currentQuestion','quizId','availableCategories'));
    }

    public function getCategoriesWithAvailableQuestions($quizId){
        $categories = DB::table('categories')
            ->join('questions', 'questions.category', '=', 'categories.id')
            ->select(
                'categories.id',
                'categories.name',
                'categories.quiz',
                DB::raw('COUNT(questions.id) as available_questions_count')
            )
            ->where('categories.quiz', $quizId)
            ->where('questions.status', 'Available')
            ->groupBy(
                'categories.id',
                'categories.name',
                'categories.quiz'
            )
            ->havingRaw('COUNT(questions.id) > 0') 
            ->orderBy('categories.name')
            ->get();

        return $categories;   
    }

    public function getCurrentQuestion($quizId){
    
        $question=DB::table('quizzes')
        ->join('categories', 'quizzes.id', '=', 'categories.quiz')
        ->join('questions', 'questions.category', '=', 'categories.id')
        ->leftJoin('choices', 'questions.id', '=', 'choices.question')
        ->select(
            'questions.id', 
            'questions.question', 
            'categories.name',
            'categories.quiz',
            'questions.points', 
            'questions.status', 
            DB::raw('GROUP_CONCAT(choices.choice ORDER BY choices.id SEPARATOR ", ") AS choices'), 
            'questions.answer', 
            'questions.format', 
            'questions.bonus',  
           )
        ->where('quizzes.id', $quizId)
        ->where('questions.status', 'Selected')
        ->groupBy('questions.id','categories.quiz', 'questions.question','categories.name','questions.status', 'questions.points', 'questions.answer', 'questions.format', 'questions.bonus')
        ->orderBy('questions.id')
        ->first(); 

        if ($question && $question->choices) {
            $question->choices = explode(', ', $question->choices);
        }
        
        return $question;
    }

    //Used to get select the next question to be asked based on what id the reuqester wants
    public function getQuestion($quizId, Request $request){
        $request->validate([
            'category_id' => 'required',
        ]);

        $question = DB::table('questions')
        ->where('category',$request->category_id)
        ->where('status', 'Available')
        ->first();

        // Skip query if null
        if (is_null($request->category_id) || is_null($question)) {
            return redirect()->back();
        }

        //open up the question to be viewed and submit answers
        DB::table('questions')
        ->where('id', $question->id)
        ->update([
            'status' => 'Selected',
            'isAccepting' => 'True' 
        ]);

        return redirect()->back();
    }

    //change status of selected question to Finished
    public function deselectQuestion($quizId){

    DB::table('questions')
        ->join('categories', 'categories.id', '=', 'questions.category')
        ->join('quizzes', 'quizzes.id', '=', 'categories.quiz')
        ->where('questions.status', 'Selected')
        ->update(['questions.status' => 'Finished']);

        return redirect()->back();
    }

    public function playQuiz($quizId){
        // Gets the current question if there is any
        $currentQuestion = $this -> getCurrentQuestion($quizId);

        //Check if there is still a question being asked
        if(is_null($currentQuestion)){
            return view('/quiz/userPlay', compact('quizId'));
        }       
        
        //Check if user has answered this question yet
        $hasAnswered = DB::table('answer_history')
        ->where('question', $currentQuestion->id)
        ->where('user', Session::get('user')->id)
        ->exists();


        return view('/quiz/userPlay', compact('currentQuestion','quizId', 'hasAnswered'));
    }

    public function submitAnswer( Request $request){

        //Validate request 
        $request->validate([
            'answer' => 'required',
            'questionId' => 'required|integer', 
            'quizId' => 'required|integer', 
        ]);
    
        //Check if player had already submitted an answer
        $exists = DB::table('answer_history')
        ->where('question', $request->questionId)
        ->where('user', Session::get('user')->id)
        ->exists();

        //Get the currect question
        $question = DB::table('questions')
        ->where('id', $request->questionId)
        ->first();

        //To prevent user from answering if he had already submitted
        if ($exists) {
            return redirect()->back()->with('error', 'You have already answered this question.');
        }


        //Prevent user from submitting answer if question is no longer selected
        if ($question->status != "Selected" || $question->isAccepting == "False") {
            return redirect()->back()->with('error', 'Your answer did not make it on time :(');
        }

        //Check if their answer matches
        $evaluation = "Incorrect";
        $points =  strtoupper($question->answer) ==  strtoupper($request -> input('answer'))? $question -> points: 0;
        
        if($points != 0){
            $evaluation = "Correct";

            //Check if first to answer correctly
            $isFirst = !DB::table('answer_history')
            ->where('question',  $request->questionId)
            ->where('evaluation',  $evaluation)
            ->orderBy('created_at', 'desc')
            ->exists();

            // Add bonus to points if correct
            if($isFirst){
                $points += ($points*$question->bonus/100);
            }
        }

        // Insert into answer_history table
        DB::table('answer_history')->insert([
            'question' => $request->questionId,
            'user' => Session::get('user')->id, 
            'answer' => $request->input('answer'),
            'evaluation' =>  $evaluation ,
            'points' => $points,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Your answer has been submitted successfully!');
    }
}
