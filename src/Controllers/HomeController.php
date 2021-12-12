<?php


namespace Plots\Controllers;

use Plots\Exceptions\NotFoundException;
use Plots\Utils\DirectoryAndFilesTrait;
use Plots\Utils\FileUploadTrait;

class HomeController extends AbstractController
{
    use FileUploadTrait;
    use DirectoryAndFilesTrait;

    protected $uploadDirectory;

    protected function setPreliminaryProperties()
    {
        $this->properties['message'] = 'Home  page';
        $this->properties['rootUrl'] = $this->request->getProtocol().$this->request->getDomain();
    }
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws NotFoundException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function homePage()
    {
        $this->setPreliminaryProperties();

        $this->processUploadedFiles();

        $this->listFiles();
        return $this->render('home.twig', $this->properties);
    }

    protected function listFiles(){
        try {
            $this->uploadDirectory = ($this->config->get('data'))['directoryPath'];
        } catch (NotFoundException $e) {
            exit($e->getMessage());
        }
        $this->properties['files'] = $this->list($this->uploadDirectory,1);
    }

    /**
     * @throws NotFoundException
     */
    public function processUploadedFiles():HomeController
    {
        if (
           ! ($this->request
                ->getParams()
                ->has('submitForm')) ||
            ($this->request
                    ->getParams()
                    ->getString('submitForm') !== 'true')
        ){
            return $this;
        }
        $fileName = $this->prepareFileUpload();
        $this->properties = [
            'message' => 'File Uploaded; File name' . $fileName
        ];
        return $this;
    }

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    private function prepareFileUpload()
    {

        $fileName = $_FILES['dataFile']['name'];
        return $fileName;
    }
}