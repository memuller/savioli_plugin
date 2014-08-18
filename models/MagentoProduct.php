<?php  
namespace ClinicaSavioli;
class MagentoProduct {

	static function build(){} 
	static function build_database(){}

	static function all($ammount = null){
		$options = get_option('clinica-savioli_options');
		if(!isset($ammount)) $ammount = $options['magento_num_posts'];
		$html = file_get_dom($options['magento_url']);
		$grid = $html('.products-grid', 0);
		$products = array();
		foreach ($grid('li.item') as $product) {
			if($ammount <= sizeof($products)) break;
			$object = new static();
			$object->name = $product('h3.product-name>a',0)->getPlainText();
			$object->image = $product('a.product-image>img',0)->src ;
			$object->url = $product('a.product-image',0)->href ;
			$products[]= $object;
		}
		return $products;
	}

}

?>