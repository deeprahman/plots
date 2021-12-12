<?php


namespace Plots\Controllers;


use Plots\Models\PlotModel;

class GraphController extends AbstractController
{
    protected $plotModel;
    public function __construct($di, $request)
    {
        parent::__construct($di, $request);
        $this->plotModel = new PlotModel($this->db);
    }

    private $fileName;
    protected function setPreliminaryProperties()
    {
        $this->properties['message'] = 'Graph page';
        $this->properties['rootUrl'] = $this->request->getProtocol().$this->request->getDomain();
    }
    public function graphConfig($fileName)
    {

        $this->setPreliminaryProperties();
        $this->properties['message'] = 'Graph page File Name: ' . $fileName;
        $this->properties['pageIndicator'] = 'graph_config';
        $this->properties['dataFile'] = $fileName;
        // TODO: Lock session.  Should be moved to its own Trait
        $_SESSION['dataFile'] = $fileName; // TODO filter for string
        // TODO: Unlock session
        return $this->render('graph.twig', $this->properties);
    }

    public function graphDisplay()
    {
        if(!isset($_SESSION['dataFile'])){
            $this->properties['message'] = 'No file selected...';
            return $this->render('graph.twig', $this->properties);
        }
        $this->properties['dataFile'] = $_SESSION['dataFile'];
        $this->setPreliminaryProperties();
        $this->properties['message'] = 'Graph Display File Name: ' . $_SESSION['dataFile'];
        $this->properties['pageIndicator'] = 'graph_display';
        $this->properties['graph'] = $this->processGraph();
        return $this->render('graph.twig', $this->properties);
    }

    private function processGraph()
    {
        // TODO: Get variable values from the Super Global
        $params = [
            'index' => $this->request->getParams()->getString('dataframeIndex'),
            'param_1' => $this->request->getParams()->getString('param_1'),
            'param_2' => $this->request->getParams()->getString('param_2'),
            'color_param_2' => $this->request->getParams()->getString('param_2_color'),
            'data_file' => ROOT . '/' . ($this->config->get('data'))['directoryPath'] .'/'. $_SESSION['dataFile']
        ];
        if(($params['index'] === $params['param_1']) || ($params['index'] === $params['param_2'])){
            $this->properties['message'] = 'Index and parameters cannot be the same !!!!!';
            return '';
        }
//        $params = [
//            'index' => 'Date',
//            'param_1' => 'T10Y3M',
//            'param_2' => 'Open',
//            'color_param_2' => 'red',
//            'data_file' => ROOT . '/' . 'DataFiles/stock_data_frome.csv'
//        ];
        $pyPath = ROOT . '/' . ($this->config->get("pythonScript"))["filePath"];
        return $this->plotModel->graph($pyPath,$params);
    }
}