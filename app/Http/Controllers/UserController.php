<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditProfile;
use App\Http\Requests\ChangePassword;
use App\Article;

class UserController extends Controller
{
    /**
     * 表示：プロフィールへんこう画面
     */
    public function showProfileEditForm()
    {
        $user = Auth::user();

        return view('mypage.profile_edit', compact('user'));
    } 


    /**
     * 更新：プロフィールへんこう
     */
    public function profileUpdate(EditProfile $request)
    {
        $user = Auth::user();

        // プロフィール変更
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('art.index')->with('flash_message', 'プロフィールを変更しました');
    }


    /**
     * 表示：パスワードへんこう画面
     */
    // public function showPasswordChangeForm()
    // {
    //     return view('mypage.password_change');
    // } 

    /**
     * 更新：パスワードへんこう
     */
    // public function passwordUpdate(ChangePassword $request)
    // {
    //     $user = Auth::user();

    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return redirect()->route('art.index')->with('flash_message', 'パスワードを変更しました');
    // }

    /**
     * 表示：ユーザーたいかい画面
     */
    public function showUnsubscribeForm()
    {
        $user = Auth::user();

        return view('mypage.unsubscribe', compact('user'));
    }

    /**
     * 削除：ユーザーたいかい
     */
    public function unsubscribe()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $delete_images = Article::where('user_id', $user_id)->select('image')->get();

        if($delete_images) {
            foreach($delete_images as $delete_image) {
                $path = storage_path().'/app/public/images/'.$delete_image->image;
                \File::delete($path);
            }
        }

        $user->delete();

        return redirect()->route('top')->with('flash_message', '退会しました。ご利用ありがとうございました！');
    }
}
