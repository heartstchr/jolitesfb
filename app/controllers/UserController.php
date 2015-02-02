<?php

use Facebook\Repositories\Eloquent\AlbumRepository;
use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;

class UserController extends \DashController {

    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    protected  $user;

    /**
     * @var Facebook\Repositories\Eloquent\AlbumRepository
     */
    protected  $album;

    public function __construct(UserRepository $user,SiteSettingsRepository $siteSettings, AlbumRepository $album)
    {
        parent::__construct($user,$siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
        $this->album = $album;
    }

    public function login()
    {
        if(Input::all())
        {
            if($this->user->login(Input::except('_token')))
            {
                if(Auth::user()->status == 2)
                {
                    return Redirect::route('home');
                }
                else
                {
                    return Redirect::back()->with('flash_success','activate');
                }

            }
            else
            {
                return Redirect::back();
            }
        }
        else
        {
            return Redirect::back();
        }
    }
    
    public function register()
    {
        if($this->user->register(Input::except('_token')))
        {
            return Redirect::back()->with('flash_success','activate');
        }
        else
        {
            return Redirect::back()->with('flash_error',$this->user->errors);
        }
    }
    
    public function activate()
    {
        if($this->user->activate(Input::all()))
        {
            $this->album->createDefault();
            return Redirect::route('welcome');
        }
        else
        {
            return Redirect::route('root')->with('flash_error',$this->user->errors);
        }
    }

    public function updateLocation()
    {
        if(Input::all())
        {
            $hometown = Users_meta::where('option','hometown')->where('user_id',Auth::user()->id)->count();
            $current_city = Users_meta::where('option','current_city')->where('user_id',Auth::user()->id)->count();
            if($hometown > 0)
            {
                $this->user->updateMeta('hometown',Input::get('hometown'));
            }
            else
            {
                $this->user->createMeta('hometown',Input::get('hometown'));
            }

            if($current_city > 0)
            {
                $this->user->updateMeta('current_city',Input::get('current_city'));
            }
            else
            {
                $this->user->createMeta('current_city',Input::get('current_city'));
            }
            return "true";
        }
        else
        {
            return "false";
        }
    }

    public function home()
    {

        $user = User::where('id',Auth::user()->id)->where('deleted_at', NULL)->with('profilePicture', 'posts')->first();
        $notifications = Notification::where('user_id', $user->id)->where('is_read', 0)->get();
        Notification::where('user_id', $user->id)->where('is_read', 0)->update(['is_read' => 1]);
        $ads = Ad::all();
        $userAds = array();
        //$usercity = Users_meta::where('user_id', $user->id)->where('option', 'current_city')->first()->value;

        foreach($ads as $ad)
        {
            $filters = json_decode($ad->filters, true);
            if($ad->paid == 1 && $filters['gender'] == $user->gender && $filters['start_age'] <= \Carbon\Carbon::createFromTimestamp(strtotime($user->dob))->age && $filters['end_age'] >= \Carbon\Carbon::createFromTimestamp(strtotime($user->dob))->age && $usercity == $filters['place'])
            {
                $userAds[] = ['img' => json_decode($ad->content)->img, 'id' => $ad->id];
            }
            $ad->impressions += 1;
            $ad->save();
        }

        $this->layoutData['friendRequest'] = Friend::where('user_two_id',$user->id)->where('status',1)->with('user')->get();

        $friend1 = Friend::where('user_one_id',$user->id)->where('status',2)->lists('user_two_id');
        $friend2 = Friend::where('user_two_id',$user->id)->where('status',2)->lists('user_one_id');
        $friendId = array_merge($friend1,$friend2);
        array_push($friendId,intval($user->id));

        $this->layoutData['user'] = $user;
        $this->layoutData['ads'] = $userAds;
        if($user->role_id==1){
            $posts = Post::with('user')->orderBy('updated_at','desc')->paginate(20);
        }else{
            $posts = Post::whereIn('user_id',$friendId)->with('user')->orderBy('updated_at','desc')->paginate(20);
        }


        return View::make('home',$this->layoutData)->with('posts',$posts)->with('notifications', $notifications);

    }

    public function profile($id)
    {
        if($id)
        {
            if($id == Auth::user()->id)
            {
                $user = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
                $users_meta = Users_meta::where('user_id',Auth::user()->id)->get();
                $this->layoutData['user'] = $user;
                $this->layoutData['users_meta'] = $users_meta;
                $posts = Post::where('user_id',$id)->with('user')->orderBy('updated_at','desc')->paginate(20);
                return View::make('mytimeline',$this->layoutData)->withPosts($posts);
            }
            else
            {
                $user = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
                $users_meta = Users_meta::where('user_id',Auth::user()->id)->get();
                $this->layoutData['user'] = $user;
                $this->layoutData['users_meta'] = $users_meta;
                $user1 = User::where('id',$id)->with(['profilePicture','coverPicture'])->first();
                $user1_meta = Users_meta::where('user_id',$id)->get();
                $this->layoutData['user1'] = $user1;
                $this->layoutData['user1_meta'] = $user1_meta;
                $friend1 = Friend::where('user_one_id',Auth::user()->id)->where('user_two_id',$id)->first();
                $friend2 = Friend::where('user_two_id',Auth::user()->id)->where('user_one_id',$id)->first();
                $this->layoutData['friend'] = isset($friend1->status)?$friend1:$friend2;
                $posts = Post::where('user_id',$id)->with('user')->orderBy('updated_at','desc')->paginate(20);
                return View::make('timeline',$this->layoutData)->withPosts($posts);
            }
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function about($id)
    {
        if($id)
        {
            if($id == Auth::user()->id)
            {
                $user = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
                $users_meta = Users_meta::where('user_id',Auth::user()->id)->get();
                $works = Work::where('user_id',Auth::user()->id)->with(['company','position','city'])->get();
                $highschools = High_school::where('user_id',Auth::user()->id)->with(['school','city'])->get();
                $colleges = College::where('user_id',Auth::user()->id)->with(['school','city'])->get();
                $this->layoutData['user'] = $user;
                $this->layoutData['users_meta'] = $users_meta;
                $this->layoutData['works'] = $works;
                $this->layoutData['highschools'] = $highschools;
                $this->layoutData['colleges'] = $colleges;
                return View::make('myAbout',$this->layoutData);
            }
            else
            {
                $user = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
                $users_meta = Users_meta::where('user_id',Auth::user()->id)->get();
                $this->layoutData['user'] = $user;
                $this->layoutData['users_meta'] = $users_meta;
                $user = User::where('id',$id)->with(['profilePicture','coverPicture'])->first();
                $users_meta = Users_meta::where('user_id',$id)->get();
                $works = Work::where('user_id',$id)->with(['company','position','city'])->get();
                $highschools = High_school::where('user_id',$id)->with(['school','city'])->get();
                $colleges = College::where('user_id',$id)->with(['school','city'])->get();
                $this->layoutData['user1'] = $user;
                $this->layoutData['user1_meta'] = $users_meta;
                $this->layoutData['works'] = $works;
                $this->layoutData['highschools'] = $highschools;
                $this->layoutData['colleges'] = $colleges;
                return View::make('about',$this->layoutData);
            }
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function friends($id)
    {
        if($id)
        {
            $this->layoutData['user'] = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
            $this->layoutData['user1'] = User::where('id',$id)->with(['profilePicture','coverPicture'])->first();
            $friend1 = Friend::where('user_one_id',$id)->where('status',2)->lists('user_two_id');
            $friend2 = Friend::where('user_two_id',$id)->where('status',2)->lists('user_one_id');
            $friendId = array_merge($friend1,$friend2);
            if(empty($friendId))
            {
                $this->layoutData['friends'] = NULL;
            }
            else
            {
                $this->layoutData['friends'] = User::whereIn('id',$friendId)->with(['profilePicture'])->get();
            }


            if($id == Auth::user()->id)
            {
                return View::make('myfriends',$this->layoutData);
            }
            else
            {
                return View::make('friends',$this->layoutData);
            }
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function friendRequest($id)
    {
        if($id)
        {
            $request1 = Friend::where('user_one_id',Auth::user()->id)->where('user_two_id',$id)->first();
            $request2 = Friend::where('user_two_id',Auth::user()->id)->where('user_one_id',$id)->first();
            if(!isset($request1) && !isset($request2))
            {
                $friend = new Friend;
                $friend->user_one_id = Auth::user()->id;
                $friend->user_two_id = $id;
                $friend->status = 1;
                $friend->save();

                $user = Auth::getUser();

                $notification_content = [
                    'link'  =>  URL::route('profile', ['profile_id' => $user->id]),
                    'message'   =>  $user->first_name.' '.$user->last_name.' has sent you a friend request.',
                ];

                if($user->profilePicture)
                {
                    $notification_content['image_path'] = $user->profilePicture->link;
                }

                $notification = new Notification();
                $notification->user_id = $id;
                $notification->is_read = 0;
                $notification->content = json_encode($notification_content);
                $notification->save();
            }
        }
        return Redirect::back();
    }

    public function cancelFriendRequest($id)
    {
        $request = Friend::where('user_one_id',Auth::user()->id)->where('user_two_id',$id)->first();
        if(isset($request))
        {
            Friend::where('user_one_id',Auth::user()->id)->where('user_two_id',$id)->forceDelete();
        }
        return Redirect::back();
    }

    public function confirmFriendRequest($id)
    {
        $request = Friend::where('user_two_id',Auth::user()->id)->where('user_one_id',$id)->first();
        if(isset($request))
        {
            Friend::where('user_two_id',Auth::user()->id)->where('user_one_id',$id)->update(['status' => 2]);

            $user = User::find($id)->with('profilePicture')->first();

            $notification_content = [
                'link'  =>  URL::route('profile', ['profile_id' => $user->id]),
                'message'   =>  $user->first_name.' '.$user->last_name.' has accepted your a friend request.',
            ];

            if($user->profilePicture)
            {
                $notification_content['image_path'] = $user->profilePicture->link;
            }

            $notification = new Notification();
            $notification->user_id = $id;
            $notification->is_read = 0;
            $notification->content = json_encode($notification_content);
            $notification->save();
        }
        return Redirect::back();
    }

    public function unFriend($id)
    {
        $request1 = Friend::where('user_two_id',Auth::user()->id)->where('user_one_id',$id)->first();
        $request2 = Friend::where('user_one_id',Auth::user()->id)->where('user_two_id',$id)->first();
        if(isset($request1))
        {
            $request1->forceDelete();
        }
        elseif(isset($request2))
        {
            $request1->forceDelete();
        }
        return Redirect::back();

    }

    public function photos($id)
    {
        if($id)
        {
            $this->layoutData['user'] = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
            $this->layoutData['albums'] = Album::where('user_id',$id)->with('firstPic')->get();
            if(empty($friendId))
            {
                $this->layoutData['friends'] = NULL;
            }
            else
            {
                $this->layoutData['friends'] = User::whereIn('id',$friendId)->with(['profilePicture'])->get();
            }


            if($id == Auth::user()->id)
            {
                return View::make('myalbums',$this->layoutData);
            }
            else
            {
                $this->layoutData['user1'] = User::where('id',$id)->with(['profilePicture','coverPicture'])->first();
                return View::make('albums',$this->layoutData);
            }
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function editProfile()
    {
        $this->layoutData['user'] = User::where('id',Auth::user()->id)->with(['profilePicture','coverPicture'])->first();
        $this->layoutData['current_city'] = Users_meta::where('user_id',Auth::user()->id)->where('option','hometown')->pluck('value');
        $this->layoutData['hometown'] = Users_meta::where('user_id',Auth::user()->id)->where('option','current_city')->pluck('value');
        return View::make('editProfile',$this->layoutData);
    }

    public function delete(){
        $user = User::find(Auth::user()->id);

        $user->delete();

        return Redirect::route('login');
    }

    public function deleteUser($id){
        if(Auth::user()->role_id==1){
            $user = User::find($id);



            Post::where('user_id',$id)->delete();

            Ad::where('user_id',$id)->delete();

            Album::where('user_id',$id)->delete();

            Comment::where('user_id',$id)->delete();

            Conversation::where('user_1_id',$id)->orWhere('user_2_id',$id)->delete();

            Conversation_reply::where('sender_id',$id)->delete();

            Follow::where('follower_id',$id)->orWhere('following_id',$id)->delete();

            Friend::where('user_1_id',$id)->orWhere('user_2_id',$id)->delete();

            Like::where('user_id',$id)->delete();

            Original_post::where('user_id',$id)->delete();

            Shared_post::where('user_id',$id)->delete();

            Users_meta::where('user_id',$id)->delete();


            $user->delete();


            return Redirect::route('home');
        }
    }

}


