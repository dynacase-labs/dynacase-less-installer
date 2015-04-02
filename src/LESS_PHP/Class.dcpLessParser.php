<?php

namespace Dcp\Style;


class dcpLessParser implements ICssParser
{
    protected $_srcFiles = null;
    protected $_styleConfig = array();
    protected $_options = array();

    /**
     * @param string|string[] $srcFiles path or array of path of source file(s) relative to server root
     * @param array $options array of options
     * @param array $styleConfig full style configuration
     */
    public function __construct($srcFiles, Array $options, Array $styleConfig)
    {
        if (is_array($srcFiles)) {
            $this->_srcFiles = $srcFiles;
        } else {
            $this->_srcFiles = array(
                $srcFiles
            );
        }
        $this->_options = $options;
        $this->_options['cache_dir'] = getTmpDir();
        $this->_options['cache_method'] = 'serialize';
        $this->_styleConfig = $styleConfig;
    }

    /**
     * @param string $destFile destination file path relative to server root (if null, parsed result is returned)
     * @throws Exception
     * @return mixed
     */
    public function gen($destFile = null)
    {
        $pubDir = \ApplicationParameterManager::getScopedParameterValue("CORE_PUBDIR", DEFAULT_PUBDIR);
        $fullTargetPath = $pubDir . DIRECTORY_SEPARATOR . $destFile;
        $fullTargetDirname = dirname($fullTargetPath);
        if (!is_dir($fullTargetDirname) && (false === mkdir($fullTargetDirname, 0777, true))) {
            throw new Exception("STY0005", "$fullTargetDirname dir could not be created for file $destFile");
        }
        $parser = new \Less_Parser($this->_options);
        if (isset($this->_styleConfig["sty_const"]["less_var"])) {
            $parser->ModifyVars($this->_styleConfig["sty_const"]["less_var"]);
        }
        foreach($this->_srcFiles as $srcPath) {
            $srcFullPath = $pubDir . DIRECTORY_SEPARATOR . $srcPath;
            $parser->parseFile($srcFullPath);
        }
        $css = $parser->getCss();
        if (false === file_put_contents($fullTargetPath, $css)) {
                throw new Exception("STY0005", "$fullTargetPath could not be written for file $destFile");
        }
    }
}