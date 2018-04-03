<?php namespace Controllers\Admin;

use AdminController;
use View;
use Redirect;
use DataGrid;
use Fsd\Feedbacks\Feedback;
use Fsd\Feedbacks\FeedbackRepository;

class FeedbackController extends AdminController {

	public function __construct(FeedbackRepository $feedback) {

		parent::__construct();
		$this->feedback 		= $feedback;
	}

	public function getIndex() {
		$feedbacks = $this->feedback->getAllFeedback();

		$dataGrid = new DataGrid([
		   'data' => $feedbacks,
		   'pagination' => [
		   	'limit_record' => 25,
		   	'total_record' => $feedbacks->getTotal()
		   ]
		]);

		$dataGrid->addColumn('feed_id', 'ID', 1);
		$dataGrid->addColumn('feed_fullname', 'Họ tên', 1);
		$dataGrid->addColumn('feed_email', 'Email', 1);
		$dataGrid->addColumn('feed_message', 'Nội dung', 1);
		$dataGrid->addColumn('feed_time', 'Gửi lúc', 1, array(), function($item) {
         return date('d/m/Y H:i:s', $item->feed_time);
      });

		$data_grid = $dataGrid->render(false);

		return View::make('backend/feedbacks/index', compact('data_grid'));
	}
}