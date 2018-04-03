<?php
namespace Fsd\Tours;
use Fsd\Core\EloquentRepository;

class TestTourRepository extends EloquentRepository implements TourRepository
{
   public function getListTourHome()
   {
      $array_return = array(
         'tour_in'  => array(
               0 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               1 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               2 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               3 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               )
            ),
         'tour_out' => array(
               0 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               1 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               2 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               ),
               3 => array(
                  'tour_city_name' => "An Giang",
                  'tour_city_link' => "http://rvtour.dev/list",
                  'tou_city_image' => "/pictures/tours/medium_nyr1432249682.jpg"
               )
            )
      );

      return $array_return;
   }
   public function getListToursPaginated($count = 10) {

   }

   public function getListToursByTypePaginated($count = 10, $type) {

   }

   public function getListTour()
   {
      
   }
}