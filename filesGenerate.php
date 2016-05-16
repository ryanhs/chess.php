<?php

$data  = [];

$path_lvl1 = 'files/';
$d_lvl1 = scandir($path_lvl1);
foreach($d_lvl1 as $entry) {
	if ($entry == '.') continue;
	if ($entry == '..') continue;
	
	if (is_dir($path_lvl1 . $entry)) {	
		$new = ['title' => $entry, 'data' => []];
					
		$path_lvl2 = $path_lvl1 . $entry . '/';
		$d_lvl2 = scandir($path_lvl2);
		foreach($d_lvl2 as $entry) {
			if ($entry == '.') continue;
			if ($entry == '..') continue;
			
			if(substr($entry, -2) == 'md') {
				$new['data'][] = [
					'src' => $path_lvl2 . $entry,
					'type' => 'markdown',
					'name' => formatAlias(substr($entry, 0, -3))
				];
			}
			
			if(substr($entry, -4) == 'html') {
				$new['data'][] = [
					'src' => $path_lvl2 . $entry,
					'type' => 'html',
					'name' => formatAlias(substr($entry, 0, -5))
				];
			}
			
			if(substr($entry, -3) == 'jpg' || substr($entry, -3) == 'png' || substr($entry, -3) == 'gif') {
				$new['data'][] = [
					'src' => $path_lvl2 . $entry,
					'type' => 'image',
					'name' => formatAlias(substr($entry, 0, -4))
				];
			}
		}
		$data[] = $new;
	}
}

$out = json_encode($data);
file_put_contents('files/repo.json', $out);
echo $out . PHP_EOL;


function formatAlias($str){
	return ucwords(str_replace('_', ' ', $str));
}
