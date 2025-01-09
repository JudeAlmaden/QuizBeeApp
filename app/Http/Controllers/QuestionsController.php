<?php

namespace App\Http\Controllers;

use App\Events\AcceptingAnswersToggledByAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function viewCategoriesList($quizId){
        if (!isset($quizId) || !is_numeric($quizId)) {
            return redirect()->route('admin.homepage');
        }

        $categories = $this->getCategories($quizId);

        return view("/quiz/menus/questions/categories",['quizId' => $quizId,'categories' => $categories]);
    }

    public function getCategories($quizId){
        // Get categories found a quiz
        $categories = DB::table('categories')
        ->where('quiz', $quizId)
        ->select('*')   
        ->orderBy('categories.id') 
        ->get();
        return $categories;
    }
    
    public function createCategory(Request $request, $quizId){
        // validate request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //Insert
        DB::table('Categories')->insert(
            ['name' => $request->input('name'), 'description' => $request->input('description'),'quiz' => $quizId]
        );
        //Return
        return redirect()->route('categories.view', ['quizId' => $quizId]);
    }

    public function viewQuestions($quizId,$categoryId){
        $questions = $this-> getQuestions($categoryId);

        return view("/quiz/menus/questions/questions",["quizId"=>$quizId,'categoryId' => $categoryId, 'questions'=> $questions]);
    }

    public function getQuestions($categoryId) {
        $questions = DB::table('questions')
            ->leftJoin('choices', 'questions.id', '=', 'choices.question')
            ->where('questions.category',$categoryId) 
            ->select(
                'questions.id', 
                'questions.question', 
                'questions.category',
                'questions.points', 
                'questions.status', 
                DB::raw('GROUP_CONCAT(choices.choice ORDER BY choices.id SEPARATOR ", ") AS choices'), 
                'questions.answer', 
                'questions.format', 
                'questions.bonus', 
            )
            ->groupBy('questions.id', 'questions.question','questions.category','questions.status',  'questions.points', 'questions.answer', 'questions.format', 'questions.bonus')
            ->orderBy('questions.id')
            ->get();

            // dd($questions);

        foreach ($questions as $question) {
            $question->choices = explode(', ', $question->choices);
        }

        return $questions;
    }
    
    public function createQuestions(Request $request, $quizId, $categoryId){
        $request->validate([
            'question' => 'required',
            'points' => 'required',
            'bonus' => 'required',
            'format' => 'required',
        ]);

        $question = $request -> input('question');
        $answer = "";
        $points = $request -> input('points');
        $bonus = $request -> input('bonus');
        $format = $request -> input('format');
        $status = "Available";

        // Get the answer based of different sources
        if($format == "True or False"){
            $answer = $request -> input('TrFalse-answer');
        }elseif($format == "Identification"){
            $answer = $request -> input('identification-answer');
        }elseif($format == "Multiple Choice"){
            $answer = $request -> input('choice-correct');
        }else{
           $this-> viewQuestions($quizId, $categoryId);
        }

        // Insert the question
        $questionId =  DB::table('Questions')->insertGetId(
            ['question' => $question, 
            'category'=> $categoryId,
            'answer' => $answer,
            'points' => $points,
            'bonus' => $bonus,
            'format' => $format,
            'status' => $status
            ]
        );

        // If the question is multiple choice, add the choices on choices table
        if($format == "Multiple Choice"){
            DB::table('choices')->insert(
                ['question' => $questionId, 
                'choice' => $answer,
                ]
            );

            DB::table('choices')->insert(
                ['question' => $questionId, 
                'choice' => $request -> input('choice-incorrect-1'),
            ]);
    
            DB::table('choices')->insert(
                ['question' => $questionId, 
                'choice' => $request -> input('choice-incorrect-2'),
            ]);

            DB::table('choices')->insert(
                ['question' => $questionId, 
                'choice' => $request -> input('choice-incorrect-3'),
            ]);
        }
        
        return redirect()->route('questions.view', ['categoryId' => $categoryId, 'quizId' => $quizId]);
    }
    
    public function deleteQuestion($quizId, $categoryId, $questionId){
        DB::table('choices')->where([
            ['question', '=', $questionId],
        ])->delete();

        DB::table('questions')->where([
            ['id', '=', $questionId],
        ])->delete();

        DB::table('answer_history')->where([
            ['question', '=', $questionId],
        ])->delete();

        return redirect()->route('questions.view', ['categoryId' => $categoryId, 'quizId' => $quizId]);
    }
    public function deleteCategory($quizId, $categoryId){
        // Delete answers related to questions in the specified category
        DB::table('answer_history')
            ->whereIn('question', function ($query) use ($categoryId) {
                $query->select('id')
                    ->from('questions')
                    ->where('category', $categoryId);
            })
            ->delete();

        // Delete choices related to questions in the specified category
        DB::table('choices')
            ->whereIn('question', function ($query) use ($categoryId) {
                $query->select('id')
                    ->from('questions')
                    ->where('category', $categoryId);
            })
            ->delete();

        // Delete questions in the specified category
        DB::table('questions')
            ->where('category', $categoryId)
            ->delete();

        // Delete the category itself
        DB::table('categories')
            ->where('id', $categoryId)
            ->delete();

        return $this -> viewCategoriesList($quizId);
    }

    public function apiGetCurrentQuestion($quizId){
        //Get the currect selected question on a quiz

        $question = DB::table('quizzes')
            ->join('categories', 'quizzes.id', '=', 'categories.quiz')
            ->join('questions', 'questions.category', '=', 'categories.id')
            ->select(
                'questions.id', 
            )
            ->where('quizzes.id', $quizId)
            ->where('questions.status', 'Selected')
            ->orderBy('questions.id')
            ->first(); 
    
        
        return response()->json($question);
    }
    
    //Toggle for allowing users to allow acceptings answers to questions
    public function apiQuestionToggleRequest($questionId, $userId)
    {
        // Check if the user is the quiz maker by running the custom SQL query
        $quizMaker = DB::select(
            "SELECT questions.id as question_id, user_quiz_rel.user as quiz_maker_id
            FROM questions
            JOIN categories ON categories.id = questions.category
            JOIN quizzes ON quizzes.id = categories.quiz
            JOIN user_quiz_rel ON user_quiz_rel.quiz = quizzes.id
            WHERE questions.id = ? AND user_quiz_rel.user = ? AND user_quiz_rel.relation = 'Creator'",
            [$questionId, $userId]
        );
    
        // If no quiz maker is found, return an error response
        if (empty($quizMaker)) {
            return response()->json(['error' => 'You are not the quiz maker.'], 403);
        }
    
        // Retrieve the question data
        $question = DB::table('questions')->where('id', $questionId)->first();
    
        // If the question exists, toggle the status
        if ($question) {
            $newStatus = $question->isAccepting === 'True' ? 'False' : 'True';
    
            DB::table('questions')
                ->where('id', $questionId)
                ->update([
                    'isAccepting' => $newStatus,
                ]);
        }
    
        // Fetch the updated question
        $updatedQuestion = DB::table('questions')
            ->where('id', $questionId)
            ->first();
    
        // Broadcast the event with the updated `isAccepting` status
        broadcast(new AcceptingAnswersToggledByAdmin([
            'isAccepting' => $updatedQuestion->isAccepting,
        ]));
    
        return response()->json($updatedQuestion);
    }
    
    

    public function apiQuestionView($questionId){   

        //gets a question using question id
        $question = DB::table('questions')
        ->where('id', $questionId)
        ->first();

        return response()->json($question);
    }
}
