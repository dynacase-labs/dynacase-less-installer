dynacase-less-installer
=======================

Installer for less parsing tool in php


You can use the parser in sty files, with rules like that :

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