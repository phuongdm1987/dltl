<?php namespace Controllers\Admin;

use AdminController;
use View;
use Redirect;
use DataGrid;
use Fsd\Subscribers\Subscriber;
use Fsd\Subscribers\SubscriberRepository;

class SubscriberController extends AdminController {

	public function __construct(SubscriberRepository $model) {

		parent::__construct();
		$this->model 		= $model;
	}

	public function getIndex() {

		$subscribers = $this->model->getAll();

		$dataGrid = new DataGrid([
		   'data' => $subscribers,
		   'pagination' => [
		   	'limit_record' => 25,
		   	'total_record' => $subscribers->getTotal()
		   ]
		]);

		$dataGrid->addColumn('sub_id', 'ID', 1);
		$dataGrid->addColumn('sub_email', 'Email', 1);
		$dataGrid->addColumn('sub_time_updated', 'Thời gian', 1, array(), function($item) {
         return date('d/m/Y H:i:s', $item->sub_time_updated);
      });

		$data_grid = $dataGrid->render(false);

		return View::make('backend/subscribers/index', compact('data_grid'));
	}
}