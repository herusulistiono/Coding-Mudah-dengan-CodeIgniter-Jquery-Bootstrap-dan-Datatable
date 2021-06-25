<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.php');
//require_once APPPATH . 'third_party/html2pdf/autoload.php';

/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdf extends Dompdf{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public function __construct(){
        parent::__construct();

        //$this->filename = "laporan.pdf";
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream($this->filename, array("Attachment" => false));
    }

    public function createPDF($view, $paper='A4', $orientation='portrait', $data = [] )
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        // Render the PDF
        $this->render();

        // Output the generated PDF to Browser
        $this->stream($this->filename, array("Attachment" => FALSE));
        /*if($download)
            $this->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $this->stream($filename.'.pdf', array('Attachment' => 0));*/
    }
}

/*class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}*/

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */