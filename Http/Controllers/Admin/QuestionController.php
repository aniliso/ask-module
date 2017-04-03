<?php

namespace Modules\Ask\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ask\Entities\Question;
use Modules\Ask\Mail\QuestionAnswered;
use Modules\Ask\Repositories\QuestionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class QuestionController extends AdminBaseController
{
    /**
     * @var QuestionRepository
     */
    private $question;

    public function __construct(QuestionRepository $question)
    {
        parent::__construct();

        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questions = $this->question->all();

        return view('ask::admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ask::admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->question->create($request->all());

        return redirect()->route('admin.ask.question.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ask::questions.title.questions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Question $question
     * @return Response
     */
    public function edit(Question $question)
    {
        return view('ask::admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Question $question
     * @param  Request $request
     * @return Response
     */
    public function update(Question $question, Request $request)
    {
        $question = $this->question->update($question, $request->all());

        if($request->has('answer') && !$question->is_answered) {
            \Mail::to($question->email)->queue(new QuestionAnswered($question));
            $this->question->update($question, ['is_answered'=>1]);
        }

        return redirect()->route('admin.ask.question.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ask::questions.title.questions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Question $question
     * @return Response
     */
    public function destroy(Question $question)
    {
        $this->question->destroy($question);

        return redirect()->route('admin.ask.question.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ask::questions.title.questions')]));
    }
}
