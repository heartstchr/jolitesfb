<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', function(){

    dd();
});

Route::group(['before'=>'guest'],function(){
    Route::get('/', [
        'as'		=>	'root',
        'uses'		=>	'HomeController@showWelcome'
    ]);

    Route::post('login', [
        'as'		=>	'login',
        'uses'		=>	'UserController@login'
    ]);

    Route::post('register', [
        'as'		=>	'register',
        'uses'		=>	'UserController@register'
    ]);

    Route::get('activate', [
        'as'		=>	'activate',
        'uses'		=>	'UserController@activate'
    ]);
});



Route::group(array('before' => 'auth'), function()
{
    Route::get('welcome', [
        'as'		=>	'welcome',
        'uses'		=>	'HomeController@welcome'
    ]);

    Route::get('home', [
        'as'		=>	'home',
        'uses'		=>	'UserController@home'
    ]);

    Route::get('profile/{profile_id}', [
        'as'		=>	'profile',
        'uses'		=>	'UserController@profile'
    ]);

    Route::get('profile/{profile_id}/about', [
        'as'		=>	'about',
        'uses'		=>	'UserController@about'
    ]);

    Route::get('profile/{profile_id}/friends', [
        'as'		=>	'friends',
        'uses'		=>	'UserController@friends'
    ]);

    Route::get('profile/{profile_id}/photos', [
        'as'		=>	'photos',
        'uses'		=>	'UserController@photos'
    ]);

    Route::post('updateLocation', [
        'as'		=>	'updateLocation',
        'uses'		=>	'UserController@updateLocation'
    ]);

    Route::post('uploadProfilePicture', [
        'as'		=>	'uploadProfilePicture',
        'uses'		=>	'ProfileController@uploadProfilePicture'
    ]);

    Route::post('uploadCoverPicture', [
        'as'		=>	'uploadCoverPicture',
        'uses'		=>	'ProfileController@uploadCoverPicture'
    ]);

    Route::post('addStatus', [
        'as'		=>	'addStatus',
        'uses'		=>	'PostController@addStatus'
    ]);


    Route::get('deleteStatus/{id}', [
        'as'		=>	'deleteStatus',
        'uses'		=>	'PostController@deleteStatus'
    ]);

    Route::post('shareStatus/{id}', [
        'as'		=>	'shareStatus',
        'uses'		=>	'PostController@sharePost'
    ]);

    Route::post('likeStatus/{id}', [
        'as'		=>	'likeStatus',
        'uses'		=>	'PostController@likeStatus'
    ]);

    Route::post('unlikeStatus/{id}', [
        'as'		=>	'unlikeStatus',
        'uses'		=>	'PostController@unlikeStatus'
    ]);

    Route::post('addWork', [
        'as'		=>	'addWork',
        'uses'		=>	'ProfileController@addWork'
    ]);

    Route::post('addHighSchool', [
        'as'		=>	'addHighSchool',
        'uses'		=>	'ProfileController@addHighSchool'
    ]);

    Route::post('addCollege', [
        'as'		=>	'addCollege',
        'uses'		=>	'ProfileController@addCollege'
    ]);

    Route::post('post/{id}/addComment', [
        'as'        =>  'addComment',
        'uses'      =>  'PostController@addComment'
    ]);

    Route::get('ads', [
        'as'    =>  'adsPage',
        'uses'  =>  'AdsController@adsPage'
    ]);

    Route::post('buyAd', [
        'as'    =>  'buyAd',
        'uses'  =>  'AdsController@buyAd'
    ]);

    Route::post('editAd', [
        'as'    =>  'editAd',
        'uses'  =>  'AdsController@editAd'
    ]);

    Route::get('deleteAd/{id}', [
        'as'    =>  'deleteAd',
        'uses'  =>  'AdsController@deleteAd'
    ]);

    Route::get('adClick/{id}', [
        'as'    =>  'adClick',
        'uses'  =>  'AdsController@adClick'
    ]);

    Route::get('checkoutAd', [
        'as'    =>  'checkoutAd',
        'uses'  =>  'AdsController@checkoutAd'
    ]);

    Route::get('purchaseFailed', [
        'as'    =>  'purchaseFailed',
        'uses'  =>  'AdsController@purchaseFailed'
    ]);

    Route::get('purchaseSuccess', [
        'as'    =>  'purchaseSuccess',
        'uses'  =>  'AdsController@purchaseSuccess'
    ]);

    Route::get('friend-request/{id}', [
        'as'		=>	'friendRequest',
        'uses'		=>	'UserController@friendRequest'
    ]);

    Route::get('friend-request/cancel/{id}', [
        'as'		=>	'cancelFriendRequest',
        'uses'		=>	'UserController@cancelFriendRequest'
    ]);

    Route::get('friend-request/confirm/{id}', [
        'as'		=>	'confirmFriendRequest',
        'uses'		=>	'UserController@confirmFriendRequest'
    ]);

    Route::get('friend-request/unfriend/{id}', [
        'as'		=>	'unFriend',
        'uses'		=>	'UserController@unFriend'
    ]);

    Route::get('messages', [
        'as'        =>  'messages',
        'uses'      =>  'MessageController@viewMessages'
    ]);

    Route::post('messages/send',[
        'as'        =>  'sendMessage',
        'uses'      =>  'MessageController@sendMessage'
    ]);

    Route::get('messages/{id}',[
        'as'        =>  'viewConversation',
        'uses'      =>  'MessageController@viewConversation'
    ]);

    Route::get('logout',[
        'as'        =>  'logout',
        'uses'      =>  'UserController@logout'
    ]);

    Route::get('profile/{profile_id}/album/{album_id}', [
        'as'		=>	'album',
        'uses'		=>	'AlbumController@album'
    ]);

    Route::post('newalbum', [
        'as'		=>	'newalbum',
        'uses'		=>	'AlbumController@newalbum'
    ]);

    Route::post('upload_photos/{album_id}', [
        'as'		=>	'uploadPhotos',
        'uses'		=>	'AlbumController@uploadPhotos'
    ]);

    Route::get('edit', [
    	'as'		=>	'editProfile',
    	'uses'		=>	'UserController@editProfile'
    ]);

    Route::get('comment/{id}/delete', [
        'as'        =>  'deleteComment',
        'uses'      =>  'PostController@deleteComment'
    ]);

    Route::post('comment/{id}/edit',[
        'as'        =>  'editComment',
        'uses'      =>  'PostController@editComment'
    ]);

    Route::get('search',[
        'as'        =>  'search',
        'uses'      =>  'HomeController@search'
    ]);
    
    Route::post('updatePassword', [
    	'as'		=>	'updatePassword',
    	'uses'		=>	'ProfileController@updatePassword'
    ]);
    
    Route::post('updateProfile', [
    	'as'		=>	'updateProfile',
    	'uses'		=>	'ProfileController@updateProfile'
    ]);

    Route::get('deleteUser',[
        'as'        =>  'deleteUser',
        'uses'      =>  'UserController@delete'
    ]);

    Route::get('adminDeleteUser/{id}',[
        'as'        =>  'adminDeleteUser',
        'uses'      =>  'UserController@deleteUser'
    ]);

});

Route::get('forgot-password', [
    'as'		=>	'forgotPassword',
    'uses'		=>	'ProfileController@forgotPassword'
]);

Route::post('forgot-password', [
	'as'		=>	'forgotPassword',
	'uses'		=>	'ProfileController@forgotPasswordProcess'
]);

Route::get('reset-password/{code}', [
	'as'		=>	'resetPassword',
	'uses'		=>	'ProfileController@resetPassword'
]);

Route::post('reset-password', [
	'as'		=>	'resetPasswordProcess',
	'uses'		=>	'ProfileController@resetPasswordProcess'
]);
