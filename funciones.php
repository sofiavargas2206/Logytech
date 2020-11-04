<?php

function login(){
	session_start();
	$ch = curl_init('https://appsdemo.logytechmobile.com/WebApplicationCreacionServicios/api/cuentas/Login');
//especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
curl_setopt ($ch, CURLOPT_POST, 1);
$email=$_REQUEST['email'];
$password=$_REQUEST['pass'];

//le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode(["email"=>$email,"password"=>$password]));
//le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//recogemos la respuesta
$respuesta = curl_exec ($ch);

//o el error, por si falla
$error = curl_error($ch);
//y finalmente cerramos curl
$array=json_decode($respuesta, true);
//print_r($array['token']);

$_SESSION['token']=$array['token'];
//var_dump($_SESSION['token']);

/*curl_setopt($ch, CURLOPT_URL, "https://appsdemo.logytechmobile.com/WebApplicationCreacionServicios/api/Deliverys/IniciarDelivery");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
*/
curl_close ($ch);
}

function consumo(){
	session_start();
		$ch = curl_init('https://appsdemo.logytechmobile.com/WebApplicationCreacionServicios/api/Deliverys/IniciarDelivery');
		$autenticacion = "Authorization: Bearer $_SESSION[token]";
		echo $autenticacion;
				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json',$autenticacion]);
					
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode(
	["entrega"=>
		["orden"=>
			["numero_orden"=>"1"], 
			["alistamiento"=>["id_alistamiento"=>"2"]],
			["cliente"=>
				["nombre"=>"Jane R."],
				["tipo_documento"=>"1"],
				["numero_documento"=>"43523451"],
				["telefono"=>"3204190041"]],
			["pedidos"=>
				["numero_pedido"=>"23332333"],
				["valor_declarado"=> "766547"],
				["proceso_venta"=>"ACT"],
		        ["ubicacion_recoleccion"=>
		        			["centro_origen"=>"C433"],
		                    ["nombre_ubicacion"=>"23423"],
		                    ["direccion_origen"=>"CL 45 24 31"]
		    	],
		    	["materiales"=>
		  			["sku"=>"7005927"],
		            ["cantidad"=>"1"],
		            ["seriales"=>
		            	["serial"=>"57101001505425920"]
		          	]
		         ],
		         ["datos_envio"=>
		                    ["codigo_municipio"=>"150"],
		                    ["departamento"=>"Bogotá"],
		                    ["cod_depart"=>"1"],
		                    ["municipio"=>"Bogotá D.C"],
		                    ["barrio"=>"Chicó"],
		                    ["direccion_normalizada"=>"CL 85 16 21"],
		                    ["direccion_lenguaje_natural"=>"Calle 85 # 16 - 21"],
		                    ["complemento"=>"Bloque 5 Apt 503"],
		          ],
		          ["priorizacion_entrega"=>
		                    ["fecha"=>"2019-09-25"],
		                    ["franja"=> "pm"],
		                    ["hora"=>"12:00:00"],
		          ]	

			],
			["observacion"=>"ok"]
		]

	]));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$res = curl_exec ($ch);
echo $res;
$error = curl_error($ch);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$respuesta = curl_exec ($ch);
$error = curl_error($ch);

}

?>
