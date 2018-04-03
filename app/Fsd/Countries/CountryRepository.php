<?php namespace Fsd\Countries;

interface CountryRepository {
	public function getContryById($id);
	public function getAllCountry();
	public function getCountryByPagination($count = 25);
   public function getListCountries();
   public function getCountriesHotForeign($limit = 12);
   public function buildArrayFromListCountries($countries);
}