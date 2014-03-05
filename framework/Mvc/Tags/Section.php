<?php

namespace T4\Mvc\Tags;

use T4\Core\Std;
use T4\Mvc\Application;
use T4\Mvc\Tag;

class Section
    extends Tag
{

    protected function render()
    {
        $id = $this->params->id;
        $app = Application::getInstance();
        $blocks = \App\Models\Block::findAllBySection($id);

        $ret = '<section role="section" data-section-id="' . $id . '">';
        foreach ($blocks as $block) {
            $ret .= '<article role="block" data-block-id="' . $block->getPk() . '">' .
                $app->callBlock($block->path, new Std(json_decode($block->options, true))) .
                '</article>' . "\n";
        }
        return $ret . '</section>' . "\n";
    }

}