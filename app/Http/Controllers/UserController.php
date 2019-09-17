<?php

namespace App\Http\Controllers;


use App\Job;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['seeker','verified'])->except('index','userAppliedJobs');
    }

    public function users(Request $request)
    {
        $query = $request->get('query');
        $users = Job::where('title','like','%'.$query.'%')
                ->orWhere('position','like','%'.$query.'%')
                ->get();
        return response()->json($users);
    }
  
    public function index(){
       // dd('i am here');
    	return view('profile.index');
    }

    public function store(Request $request){
        $this->validate($request,[

            'address'=>'required',
            'bio'=>'required|min:20',
            'experience'=>'required|min:20',
            'phone_number'=>'required|min:10|numeric'
        ]);

   		$user_id = auth()->user()->id;
   		
      Profile::where('user_id',$user_id)->update([
        'address'=>request('address'),
   			'experience'=>request('experience'),
   			'bio'=>request('bio'),
            'phone_number'=>request('phone_number')
   		]);
   		return redirect()->back()->with('message','Profile Sucessfully Updated!');

   }

    public function coverletter(Request $request){
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
            Profile::where('user_id',$user_id)->update([
              'cover_letter'=>$cover
            ]);
            return redirect()->back()->with('message','Cover letter Sucessfully Updated!');



   }
    public function resume(Request $request){
        $this->validate($request,[
            'resume'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
          $user_id = auth()->user()->id;
          $resume = $request->file('resume')->store('public/files');
            Profile::where('user_id',$user_id)->update([
              'resume'=>$resume
            ]);
        return redirect()->back()->with('message','Resume Sucessfully Updated!');



   }

    public function avatar(Request $request){
        $this->validate($request,[
            'avatar'=>'required|mimes:png,jpeg,jpg|max:20000'
        ]);
        $user_id = auth()->user()->id;
        dd('here');
        if($request->hasfile('avatar')){
            $file = $request->file('avatar');
            $ext =  $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/',$filename);
            Profile::where('user_id',$user_id)->update([
              'avatar'=>$filename
            ]);

        return redirect()->back()->with('message','Profile picture Sucessfully Updated!');
        }
 
   }

   public function jobsApplied(User $user){
      // dd($user->jobs);
       return view('user.jobs.applied')->with('jobs',$user->jobs);
   }

   // for the employer..
   public function userAppliedJobs(){
        $user = Auth::user();
        //dd($user->id);
        $jobs = Job::where('user_id',$user->id)->get();
        return view('jobs.employer_jobs_user')->with('jobs',$jobs);
        // foreach($jobs as $job){
        //     $job = Job::find($job->id)->users;
        //    // print_r($job->profile);
        //     foreach ($job as $j) {
        //         echo "<pre>";
        //         print_r($j->profile->phone_number);
        //         print_r($j->id);
        //         print_r($j->name);
        //         print_r($j->pivot->user_id);
        //         print_r($j->pivot->job_id);
        //         print_r($j->pivot->pivotParent->position);
        //         print_r($j->pivot->pivotParent->user_id);
        //         echo "</pre>";
        //     }
            
        //  }

            

       // print_r($jobs);
      //  $job = Job::find($jobs->id);
       // $users = 
        //dd($job);
       // dd($jobs->toSql(),$jobs->getBindings());

   }

   
    
}
