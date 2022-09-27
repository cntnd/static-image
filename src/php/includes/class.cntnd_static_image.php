<?php

namespace Cntnd\StaticImage;

require_once("class.cntnd_util.php");

/**
 * cntnd_static_image Class
 */
class CntndStaticImage extends CntndUtil
{

    private $lang;
    private $client;
    private $db;
    private $folders = array();
    private $imagetypes = array('jpeg', 'jpg', 'gif', 'png');
    private $uploadDir;
    private $uploadPath;

    function __construct($lang, $client)
    {
        $this->lang = $lang;
        $this->client = $client;
        $this->db = new \cDb;

        $cfgClient = \cRegistry::getClientConfig();
        $this->uploadDir = $cfgClient[$client]["upl"]["htmlpath"];
        $this->uploadPath = $cfgClient[$client]["upl"]["path"];

        // contenido config
        $cfg = \cRegistry::getConfig();

        // folders

        $sql = "SELECT DISTINCT dirname FROM :table WHERE idclient=:idclient ORDER BY dirname ASC";
        $values = array(
            'table' => $cfg['tab']['upl'],
            'idclient' => \cSecurity::toInteger($client)
        );
        $this->db->query($sql, $values);
        while ($this->db->nextRecord()) {
            $this->folders[] = $this->db->f('dirname');
        }

        // endregion
    }

    public function folders()
    {
        return $this->folders;
    }

    public function images($folder)
    {
        // images
        $images = array();
        $cfg = \cRegistry::getConfig();

        $sql = "SELECT * FROM :table WHERE idclient=:idclient AND dirname=':dirname' ORDER BY filename";
        $values = array(
            'table' => $cfg['tab']['upl'],
            'idclient' => \cSecurity::toInteger($this->client),
            'dirname' => \cSecurity::toString($folder)
        );
        $this->db->query($sql, $values);
        while ($this->db->nextRecord()) {
            // Bilder
            if (in_array($this->db->f('filetype'), $this->imagetypes)) {
                //$image = $this->uploadDir . $this->db->f('dirname') . $this->db->f('filename');
                $images[$this->db->f('idupl')] = $this->db->f('filename');
            }
        }
        return $images;
    }

    public function image($image, $folder) {
        return $this->uploadDir . $folder .$image;
    }
}

?>
