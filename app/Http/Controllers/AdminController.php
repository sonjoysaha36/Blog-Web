<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Feedback;

class AdminController extends Controller
{
    public function view_category()
    {
        $data=category::all();
        return view('admin.category',compact('data'));
    }
    // for blog post page
    public function blog_post()
    {
        $data=category::all();
        return view('admin.blog_post',compact('data'));
    }
    // Adding Category
    public function add_category(Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $image=$request->image;
        
        // give unique name
        $imagename=time().'.'.$image->getClientOriginalExtension();
        // move to the file
        $request->image->move('category_picture',$imagename);
        // insert in database
        $data->image=$imagename;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }
    // delete category
    public function delete_category($id)
    {
        $category=category::find($id);
        if($category){
            $category->delete();
            return redirect()->back()->with('message','Category Delete Successfully');
        }
    }

    // adding blog
    public function add_blog(Request $request)
    {
        if (Auth::check()) {
        $id=Auth::user()->id;
        $description=$request->input('comment');
        $blog=new Blog;
        $blog->title=$request->title;
        
        
        $blog->category=$request->category;
        $blog->description=$description;
        // store image
        // store image in variable
        $image=$request->image;
        
                // give unique name
        $imagename=time().'.'.$image->getClientOriginalExtension();
        // move to the file
        $request->image->move('blog_picture',$imagename);
        // insert in database
        $blog->image=$imagename;
        
        $blog->user_id=$id;
        // Set the status based on user type
        $userType = Auth::user()->usertype;
        $blog->status = ($userType == 1) ? 1 : 0;
        
        // $blog->status=1;
        
       
        $blog->save();
        return redirect()->back()->with('message','Blog Added Successfully');
        }
        else{
        return redirect()->back()->with('message', 'You must be logged in to add a blog.');
        }
    }

    // show blog
    public function show_blog()
    {
        $data=Blog::orderBy('created_at', 'desc')->get();
        return view('admin.show_blog',compact('data'));
    }

    // delete blog
    public function delete_blog($id)
    {
        $blog=Blog::find($id);
        if($blog){
        // Remove the picture from the folder
        $imagePath = public_path('blog_picture/' . $blog->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
            $blog->delete();
            return redirect()->back()->with('message','Blog Delete Successfully');
        }
    }
    // delete user
    public function delete_user($id)
    {
        $user=User::find($id);
        if($user){
            $user->delete();
            return redirect()->back()->with('message','User Remove Successfully');
        }
    }
    // approve_request 
    public function approve_request()
    {
        $data = Blog::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.approve_request',compact('data'));
    }
    // manage_user
    public function manage_user()
    {
        $data = User::where('usertype', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.manage_user',compact('data'));
    }

    // edit blog
    public function edit_blog($id)
    {
        $data=category::all();
        $blog=Blog::find($id);
        return view('admin.edit_blog',compact('blog','data'));
    }

    // update_blog
    public function update_blog(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        
        $blog->description = $request->comment;
        

        // Check if the user uploaded a new image
        if ($request->hasFile('image')) {
            // Delete the previous image file from the folder
            $previousImage = $blog->image;
            if ($previousImage) {
                $imagePath = public_path('blog_picture') . '/' . $previousImage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Upload the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('blog_picture', $imageName);

            $blog->image = $imageName;
        }

        $blog->save();
        return redirect()->back()->with('message', 'Blog Updated Successfully');
    }

    // watch fedback
    public function feedback()
    {
        $feedback=Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.feedback',compact('feedback'));
    }
    
    // delete feedback
    public function delete_feedback($id)
    {
        $feedback=Feedback::find($id);
        if($feedback){
            $feedback->delete();
            return redirect()->back()->with('message','Feedback Remove Successfully');
        }
    }
}