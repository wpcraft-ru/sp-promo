<?php
// поддержка миниатюр и мею
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
	add_theme_support('menus');
}

function cp_get_id_service_page($service_page){
	
	$service_page_array = array(
		'about'
		,'girls'
		,'interior'
		,'vacansii'
		,'guest-room'
		,'schedule'
		,'direct'
		,'aktsii'
		,'sauna'
	);
	
	if( in_array($service_page, $service_page_array) ){
		$page = get_page_by_path($service_page, OBJECT, 'page');
		return $page->ID ;	
	}
	else{
		return NULL;
	}
}


add_action( 'attachments_register', 'attachments_appartaments' );
function attachments_appartaments( $attachments ){
	$args = array(
		'label' => 'Интерьеры салона',
		'post_type' => array( 'page' ),
		'filetype' => array ( 'image' ),
		'note' => null,
		'button_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'modal_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'fields' => array(
			 array(
			  'name'      => 'title',                         
			  'type'      => 'text',                          
			  'label'     => __( 'Title', 'attachments' ),    
			  'default'   => 'title',                         
			)
		) 
	);
	 
	if(isset($_GET['post']) AND $_GET['post']== cp_get_id_service_page('interior')) $attachments->register( 'attachments_appartaments', $args );
}

add_action( 'attachments_register', 'attachments_appartaments_video' );
function attachments_appartaments_video( $attachments ){
	$args = array(
		'label' => 'Видео интерьеры салона',
		'post_type' => array( 'page' ),
		'filetype' => array ( 'image' ),
		'note' => null,
		'button_text' => __( 'Прикрепить видео или загрузить его', 'attachments' ),
		'modal_text' => __( 'Прикрепить видео или загрузить его', 'attachments' ),
		'fields' => array(
			 array(
			  'name'      => 'title',                         
			  'type'      => 'text',                          
			  'label'     => __( 'Title', 'attachments' ),    
			  'default'   => 'title',                         
			)
		) 
	);
	 
	if(isset($_GET['post']) AND $_GET['post']== cp_get_id_service_page('interior')) $attachments->register( 'attachments_appartaments_video', $args );
}

add_action( 'attachments_register', 'attachments_stock' );
function attachments_stock( $attachments ){
	$args = array(
		'label' => 'Изображения для акций',
		'post_type' => array( 'page' ),
		'filetype' => array ( 'image' ),
		'note' => null,
		'button_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'modal_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'fields' => array(
			 array(
			  'name'      => 'title',                         
			  'type'      => 'text',                          
			  'label'     => __( 'Title', 'attachments' ),    
			  'default'   => 'title',                         
			)
		) 
	);
	 
	if(isset($_GET['post']) AND $_GET['post']== cp_get_id_service_page('aktsii')) $attachments->register( 'attachments_stock', $args );
}

add_action( 'attachments_register', 'attachments_sauna' );
function attachments_sauna( $attachments ){
	$args = array(
		'label' => 'Интерьеры сауны',
		'post_type' => array( 'page' ),
		'filetype' => array ( 'image' ),
		'note' => null,
		'button_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'modal_text' => __( 'Прикрепить изображение или загрузить его', 'attachments' ),
		'fields' => array(
			 array(
			  'name'      => 'title',                         
			  'type'      => 'text',                          
			  'label'     => __( 'Title', 'attachments' ),    
			  'default'   => 'title',                         
			)
		) 
	);
	 
	if(isset($_GET['post']) AND $_GET['post']== cp_get_id_service_page('sauna')) $attachments->register( 'attachments_sauna', $args );
}

add_filter('get_previous_post_join', 'exclude_dismissed_girls_join',10,3);
add_filter('get_next_post_join', 'exclude_dismissed_girls_join',10,3);
function exclude_dismissed_girls_join($join, $in_same_term, $excluded_terms){
	global $wpdb, $post;
	$my_join = $join . " INNER JOIN $wpdb->postmeta AS pm ON pm.post_id = p.ID ";
	return $my_join;
}
add_filter('get_previous_post_where', 'exclude_dismissed_girls_where',10,3);
add_filter('get_next_post_where', 'exclude_dismissed_girls_where',10,3);
function exclude_dismissed_girls_where($where, $in_same_term, $excluded_terms){
	global $wpdb, $post;
	$my_where = $where . " AND pm.meta_key = 'see-girl' AND pm.meta_value = 1 ";
	return $my_where;
}

/***************************************************/
/*********************  Видео   ********************/
remove_shortcode( 'video' );
add_shortcode( 'video', function(){} );

function cp_get_video_atts($p_id = false){
	$p_id = $p_id?$p_id:get_the_ID();
	$video_atts = false;
	$videos = new Attachments( 'attachments_girls_video', $p_id );
	if( $videos->exist() ){
		$videos->get();
		$video_atts['url'] = $videos->url();
		$video_atts['title'] = $videos->field('title');
	}
	
	return $video_atts;
}

function cp_get_photo_count($p_id = false){
	$p_id = $p_id?$p_id:get_the_ID();
	$photo_count = 0;
	$photo = new Attachments( 'attachments_girls', $p_id );
	if( $photo->exist() ) : 
		while( $photo->get() ) :
			$photo_count++;
		endwhile;
	endif;
	
	return $photo_count;
}
