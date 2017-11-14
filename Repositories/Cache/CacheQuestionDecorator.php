<?php

namespace Modules\Ask\Repositories\Cache;

use Modules\Ask\Repositories\QuestionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheQuestionDecorator extends BaseCacheDecorator implements QuestionRepository
{
    public function __construct(QuestionRepository $question)
    {
        parent::__construct();
        $this->entityName = 'ask.questions';
        $this->repository = $question;
    }
}
