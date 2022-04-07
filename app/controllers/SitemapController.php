<?php

use Fsd\Categories\CategoryRepository;
use Fsd\Cities\CityRepository;
use Fsd\Places\PlaceRepository;
use Fsd\Posts\PostRepository;
use Illuminate\Support\Facades\View;

class SitemapController extends Controller
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var PlaceRepository
     */
    private $placeRepository;
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(
        PostRepository     $postRepository,
        CategoryRepository $categoryRepository,
        PlaceRepository $placeRepository,
        CityRepository $cityRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->placeRepository = $placeRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $cities = $this->cityRepository->getListCities();
        $places = $this->placeRepository->getAllPlace();
        $posts = $this->postRepository->getAll(0);
        header("Content-type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>';

        return View::make('sitemap', compact('categories', 'cities', 'places', 'posts'));
    }
}
