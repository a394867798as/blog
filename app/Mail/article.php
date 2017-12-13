<?php

namespace App\Mail;

use App\Model\ArticleModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class article extends Mailable
{
    use Queueable, SerializesModels;

    protected $article;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ArticleModel $article)
    {
        $this->article = $article;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.article.success')
            ->with(['title'=>$this->article->atitle,
                'aid'=>$this->article->aid]);
    }
}
