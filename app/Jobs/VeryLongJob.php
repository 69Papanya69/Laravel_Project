<?php
namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewCommentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct(public Comment $comment, public $article_name)
    {
        //
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('miha.frolow2017@yandex.ru')->send(new NewCommentMail($this->comment, $this->article_name));
    }
}