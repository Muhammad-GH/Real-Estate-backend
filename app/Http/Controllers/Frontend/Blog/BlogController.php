<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Alert;

use App\Models\Blog;
use App\Models\BlogCategory;


/**
 * Class BlogController.
 */
class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request,$category=0)
    {   
        $category = null;
        if ($request->has('category')) {
            $category = BlogCategory::where('slug',$request->category)->first();
            $blog = Blog::where('blog_category_id',$category->id)->where('status','Publish')->orderBy('id', 'asc')->paginate(6);
            
        }else{
            $blog = Blog::where('status','Publish')->orderBy('id', 'asc')->paginate(6);
        }
        $blogCategory = BlogCategory::get();
        if($request->ajax()){
            return view('frontend.blog.bloglist')->withBlogCategory($blogCategory)->withBlog($blog);
        }
        return view('frontend.blog.index')->withBlogCategory($blogCategory)->withBlog($blog)->withCategory($category);
    }


    public function category(Request $request, $category )
    {
        $category = BlogCategory::where('slug',$category)->first();
        $blogCategory = BlogCategory::get();
        $blog = Blog::where('blog_category_id',$category->id)->where('status','Publish')->orderBy('id', 'asc')->paginate(6);
        return view('frontend.blog.bloglist',$category)->withBlogCategory($blogCategory)->withCategory($category)->withBlog($blog);
    }

    public function view(Request $request, $blog_slug )
    {
        $blog = Blog::where('slug',$blog_slug)->where('status','Publish')->with('category')->first();
 
        // get previous user id
        /*$previous = Blog::where('id', '<', $blog->id)->orderBy('id','desc')->first();
        if($previous)
            $blog_rel[] = $previous;
        // get next user id
        $next = Blog::where('id', '>', $blog->id)->orderBy('id','asc')->first();
        if($next)
            $blog_rel[] = $next;*/
        if($blog){    
            $blog_rel = Blog::where('id', '<', $blog->id)->where('status','Publish')->orderBy('id','desc')->limit(3)->get();
            if($blog_rel->count()< 3){
                $blog_rel = Blog::where('id', '>', $blog->id)->where('status','Publish')->orderBy('id','desc')->limit(3)->get();
            }
            return view('frontend.blog.view',['blog_rel' => $blog_rel])->withBlog($blog);
        }else{
            return redirect()->route('frontend.blog');
        }
    }

}
