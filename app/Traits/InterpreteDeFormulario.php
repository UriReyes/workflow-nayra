<?php

namespace App\Traits;

trait InterpreteDeFormulario
{
    public function interpretar($formJson, $url)
    {
        $proccess_screen = json_decode($formJson, true);
        $screens = json_decode($proccess_screen['config'], true)['screens'];
        $form = "
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css' integrity='sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn' crossorigin='anonymous'>
        <form method='post' action='{$url}'>";
        foreach ($screens as $screen) {
            $items = $screen['config'];
            foreach ($items as $itemPre) {
                foreach ($itemPre['items'] as $item) {
                    // dd($itemPre['items'][1]);
                    $form .= $this->renderizarComponentes($item);
                }
            }
        }
        // $form .= '</form>';
        return $form;
    }

    private function renderizarComponentes($item)
    {
        switch ($item['component']) {
            case 'FileDownload':
                $componente = "<div class='form-group'><a class='form-control' name='{$item["config"]["name"]}'><i class='{$item["config"]["icon"]}'></i>{$item["config"]["label"]}</a></div>";
                return $componente;
                break;
            case 'FormCheckbox':
                $componente = "<div class='form-group form-check'><label class='form-check-label'><input type='hidden' name='{$item["config"]["name"]}' value='off'><input class'form-check-input' name='{$item["config"]["name"]}' type='checkbox'/>{$item["config"]["label"]}</label></div>";
                return $componente;
                break;

            case 'FormButton':
                $componente = "<button class='btn btn-success' type='submit' name='{$item["config"]["name"]}'><i class='{$item["config"]["icon"]}'></i>{$item["config"]["label"]}</button>";
                return $componente;
                break;
            default:
                # code...
                break;
        }
    }
}
