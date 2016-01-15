<?php
echo "Downloading Images\n";
$data = db_select("field_data_body", 'b')
			->fields('b')
			->condition('bundle', array('page', 'article', 'blog'), 'IN')
			->execute();

while($node = $data->fetchObject()) {
	$body = $node->body_value;
	preg_match('/\<img(\s+[a-zA-Z\_\-]+\s*\=\s*[\'\"][^\'\"]*[\'\"])*(\s+src\s*\=\s*[\'\"]([^\'\"]*)[\'\"])\s*\/?\>/', $body, $tags);
	if(!empty($tags[3])) {
		echo "Node: ".$node->entity_id."\n";
		echo "Image: ".$tags[3]."\n\n";
	}
}
