<?php

/**
 * Подключение Titan Framework пользовательских опций
 */
require_once('titan-framework/titan-framework-embedder.php');
require_once('titan-framework/options.php');
add_action('tf_create_options', 'my_theme_create_options');

/**
 * Подключение TGM-Plugin-Activation для установки необходимых плагинов
 */
require_once dirname(__FILE__ ) . '/tgm-class-activation/class-tgm-plugin-activation.php';
add_action('tgmpa_register','mytheme_require_plugins');
function mytheme_require_plugins() {
    $plugins = array(
        'name' => 'Rus-To-Lat',
        'slug' => 'rustolat',
        'source' => get_stylesheet_directory().'/tgm-class-activation/plugins/rustolat.zip',
        'required' => true,
    );
    $config = array();
    tgmpa($plugins, $config);
}

/**
 * Количество слов в цитата
 *
 * @param $length
 *
 * @return int
 */
function custom_citation_length($length) {
  return 20;
}
add_filter('excerpt_length', 'custom_citation_length', 999);

/**
 * Замена символа [...]
 *
 * @param $text
 *
 * @return string
 */
function trim_excerpt($text) {
	return rtrim($text,'[&hellip], [...]') . '...';
}
add_filter('get_the_excerpt', 'trim_excerpt');

/**
 * Скрываем админ панель
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Подключаем скрипты и стили
 */
function load_style_script() {
    wp_deregister_script('jquery');

	wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('medias', get_template_directory_uri() . '/css/media.css');

    wp_enqueue_script('maps', 'http://maps.google.com/maps/api/js?sensor=false');
    wp_enqueue_script('jquery', 'http://code.jquery.com/jquery-2.1.4.min.js');
    wp_enqueue_script('jquery-ui', 'http://code.jquery.com/ui/1.12.0-beta.1/jquery-ui.min.js');
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js');
}
add_action('wp_enqueue_scripts', 'load_style_script');

/**
 * Добавляем поддержку миниатюр
 */
add_theme_support('post-thumbnails');
set_post_thumbnail_size(192,193);

/**
 * Регистрация меню в футере
 *
 * Class True_Walker_Nav_Menu
 */
class True_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output
     * @param object $item Объект элемента меню, подробнее ниже.
     * @param int $depth Уровень вложенности элемента меню.
     * @param object $args Параметры функции wp_nav_menu
     */
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        /*
         * Некоторые из параметров объекта $item
         * ID - ID самого элемента меню, а не объекта на который он ссылается
         * menu_item_parent - ID родительского элемента меню
         * classes - массив классов элемента меню
         * post_date - дата добавления
         * post_modified - дата последнего изменения
         * post_author - ID пользователя, добавившего этот элемент меню
         * title - заголовок элемента меню
         * url - ссылка
         * attr_title - HTML-атрибут title ссылки
         * xfn - атрибут rel
         * target - атрибут target
         * current - равен 1, если является текущим элементов
         * current_item_ancestor - равен 1, если текущим является вложенный элемент
         * current_item_parent - равен 1, если текущим является вложенный элемент
         * menu_order - порядок в меню
         * object_id - ID объекта меню
         * type - тип объекта меню (таксономия, пост, произвольно)
         * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
         * type_label - название данного типа с локализацией (Рубрика, Страница)
         * post_parent - ID родительского поста / категории
         * post_title - заголовок, который был у поста, когда он был добавлен в меню
         * post_name - ярлык, который был у поста при его добавлении в меню
         */
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        // Генерируем строку с CSS-классами элемента меню
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        // функция join превращает массив в строку
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        // Генерируем ID элемента
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        // Генерируем элемент меню
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        // атрибуты элемента, title="", rel="", target="" и href=""
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // ссылка и околоссылочный текст
        $item_output = $args->before;
        $item_output .= '<a class="header-menu__link"'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
register_nav_menu('menu', 'Меню в шапке');

//Добавляем виджет в сайдбар
//register_sidebar(array(
//     				'name' => 'Сайдбар',
//     				'id' => 'sidebar',
//     				'before_widget' => '',
//     				'after_widget'  => '',
//     				'before_title'  => '',
//     				'after_title'   => ''
//                    )
//                );

/**
 * Добавление пагинации
 */
function my_pagenavi() {
       global $wp_query, $wp_rewrite;
       $pages = '';
       $max = $wp_query->max_num_pages;
       if (!$current = get_query_var('paged')) $current = 1;
       $a['base'] = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
       $a['total'] = $max;
       $a['current'] = $current;
       $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
       $a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
       $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
       $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
       $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"
       if ($max > 1) echo '<div class="page-nav">';
       if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
       echo $pages . paginate_links($a);
       if ($max > 1) echo '</div>';
		}
