<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/* Page Route */
Route::get( '/', array( PostController::class, 'blogPage' ) );
Route::get( '/blogs', array( PostController::class, 'blogPage' ) );
Route::get( '/blog/post/{postId}', array( PostController::class, 'postPage' ) );

Route::get( '/about-us', function () {
    return view( 'pages.about-us' );
} );

Route::get( '/contact-us', function () {
    return view( 'pages.contact-us' );
} );

/* Ajax Call Route */
// Users
Route::controller( UserController::class )->group( function () {
    /* User Authentication */
    // Pages
    Route::get( '/signup', 'UserSignupPage' );
    Route::get( '/login', 'UserLoginPage' );
    Route::get( '/forget-password', 'SendOTPToEmailPage' );
    Route::get( '/verify-otp', 'VerifyOTPPage' );
    Route::get( '/reset-password', 'ResetPasswordPage' );

    // Logic
    Route::post( '/UserSignup', 'UserSignup' );
    Route::post( '/UserLogin', 'UserLogin' );
    Route::post( '/SendOTPToEmail', 'SendOTPToEmail' );
    Route::post( '/VerifyOTP', 'VerifyOTP' );
    Route::post( '/ResetPassword', 'ResetPassword' )->middleware([TokenVerificationMiddleware::class]);
    Route::get( '/UserLogout', 'UserLogout' );

    /* User Control */
    Route::get( '/users', 'getUsers' ); // Read All Users
    Route::get( '/user/{userId}', 'getUserById' ); // Read User By ID
    Route::post( '/user/create', 'addUser' ); // Create User
    Route::post( '/user/{userId}/update', 'updateUser' ); // Update User
    Route::get( '/user/{userId}/delete', 'deleteUser' ); // Delete User

    // Dashboard
    Route::get('/dashboard', 'UserDashboardPage')->middleware([TokenVerificationMiddleware::class]);
} );

// Profiles
Route::controller( ProfileController::class )->group( function () {
    /* Profile Control */
    Route::get( '/profiles', 'getProfiles' ); // Read All Profiles
    Route::get( '/user/{userId}/profile', 'getProfileByUserId' ); // Get profile of a specific user
    Route::post( '/user/{userId}/profile/create-or-update', 'createOrUpdateProfileByUserId' ); // Create or update profile
    Route::get( '/user/{userId}/profile/delete', 'deleteProfileByUserId' ); // Delete profile
} );

// Tags
Route::controller( TagController::class )->group( function () {
    /* Tags Control */
    Route::get( '/tags', 'getTags' ); // Read All Users
    Route::get( '/tag/{tagId}/posts/', 'getTagsByPostId' ); // Read tags for each posts
    Route::post( '/tag/create', 'addTag' ); // Create tag for a specific post
    Route::post( '/tag/{tagId}/update', 'updateTag' ); // Update tag for a specific post
    Route::get( '/tag/{tagId}/delete', 'deleteTag' ); // Delete tag for a specific post
} );

// Posts
Route::controller( PostController::class )->group( function () {
    /* Posts Control */
    Route::get( '/posts', 'getPosts' ); // Read All Posts
    Route::get( '/post/{postId}', 'getPostById' ); // Read Post By Id
    Route::get( '/posts/user/{userId}', 'getPostsByUserId' ); // Read Post By User Id
    Route::post( '/post/create', 'addPost' ); // Create Post
    Route::post( '/post/{postId}/update', 'updatePost' ); // Update Post
    Route::get( '/post/{postId}/delete', 'deletePost' ); // Delete Post
} );

// Comments
Route::controller( CommentController::class )->group( function () {
    /* Comments Control */
    Route::get( '/comments', 'getComments' ); // Read All Comments
    Route::get( '/comment/{commentId}', 'getCommentById' ); // Read  Comments with comment id
    Route::get( '/post/{postId}/comments', 'getCommentByPostId' ); // Read comments for a specific post
    Route::get( '/user/{userId}/comments', 'getCommentsByUserId' ); // Read comments of a specific user
    Route::get( '/post/{postId}/user/{userId}/comments', 'getCommentsByPostIdAndUserId' ); // Read comments for a specific post done by a specific user
    Route::post( '/comment/create', 'addComment' ); // Create Comment
    Route::post( 'comment/{commentId}/update', 'updateComment' ); // Update Comment
    Route::get( '/comment/{commentId}/delete', 'deleteComment' ); // Delete Comment
} );


