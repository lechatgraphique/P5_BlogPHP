<?php

namespace App\Libs;

class Pagination {

    private $nbMaxElements;
    private $nbElementsInPage;
    private $currentPage;
    private $content;
    private $url;
    private $innerLinks;
    private $linksSeparator = '...';

    public function setNbMaxElements($int) {
        $this->nbMaxElements = (int) $int;
    }

    public function setNbElementsInPage($int) {
        $this->nbElementsInPage = (int) $int;
    }

    public function setCurrentPage($int) {
        $this->currentPage = (int) $int;
    }

    public function setUrl($string) {
        $this->url = $string;
    }

    public function setInnerLinks($int) {
        $this->innerLinks = (int) $int;
    }

    public function setLinksSeparator($string) {
        $this->linksSeparator = $string;
    }

    public function setContent($array) {
        return $this->content = array_slice($array, ($this->currentPage - 1) * $this->nbElementsInPage, $this->nbElementsInPage);
    }

    public function renderBootstrapPagination() {
        $array_pagination = $this->generateArrayPagination();
        $html = $this->generateHtmlPagination($array_pagination);
        return $html;
    }

    private function generateArrayPagination() {
        $array_pagination = array();
        $keyArray = 0;

        $subLinks = $this->currentPage - $this->innerLinks;
        $nbLastLink = ceil($this->nbMaxElements / $this->nbElementsInPage);

        if ($this->currentPage > 1) {
            $array_pagination[$keyArray++] = '<a class="page-link" href="' . str_replace('{i}', 1, $this->url) . '">1</a>';
        }
        if ($subLinks > 2) {
            $array_pagination[$keyArray++] = '<div class="page-link text-dark">' . $this->linksSeparator . '</div>';
        }
        for ($i = $subLinks; $i < $this->currentPage; $i++) {
            if ($i >= 2) {
                $array_pagination[$keyArray++] = '<a class="page-link" href="' . str_replace('{i}', $i, $this->url) . '">' . $i . '</a>';
            }
        }
        $array_pagination[$keyArray++] = '<div class="page-link text-dark">' . $this->currentPage . '</div>';

        for ($i = ($this->currentPage + 1); $i <= ($this->currentPage + $this->innerLinks); $i++) {
            if ($i < $nbLastLink) {
                $array_pagination[$keyArray++] = '<a class="page-link" href="' . str_replace('{i}', $i, $this->url) . '">' . $i . '</a>';
            }
        }
        if (($this->currentPage + $this->innerLinks) < ($nbLastLink - 1)) {
            $array_pagination[$keyArray++] = '<div class="page-link text-dark">' . $this->linksSeparator . '</div>';
        }
        if ($this->currentPage != $nbLastLink) {
            $array_pagination[$keyArray++] = '<a class="page-link" href="' . str_replace('{i}', $nbLastLink, $this->url) . '">' . $nbLastLink . '</a>';
        }

        return $array_pagination;
    }

    private function generateHtmlPagination($array_pagination) {
        $html = "";
        $html .= '<div';
        $html .= '<ul class="pagination">';
        if ($this->nbMaxElements) {
            foreach ($array_pagination as $v) {
                if ($v == $this->linksSeparator) {
                    $html .= '<li class="page-item disabled"><span>' . $this->linksSeparator . '</span></li>';
                } else if (preg_match("/<b>(.*)<\/b>/i", $v)) {
                    $html .= '<li class="page-item active"><span>' . strip_tags($v) . '</span></li>';
                } else {
                    $html .= '<li class="page-item">' . $v . '</li>';
                }
            }
        } else {
            $html .= '<li class="page-item active"><span>1</span></li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }
}
