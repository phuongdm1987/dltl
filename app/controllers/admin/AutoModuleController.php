<?php namespace Controllers\Admin;

use AdminController;
use Input;
use DB;
use View;

class AutoModuleController extends AdminController{

	public function getCreate() {
		$rowFields = array();
		return View::make('backend/auto/index', compact('rowFields'));
	}

	public function postCreate() {
		$table = Input::get('table');
		$rowFields = objects2Arrays(DB::select("SHOW FIELDS FROM " . $table));
		return View::make('backend/auto/index', compact('rowFields'));
	}


	public function postCreateStep2() {
		$table = Input::get('table');
		$ucfirstModule = ucfirst($table);
		$lowercaseModule = strtolower($table);
		$moduleControllerName = $ucfirstModule . 'Controller';
		$moduleModelName = $ucfirstModule;

		$rowFields = objects2Arrays(DB::select("SHOW FIELDS FROM " . $table));

		// Find primary key
		$primaryKey = '';
		foreach($rowFields as $row) {
			if(isset($row['Key']) && $row['Key'] == 'PRI') {
				$primaryKey = $row['Field'];
				break;
			}
		}

		// Make Controller
		$controllerTpl = file_get_contents(BASE_PATH . 'app/views/core_templates/Controller.tpl');
		$controllerTpl = str_replace(array('className', '__PERMISSION_PREFIX__', '__MODEL__', '__PRIMARY_KEY__'), array( ucfirst($table).'Controller', $lowercaseModule, $ucfirstModule, strtolower($primaryKey)), $controllerTpl);
		file_put_contents(BASE_PATH . 'app/auto/'. ucfirst($table) .'Controller.php', $controllerTpl);

		// Make Model
		$modelTpl = file_get_contents(BASE_PATH . 'app/views/core_templates/Model.tpl');
		$modelTpl = str_replace(array('__MODEL__', '@table@', '@primaryKey@'), array(ucfirst($table), strtolower($table), strtolower($primaryKey)), $modelTpl);
		file_put_contents(BASE_PATH . 'app/auto/'. ucfirst($table) .'.php', $modelTpl);

		// Make add view
		$controlsAdd = $controlsEdit = "";
		$field_titles = Input::get('field_titles');
		$field_names = Input::get('field_names');
		$field_controls = Input::get('field_controls');

		foreach($field_titles as $key => $title) {
			$defaultValue = '$' . $lowercaseModule . '->' . $field_names[$key];
			switch ($field_controls[$key]) {
				case 1:
					$controlHtmlAdd = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') , "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') , "class" => "form-control"))';
					break;

				case 2:
					$controlHtmlAdd = 'FormCreator::password(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') , "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::password(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') , "class" => "form-control"))';
					break;

				case 3:
					$controlHtmlAdd = 'FormCreator::hidden(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') ,"class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::hidden(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') ,"class" => "form-control"))';
					break;

				case 4:
					$controlHtmlAdd = 'FormCreator::select(array(), Input::old(\''. $field_names[$key] .'\') , array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::select(array(), Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') , array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					break;

				case 5:
					$controlHtmlAdd = 'FormCreator::textarea(Input::old(\''. $field_names[$key] .'\'), array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::textarea(Input::old(\''. $field_names[$key] .'\', '. $defaultValue. '), array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					break;

				case 6:
					$controlHtmlAdd = 'FormCreator::checkbox(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') ,"class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::checkbox(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') ,"class" => "form-control"))';
					break;

				case 7:
					$controlHtmlAdd = 'FormCreator::radio(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') , "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::radio(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') , "class" => "form-control"))';
					break;

				case 8:
					$controlHtmlAdd = 'FormCreator::file(array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::file(array("name" => "'. $field_names[$key] . '", "class" => "form-control"))';
					break;

				case 9:
					$controlHtmlAdd = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') ,"class" => "form-control date-picker"))';
					$controlHtmlEdit = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') ,"class" => "form-control date-picker"))';
					break;

				default:
					$controlHtmlAdd = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\') ,"class" => "form-control"))';
					$controlHtmlEdit = 'FormCreator::text(array("name" => "'. $field_names[$key] . '", "value" => Input::old(\''. $field_names[$key] .'\', '. $defaultValue. ') , "class" => "form-control"))';
					break;
			}
			$controlsAdd .= 'echo FormCreator::makeControl("'. $title . '", '. $controlHtmlAdd .');' . "\n\t\t";
			$controlsEdit .= 'echo FormCreator::makeControl("'. $title . '", '. $controlHtmlEdit .');' . "\n\t\t";
		}

		$addViewTpl = file_get_contents(BASE_PATH . 'app/views/core_templates/create.tpl');
		$addViewTpl = str_replace(array('@page_title@', '@form_controls@'), array('Add ' . ucfirst($table), $controlsAdd), $addViewTpl);

		$editViewTpl = file_get_contents(BASE_PATH . 'app/views/core_templates/create.tpl');
		$editViewTpl = str_replace(array('@page_title@', '@form_controls@'), array('Edit ' . ucfirst($table), $controlsEdit), $editViewTpl);

		$pathFolderModule = BASE_PATH . 'app/auto/'. strtolower($table);

		if(!is_dir($pathFolderModule)) {
			mkdir($pathFolderModule);
		}

		file_put_contents($pathFolderModule . '/create.blade.php', $addViewTpl);
		file_put_contents($pathFolderModule . '/edit.blade.php', $editViewTpl);

		// Make routes
		$routesContentGroup = "\tRoute::group(array('prefix' => '". $lowercaseModule. "'), function() {
		Route::get('/', array('as' => '". $lowercaseModule. "', 'uses' => 'Controllers\Admin\\".$moduleControllerName."@getIndex'));
		Route::get('create', array('as' => 'create/". $lowercaseModule ."', 'uses' => 'Controllers\Admin\\". $moduleControllerName ."@getCreate'));
		Route::post('create', 'Controllers\Admin\\". $moduleControllerName ."@postCreate');
		Route::get('{id}/edit', array('as' => 'edit/". $lowercaseModule ."', 'uses' => 'Controllers\Admin\\". $moduleControllerName ."@getEdit'));
		Route::post('{id}/edit', 'Controllers\Admin\\". $moduleControllerName ."@postEdit');
		Route::get('{id}/delete', array('as' => 'delete/". $lowercaseModule ."', 'uses' => 'Controllers\Admin\\". $moduleControllerName ."@getDelete'));
		Route::get('{id}/active', array('as' => 'active/". $lowercaseModule ."', 'uses' => 'Controllers\Admin\\". $moduleControllerName ."@getActive'));
	});";

		$routesContentAppend = "\t#{ROUTE_AUTO_GENERATE}#\n" . $routesContentGroup;

		$routesPath = BASE_PATH . 'app/routes.php';
		$routesContent = file_get_contents($routesPath);
		$routesContent = str_replace(trim($routesContentGroup), '', $routesContent);
		$routesContent = str_replace('#{ROUTE_AUTO_GENERATE}#', trim($routesContentAppend), $routesContent);
		file_put_contents(BASE_PATH . 'app/auto/routes.php', trim($routesContent));
	}
}