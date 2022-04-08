<?php

use Fsd\Categories\CategoryRepository;
use Fsd\Cities\CityRepository;
use Fsd\Places\PlaceRepository;
use Fsd\Posts\PostRepository;
use Fsd\Tours\TourRepository;
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
    /**
     * @var TourRepository
     */
    private $tourRepository;

    public function __construct(
        PostRepository     $postRepository,
        CategoryRepository $categoryRepository,
        PlaceRepository $placeRepository,
        CityRepository $cityRepository,
        TourRepository $tourRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->placeRepository = $placeRepository;
        $this->cityRepository = $cityRepository;
        $this->tourRepository = $tourRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $cities = $this->cityRepository->getListCities();
        $places = $this->placeRepository->getAllPlace();
        $tours = $this->tourRepository->getPublishToursPaginated(0);
        $posts = $this->postRepository->getAll(0);
        header("Content-type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>';

        return View::make('sitemap', compact('categories', 'cities', 'places', 'tours', 'posts'));
    }
}
