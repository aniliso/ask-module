<?php

namespace Modules\Ask\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Ask\Entities\Question;

class QuestionAnswered extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Question
     */
    private $question;

    /**
     * QuestionAnswered constructor.
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ask::emails.answer')
            ->subject('Doktora Sorun : '.$this->question->id.' No.lu Sorunuzun cevabı')
            ->replyTo($this->question->email, $this->question->fullname)
            ->with(['question'=>$this->question]);
    }
}
