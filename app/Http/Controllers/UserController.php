<?php
namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewIndex(){
        return view('auth.index');
    }

    public function login(Request $request) {
        // Validate the request data
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
    
        // Retrieve the user from the database
        $user = DB::table('users')
            ->where('id', $request->input('id'))
            ->first();
    
        // Verify the password
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Session::put('user', $user);                      // Save the user to session cache
            return redirect()->route('homepage');             // Route to the appropriate homepage

        } else {
            // Redirect back to the index page with an error message
            return redirect()->route('index')->withErrors([
                'login' => 'Incorrect login credentials.'
            ]);
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('index');
    }

    public function viewHomepage() {
        // Route to admin or user homepage
        $quizController = app(QuizController::class);
        if (Session::get('user')->privilege === 'admin') {      //If user is of admin status

        } else {
            $members = DB::table('members')->where('user', Session::get('user')->id)->get();
            $quizzes = $quizController->getQuizzesOf(Session::get('user')->id);

            return view('user.homepage', ['quizzes' => $quizzes, 'members'=>$members]);
        }
    }


    public function updateTeam(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'members' => 'array',
            'members.*' => 'string|max:255'
        ]);
        //Preparation
        $members = $request->input('members', []);
        $memberData = [];
        $userId = Session::get('user')->id;

        //Update team name
        DB::table('users')
        ->where('id', Session::get('user')->id)
        ->update([
            'name' => $request->input('name'),
        ]);

        DB::table('members')
        ->where('user', Session::get('user')->id)
        ->delete();

        foreach ($members as $memberName) {
            $memberData[] = [
                'user' => $userId,
                'memberName' => $memberName,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
    
        // Batch insert members
        DB::table('members')->insert($memberData);

        return redirect()->back()->with('status', 'Team updated successfully!');
    }
}