//Добавление функции в шаблон <?php my_pagenavi();

/**
 * Хлебные крошки
 */
function dimox_breadcrumbs() {
$showOnHome = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
$delimiter = '&raquo;'; // разделить между "крошками"
$home = 'Главная'; // текст ссылка "Главная"
$showCurrent = 1; // 1 - показывать название текущей статьи/страницы, 0 - не показывать
$before = '<span>'; // тег перед текущей "крошкой"
$after = '</span>'; // тег после текущей "крошки"
global $post;
$homeLink = get_bloginfo('url');
if (is_home() || is_front_page()) {
if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
} else {
echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
if (is_category()) {
$thisCat = get_category(get_query_var('cat'), false);
if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
echo $before . 'Архив рубрики "' . single_cat_title('', false) . '"' . $after;
} elseif (is_search()) {
echo $before . 'Результаты поиска по запросу "' . get_search_query() . '"' . $after;
} elseif (is_day()) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('d') . $after;
} elseif (is_month()) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('F') . $after;
} elseif (is_year()) {
echo $before . get_the_time('Y') . $after;
} elseif (is_single() && !is_attachment()) {
if (get_post_type() != 'post') {
$post_type = get_post_type_object(get_post_type());
$slug = $post_type->rewrite;
echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
} else {
$cat = get_the_category(); $cat = $cat[0];
$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
echo $cats;
if ($showCurrent == 1) echo $before . get_the_title() . $after;
}
} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
$post_type = get_post_type_object(get_post_type());
echo $before . $post_type->labels->singular_name . $after;
} elseif (is_attachment()) {
$parent = get_post($post->post_parent);
$cat = get_the_category($parent->ID); $cat = $cat[0];
echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
} elseif (is_page() && !$post->post_parent) {
if ($showCurrent == 1) echo $before . get_the_title() . $after;
} elseif (is_page() && $post->post_parent) {
$parent_id  = $post->post_parent;
$breadcrumbs = array();
while ($parent_id) {
$page = get_page($parent_id);
$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
$parent_id  = $page->post_parent;
}
$breadcrumbs = array_reverse($breadcrumbs);
for ($i = 0; $i < count($breadcrumbs); $i++) {
echo $breadcrumbs[$i];
if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
}
if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
} elseif (is_tag()) {
echo $before . 'Записи с тегом "' . single_tag_title('', false) . '"' . $after;
} elseif (is_author()) {
global $author;
$userdata = get_userdata($author);
echo $before . 'Статьи автора ' . $userdata->display_name . $after;
} elseif (is_404()) {
echo $before . 'Error 404' . $after;
}
if (get_query_var('paged')) {
if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
echo __('Page') . ' ' . get_query_var('paged');
if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
}
echo '</div>';
}
} // end dimox_breadcrumbs()

/**
 * Функция получения записи по ID
 *
 * @param $post_id
 *
 * @return bool
 */
function get_the_content_by_id($post_id) {
  $page_data = get_page($post_id);
  if ($page_data) {
    return apply_filters('the_content', $page_data->post_content);
  }
  else return false;
}

/**
 * Вывод номера ID постов в админке
 */
function ssid_column($cols) {
      $cols['ssid'] = 'ID';
      return $cols;
}
function ssid_value($column_name, $id) {
      if ($column_name == 'ssid')
            echo $id;
}
function ssid_return_value($value, $column_name, $id) {
      if ($column_name == 'ssid')
            $value = $id;
      return $value;
}
function ssid_css() {
?>
<style type="text/css">
      #ssid { width: 50px; }
</style>
<?php
}
function ssid_add() {
      add_action('admin_head', 'ssid_css');
      add_filter('manage_posts_columns', 'ssid_column');
      add_action('manage_posts_custom_column', 'ssid_value', 10, 2);
      add_filter('manage_pages_columns', 'ssid_column');
      add_action('manage_pages_custom_column', 'ssid_value', 10, 2);
      add_filter('manage_media_columns', 'ssid_column');
      add_action('manage_media_custom_column', 'ssid_value', 10, 2);
      add_filter('manage_link-manager_columns', 'ssid_column');
      add_action('manage_link_custom_column', 'ssid_value', 10, 2);
      add_action('manage_edit-link-categories_columns', 'ssid_column');
      add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);
      foreach ( get_taxonomies() as $taxonomy ) {
            add_action("manage_edit-${taxonomy}_columns", 'ssid_column');
            add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
      }
      add_action('manage_users_columns', 'ssid_column');
      add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);
      add_action('manage_edit-comments_columns', 'ssid_column');
      add_action('manage_comments_custom_column', 'ssid_value', 10, 2);
}
add_action('admin_init', 'ssid_add');