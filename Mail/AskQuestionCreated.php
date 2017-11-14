<?php

namespace Modules\Ask\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Ask\Entities\Question;
use Modules\Ask\Repositories\QuestionRepository;

class AskQuestionCreated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var QuestionRepository
     */
    private $question;

    /**
     * AskQuestionCreated constructor.
     * @param QuestionRepository $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @return $this
     */
    public function build()
    {
        if($this->question->attachment()->exists()) {
            $this->attach(public_path($this->question->attachment()->first()->path));
        }
        return $this->view('ask::emails.question')
            ->subject('Doktora Sorun : '.$this->question->id.' No.lu Sorusu')
            ->replyTo($this->question->email, $this->question->fullname)
            ->with(['question'=>$this->question]);
    }
}
