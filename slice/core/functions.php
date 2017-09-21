<?php
/**
 * Created by PhpStorm.
 * User: leonardvujanic
 * Date: 21/09/2017
 * Time: 12:59
 */


# region Helpers

/**
 * @param      $fileName
 * @param null $data
 *
 * @return string
 * @throws Exception
 */
function renderRootFile($fileName, $data = null)
{
    $fileName = SLICE_ROOT . _sanitizeFileName($fileName) . '.php';
    
    if (file_exists($fileName) && is_readable($fileName)) {
        
        if ($data !== null) {
            extract($data, EXTR_OVERWRITE);
        }
        
        ob_start();
        ob_implicit_flush(false);
        
        require $fileName;
        
        return ob_get_clean();
    }
    
    throw new Exception('Missing file : ' . $fileName);
}

/**
 * @param $name
 *
 * @return string
 */
function _sanitizeFileName($name)
{
    return ltrim($name, '/');
}

# endregion

# region WP Like functions

/**
 * @param null $name
 *
 * @throws Exception
 */
function get_header($name = null)
{
    $fileName = 'header';
    
    if ($name !== null) {
        $fileName = $fileName . '-' . $name;
    }
    
    echo renderRootFile($fileName);
}

/**
 * @param null $name
 *
 * @throws Exception
 */
function get_footer($name = null)
{
    $fileName = 'footer';
    
    if ($name !== null) {
        $fileName = $fileName . '-' . $name;
    }
    
    echo renderRootFile($fileName);
}


# endregion

# region Degordian function

/**
 * @param string $url
 *
 * @return string
 * @throws Exception
 */
function bu($url = '')
{
    if (defined('INTERNAL_STATIC_PATH')) {
        return INTERNAL_STATIC_PATH . _sanitizeFileName($url);
    }
    
    $uriChunks = explode('slice', $_SERVER['REQUEST_URI']);
    
    if (count($uriChunks) !== 2) {
        throw new Exception('Invalid uri chunks length');
    }
    
    $internalStaticPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $uriChunks[0] . STATIC_DIR . '/';
    
    define('INTERNAL_STATIC_PATH', $internalStaticPath);
    
    return INTERNAL_STATIC_PATH . _sanitizeFileName($url);
}

/**
 * @param      $partial
 * @param null $data
 * @param bool $return
 *
 * @return string
 * @throws Exception
 */
function get_partial($partial, $data = null, $return = false)
{
    $partial = PARTIALS_DIR . '/' . _sanitizeFileName($partial);
    
    $content = renderRootFile($partial, $data);
    
    if ($return === true) {
        return $content;
    }
    
    echo $content;
}

# endregion




