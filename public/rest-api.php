<?php


/**
 * @author Bruno Carvalho <admin@fullcontent>
 * @copyright Fullcontent 2017
 * @package test
 * 
 * 
 * Created using Ionic App Builder
 * http://codecanyon.net/item/ionic-mobile-app-builder/15716727
 */


/** CONFIG:START **/
$config["host"] 		= "mysql40.fullcontent.com.br" ; 		//host
$config["user"] 		= "fullcontent38" ; 		//Username SQL
$config["pass"] 		= "juc4b4l4" ; 		//Password SQL
$config["dbase"] 		= "fullcontent38" ; 		//Database
$config["limit"] 		= 500 ; 		//limit row
$config["abs_url_images"] 		= "http://www.fullcontent.com.br/www_arteaovento2/public" ; 		//Absolute Images URL
$config["abs_url_videos"] 		= "http://your-web/" ; 		//Absolute Videos URL
$config["abs_url_audios"] 		= "http://your-web/" ; 		//Absolute Audio URL
/** CONFIG:END **/

$rest_api = array();
function utf8ize($d) {
	if (is_array($d)) {
		foreach ($d as $k => $v) {
			$d[$k] = utf8ize($v);
		}
	} else if (is_string ($d)) {
		return utf8_encode($d);
	}
	return $d;
}

/** connect to mysql **/
$mysql = new mysqli($config["host"], $config["user"], $config["pass"], $config["dbase"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}


if(!isset($_GET["json"])){

	$_GET["json"]= "route";

}


switch($_GET["json"]){
	case "cb_clientes":
		/** create statement for SQL **/
		$where = $_where = null;
		if(isset($_GET["id"])){
			$_where[] = "`id` LIKE '%".$mysql->escape_string($_GET["id"])."%'";
		}
		if(isset($_GET["nome"])){
			$_where[] = "`nome` LIKE '%".$mysql->escape_string($_GET["nome"])."%'";
		}
		if(isset($_GET["email"])){
			$_where[] = "`email` LIKE '%".$mysql->escape_string($_GET["email"])."%'";
		}
		if(isset($_GET["telefone"])){
			$_where[] = "`telefone` LIKE '%".$mysql->escape_string($_GET["telefone"])."%'";
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		/** create SQL Code **/

		$sql = "SELECT * FROM `cb_clientes` ".$where."ORDER BY `nome` ASC LIMIT 0, 300" ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				$rest_api[$z]['id'] = $data['id']; # id
				$rest_api[$z]['nome'] = $data['nome']; # heading-1
				$rest_api[$z]['email'] = $data['email']; # heading-2
				$rest_api[$z]['telefone'] = $data['telefone']; # heading-2
				$z++;
			}
			$result->close();
		}

		break;

	case "cb_produtos":
		/** create statement for SQL **/
		$where = $_where = null;
		if(isset($_GET["id"])){
			$_where[] = "`id` LIKE '%".$mysql->escape_string($_GET["id"])."%'";
		}
		if(isset($_GET["foto"])){
			$_where[] = "`foto` LIKE '%".$mysql->escape_string($_GET["foto"])."%'";
		}
		if(isset($_GET["nome"])){
			$_where[] = "`nome` LIKE '%".$mysql->escape_string($_GET["nome"])."%'";
		}
		if(isset($_GET["precoVendaVarejo"])){
			$_where[] = "`precoVendaVarejo` LIKE '%".$mysql->escape_string($_GET["precoVendaVarejo"])."%'";
		}
		if(isset($_GET["precoVendaAtacado"])){
			$_where[] = "`precoVendaAtacado` LIKE '%".$mysql->escape_string($_GET["precoVendaAtacado"])."%'";
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		/** create SQL Code **/

		$sql = "SELECT * FROM `cb_produtos` ".$where."ORDER BY `id` ASC LIMIT 0, 300" ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				$rest_api[$z]['id'] = $data['id']; # id
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if((substr($data['foto'], 0, 7)=='http://')||(substr($data['foto'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				$rest_api[$z]['foto'] = $abs_url_images . $data['foto']; # images
				$rest_api[$z]['nome'] = $data['nome']; # heading-1
				$rest_api[$z]['precovendavarejo'] = "Varejo: R$".$data['precoVendaVarejo']; # heading-2
				$rest_api[$z]['precovendaatacado'] = "Atacado: R$".$data['precoVendaAtacado']; # heading-2
				$z++;
			}
			$result->close();
		}

		break;

	case "route":
		$rest_api["routes"][0]["namespace"] = "cb_clientes";
		$rest_api["routes"][0]["methods"][] = "GET";
		$rest_api["routes"][0]["args"]["id"] = array("required"=>"false","description"=>"Selecting `cb_clientes` based `id`");
		$rest_api["routes"][0]["args"]["foto"] = array("required"=>"false","description"=>"Selecting `cb_clientes` based `foto`");
		$rest_api["routes"][0]["args"]["nome"] = array("required"=>"false","description"=>"Selecting `cb_clientes` based `nome`");
		$rest_api["routes"][0]["args"]["precoVendaVarejo"] = array("required"=>"false","description"=>"Selecting `cb_clientes` based `precoVendaVarejo`");
		$rest_api["routes"][0]["args"]["precoVendaAtacado"] = array("required"=>"false","description"=>"Selecting `cb_clientes` based `precoVendaAtacado`");
		$rest_api["routes"][0]["_links"]["self"] = $_SERVER["PHP_SELF"]."?json=cb_clientes";
		$rest_api["routes"][1]["namespace"] = "cb_produtos";
		$rest_api["routes"][1]["methods"][] = "GET";
		$rest_api["routes"][1]["args"]["id"] = array("required"=>"false","description"=>"Selecting `cb_produtos` based `id`");
		$rest_api["routes"][1]["args"]["foto"] = array("required"=>"false","description"=>"Selecting `cb_produtos` based `foto`");
		$rest_api["routes"][1]["args"]["nome"] = array("required"=>"false","description"=>"Selecting `cb_produtos` based `nome`");
		$rest_api["routes"][1]["args"]["precoVendaVarejo"] = array("required"=>"false","description"=>"Selecting `cb_produtos` based `precoVendaVarejo`");
		$rest_api["routes"][1]["args"]["precoVendaAtacado"] = array("required"=>"false","description"=>"Selecting `cb_produtos` based `precoVendaAtacado`");
		$rest_api["routes"][1]["_links"]["self"] = $_SERVER["PHP_SELF"]."?json=cb_produtos";
		break;
}

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode(utf8ize($rest_api));