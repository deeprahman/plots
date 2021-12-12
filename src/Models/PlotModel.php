<?php


namespace Plots\Models;


class PlotModel extends AbstractModel
{
    /**
     * creates plot
     * @param string $pyPath    file path of the Python script
     * @param array $param  [
     *          index_var => Dataframe Index
     *          param_1 => dataframe colum name
     *          param_1 => dataframe colum name
     *          color_param_2 => dataframe colum name
     * ]
     */
    public function graph($pyPath, array $param):string
    {
        $command_string = "/usr/bin/python3 {$pyPath} {$param["index"]}  {$param["param_1"]} {$param["param_2"]} {$param["color_param_2"]} {$param["data_file"]}";
        $command = escapeshellcmd($command_string);
        echo shell_exec($command);exit;
//        return $output;

    }
}