<?php namespace Modules\Ask\Presenters;

use Laracasts\Presenter\Presenter;

class QuestionPresenter extends Presenter
{
    public function is_answered()
    {
        return $this->entity->is_answered ? trans('ask::questions.table.answered') : trans('ask::questions.table.not answered');
    }
}