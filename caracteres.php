<?php
//Tiempo en milisegundos al empezar el script
$time = microtime(true);
//Argumento del nombre del archivo
$fileName = !empty($argv[2])?$argv[2]:'';
//Procedimiento: eliminar, reemplazar o contar frecuencia
$process = $argv[1];
//Verificación de la opción seleccionada por el usurio
if($process!='-e' && $process!='-r' && $process!='-h' && $process!='-f'){
	echo "Opción no válida\n";
}
elseif ($process=='-h') {
$help='
-----------------------------------------------------------
---------Identificador y eliminador de caracteres----------
-----------------en archivos de texto----------------------
|                                                         |
| Sintaxis:                                               |
| php caracteres.php -herf <opción> texto <ArchivoEntrada>|
|                                                         |
| <opción> : -h  Ayuda, muestra la información de ayuda   |
|            -e  Eliminar, elimina los caracteres extraños|
|            El archivo resultante, tendrá como nombre    |
|            <ArchivoEntrada>_e.txt                       |
|            -r  Reemplazar, reemplaza los caracteres     |
|            El archivo resultante, tendrá como nombre    |
|            <ArchivoEntrada>_r.txt                       |
|            -f  Frecuencia, cuenta la frecuencia con la  |
|                la que se repite cada caracter           |
|            <ArchivoEntrada>_f.txt                       |
|                                                         |
| <ArchivoEntrada> : Nombre del archivo de entrada        |
|                                                         |
| Ejemplos:                                               |
| Eliminar caracteres: $php caracteres.php -e <Archivo>   |
| Reemplazar caracteres: $php caracteres.php -r <Archivo> |
| Contar frecuencia: $php caracteres.php -f <Archivo>     |
|                                                         |
| Elaborado por:                                          |
| Jaime Alberto Gomez     jaime_alberto.gomez@uao.edu.co  |
| Hector Fabio Polanco    hector_fabio.polanco@uao.edu.co |
|                                                         |
| Universidad Autonoma de Occidente                       |
| Especialización en Seguridad Informatica                |
|                                                         |
| Profesor : Siler Amador D.    samador@unicauca.edu.co   |
-----------------------------------------------------------
';
	echo $help;
} 
//Verificación archivo existente
elseif (!file_exists($fileName)) {
    echo "File " . $fileName . " not found\n";
} 
else {
//Extracción de la información contenida en el archivo
    $file = file_get_contents($fileName);
//Eliminación de caracteres especiales
    echo "Loading...\n";
	$array_name=explode(".", $fileName);
	if($process=='-e'){
		$result = preg_replace('/\W/i', '', $file);
		$fileNameNew = $array_name[0] . '_e.'.$array_name[1];
		}
	elseif($process=='-r'){
		$result=utf8_encode($file);
		$fileNameNew = $array_name[0] . '_r.'.$array_name[1];
		}
	else{
		$result = shell_exec("awk -f freq.awk $fileName");
		$fileNameNew = $array_name[0] . '_f.'.$array_name[1];
		}
//Exportación del resultado obtenido 
    file_put_contents($fileNameNew, $result);
//Tiempo final al terminar la ejecución
    $final_time = microtime(true) - $time;
//Impresión del tiempo final tomado para ejecutar script
    echo "El tiempo de ejecución del archivo ha sido de " . $final_time . " segundos\n";
//Finalización
    echo "Done...\n";	
}
?>