# Dynacase LESS Installer

## Description

Installer for less parsing tool in php.

You can use the parser in sty files, with rules like that:

 ```
 $sty_rules = array(
    'css' => array(
         'dcp/bootstrap/bootstrap.css' => array(
            "src" => array(
                "ultra"=>"STYLE/LESS_STYLE/Layout/bootstrap.less"
            ),
            "deploy_parser" => array(
                "className" => '\Dcp\Style\dcpLessParser'
            )
        )
    )
 );
 ```
 
The parser used is: https://github.com/oyejorge/less.php

## Licence

Merci de vous référer au fichier [LICENSE](LICENSE) pour connaitre les droits
de modification et de distribution du module et de son code source.

La licence s'applique à l'ensemble des codes source du module. 

Elle prévaut sur toutes licences qui pourraient être mentionnées dans certains
fichiers.
