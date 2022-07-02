<?php

namespace App\Mail;

use App\News;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsReleaseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $news;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news=$news;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.newsrelease',['news'=>$this->news]);
        return $this->markdown('emails.newsrelease')->with([
            'userimage'=>$this->news->user->userimage,
            'lastname'=>$this->news->user->lastname,
            'firstname'=>$this->news->user->firstname,
            'title'=>$this->news->title,
            'body'=>$this->news->body,
            'image'=>$this->news->image,
            'filename'=>$this->news->filename,
            'updated_at'=>$this->news->updated_at,
        ]);
    }
}
