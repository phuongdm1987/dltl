<?php
namespace Fsd\Posts;
use Fsd\Core\EloquentRepository;

class DbPostRepository extends EloquentRepository implements PostRepository{

	public function __construct(Post $model) {
		$this->model = $model;
	}

   public function getPostByPagination($count = 25) {
      return $this->model->paginate($count);
   }

   public function getPostById($id) {
      return $this->model->find($id);
   }

   public function getCarHot($take = 4)
   {
      return $this->model
         ->where('pos_active', 1)
         ->where('pos_category_id', 3)
         ->where('pos_hot', 1)
         ->take($take)
         ->get();
   }

   public function getHotelHot($take = 8)
   {
      return $this->model
         ->where('pos_active', 1)
         ->where('pos_category_id', 4)
         ->where('pos_hot', 1)
         ->take($take)
         ->get();
   }

   public function getPostByCategory($id, $count = 10)
   {
      return $this->model
         ->where('pos_active', 1)
         ->where('pos_category_id', $id)
         ->paginate($count);
   }

    public function getAll($count = 10)
    {
        $query = $this->model
            ->where('pos_active', 1);

        if ($count > 0) {
            return $query->paginate($count);
        }

        return $query->get();
    }
}