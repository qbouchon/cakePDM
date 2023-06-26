# BakeStrap plugin for CakePHP
---------
Make defaults templates using bootstrap when baking
---------
Put the folder in app/plugins

use option --theme BakeStrap when baking templates
or add 
"Configure::write('Bake.theme', 'BakeStrap');"
in your app/src/Application.php in fonction bootstrapCli() before loading bake

(deprecated) For modify paginator template add 
$this->loadHelper('Paginator', ['templates' => 'BakeStrap.paginator-templates']); 
to AppView.php (deprecated) 

---------
Feel free to modify templates in BakeStrap/templates/bake/template/ to match your requirements



P'tit Bouchon
