<?php

namespace App\Traits;

trait InterpreteDeFormulario
{
    public function interpretar($formJson, $url, $data = null)
    {
        $proccess_screen = json_decode($formJson, true);

        $formConfiguration = json_decode($proccess_screen['config'], true);
        if (isset($formConfiguration['screens'])) {
            $screens = $formConfiguration['screens'];
        } else {
            $screens = $formConfiguration;
        }
        $form = "
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css' integrity='sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn' crossorigin='anonymous'>
        <form method='post' action='{$url}'>";

        foreach ($screens as $screen) {
            if (isset($screen['config'])) {
                $items = $screen['config'];
            } else {
                $items = $screen;
            }

            foreach ($items['items'] as $item) {
                // dd($item);
                $form .= $this->renderizarComponentes($item, $data);
            }
        }
        // $form .= '</form>';
        return $form;
    }

    private function renderizarComponentes($item, $data)
    {
        $base_configuration = $item["config"];
        switch ($item['component']) {
            case 'FormHtmlViewer':
                $componente = "<div class='form-group'>{$base_configuration['content']}</div>";
                return $componente;
                break;
            case 'FileDownload':
                $componente = "<div class='form-group'><a class='form-control' name='{$base_configuration["name"]}'><i class='{$base_configuration["icon"]}'></i>{$base_configuration["label"]}</a></div>";
                return $componente;
                break;
            case 'FormCheckbox':
                $componente = "<div class='form-group form-check'><label class='form-check-label'><input type='hidden' name='{$base_configuration["name"]}' value='off'><input class'form-check-input' name='{$base_configuration["name"]}' type='checkbox'/>{$base_configuration["label"]}</label></div>";
                return $componente;
                break;

            case 'FormButton':
                $componente = "<button class='btn btn-success' type='submit' name='{$base_configuration["name"]}'><i class='{$base_configuration["icon"]}'></i>{$base_configuration["label"]}</button>";
                return $componente;
                break;
            default:
                # code...
                break;
        }
    }
}
