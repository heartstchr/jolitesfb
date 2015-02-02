<?php

class MessageController extends \BaseController {

	public function viewMessages(){


		$user = User::where('id',Auth::user()->id)->where('deleted_at', NULL)->with('profilePicture', 'posts')->first();
		$this->layoutData['user'] = $user;

		$conversations = Conversation::where('user_one_id',$user->id)->orWhere('user_two_id',$user->id)->orderBy('updated_at','desc')->with('last_message','user_one','user_two')->get();

		$messegers = [];
		foreach($conversations as $conversation)
		{
			if($conversation->user_one_id == $user->id){
				$messegers[$conversation->id]	=	$conversation->user_two;
			}else{
				$messegers[$conversation->id]	=	$conversation->user_one;
			}
		}


		return View::make('viewMessages',$this->layoutData)->withConversations($conversations)->withMessegers($messegers);


	}

	public function sendMessage(){

		$sender = Auth::user()->id;
		$receiver = Input::get('receiver');

		$conversation = Conversation::where('user_one_id',$sender)->where('user_two_id',$receiver)->first();

		if(!isset($conversation->id))
		{
			$conversation = Conversation::where('user_one_id',$receiver)->where('user_two_id',$sender)->first();
		}

		if(!isset($conversation->id))
		{
			$conversation = new Conversation();

			$conversation->user_one_id = $sender;
			$conversation->user_two_id = $receiver;

			$conversation->save();

		}

		$conversation_reply = new Conversation_reply();

		$conversation_reply->sender_id 	= $sender;
		$conversation_reply->message	= Input::get('message');
		$conversation_reply->conversation_id	=	$conversation->id;
		$conversation_reply->status		=	0;

		$conversation_reply->save();

		$conversation->touch();

		return Redirect::back()->with('success','Message Sent successfully');

	}

	public function viewConversation($id){

		$user = User::where('id',Auth::user()->id)->where('deleted_at', NULL)->with('profilePicture', 'posts')->first();
		$this->layoutData['user'] = $user;

		$conversation	=	Conversation::where('id',$id)->with('user_one','user_two')->first();

		if($conversation->user_one_id == $user->id)
		{
			$friend	=	$conversation->user_two;
		}else{
			$friend =	$conversation->user_one;
		}

		$messages		=	Conversation_reply::where('conversation_id',$id)->orderBy('updated_at')->get();


		return View::make('viewConversation',$this->layoutData)->with('friend',$friend)->with('messages',$messages)->with('user',$user);

	}

}