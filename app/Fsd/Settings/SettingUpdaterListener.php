<?php namespace Fsd\Settings;

interface SettingUpdaterListener {
	public function updationFailed();
	public function updationSuccess();
	public function updationQueryException($e);
}