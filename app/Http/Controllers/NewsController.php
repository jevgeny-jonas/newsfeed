<?php

namespace App\Http\Controllers;

use App\NewsReaderInterface;

class NewsController extends Controller
{
    protected $newsReader;
    
    public function __construct(NewsReaderInterface $newsReader)
    {
        $this->newsReader = $newsReader;
    }
    
    /**
     * @throws App\Exceptions\NewsException
     */
    public function index()
    {
        $news = $this->newsReader->getNews();
        return response($news, 200)
                      ->header('content-type', 'application/rss+xml');
        //if NewsException is thrown, let it propagate to return 500
    }
}
