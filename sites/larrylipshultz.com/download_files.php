<?php
echo "Downloading Images\n";
$data = db_select("field_data_body", 'b')
			->fields('b')
			->condition('bundle', array('page', 'article', 'blog'), 'IN')
			->execute();

while($node = $data->fetchObject()) {
	$body = $node->body_value;
	preg_match_all('/\<img(\s+[a-zA-Z\_\-]+\s*\=\s*[\"][^\"]*[\"])*(\s+[a-zA-Z\_\-]+\s*\=\s*[\'][^\']*[\'])*(\s+src\s*\=\s*[\'\"]([^\'\"]*)[\'\"])(\s+[a-zA-Z\_\-]+\s*\=\s*[\"][^\"]*[\"])*(\s+[a-zA-Z\_\-]+\s*\=\s*[\'][^\']*[\'])*\s*\/?\>/', $body, $tags);

	if(!empty($tags[4])) {
		echo "Node: ".$node->entity_id."\n";
		echo "Images: \n";
		print_r($tags[4]);
	}
}
