# BakeStrap plugin for CakePHP
---------
Make defaults templates using bootstrap when baking
---------
Put the folder in app/plugins (if not working, bake new plugin named BakeStrap and copy the "templates" folder)
---------
use option --theme BakeStrap when baking templates

or add 
"Configure::write('Bake.theme', 'BakeStrap');"
in your app/src/Application.php in fonction bootstrapCli() before loading bake

---------
Feel free to modify templates in BakeStrap/templates/bake/template/ to match your requirements



P'tit Bouchon
