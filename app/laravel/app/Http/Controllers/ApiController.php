<?php

	namespace App\Http\Controllers;


	use Illuminate\Support\Facades\Http;
	use Illuminate\View\View;


	class ApiController extends Controller
	{
		public function index(): View
		{
			/* https://api.privatbank.ua/#p24/exchange
				ccy	        Код валюти (довідник кодів валют: https://ru.wikipedia.org/wiki/Коды_валют) - убрать
				base_ccy	Код національної валюти - убрать
				buy	        Курс купівлі - сохранить
				sale	    Курс продажу - сохранить
			*/

			$response = Http::get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
			$r        = $response->json();
			$d = [];
			foreach ($r as $k => $v) {
				$d[$v['ccy']] =
					array_slice($v, 2, 2, true);
			}
			$uah = [
				'UAH' => [
					'buy'  => '1',
					'sale' => '1',
				]
			];
			$d   = array_merge($d, $uah);
			return view('welcome', ['data' => $d]);
		}
	}
