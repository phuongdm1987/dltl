<?php
use Fsd\Categories\CategoryRepository;
use Fsd\Core\Exceptions\EntityNotFoundException;
use Fsd\Posts\Post;
use Fsd\Posts\PostRepository;

class PostController extends BaseController {

   public function __construct(PostRepository $post, CategoryRepository $category) {
      $this->post     = $post;
      $this->category = $category;
      parent::__construct();
   }

   public function getPostDetail($id, $slug)
   {
      if(! $post = $this->post->getPostById($id)) return \App::abort(404);

      $category = $post->category;

      $this->metadata->setTitle($post->pos_title . " :: " . $this->metadata->getTitle());
      $this->metadata->setDescription($post->pos_teaser);

      return View::make('dltl/frontend/detail', compact('post', 'category'));
   }

   /*
   * Danh sach tour theo country
   * @return array tour by country
   */
   public function getPostByCategory($id, $slug) {

      if (!$category = $this->category->getById($id)) {
         return \App::abort(404);
      }

      //Meta data
      $this->metadata->setTitle($category->name . " :: " . $this->metadata->getTitle());
      $this->metadata->setDescription($category->description);

      $posts   = $this->post->getPostByCategory($id, 25);

      return View::make('dltl/frontend/post', compact('posts', 'category'));
   }

    /*
    * Danh sach tour theo country
    * @return array tour by country
    */
    public function getAll() {
        //Meta data
        $this->metadata->setTitle("Tin Tức :: " . $this->metadata->getTitle());
        $this->metadata->setDescription('Tin tức, cẩm nang du lịch');

        $posts = $this->post->getAll(25);

        return View::make('dltl/frontend/post', compact('posts'));
    }
}