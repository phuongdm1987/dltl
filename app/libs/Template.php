<?php
class Template {

	/**
	 * HTML show queries in page
	 */
	public static function getQueriesExecute() {
		$ip_allow = json_decode(file_get_contents(BASE_PATH . '/ip_allow.json'), true);

		if(in_array($_SERVER['REMOTE_ADDR'], $ip_allow)) {
			// Get query and sort query by time desc
			$queries = DB::getQueryLog();
			usort($queries, function($a, $b) {
				return $a['time'] > $b['time'] ? -1 : 1;
			});

			// Generate HTML table
			$htmlTableBody = '';
			$htmlTimeLoadPage = '';
			$no = 0;
			foreach($queries as $key => $query) {
				if(!isset($query['file'])) $query['file'] = null;
				if(!isset($query['line'])) $query['line'] = null;
				$htmlTableBody .= '
					<tr>
						<td>'. ($no+1) .'</td>
						<td>'. $query['query'] .'</td>
						<td>'. $query['time'] .'</td>
						<td>'. $query['file'] .'</td>
						<td>'. $query['line'] .'</td>
					</tr>
				';
				$no ++;
			}

			return '
			<table class="table table-hover table-stripped table-bordered">
				<thead>
					<th>STT</th>
					<th>Query</th>
					<th>Time</th>
					<th>File</th>
					<th>Line</th>
				</thead>
				<tbody>'. $htmlTableBody .'</tbody>
			</table>';
		}
	}


	/**
	 * HTML time load page
	 */
	public static function getTimeLoadPage($startTime, $endTime) {
		$ip_allow = json_decode(file_get_contents(BASE_PATH . '/ip_allow.json'), true);
		if(in_array($_SERVER['REMOTE_ADDR'], $ip_allow )) {
			return '<div class="text-center"> Time: ' . number_format($endTime - $startTime, 4, '.', '.') . 's - Memory usage: '. number_format(memory_get_usage() / 1024) .'KB</div>';
		}

		return ;
	}

	public static function getPagination($datas){
		return '<div class="pangition">
					<div class="col-md-4 label">
						<p class="text-pagination text-left">'. pagination_label($datas) .'</p>
					</div>
					<div class="text-right pagination-link">'. $datas->appends(Input::all())->links() .'</div>
				</div>';
	}
}