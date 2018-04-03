<?php namespace Fsd\Categories;

use McCool\LaravelAutoPresenter\BasePresenter;

class CategoryPresenter extends BasePresenter {

	/**
	 * Template danh mục
	 * @param  object $errors
	 * @return string
	 */
	public function getTemplateDropdown($errors = null, $default_value = 0, $attr = array()) {

		$html_option	= '';
		$html				= '';
		$has_error		= '';

		$iCategory = \App::make('Fsd\Categories\CategoryRepository');
		$categories = $iCategory->getListChilds();
		$default_attr = array('name' => 'post_category', 'class' => 'form-control');
		$attr = array_merge($default_attr, $attr);

		foreach ($categories as $category) {
			$selected = $category->id == \Input::old($attr['name'], $default_value) ? 'selected' : '';

			$html_option .= '<option value="'. $category->id .'" '. $selected .'>';

			for ($i = 0; $i < $category->level; $i++) {
				$html_option .= ($i == 0 ? '|' : '') . '&rarr;';
			}

			$html_option .= $category->name;
			$html_option .= '</option>';
		}

		if(is_object($errors) && $errors->has('parents')) {
			$has_error = 'has-error';
		}

		$text_error = '';

		if(is_object($errors)) {
			$text_error = $errors->first('parents', '<span class="help-inline text-danger">:message</span>');
		}

		$form = new \FormMaker();

		$html .= '<div class="form-group '. $has_error .'">
			<label class="control-label col-sm-2" for="parents">Danh mục</label>
			<div class="col-sm-6">
				<select '. $form->makeAttributes($attr) .'>
					<option value="0">-- Chọn danh mục --</option>
					'. $html_option .'
				</select>
				'. $text_error .'
			</div>
		</div>';

		return $html;
	}
}