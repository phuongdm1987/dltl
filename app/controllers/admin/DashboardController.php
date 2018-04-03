<?php namespace Controllers\Admin;

use AdminController;
use Fsd\Users\User;
use View;

class DashboardController extends AdminController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function getDashboard()
	{
		// Thứ trong tuần
		$daysOfWeek = array(
			0 => 'Chủ nhật',
			1 => 'Thứ 2',
			2 => 'Thứ 3',
			3 => 'Thứ 4',
			4 => 'Thứ 5',
			5 => 'Thứ 6',
			6 => 'Thứ 7',
		);

		// Count users
		$users = User::all()->count();

		// Show the page
		return View::make('backend/dashboard', compact('daysOfWeek', 'users'));
	}

	/**
	 * Index admin view
	 */
	public function getIndex() {
		return View::make('backend/index');
	}

}
