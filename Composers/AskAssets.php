<?php namespace Modules\Ask\Composers;


use Illuminate\View\View;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;

class AskAssets
{
    /**
     * @var AssetPipeline
     */
    private $assetPipeline;

    public function __construct(AssetPipeline $assetPipeline)
    {

        $this->assetPipeline = $assetPipeline;
    }

    public function compose(View $view)
    {

    }
}