<?php

function login(){
	session_start();
	$ch = curl_init('https://appsdemo.logytechmobile.com/WebApplicationCreacionServicios/api/cuentas/Login');
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
curl_setopt ($ch, CURLOPT_POST, 1);
$email=$_REQUEST['email'];
$password=$_REQUEST['pass'];

curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode(["email"=>$email,"password"=>$password]));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$respuesta = curl_exec ($ch);

$error = curl_error($ch);
$array=json_decode($respuesta, true);

$_SESSION['token']=$array['token'];

curl_close ($ch);
}

function consumo(){
	session_start();
		$ch = curl_init('https://appsdemo.logytechmobile.com/WebApplicationCreacionServicios/api/Deliverys/IniciarDelivery');
		$autenticacion = "Authorization: Bearer $_SESSION[token]";
	//	echo $autenticacion;
				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json',$autenticacion]);
					
curl_setopt ($ch, CURLOPT_POST, 1);
$variable = json_encode(["entrega"=> [
        "orden"=> [
            "numero_orden"=> "1"
        ],
        "alistamiento"=> [
            "id_alistamiento"=> "2"
        ],
        "cliente"=> [
            "nombre"=> "Sofia p1.",
            "tipo_documento"=> "1",
            "numero_documento"=> "43523451",
            "telefono"=> "3204190041"
        ],
        "pedidos"=> [
            [
                "numero_pedido"=> "23332337",
                "valor_declarado"=> "766547",
                "proceso_venta"=> "ACT",
                "ubicacion_recoleccion"=> [
                    "centro_origen"=> "C433",
                    "nombre_ubicacion"=> "23423",
                    "direccion_origen"=> "CL 45 24 31"
                ],
                "materiales"=> [
                    [
                        "sku"=> "7005927",
                        "cantidad"=> "1",
                        "seriales"=> [
                            [
                                "serial"=> "57101001505425920"
                            ]
                        ]
                    ]
                ],
                "datos_envio"=> [
                    "codigo_municipio"=> "150",
                    "departamento"=> "Bogotá",
                    "cod_depart"=> "1",
                    "municipio"=> "Bogotá D.C",
                    "barrio"=> "Chicó",
                    "direccion_normalizada"=> "CL 85 16 21",
                    "direccion_lenguaje_natural"=> "Calle 85 # 16 - 21",
                    "complemento"=> "Bloque 5 Apt 503"
                ],
                "priorizacion_entrega"=> [
                    "fecha"=> "2020-12-25",
                    "franja"=> "pm",
                    "hora"=> "12:00:00"
                ]
            ]
        ],
        "observacion"=> ""
    ]
]

);
curl_setopt ($ch, CURLOPT_POSTFIELDS,$variable);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$res = curl_exec ($ch);
//echo $variable;
echo $res;
$error = curl_error($ch);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$respuesta = curl_exec ($ch);
$error = curl_error($ch);

}

?>
