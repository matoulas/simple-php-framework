<?php
/**
 * Created by Matoulas Thomas
 * Date: 11/24/16
 * Time: 8:34 PM
 */

namespace Api\Models;

use Api\App\DepiaModel,
    Api\App\Response,
    Api\App\DepiaLanguage,
    Api\App\Utils;

class Home extends DepiaModel {
    protected function setModelTable()  {
        $this->table = "home_page";
    }
    
    public function getContent() {
        $type = "i";
        $language = $this->getCurrentLanguage();
        $result = $this->prepareQuery("SELECT content FROM $this->table WHERE lang_code = ?", [$language], $type);

        return $result;
    }

    public function getAdminContent($args = []) {
        $content = $this->prepareQuery("SELECT * FROM $this->table");

        $result = [
            "el" => [],
            "en" => []
        ];

        foreach ($content as $c) {
            $lang = DepiaLanguage::getLanguageLabel($c["lang_code"]);
            $result[$lang] = [
                "id" => $c["id"],
                "content" => $c["content"]
            ];
        }

        $slider = $this->getSliderImages();
        return array_merge(Response::success(), ["data" => $result, "slider" => $slider]);
    }

    public function updateContent($args = []) {
        $response = Response::invalidRequest();
        
        if (isset($args["post"]->id) && isset($args["post"]->content)) {
            if(Utils::isInteger($args["post"]->id)) {
                $type = "si";
                $this->prepareQuery("UPDATE $this->table SET content = ? WHERE id = ?", [$args["post"]->content, $args["post"]->id], $type);
                $response = Response::success();
            }
        }
        
        return $response;
    }

    public function getSliderImages() {
        $type = "s";
        $result = $this->prepareQuery("SELECT * FROM images WHERE section = ?", ['slider'], $type);
        return $result;
    }

    public function getLastNews($limit) {
        $type = "ii";
        $result = $this->prepareQuery("SELECT * FROM news WHERE lang_code = ? LIMIT ? ORDER BY id DESC", [1, $limit], $type);
        return $result;
    }
}
