<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function getQuizzesOf($userId){
        // Get all quizzes related to a user
        $quizzes = DB::table('user_quiz_rel')
        ->join('quizzes', 'user_quiz_rel.quiz', '=', 'quizzes.id')
        ->where('user_quiz_rel.user', $userId)
        ->select(
            'quizzes.id',
            'user_quiz_rel.user',
            'user_quiz_rel.relation',
            'quizzes.name',
            'quizzes.description',
            'quizzes.created_at',
            'quizzes.updated_at'
        )
        ->orderBy('quizzes.id') 
        ->get();

        return $quizzes;
    }

    public function joinQuiz(Request $request){
        $request->validate([
            'code' => 'required'
        ]);
        //Check if the quiz exist
        $quiz=DB::table('quizzes')
        ->where('code', $request -> input('code'))
        ->first();

        if($quiz){
            //Check if user has prior relation to quiz
            $exists = DB::table('user_quiz_rel')
            ->where('user', Session::get('user')->id)
            ->where('quiz', $quiz->id)
            ->exists();

            if(!$exists){
                DB::table('user_quiz_rel')->insert([
                    'user' => Session::get('user')->id, 
                    'quiz' =>  $quiz->id ,
                    'relation' => 'Pending',
                ]);

                return redirect()->back()->with('status', 'Successfully applied');

            }else{
                return redirect()->back()->with('status', 'Already applied');

            }
        }else{
            return redirect()->back()->with('status', 'Invalid id');
        }
    }
    public function createQuiz(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $code = $this->generateRandomString();

        //Insert to database and get the quiz id
        $quizId = DB::table('quizzes')->insertGetId(
            ['name' => $request->input('name'), 'description' => $request->input('description'), 'code'=> $code]
        );

        //use quiz id to relate it touser
        $userId = Session::get('user')->id; 
        DB::table('user_quiz_rel')->insert(
            ['user' => $userId, 'quiz' => $quizId, 'relation' => 'Creator'] 
        );

        //go back to homepage
        return redirect()->route('homepage');
    }

    public function generateRandomString() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
    
    public function viewQuiz($quizId){
        // If not found redirect to index/homepage
        if (!isset($quizId) || !is_numeric($quizId)) {
            return redirect()->route('index');
        }

        //get the relation of user to the quiz
        $result = DB::table('user_quiz_rel')
        ->join('quizzes', 'user_quiz_rel.quiz', '=', 'quizzes.id')
        ->where('user_quiz_rel.user', Session::get('user')->id)
        ->where('quizzes.id', $quizId)
        ->select('user_quiz_rel.relation')
        ->first();

        // Get quiz data for side nav
        $quiz = DB::table('quizzes')->where('id', $quizId)->first();
        
        if($result->relation == 'Creator'){
            return view('/quiz/dashboard', ['quiz' => $quiz]);
        }
        else if($result->relation == 'Player'){
            return redirect()->route('quiz.play', $quizId);
        }else{
            return redirect()->route('homepage');
        }
    }

    public function deleteQuiz($quizId){

        DB::transaction(function() use ($quizId) {
            // Step 1: Delete answers related to questions in the quiz
            DB::table('answer_history')
                ->whereIn('question', function($query) use ($quizId) {
                    $query->select('questions.id')
                        ->from('questions')
                        ->join('categories', 'questions.category', '=', 'categories.id')
                        ->where('categories.quiz', $quizId);
                })
                ->delete();
        
            // Step 2: Delete choices related to questions in the categories of the quiz
            DB::table('choices')
                ->whereIn('question', function($query) use ($quizId) {
                    $query->select('questions.id')
                        ->from('questions')
                        ->join('categories', 'questions.category', '=', 'categories.id')
                        ->where('categories.quiz', $quizId);
                })
                ->delete();
        
            // Step 3: Delete questions related to categories in the quiz
            DB::table('questions')
                ->whereIn('category', function($query) use ($quizId) {
                    $query->select('id')
                        ->from('categories')
                        ->where('quiz', $quizId);
                })
                ->delete();
        
            // Step 4: Delete user_quiz_rel related to the quiz
            DB::table('user_quiz_rel')
                ->where('quiz', $quizId)
                ->delete();
        
            // Step 5: Delete categories related to the quiz
            DB::table('categories')
                ->where('quiz', $quizId)
                ->delete();
        
            // Step 6: Delete the quiz itself
            DB::table('quizzes')
                ->where('id', $quizId)
                ->delete();
        });
        return redirect()->route('homepage');
    }

    public function viewLeaderboard($quizId){
  
        $userPointsSubquery = DB::table('answer_history')
        ->join('questions', 'questions.id', '=', 'answer_history.question')
        ->join('categories', 'categories.id', '=', 'questions.category')
        ->join('quizzes', 'quizzes.id', '=', 'categories.quiz')
        ->join('user_quiz_rel', 'user_quiz_rel.user', '=', 'answer_history.user')
        ->select('user_quiz_rel.user AS userId', DB::raw('SUM(answer_history.points) AS totalPoints'))
        ->where('user_quiz_rel.relation', 'Player')
        ->where('quizzes.id', $quizId)
        ->groupBy('user_quiz_rel.user');

        $results = DB::table('users')
        ->leftJoinSub($userPointsSubquery, 'UserPoints', function ($join) {
            $join->on('users.id', '=', 'UserPoints.userId');
        })
        ->leftJoin('members', 'users.id', '=', 'members.user')
        ->leftJoin('user_quiz_rel', 'users.id', '=', 'user_quiz_rel.user') // Additional join to ensure 'Player' relation
        ->select(
            'users.id AS userId',
            'users.name AS userName',
            DB::raw('GROUP_CONCAT(DISTINCT members.memberName SEPARATOR ", ") AS members'),
            DB::raw('COALESCE(UserPoints.totalPoints, 0) AS totalPoints')
        )
        ->where('user_quiz_rel.relation', 'Player') // Ensure to filter by 'Player' relation in main query
        ->groupBy('users.id', 'users.name', 'UserPoints.totalPoints')
        ->orderBy('totalPoints','desc')
        ->get();

        return view('/quiz/menus/leaderboard/leaderboards', ['quizId'=> $quizId, 'results'=>$results]);
    }

    
    public function viewRecentQuestions($quizId){

        $results = DB::table('questions')
            ->select('questions.question', 'questions.id', 'questions.updated_at as updated_at' )
            ->join('categories', 'questions.category', '=', 'categories.id')
            ->join('quizzes', 'categories.quiz', '=', 'quizzes.id')
            ->where('questions.status', 'Finished')
            ->orderBy('questions.updated_at', 'desc')
            ->get();

        return view('/quiz/menus/answers/review', ['quizId'=> $quizId, 'results'=>$results]);
    }

    // Lists all  the answers to a given question
    public function viewPlayerAnswers($quizId, $questionId){
        $results = DB::table('answer_history')
        ->select(
            'users.name',
            'answer_history.id as answerId',
            'answer_history.evaluation',
            'answer_history.answer',
            'answer_history.points',
            'answer_history.id',
            'questions.bonus',
            'questions.id as questionId',
            'questions.points as basepoints',
            'answer_history.created_at'
        )
        ->join('questions', 'questions.id', '=', 'answer_history.question')
        ->join('users', 'users.id', '=', 'answer_history.user')
        ->where('questions.id', $questionId)
        ->orderByRaw("FIELD(answer_history.evaluation, 'Correct', 'Incorrect')")
        ->orderBy('answer_history.created_at')
        ->get();
    
        $isAdmin = DB::table('user_quiz_rel')
        ->join('quizzes', 'user_quiz_rel.quiz', '=', 'quizzes.id')
        ->where('user_quiz_rel.user', Session::get('user')->id)
        ->where('quizzes.id', $quizId)
        ->select('user_quiz_rel.relation')
        ->first();

        if (!$isAdmin || $isAdmin->relation !== "Creator") {
            $isAdmin=false;
        }else{
            $isAdmin=true;
        }

        return view('/quiz/menus/answers/answers' , ['results' => $results, 'quizId' =>$quizId, 'isAdmin' => $isAdmin]);
    }
    
    public function toggleEvaluaton(Request $request){
        $request->validate([
            'answerId' => 'required',
            'questionId' => 'required',
            'initialEvaluation' => 'required'
        ]);

        $newEvaluation = ($request->input('initialEvaluation') === 'Correct') ? 'Incorrect' : 'Correct';
            // Update the entry
            DB::table('answer_history')
            ->where('id', $request->input('answerId'))
            ->update(['evaluation' => $newEvaluation]);
    
        //Get the initial question amd relevant data
        $question = DB::table('questions')
            ->where('id', $request->input('questionId'))
            ->first();
        
        $firstCorrectAnswerId = DB::table('answer_history')
        ->orderBy('answer_history.created_at', 'asc') 
        ->first();
                
        //Update status of all correct answers
        DB::table('answer_history')
            ->where('question', $request->input('questionId'))
            ->where('evaluation','Correct')
            ->update(['points' => $question->points]);

        //Update status of all incorrect answers
        DB::table('answer_history')
            ->where('question', $request->input('questionId'))
            ->where('evaluation','Incorrect')
            ->update(['points' =>  0]);

        //Update the points of the first correct answer
        DB::table('answer_history')
            ->where('id', $firstCorrectAnswerId->id)
            ->where('question', $request->input('questionId'))
            ->where('evaluation','Incorrect')
            ->update(['points' =>  $question->points + ($question->points * $question->bonus)/100]);

         return redirect()->back();
    }

    public function viewTeams($quizId){
        $teams = $this -> getTeams($quizId);
        return view('/quiz/menus/teams/teams', ['results'=>$teams, 'quizId' => $quizId]);
    }
    public function getTeams($quizId){
        $results = DB::table('user_quiz_rel')
        ->select(
            'users.id as id',
            'user_quiz_rel.id as rel_id',
            'users.name as team_name',
            DB::raw('GROUP_CONCAT(members.memberName SEPARATOR ", ") AS members'),
            'user_quiz_rel.relation as relation'
        )
        ->leftJoin('users', 'users.id', '=', 'user_quiz_rel.user')
        ->leftJoin('members', 'members.user', '=', 'user_quiz_rel.user')
        ->where('user_quiz_rel.relation', '!=', 'creator')
        ->where('user_quiz_rel.quiz', '=',$quizId)
        ->groupBy('users.id', 'users.name', 'user_quiz_rel.relation',"rel_id")
        ->get();

        // Process the results
        $processedResults = $results->map(function ($item) {
            // Explode the members string into an array
            $item->members = explode(', ', $item->members);
            return $item;
        });

        // Return or use the processed results as needed
        return  $processedResults;

    }

    //Id pertains to the rel id we want to modify
    public function removeTeam($quizId, $id){
        DB::table('user_quiz_rel')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function approveTeam($quizId, $id){
        DB::table('user_quiz_rel')
        ->where('id', $id)
        ->update(['relation' => 'Player']);
    
        return redirect()->back();
    }

    public function returnFromAnswers($quizId){
        $result = DB::table('user_quiz_rel')
        ->join('quizzes', 'user_quiz_rel.quiz', '=', 'quizzes.id')
        ->where('user_quiz_rel.user', Session::get('user')->id)
        ->where('quizzes.id', $quizId)
        ->select('user_quiz_rel.relation')
        ->first();

        if($result->relation == 'Creator'){
            return redirect()->route('quiz.playQuizAsAdmin', $quizId);
        }
        else if($result->relation == 'Player'){
            return redirect()->route('quiz.play', $quizId);
        }else{
            return redirect()->route('homepage');
        }
    }
}
