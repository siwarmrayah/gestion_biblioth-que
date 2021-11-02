<?php
/**
 * Initialisation du framework Silex
 
 * @copyright 2017 Telecom SudParis
 * @license    "MIT/X" License - cf. LICENSE file at project root
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// Décommenter ce qui suit pour passer en mode debug
$app['debug'] = true;

// Moteur de template Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/templates',
        'twig.options' => array('debug' => true)
    ));

$app['twig'] = $app->extend('twig', function($twig, $app) {
	$twig->addExtension(new \Twig_Extension_Debug());
            return $twig;
        });

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
            'translator.domains' => array(),
));

// Gestion des "assets"
$app->register( new Silex\Provider\AssetServiceProvider());

// Ajout de la fonction 'path' dans les templates Twig
$app['twig'] = $app->extend('twig', 
    function($twig, $app) 
    {
            $twig->addFunction(new \Twig_SimpleFunction('path', function(...$url) use ($app) {
                 return call_user_func_array(array($app['url_generator'], 'generate'), $url);
            }));
            return $twig;
    });

// Session (pour flashbags)
$app->register(new Silex\Provider\SessionServiceProvider(), array(
  'session.storage.save_path' => __DIR__.'/var'
));

// Formulaires
$app->register(new Silex\Provider\FormServiceProvider());

$app['locale']="fr_FR.UTF-8";

// BD SQLite
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
		'db.options' => array(
				'driver'   => 'pdo_sqlite',
				'path'     => __DIR__.'/agvoy.sqlite',
		),
));

// Changer à true pour obtenir un debug des requêtes SQL
$debug_sql_queries = false;
if ( $app['debug'] && $debug_sql_queries) 
{
    // Gestion d'une pile de messages de debug
    $logger = new Doctrine\DBAL\Logging\DebugStack();
    $app['db.config']->setSQLLogger($logger);
  
    // Installation d'un affichage des requêtes SQL 
    $app->after(
        function(Request $request, Response $response) use ($app, $logger) 
        {
            // S'il n'y a pas de redirection, on affiche sur la sortie
            if($response->getStatusCode() == Response::HTTP_OK) 
            {
                foreach ( $logger->queries as $query ) {
                    $message = $query['sql'];
                    $message .= ' ';
                    $message .= print_r(array(
                                            'params' => $query['params'],
                                            'types' => $query['types']
                                            ), true);
                    echo $message. PHP_EOL;;
                }
            }
            else 
          {
                // Ajout des requêtes en messages flashbag pour après le redirect
                foreach ( $logger->queries as $query ) 
                {    
                    $message = print_r(array($query['sql'], array(
                        'params' => $query['params'],
                        'types' => $query['types']
                    )), true);
                    $app['session']->getFlashBag()->add('message', $message);
                }
            }
    });
                   
}

return $app;
