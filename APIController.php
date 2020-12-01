<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; //For recieveing Post/Get request data
use App\Models\User;   //Laravel eloquent model for users table
use Illuminate\Http\Response; //for returning response in JSON
use Illuminate\Support\Facades\Hash;  //For password hash
class APIController extends Controller
{



	public function Register(Request $request){
		if ($request->name=="") {	//check if user has entered user name 
			return Response()->json("Enter User Name or check Header content-type"); 
		}
		if ($request->password=="") { //check if user has entered Password 
			return Response()->json("Enter User Password"); 
		}
		$existing_user = User::where('name',$request->name)->first(); //check if there is a user already existing with same name
		if ($existing_user) {
			return Response()->json("User Already exists. Try with another name"); 
		}
		$User=new User(); //Using laravel eloquent model for database query
		$User->name=$request->name;
		$User->password=Hash::make($request->password);
		$User->save();
		return Response()->json("New User Registered successfully with the name :" . $User->name); 
	} 




	public function login(Request $request)
	{
		$user = User::where('name',$request->name)->first();
		if ($user=="") //if no matching user name found in database 
		{
			return Response()->json("No User Found with this name"); 
		}
		if($user){  //if user exists then match entered password 
			if (Hash::check($request['password'],$user->password)) { //Hash check to match with hashed password
				return Response()->json("Loged in as :".$user->name); //return json responce with user name
			}
			else{ //if password wrong
				return Response()->json("Invalid Password");
			}
		}  
	}




	public function list(Request $request)
	{
		$users = User::all();	//using Laravel Eloquent Modal for query.
		return Response()->json($users); //Retuning All useres in json Format
	}


}
