<?php
global $base;
$base = '/home/uitoux/larrylipshultz.com/httpdocs/sites/larrylipshultz.com/files/downloads';
echo "Downloading Images\n";
$data = db_select("field_data_body", 'b')
			->fields('b')
			->condition('bundle', array('page', 'article', 'blog'), 'IN')
			->execute();

while($node = $data->fetchObject()) {
	$body = $node->body_value;
	preg_match_all('/\<img(\s+[a-zA-Z\_\-]+\s*\=\s*[\"][^\"]*[\"])*(\s+[a-zA-Z\_\-]+\s*\=\s*[\'][^\']*[\'])*(\s+src\s*\=\s*[\'\"]([^\'\"]*)[\'\"])(\s+[a-zA-Z\_\-]+\s*\=\s*[\"][^\"]*[\"])*(\s+[a-zA-Z\_\-]+\s*\=\s*[\'][^\']*[\'])*\s*\/?\>/', $body, $tags);

	if(!empty($tags[4])) {
		//echo "Node: ".$node->entity_id."\n";
		//echo "Images: \n";
		foreach($tags[4] as $src) {
			if(!empty($src)) {
				echo downloadImage($src)."\n";
			}
		}
	}
}

function downloadImage($src) {
	global $base;
	preg_match('/[^\.]*\.([^\?]*)/', basename($src), $ext);
	$file = basename(tempnam('', 'image_')).'.'.$ext[1];
	exec("curl -o ".$base."/".$file." ".$src);
	return $file;
}
