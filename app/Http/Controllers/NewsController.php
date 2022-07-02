<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Newscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Image;

use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        $newscategories=Newscategory::orderBy('name','asc')->get();
        return view('admin.news.index', array('user' => Auth::user()), compact('news','newscategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save(public_path('news_images/' . $imageName));


            if ($request->hasFile('filename')) {
                $thefilename='newsfile_'.time().'.'.$request->filename->getClientOriginalExtension();
                $request->filename->storeAs('public/news_files/', $thefilename);
                
                $news = new News;
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                $news->image = $imageName;
                $news->filename = $thefilename;
    
                $news->save();
            }else{
                $news = new News;
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                $news->image = $imageName;
                $news->filename = $request->filename;
    
                $news->save();
            }

        }

        return redirect()->route('news.index')->with('success','News added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $nws = News::where('slug',$news->slug)->first();

        return view('admin.news.show', array('user' => Auth::user()), compact('nws'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $news = News::where('slug',$news->slug)->first();
        $newscategories=Newscategory::orderBy('name','asc')->get();
        return view('admin.news.edit', array('user' => Auth::user()), compact('news','newscategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save(public_path('news_images/' . $imageName));

            $news = News::find($news->id);
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                $news->image = $imageName;
                // $news->filename = $request->filename;
    
                $news->save();
        }else{
            $news = News::find($news->id);
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                $news->image = $request->news_image;
                // $news->filename = $thefilename;
    
                $news->save();
        }

            if ($request->hasFile('filename')) {

                $thefilename='newsfile_'.time().'.'.$request->filename->getClientOriginalExtension();
                $request->filename->storeAs('public/news_files/', $thefilename);
                
                $news = News::find($news->id);
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                // $news->image = $imageName;
                $news->filename = $thefilename;
    
                $news->save();
            }else{
                $news = News::find($news->id);
                $news->title = $request->title;
                $news->slug=Str::slug($request->title);
                $news->newscategory_id = $request->newscategory_id;
                $news->user_id = $request->user_id;
                $news->body = $request->body;
                // $news->image = $request->news_image;
                $news->filename = $request->news_file;
    
                $news->save();
            }


        return redirect()->route('news.index')->with('success','News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //deleting manifesto files from folder
        File::delete([public_path('storage/news_images/'.$news->image)]);
        File::delete([public_path('storage/news_files/'.$news->filename)]);
       
        //deleting  files from the database
        $news->delete();

        //redirecting page
        return redirect()->back()->with('deleted','News deleted successfully!');
    }

    public function approve($slug){
        $news=News::find($slug);
        $news->isapproved='1';
        $news->save();

        //saving the news approval details
        // $napproval=new Napproval;
        // $napproval->user_id=Auth::user()->id;
        // $napproval->news_id=$news->id;
        // $napproval->save();

        //for notification

        // $recipients=['cyril.ezeaku@cleannigeria.org','etiese.etuk@cleannigeria.org','nosa.erhabor@cleannigeria.org','maxmilian.nwosu@cleannigeria.org','mfon.edet@cleannigeria.org','lawrence.obi@cleannigeria.org','brownson.digika@cleannigeria.org','emmanuel.aghaunor@cleannigeria.org','chester.iyama@cleannigeria.org','ralph.uwhumiakpor@cleannigeria.org'];
        $recipients=[ 
'adetola.onasanwo@cleannigeria.org',
'akandu.okonkwo@cleannigeria.org',
'andrew.okposio@cleannigeria.org',
'anthony.okpaku@cleannigeria.org',
'anthony.ukwa@cleannigeria.org',
'babatola.olusesan@cleannigeria.org',
'brownson.digika@cleannigeria.org',
'chester.iyama@cleannigeria.org',
'chi.nnubia@cleannigeria.org',
'cyril.ezeaku@cleannigeria.org',
'douglas.ugochukwu@cleannigeria.org',
'edwin.nkan@cleannigeria.org',
'emeka.uma@cleannigeria.org',
'emmanuel.aghaunor@cleannigeria.org',
'emmanuel.anene@cleannigeria.org',
'emmanuel.obokare@cleannigeria.org',
'emmanuel.vilola@cleannigeria.org',
'etiese.etuk@cleannigeria.org',
'friday.ekiye@cleannigeria.org',
'harrison.ogheneruona@cleannigeria.org',
'henry.bassey@cleannigeria.org',
'innocent.agbaeze@cleannigeria.org',
'kingsley.ugochukwu@cleannigeria.org',
'kowe.stephen@cleannigeria.org',
'lawal.tajudeen@cleannigeria.org',
'lawrence.obi@cleannigeria.org',
'manna.harris@cleannigeria.org',
'maximilian.nwosu@cleannigeria.org',
'maxwell.amadi@cleannigeria.org',
'ndubuisi.nlemadim@cleannigeria.org',
'nosa.erhabor@cleannigeria.org',
'odiowei.izonfuo@cleannigeria.org',
'onyaye.ipalimote@cleannigeria.org',
'osagie.osamudiamen@cleannigeria.org',
'otavie.nduka@cleannigeria.org',
'peter.nnubia@cleannigeria.org',
'promise.ayomanor@cleannigeria.org',
'ralph.uwhumiakpor@cleannigeria.org',
'rufai.sheidu@cleannigeria.org',
'saleh.ibrahim@cleannigeria.org',
'santus.eburue@cleannigeria.org',
'solomon.imoni@cleannigeria.org',
'somiari.brown@cleannigeria.org',
'sunny.aakol@cleannigeria.org',
'sylvanus.ichene@cleannigeria.org',
'wilson.evans@cleannigeria.org',
'yusuf.aliyu@cleannigeria.org',
'sample.adiki@cleannigeria.org',
'ufuoma.alex@cleannigeria.org',
'usan.peter@cleannigeria.org',
'damian.aguiyi@cleannigeria.org',
'gilbert.omatsemigbe@cleannigeria.org',
'glory.eromosele@cleannigeria.org',
'jimmy.nseobong@cleannigeria.org',
'joachin@cleannigeria.org',
'kenny.idatsable@cleannigeria.org',
'olujuwon.babatola@cleannigeria.org',
'paul.omeje@cleannigeria.org',
'promise.ekechi@cleannigeria.org',
'sigismund.iheagwam@cleannigeria.org',
'teega.ernest@cleannigeria.org'];
        
        foreach ($recipients as $recipient) {

                // Mail::to($recipient)->send(new NewsReleaseMail($news));
        }

        return redirect()->back();
    }


    public function newsfiledownload($filename){
        $file = public_path('storage/news_files/'.$filename);
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function viewnewsfile($newsfile){
        // return response()->file(public_path('storage/news_files/'.$newsfile));
        public_path('storage/news_files/'.$newsfile);
    }
}
