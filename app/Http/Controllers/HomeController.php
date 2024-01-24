<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Blog;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Like;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $carts = cart::where('user_id', $id)->count();
          } else {
            $carts = 0;
          }
        $data=category::all();
        $blog = Blog::orderBy('created_at', 'desc')
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->select('blogs.*', 'categories.category_name as name')
            ->where('blogs.status', 1)
            ->paginate(8);
        $blogs = DB::table('blogs')
            ->join('likes', 'blogs.id', '=', 'likes.blog_id')
            ->select('blogs.id', 'blogs.title', 'blogs.description', 'blogs.image', 'blogs.category', 'blogs.user_id', 'blogs.status', 'blogs.created_at', DB::raw('COUNT(likes.id) as like_count'))
            ->groupBy('blogs.id', 'blogs.title', 'blogs.description', 'blogs.image', 'blogs.category', 'blogs.user_id', 'blogs.status', 'blogs.created_at')
            ->orderByDesc('like_count')
            ->limit(4)
            ->get();
        
        // dd($blogs);
        return view('home.userpage',compact('data','blog','carts','blogs'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            $user=User::all();
            $total_user=$user->count();
            // // dd($total_user);
            $total_blog=Blog::all()->count();
            $total_comment=Comment::all()->count();
            // total feedback
            $total_feedback=Feedback::all()->count();
            // $total_price=Enroll::all()->sum('price');

            $users = User::select(\DB::raw('DATE(created_at) as date'), \DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            $chartData = [
                'labels' => $users->pluck('date'),
                'data' => $users->pluck('count'),
            ];

            // $total_enroll_course=Enroll::distinct('course_id')->count();
            return view('admin.home',compact('total_user','total_blog','total_feedback','total_comment','chartData'));
            
            
            // return view('admin.home',compact('user','total_user','total_course','total_price','total_enroll_course'));

        }
        else{
            $id=Auth::user()->id;
            $carts=Cart::where('user_id','=',$id)->count();
            $data=category::all();
            $blogs = DB::table('blogs')
                ->join('likes', 'blogs.id', '=', 'likes.blog_id')
                ->select('blogs.id', 'blogs.title', 'blogs.description', 'blogs.image', 'blogs.category', 'blogs.user_id', 'blogs.status', 'blogs.created_at', DB::raw('COUNT(likes.id) as like_count'))
                ->groupBy('blogs.id', 'blogs.title', 'blogs.description', 'blogs.image', 'blogs.category', 'blogs.user_id', 'blogs.status', 'blogs.created_at')
                ->orderByDesc('like_count')
                ->limit(4)
                ->get();

            $blog = Blog::orderBy('created_at', 'desc')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*', 'categories.category_name as name')
                ->where('blogs.status', 1)
                ->paginate(8);
            return view('home.userpage',compact('data','blog','carts','blogs'));
            
            // $data=category::all();
            // $course=course::orderby('created_at','DESC')->take(6)->get();;
            // $ratings=Rating::all();
            // $discount=course::orderby('discount_price','ASC')->take(4)->get();
            // $id=Auth::user()->id;
            // $carts=cart::where('user_id','=',$id)->count();
            // return view('home.userpage');
        }
    }

    public function post_blog()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $carts = cart::where('user_id', $id)->count();
          } else {
            $carts = 0;
          }
        $data=category::all();
        return view('home.post_blog',compact('data','carts'));
    }
    public function add_cart($id)
    {
        if(Auth::id()){
            // return redirect()->back();
            $user=Auth::user();
            $blog=Blog::find($id);
            // dd($user);
            $cart=new cart;
            $cart->blog_title=$blog->title;
            $cart->blog_description=$blog->description;
            $cart->image=$blog->image;
            
            
            $cart->blog_id=$blog->id;
            $cart->user_id=$user->id;
            $cart->save();
            return redirect()->back()->with('message','1 new Blog(s) have been added');
        }

        else{
            return redirect()->back()->with('message','You can not save blog without login');
        } 
    }
    public function read($id)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $carts = Cart::where('user_id', $userId)->count();
            $usertype = Auth::user()->usertype;
            
        } else {
            $carts = 0;
            $usertype = 0;
        }
        
        $data = Category::all();
        $blog = Blog::find($id);
        $related_blog = Blog::where('category',$blog->category)
                        ->whereNotIn('id', [$blog->id])
                        ->where('status', 1)
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();
        // dd($related_blog);
        $like = Like::where('blog_id',$blog->id)
                    ->where('status', 1)
                    ->count();
        // dd($like);

        $comment = Comment::where('blog_id', $blog->id)
                            ->where('status',1)
                            ->get();
        $commentCount = $comment->count();
        
        $user = User::find($blog->user_id);
        $category = Category::find($blog->category);
        
        return view('home.single_blog', compact('data', 'carts', 'blog', 'user', 'category', 'comment', 'commentCount','like','related_blog','usertype'));
    }
    
    
    public function add_comment(Request $request)
    {
        if(Auth::user()){
                $user_comment=$request->input('comment');
                $blog_id=$request->input('blog_id');
                // dd($course_id);
                $user=Auth::user();
                // dd($course_id);
                // dd($starts_rated);
                
                // $row_count=$verified_purchase->count(*);
                // dd($verified_purchase);
                    
                        
                $comment=new Comment;
                $comment->user_id=$user->id;
                $comment->name=$user->name;
                $comment->blog_id=$blog_id;
                $comment->comment=$user_comment;
                $comment->status=1;
                $comment->save();
                return redirect()->back()->with('message','Thank you for Comment this Blog');

                    

        }else{
            return redirect()->back()->with('message','You cannot Comment without Login');
        }
        
        
        
        
    }

    public function add_like(Request $request,$id)
    {
        if(Auth::user()){
        // Check if the user has already liked the blog
            $user = auth()->user();
            $blog = Blog::find($id);
            $like = Like::where('blog_id', $id)
                ->where('user_id', $user->id)
                ->first();

            if ($like) {
                // User has already liked the blog, so remove the like
                // $like->status=0;
                if ($like->status == 0) {
                    $like->status = 1;
                } else {
                    $like->status = 0;
                }
                $like->save();
                return redirect()->back()->with('message','Updated');
            } else {
                $like=new Like;
                $like->user_id=$user->id;
                $like->name=$user->name;
                $like->blog_id=$id;
                $like->status=1;
                $like->save();


                // User has not liked the blog, so add the like
                return redirect()->back()->with('message','Thanks for like this blog');
            }

        }
        else{
            return redirect()->back()->with('message','Cannot Like this blog Without Login');
        }
    }

    // show all blogs
    public function all_blogs()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $carts = cart::where('user_id', $id)->count();
          } else {
            $carts = 0;
          }
        $data=category::all();
        $heading ='All';
        $blog = Blog::orderBy('created_at', 'desc')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*', 'categories.category_name as name')
                ->where('blogs.status', 1)
                ->paginate(8);
        return view('home.all_blogs',compact('data','blog','carts','heading'));
    }
    // category selected blogs
    public function category_blog($id)
    {
        $category_id=$id;
        if (Auth::check()) {
            $id = Auth::user()->id;
            $carts = cart::where('user_id', $id)->count();
          } else {
            $carts = 0;
          }
        $data=category::all();
        $cat=category::find($category_id);
        $heading =$cat->category_name;
        $blog = Blog::orderBy('created_at', 'desc')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*', 'categories.category_name as name')
                ->where('blogs.status', 1)
                ->where('blogs.category', $category_id)
                ->paginate(8);
        return view('home.all_blogs',compact('data','blog','carts','heading'));
    }
    public function search()
    {
        $data=category::all();
        if (Auth::check()) {
            $carts = cart::where('user_id', Auth::id())->count();
          } else {
            $carts = 0;
          }
        $search_text = $_GET['search'];
        $blog = Blog::orderBy('created_at', 'desc')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*', 'categories.category_name as name')
                ->where('blogs.status', 1)
                ->where('title','LIKE','%'.$search_text.'%')
                ->paginate(8);
        $heading="Results for '" .$search_text. "' Related";
        // $product = Product::where('title','LIKE','%'.$search_text.'%')->get();
        // dd($users);
        
          
        return view('home.all_blogs',compact('data','blog','carts','heading'));
        
    }
    // for showing cart
    public function show_cart()
    {
        if(Auth::id()){
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
            $carts=cart::where('user_id','=',$id)->count();
            $data=category::all();
            return view('home.show_cart',compact('data','cart','carts'));
            }
            else{
                return redirect('login');
            }
    }
    // remove cart
    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','Successfully Remove This Blog');
    }

    // contact page
    public function contact()
    {
        $data=category::all();
        if (Auth::check()) {
            $carts = cart::where('user_id', Auth::id())->count();
          } else {
            $carts = 0;
          }
        return view('home.contact',compact('data','carts'));
    }

    public function feedback(Request $request)
    {
        $data=new Feedback;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->message=$request->message;
        $data->save();
        return redirect()->back()->with('message','Thanks for your Feedback');
    }

    // for hide comment
    public function hide_comment($id)
    {
        $hide=Comment::find($id);
        $hide->status=0;
        $hide->save();
        return redirect()->back()->with('message','Comment Hide');
    }
}