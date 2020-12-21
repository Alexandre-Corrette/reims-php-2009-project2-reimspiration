<?php
/**
 * This file dispatch routes.
 *
 * PHP version 7
 *
 * @author  Christophe Chapleau <ch.chapleau@gmail.com>
 *
 * @author  Alexandre Corrette <alexandrecorrette@gmail.com>
 *
 * @author  Denis Cîrlan <dkirlan02@gmail.com>
 *
 * @author  Massinta Ait Braham <massinta.aitbraham@gmail.com>
 *
 * @link    https://github.com/WildCodeSchool/reims-php-2009-project2-reimspiration
 *
 */

use App\Controller\HomeController;
use App\Controller\ActivityController;

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $urlPath) {
    /*
     * Homepage
     */
    echo (new HomeController())->index();
} elseif ('/about-us' === $urlPath) {
    /*
     * About us page
     */
    echo (new HomeController())->aboutUs();
} elseif ('/info-covid' === $urlPath) {
    /*
     * Covid informations page
     */
    echo (new HomeController())->covidInfo();

} elseif ('/show' === $urlPath && isset($_GET['id'])) {
    /*
     * Show activity page
     */
    echo (new ActivityController())->read($_GET['id']);
} elseif ('/add' === $urlPath) {
    /*
     * Add activity page
     */
    echo (new ActivityController())->add();
} elseif ('/delete' === $urlPath && isset($_GET['id'])) {
    /*
     * Delete activity page
     */
    echo (new ActivityController())->delete($_GET['id']);
} elseif ('/edit' === $urlPath && isset($_GET['id'])) {
    /*
     * Edit activity page
     */
    echo (new ActivityController())->edit($_GET['id']);
} else {
    /*
     * 404 not found page
     */
    header('HTTP/1.1 404 Not Found');
}
