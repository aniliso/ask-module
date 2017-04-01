<?php

namespace Modules\Ask\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Ask\Presenters\QuestionPresenter;
use Modules\Media\Entities\File;

class Question extends Model
{
    use PresentableTrait;

    protected $table = 'ask__questions';
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'question', 'answer', 'attachment', 'is_answered'];
    protected $presenter = QuestionPresenter::class;

    public function attachment()
    {
        return $this->hasOne(File::class, 'id', 'attachment');
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
