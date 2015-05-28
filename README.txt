@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.7.1
@since Version 0.2

BLANK THEME

	As you can see by yourself, Basics is not supposed to be used "as is". You could fill the css/author.css file to give your blog its own style. Or you can use a Child Theme.

CHILD THEME

	I recommand you to use a Child Theme - like Beyond Basics - to make your website with Basics in order to minimize the works brought by the updates I could make (and I'll do!). Read the README.txt file of Beyond Basics for more informations.

Thanks to use Basics.

/*-----------------------------------------------------------------------------------*/

@author Régis Robineau

OPTIMISATION CSS

L'optimisation consiste à fusionner en un seul fichier toutes les feuilles de styles appelées par la règle @import, et à les compacter (optimisation du code CSS)

bin/optimize
-> script shell exécutant nodeJS pour lancer l'optimisation

css/css.build.js
-> fichier des paramètres d'optimisation utilisés par r.js

build/css/style.min.css
-> fichier de sortie (css optimisé)

js/libs/r.js
-> librairie require.js
