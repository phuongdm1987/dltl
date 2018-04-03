<?php 

namespace Controllers\Api;

use Fsd\Places\PlaceRepository;
use Fsd\Cities\CityRepository;
use Fsd\Tours\TourRepository;
use BaseController;
use Libs\UploadService;
use Config;

class UpdateResizeImageController extends BaseController {

    public function __construct(CityRepository $city, TourRepository $tour, PlaceRepository $place, UploadService $upload) {
        parent::__construct();
        $this->city   = $city;
        $this->place  = $place;
        $this->tour   = $tour;
        $this->upload = $upload;
        $this->config = Config::get('configuration');
    }

    public function updateResizeImage() {
        //City
        $all_city = $this->city->getAll();
        foreach ($all_city as $city) {
            //Check exist file
            if ($city->cit_image != "" && file_exists(PATH_UPLOAD_IMAGE_CITY . $city->cit_image)) {
                // If exist file resize
                $arrayResize = $this->config['array_resize_image_city'];
                $this->upload->resize(PATH_UPLOAD_IMAGE_CITY . $city->cit_image, PATH_UPLOAD_IMAGE_CITY, $arrayResize);
                echo "Resize Image City ID: " . $city->cit_id . " success.<br/>";
            }
        }

        //Tour
        $all_tour = $this->tour->getAll();
        foreach ($all_tour as $tour) {
            //Check exist file
            if ($tour->tou_image != "" && file_exists(PATH_UPLOAD_IMAGE_TOUR . $tour->tou_image)) {
                // If exist file resize
                $arrayResize = $this->config['array_resize_image_tour'];
                $this->upload->resize(PATH_UPLOAD_IMAGE_TOUR . $tour->tou_image, PATH_UPLOAD_IMAGE_TOUR, $arrayResize);
                echo "Resize Image Tour ID: " . $tour->tou_id . " success.<br/>";
            }
        }

        //Place
        $all_place = $this->place->getAllPlace();
        foreach ($all_place as $place) {
            $place_image = $this->place->getImagePlaceById($place);
            foreach ($place_image as $key => $image) {
                //Check exist file
                if ($image->pim_image != "" && file_exists(PATH_UPLOAD_IMAGE_PLACE . $image->pim_image)) {
                    // If exist file resize
                    $arrayResize = $this->config['array_resize_image_place'];
                    $this->upload->resize(PATH_UPLOAD_IMAGE_PLACE . $image->pim_image, PATH_UPLOAD_IMAGE_PLACE, $arrayResize);
                    echo "Resize Image Place ID: " . $image->pim_pla_id . " success.<br/>";
                }   
            }
        }

    }
}