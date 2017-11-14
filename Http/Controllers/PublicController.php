<?php namespace Modules\Ask\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ask\Http\Requests\CreateQuestionRequest;
use Modules\Ask\Mail\AskQuestionCreated;
use Modules\Ask\Repositories\QuestionRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Media\Services\FileService;
use Mail;

class PublicController extends BasePublicController
{
    /**
     * @var FileService
     */
    private $fileService;
    /**
     * @var QuestionRepository
     */
    private $question;

    public function __construct(FileService $fileService, QuestionRepository $question)
    {
        parent::__construct();
        $this->fileService = $fileService;
        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function create()
    {
        return view('ask::form');
    }

    public function store(CreateQuestionRequest $request)
    {
        try
        {
            if($request->ajax()) {
                $requestData = $request->all();
                if($request->hasFile('attachment')) {
                    $file = $this->fileService->store($request->attachment);
                    $requestData['attachment'] = $file->id;
                } else {
                    $requestData['attachment'] = null;
                }
                if ($question = $this->question->create($requestData)) {
                    Mail::to(setting('theme::email'))->queue(new AskQuestionCreated($question));
                }
                return response()->json([
                    'success' => true,
                    'data' => ['message'=>'Eklendi']
                ], Response::HTTP_OK);
            }
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'success' => false,
                'message'  => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
