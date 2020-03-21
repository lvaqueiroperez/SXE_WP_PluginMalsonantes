<?php
/**
 * @package palabrasMal
 * @version 1.0.0
 */
/*
Plugin Name: palabrasMal
Plugin URI: http://wordpress.org/plugins/palabrasMal/
Description: Renombra el las páginas/posts cualquier tipo de palabra malsonante registrada en la BD
Author: Luis
Version: 1.7.2
Author URI: http://ma.tt/
*/

//CREAMOS TABLA SI NO EXISTE:
function crear_tabla() {
  
  global $wpdb;
  
    // Con esto creamos el nombre de la tabla y nos aseguramos que se cree con el mismo prefijo que ya tienen las otras tablas creadas (wp_form).
    $table_name = $wpdb->prefix . 'palabrasMal';
 
    // CREAMOS LA TABLA CON UN "IF NOT EXISTS" PARA QUE NO LA SOBREESCRIBA
    // Y CON UN ID QUE SERÁ UNIQUE KEY, PARA QUE SI EXISTE YA LA PALABRA NO LA VUELVA A PONER EN CASO DE RECARGAR EL PLUGIN
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      nombre varchar(255) NOT NULL,
      UNIQUE KEY id (id)
    );";
    // upgrade contiene la función dbDelta la cuál revisará si existe la tabla.
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // Creamos la tabla
    dbDelta($sql);
}
// Ejecutamos nuestra funcion en WordPress cuando activemos el plugin con:
add_action('init', 'crear_tabla');



//AÑADIMOS PALABRAS MALSONANTES A LA TABLA:
function insertar_palabras(){
  
  global $wpdb;
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>1,
        'nombre'=>"puta",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>2,
        'nombre'=>"puto",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>3,
        'nombre'=>"hostia",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>4,
        'nombre'=>"joder",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>5,
        'nombre'=>"cojones",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>6,
        'nombre'=>"hijo de puta",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>7,
        'nombre'=>"subnormal",
        )
        
        );
        
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>8,
        'nombre'=>"malnacido",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>9,
        'nombre'=>"ostia",
        )
        
        );
  
  $wpdb->insert('wp_5_2palabrasMal',
  
  array('id'=>10,
        'nombre'=>"polla",
        )
        
        );

}
// Ejecutamos la función
add_action('init', 'insertar_palabras');


//USAMOS LA FUNCIÓN DE SUSTITUCIÓN PARA SUSTITUÍR PALABRAS DE UNA PÁGINA O POST QUE
//COINCIDAN CON ALGUNA DE LA BD POR "****"

//FUNCION PARA SUSTITUIRLOS
function filtrar_palabra($text){
  
  $resultadosArray = array();
  
  global $wpdb;
  
  // OJO! LA TABLA NO SE LLAMA "palabrasMal", LE HEMOS PUESTO UN PREFIJO !!!
  $resultados = $wpdb->get_results("SELECT * FROM wp_5_2palabrasMal");
  
  foreach($resultados as $result){
    
		array_push($resultadosArray, $result->nombre);
		
	}

return str_replace( $resultadosArray,'*****', $text );

}
//LLAMAMOS A LA FUNCIÓN CON EL FILTRO EN "THE_CONTENT":
add_filter( 'the_content', 'filtrar_palabra' );
?>